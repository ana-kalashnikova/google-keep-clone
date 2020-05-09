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
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light sticky-top bg-white">
  <a class="navbar-brand"><img src="google-keep.png" alt="logo" width=60 height=60>Keep</a>
  <form class="form-inline">
    <button class="btn btn-outline-success my-2 my-sm-0 signin" type="submit" onclick="signin">Sign In</button>

  </form>
</nav>

<div>
  <form class="user" action="test1.php" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Sign In</button>
    <button type="submit" class="btn btn-primary signup">Sign Up</button>
  </form>
</div>

<form class="register" action="test1.php" method="post">
  <div class="form-group">
    <label for="exampleInputUser1">User name</label>
    <input type="text" name="newUser" class="form-control" id="exampleInputUser1" aria-describedby="emailHelp" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="newEmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="newPass" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
  </div>
  <button type="submit" class="btn btn-primary userSignIn">Sign Up</button>
</form>

<main>

  <div class="container-fluid">
     <div class="d-flex flex-row flex-wrap topNote">
          <form class="note" action="test1.php" method="post">
            <textarea name="init" class="init" placeholder="Take a note..."></textarea>
            <button type="submit" id="close">close</button>
          </form>
      </div>

      <div class="d-flex flex-row flex-wrap  insert">
        <?php
        if(!empty($newNote)){
          echo $newNote;
          echo "<div class='d-flex flex-column collection'><form class='formCollection' action='test1.php' method='post'><textarea name='form-control collection' class='txtareaCollection'>".$newNote."</textarea><button type='submit' id='buttonCollection'>close</button></form></div>";
        }
         ?>
      </div>
  </div>
</main>
<?php
define('db_user','root');
define('db_password','');
define('db_host','localhost');
define('db_name','keep');
$dbc=mysqli_connect(db_host,db_user,db_password,db_name) or die ('Could not connect to MySQL'.mysqli_connect_error());


//sign in existing user
if (isset($_POST['email'])){
  $email=$_POST['email'];
}
if (isset($_POST['pass'])){
  $password=$_POST['pass'];
}
//chech in DB if this user exists:
try {
  $userLookup="select email from keep.users where email=$email&&password=$password";
}catch(Exception $e){
  echo "<p id='error'>Invalid email or password.</p>";
}

//sign up new user
if (isset($_POST['newUser'])&&isset($_POST['newEmail'])&&isset($_POST['newPass'])){
  $newUser=$_POST['newUser'];
  $newEmail=$_POST['newEmail'];
  $newPass=$_POST['newPass'];
}

//set variable for current user:
if (isset($_POST['email'])){
  $currentUserEmail=$_POST['email'];
}
elseif (isset($_POST['newEmail'])) {
  $currentUserEmail=$_POST['newEmail'];
}
//add notes:
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(!empty($_POST['init'])){
    $newNote = $_POST['init'];
  }
}

?>
  </body>
</html>
