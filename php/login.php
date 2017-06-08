<?php
session_start();
$_SESSION['time'] = time();

$username = $_POST["username"];
$password = $_POST["password"];

include_once("connect.php");
$dbh = ConnectDB();

$query = "SELECT `userID`,`password`,`email`,`role`
          FROM `users`
          WHERE `username`=:username";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':username',$username);
$stmt->execute() or die("Failed!");
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);

$userID;
$email;
$dbpass;
$role;

foreach($result as $obj){ //There's only one but idk how to get it otherwise
    $userID = $obj['userID'];
    $email = $obj['email'];
    $dbpass = $obj['password'];
    $role = $obj['role'];
}
if(password_verify($password, $dbpass)){
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['userID'] = $userID;
    $_SESSION{'role'] = $role;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
   <title>Login</title>
   <meta http-equiv="Content-Type" content="application/xhtml_xml; charset=UTF-8" />
   <meta name="Author" content="Michael Crinite" />
   <meta name="generator" content="vi" />

 </head>
 <body>
<?php
    echo "<script>location.href='../Pages/userprofile.html';</script>";
}else{
    echo "<p>Incorrect Password</p>";
}

$stmt = null;

?>
</body>
