<?php
$page_title = 'Saving your Registration...';
require_once ('header.php');

// store the inputs into variables
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validation
if (empty($email)) {
    echo 'Email is required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

if ($ok) {
    // connect
    require_once ('db.php');

    // set up the sql insert
    $sql = "INSERT INTO journal (email, password) VALUES (:email, :password)";

    // hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // fill the params and execute
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':email', $email);
    $cmd->bindParam(':password', $hashed_password);
    $cmd->execute();

    // disconnect
    $conn = null;

    echo 'Your registration was successful.  Click to <a href="login.php">Log In</a>';
}

require_once ('footer.php');
?>
