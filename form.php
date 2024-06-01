<?php
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
if (empty($name)) {
    echo "Name is required.";
} elseif (preg_match("/^[a-zA-Z ]{2,50}$/", $name)) {
    echo "Name is valid.";
} else {
    echo "Name is not valid.";
}
echo "<br>";

if (empty($email)) {
    echo "Email is required.";
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email is valid.";
} else {
    echo "Email is not valid.";
}
echo "<br>";
if (empty($password)) {
    echo "Password is required.";
} elseif (preg_match("/^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{4,}$/", $password)) {
    echo "Password is valid.";
} else {
    echo "Password is not valid.";
}
?>