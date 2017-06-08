<?php
session_start();

$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

$hash = password_hash($password);

include_once("connect.php");
$dbh = ConnectDB();

$query = "INSERT into `users`
          (username, password, email)
          values (:username,:password,:email)";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $hash);
$stmt->bindParam(':email', $email);
$stmt->execute() or die("Failed");
$stmt = null;

//Could use include instead
$query = "SELECT `userID`
          FROM `users`
          WHERE `username`=:username";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':username',$username);
$stmt->execute() or die("Failed!");
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);

$userID;

foreach($result as $obj){
    $userID = $obj['userID'];
}

$_SESSION['username'] = $username;
$_SESSION['email'] = $email; //just in case
$_SESSION['userID'] = $userID;
//User is now logged in as well

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>User Creation</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="Author" content="Michael Crinite" />
  <meta name="generator" content="vi" />  
</head>
<body>
<?php

echo "<script>location.href='../pages/userprofile.html';
      </script>";
$stmt = null;
?>
</body>
