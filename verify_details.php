<?php
$con = new mysqli('localhost', 'root', '', 'hostel_user');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $txtName = $_POST['username'];
    $txtPassword = $_POST['password'];

    // Query the database
    $sql = "SELECT Name, Password FROM user_details WHERE Name = '$txtName'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row["Password"];

        // Verify the entered password against the stored hashed password
        if ($txtPassword == $storedPassword) {
            if ($txtPassword == "123" && $txtName == "Admin") {
                header("Location: DisplayComplain.html");
                exit();
            } else {
                header("Location: Complaints.html");
                exit();
            }
        } else {
            // Incorrect password, show alert
            echo '<script>alert("Incorrect password");</script>';
        }
    } else {
        // Username not found, show alert
        echo '<script>alert("Username not found");</script>';
    }
}
?>
