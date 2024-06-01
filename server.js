const express = require('express');
const bodyParser = require('body-parser');
const jwt = require('jsonwebtoken');
const mysql = require('mysql');
const cors = require('cors')
const nodemailer = require('nodemailer');
const fs = require('fs');
const path = require('path');

const app = express();
const port = 3000; // Use a different port than the MySQL port

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(cors());

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '', // Provide your MySQL password if it's set
    database: 'hostel_user' // Update with your database name
});

connection.connect((err) => {
    if (err) {
        console.error('Error connecting to database:', err);
        return;
    }
    console.log('Connected to database');
});

app.post('/register', (req, res) => {
    const date = req.body.date;
    const hostel = req.body.hostel;
    const room = req.body.room;
    const issue = req.body.issue;
    const contact = req.body.contact;
    const name = req.body.name;

    // Generate a unique token based on the complaint details
    const token = jwt.sign({ date, hostel, room, issue, contact, name }, 'secret_key');
    //console.log('Generated token:', token);

    // Save complaint to the database
    const sql = `INSERT INTO plumb_complaints (Date, Hostel_block, Room_number, Issue, Phone_number, Name, Token) 
                VALUES (?, ?, ?, ?, ?, ?, ?)`;
    const values = [date, hostel, room, issue, contact, name, token];

    connection.query(sql, values, (err, result) => {
        if (err) {
            console.error('Error registering complaint:', err);
            return res.json({ msg: date });
        }

        console.log('Complaint registered successfully');

        // Send a success response without sending the token back
        // res.status(200).send('Complaint registered successfully');
        res.json({
            msg: "successful 👍"
        })
    });
});

app.get('/get-complaints', (req, res) => {
    const sql = 'SELECT * FROM plumb_complaints';

    connection.query(sql, (err, results) => {
        if (err) {
            console.log("error in fetching complaints", err);
            return res.status(500).json({ error: 'internal server error' });
        }
        res.send(JSON.stringify(results));
    });
});

app.route('/send-complaint')

    .get((req, res) => {
        const issueToDelete = req.query.issue;
        const phoneNumbertoDelete = req.query.phone;

        const sql = `
            SELECT pc.Token, ud.Email 
            FROM plumb_complaints pc
            JOIN user_details ud ON pc.Phone_number = ud.Phone_number
            WHERE pc.Issue = ? AND pc.Phone_number = ?`;

        connection.query(sql, [issueToDelete, phoneNumbertoDelete], (err, results) => {
            if (err) {
                console.error('Error fetching complaint details:', err);
                return res.status(500).json({ error: 'internal server error' });
            }

            if (results.length === 0) {
                return res.status(404).json({ error: 'complaint not found' });
            }

            const { Token: token, Email: email } = results[0];

            const confirmationLink = `http://localhost:3000/confirm-deletion?token=${token}`;

            const message = `
            <p>Complaint Details:</p>
            <p>Issue: ${issueToDelete}</p>
            <p>Phone number: ${phoneNumbertoDelete}</p>
            <a href="${confirmationLink}">${confirmationLink}</a>
        `;

            const auth = nodemailer.createTransport({
                service: "gmail",
                secure: true,
                port: 465,
                auth: {
                    user: "vidhi.d.kotak@gmail.com",
                    pass: "neiuojawjseciuzd"
                }
            });

            const receiver = {
                from: "vidhi.d.kotak@gmail.com",
                to: email,
                subject: "test mail for hostel",
                html: message
            };

            auth.sendMail(receiver, (error, emailResponse) => {
                if (error) {
                    console.log("error to send email ");
                    return res.status(500).json({ error: 'error sending email' });
                }
                console.log("Email sent successfully");
                res.status(200).json({ message: 'email sent' });
            });

        });
    })

app.get('/confirm-deletion', (req, res) => {
    const token = req.query.token;

    // Read the HTML file
    fs.readFile(path.join(__dirname, 'confirmDeletion.html'), 'utf8', (err, html) => {
        if (err) {
            console.error('Error reading HTML file:', err);
            return res.status(500).send('Internal server error');
        }

        // Replace the token placeholder with the actual token value
        const modifiedHtml = html.replace('{{ token }}', token);

        // Send the modified HTML as the response
        res.send(modifiedHtml);
    });
});


app.post('/confirm-deletion', (req, res) => {
    const token = req.body.token;
    const confirmed = req.body.confirmation === 'yes';
    if (confirmed) {
        // Execute deletion operation on the server
        deleteRecord(token, res);
    } else {
        // User canceled deletion, handle accordingly
        res.status(200).json({ message: 'Deletion cancelled' });
    }
});

const deleteRecord = (token, res) => {
    // Implement your logic here to delete the record from the database using the provided token
    // For example, you might execute a SQL DELETE query based on the token
    const sql = 'DELETE FROM plumb_complaints WHERE token = ?';
    connection.query(sql, [token], (err, result) => {
        if (err) {
            console.error('Error deleting record:', err);
            return res.status(500).json({ error: 'complaint not deleted' });
            // Handle error appropriately
        }
        if (result.affectedRows > 0) {
            res.sendFile('DisplayComplain.html', { root: __dirname }); // Redirect to DisplayComplain.html after successful deletion
        } else {
            res.status(404).json({ error: 'complaint not found' });
        }
    });
};


app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});