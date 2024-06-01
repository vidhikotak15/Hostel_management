<?php
$con = new mysqli('localhost', 'root', '','hostel_user');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
    $date = $_POST["date"];
    $hostel = $_POST["hostel"];
    $room = $_POST["room"];
    $issue = $_POST["issue"];
    $contact = $_POST["contact"];
    $name = $_POST["name"];

    $sql = "INSERT INTO `electrician_complaints` (`Date`, `Hostel_block`, `Room_number`, `Issue`, `Phone_number`, `Name`) VALUES ('$date', '$hostel', '$room', '$issue', '$contact', '$name');";
    if ($con->query($sql) === TRUE) {
        // echo "<script>window.location = 'Thank_you.html';</script>";
        // header("Location: Thank_you.html");
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
?>