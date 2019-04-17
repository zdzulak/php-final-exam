<?php
ob_start();
  require('db.php');
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM journal WHERE email = :email;";

  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $user = $stmt->fetch();

if ($user && password_verify($password, $user['password']))
{

    session_start();

    $_SESSION['user_id'] = $user['user_id'];

    header('location:entries.php');
}

else {
    echo "invalid";
    exit();
}

  $cmd->closeCursor();


ob_flush();
?>
