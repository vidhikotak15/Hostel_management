<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Complaints</title>
    <link rel="stylesheet" href="complaint.css">
    <script>
        function signOut() {
            // Redirect to the login page
            window.location.href = 'DormCare_login.html';
        }
    </script>
</head>
<body>
    <header>
    <button class="button-like-a" onclick="signOut()">Sign Out</button>
        <h1 id="heading">DORMCARE</h1>
    </header>
    <h1>Registered Complaints</h1>

    <?php

    $con = new mysqli('localhost', 'root', '','hostel_user');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['delete'])) {
    $issueToDelete = $_POST['delete']; // Issue to delete
    $phone_numberToDelete = $_POST['phone_number']; // Phone_number to delete

    // Ensure the values are properly escaped to prevent SQL injection
    $issueToDelete = $con->real_escape_string($issueToDelete);
    $phone_numberToDelete = $con->real_escape_string($phone_numberToDelete);

    $sqlDelete = "DELETE FROM plumb_complaints WHERE Issue = '$issueToDelete' AND Phone_number = '$phone_numberToDelete'";
    if ($con->query($sqlDelete) === TRUE) {
        // Row deleted successfully
        echo "Record deleted successfully.\n";
    } else {
        echo "Error deleting record: " . $con->error;
    }
}

if (isset($_POST['delete2'])) {
    $issueToDelete = $_POST['delete2']; // Issue to delete
    $phone_numberToDelete = $_POST['phone_number']; // Phone_number to delete

    // Ensure the values are properly escaped to prevent SQL injection
    $issueToDelete = $con->real_escape_string($issueToDelete);
    $phone_numberToDelete = $con->real_escape_string($phone_numberToDelete);

    $sqlDelete = "DELETE FROM electrician_complaints WHERE Issue = '$issueToDelete' AND Phone_number = '$phone_numberToDelete'";
    if ($con->query($sqlDelete) === TRUE) {
        // Row deleted successfully
        echo "Record deleted successfully.\n";
    } else {
        echo "Error deleting record: " . $con->error;
    }
}

if (isset($_POST['delete3'])) {
    $issueToDelete = $_POST['delete3']; // Issue to delete
    $phone_numberToDelete = $_POST['phone_number']; // Phone_number to delete

    // Ensure the values are properly escaped to prevent SQL injection
    $issueToDelete = $con->real_escape_string($issueToDelete);
    $phone_numberToDelete = $con->real_escape_string($phone_numberToDelete);

    $sqlDelete = "DELETE FROM carpenter_complaints WHERE Issue = '$issueToDelete' AND Phone_number = '$phone_numberToDelete'";
    if ($con->query($sqlDelete) === TRUE) {
        // Row deleted successfully
        echo "Record deleted successfully.\n";
    } else {
        echo "Error deleting record: " . $con->error;
    }
}

$tableName = "plumb_complaints";

// SQL query to select all rows from the specified table
$sql = "SELECT * FROM $tableName";

// Execute the query
$result = $con->query($sql);

if ($result) {
    echo "<b>Plumber Complaints</b><br>";
    if ($result->num_rows > 0) {
        echo "<form method='post'>";
        echo "<table border='1'>";
        echo "<tr>
        <th>Date</th><th>Hostel_block</th><th>Room_number</th><th>Issue</th><th>Phone_number</th><th>Name</th><th>Action</th>
        </tr>"; // Adjust column headers as per your table structure

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Date"] . "</td><td>" . $row["Hostel_block"] . "</td><td>" . $row["Room_number"] . "</td><td>" . $row["Issue"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . $row["Name"] . "</td>";
            echo "<input type='hidden' name='phone_number' value='" . $row["Phone_number"] . "'>";
            echo "<td><button type='submit' name='delete' value='" . $row["Issue"] . "'>Resolve</button></td>";
            echo "</tr>"; // Adjust column names accordingly
        }
        echo "</table>";
        echo "</form>";
    } 
    else {
        echo "No records found in the table.";
    }
}
echo "<br><br>";
$tableName2 = "electrician_complaints";

// SQL query to select all rows from the specified table
$sql = "SELECT * FROM $tableName2";

// Execute the query
$result = $con->query($sql);

if ($result) {
    echo "<b>Electrician Complaints</b><br>";
    if ($result->num_rows > 0) {
        echo "<form method='post'>";
        echo "<table border='1'>";
        echo "<tr>
        <th>Date</th><th>Hostel_block</th><th>Room_number</th><th>Issue</th><th>Phone_number</th><th>Name</th><th>Action</th>
        </tr>"; // Adjust column headers as per your table structure

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Date"] . "</td><td>" . $row["Hostel_block"] . "</td><td>" . $row["Room_number"] . "</td><td>" . $row["Issue"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . $row["Name"] . "</td>";
            echo "<input type='hidden' name='phone_number' value='" . $row["Phone_number"] . "'>";
            echo "<td><button type='submit' name='delete2' value='" . $row["Issue"] . "'>Resolve</button></td>";
            echo "</tr>"; // Adjust column names accordingly
        }
        echo "</table>";
        echo "</form>";
    } 
    else {
        echo "No records found in the table.";
    }
}
echo "<br><br>";
$tableName3 = "carpenter_complaints";

// SQL query to select all rows from the specified table
$sql = "SELECT * FROM $tableName3";

// Execute the query
$result = $con->query($sql);

if ($result) {
    echo "<b>Carpenter Complaints</b><br>";
    if ($result->num_rows > 0) {
        echo "<form method='post'>";
        echo "<table border='1'>";
        echo "<tr>
        <th>Date</th><th>Hostel_block</th><th>Room_number</th><th>Issue</th><th>Phone_number</th><th>Name</th><th>Action</th>
        </tr>"; // Adjust column headers as per your table structure

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Date"] . "</td><td>" . $row["Hostel_block"] . "</td><td>" . $row["Room_number"] . "</td><td>" . $row["Issue"] . "</td><td>" . $row["Phone_number"] . "</td><td>" . $row["Name"] . "</td>";
            echo "<input type='hidden' name='phone_number' value='" . $row["Phone_number"] . "'>";
            echo "<td><button type='submit' name='delete3' value='" . $row["Issue"] . "'>Resolve</button></td>";
            echo "</tr>"; // Adjust column names accordingly
        }
        echo "</table>";
        echo "</form>";
    } 
    else {
        echo "No records found in the table.";
    }
}
    else {
    echo "Error: " . $con->error;
    }
    ?>
    <!-- <footer>
        <p>&copy; <span id="footer-year"></span> DormCare. All rights reserved.</p>
    </footer> -->
</body>
</html>
