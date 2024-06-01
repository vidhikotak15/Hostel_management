const express = require('express');
const bodyParser = require('body-parser');
const jwt = require('jsonwebtoken');
const mysql = require('mysql');
const cors = require('cors')

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
    console.log("hii from server")
    const date = req.body.date;
    const hostel = req.body.hostel;
    const room = req.body.room;
    const issue = req.body.issue;
    const contact = req.body.contact;
    const name = req.body.name;

    // Generate a unique token based on the complaint details
    const token = jwt.sign({ date, hostel, room, issue, contact, name }, 'secret_key');
    console.log('Generated token:', token);

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


app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
