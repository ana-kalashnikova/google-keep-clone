<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="icon" href="google-keep.png" type="image/ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">  </head>
<body>
  <nav class="navbar navbar-expand-md navbar-light sticky-top bg-white">
    <a class="navbar-brand"><img src="google-keep.png" alt="logo" width=60 height=60>Keep</a>
  </nav>
<?php
require('keep_connect.php');
if ($_SERVER['REQUEST_METHOD']=='POST'){
  if (isset($_POST['newUser'])&&isset($_POST['newEmail'])&&isset($_POST['newPass'])){
    $tryName=$_POST['newUser'];
    $checkUserName="select user_name from users where user_name='$tryName'";
    $run=mysqli_query($dbc,$checkUserName);
    if (mysqli_num_rows($run)==0){
      $newUser=$_POST['newUser'];

      $email=$_POST['newEmail'];
      $password=$_POST['newPass'];

      $addNewUserToUsers="insert into users (user_name, email, password) values ('$newUser', '$email', sha1('$password'))";
      $run=mysqli_query($dbc,$addNewUserToUsers);
      echo "<p id='userNameAccepted'>Thank you! <br /> You've registered!</p>";
      header("Refresh:3, URL=signin.php");
    }else{
      echo "<p id='userNameError'>This username already exists, please choose a different username.</p>";
    }
  }
}
mysqli_close($dbc);
 ?>
  <form class="register" action="signup.php" method="post">
  <div class="form-group">
    <label for="UserName">User name</label>
    <input type="text" name="newUser" class="form-control" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="Email">Email address</label>
    <input type="email" name="newEmail" class="form-control" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" name="newPass" class="form-control" placeholder="Enter your password">
  </div>
  <input type="submit" class="btn btn-primary userSignUp" value="Sign Up">
  </form>


 </body>
 </html>
