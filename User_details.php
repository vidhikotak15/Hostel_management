<!-- <html> -->
<?php
$con = new mysqli('localhost', 'root', '', 'hostel_user');
$txtName = $_POST['fullname'];
$txtEmail = $_POST['email'];
$txtNumber = $_POST['number'];
$txtPassword = $_POST['password'];

// Check if the user already exists
$checkQuery = "SELECT * FROM `user_details` WHERE `Email`='$txtEmail' OR `Phone_Number`='$txtNumber' OR `Name`='$txtName'";
$result = $con->query($checkQuery);

if ($result->num_rows > 0) {
    // User already exists, display an alert
    echo '<script>alert("User already exists. Please enter different data."); window.location.href = "DormCare_login.html";</script>';
} else {
    // User does not exist, proceed with the insertion
    $sql = "INSERT INTO `user_details` (`Name`, `Email`, `Phone_number`, `Password`) VALUES ('$txtName', '$txtEmail', '$txtNumber' , '$txtPassword');";
    
    if ($con->query($sql) === TRUE) {
        // Data inserted successfully
        header("Location: DormCare_login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>

    <!-- <body>
        
    </body> -->
<!-- </html> -->