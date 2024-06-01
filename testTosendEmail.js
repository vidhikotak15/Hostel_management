const http = require("http");
const nodemailer = require("nodemailer");

const server = http.createServer((req, res) => {
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
        to: "vidhi.kce21@sot.pdpu.ac.in",
        subject: "test mail",
        text: "this is a text mail from vidhi"
    };

    auth.sendMail(receiver, (error, emailResponse) => {
        if (error) {
            throw error;
        }
        console.log("success");
        res.end();
    });
});

server.listen(8080);
