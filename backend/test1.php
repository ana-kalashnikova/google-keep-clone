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



<?php require('keep_connect.php');
error_reporting(E_ALL ^ E_NOTICE);
?>
  <nav class="navbar navbar-expand-md navbar-light sticky-top bg-white">
    <a class="navbar-brand"><img src="google-keep.png" alt="logo" width=60 height=60>Keep</a>
    <form class="form-inline">
      <input class="btn btn-outline-success my-2 my-sm-0 signin" type="submit" value="Sign In">
    </form>
  </nav>

<div>
<?php
  //sign in existing use
  $email=$_POST['email'] ??'';
  $password=$_POST['pass'] ?? '';

  //check in DB if this user exists:
  try {
    $userLookup="select email from keep.users where email=$email&&password=$password";
  }catch(Exception $e){
    echo "<p id='error'>Invalid email or password.</p>";
  }
 ?>
<form class="user" action="test1.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
  </div>
  <input type="submit" class="btn btn-primary" value="Sign In">
  <input type="submit" class="btn btn-primary signup" value="Sign Up">
</form>
</div>

<?php
if (!empty($_POST['newUser'])&&!empty($_POST['newEmail'])&&!empty($_POST['newPass'])){
  $newUser=$_POST['newUser'];
  $newEmail=$_POST['newEmail'];
  $newPass=$_POST['newPass'];
}
$addNewUserToUsers="insert into users (user_name, email, password) values ('$newUser', '$newEmail', '$newPass')";
$run=mysqli_query($dbc,$addNewUserToUsers);
$addNewUserToNotes="insert into notes (user_id) values (select user_id from users)";
$run=mysqli_query($dbc,$addNewUserToNotes);

if (!empty($_POST['email'])){
  $currentUserEmail=$_POST['email'];
}
elseif (!empty($_POST['newEmail'])) {
  $currentUserEmail=$_POST['newEmail'];
}
 ?>

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
<input type="submit" class="btn btn-primary userSignIn" value="Sign Up">
</form>

<main>
<div class="container-fluid">
   <div class="d-flex flex-row flex-wrap topNote">
     <?php
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $newNote = $_POST['postInitial'] ?? '';
          // note doesn't get added ?????????????????????????????????????????????????????????
          $addNote="insert into notes (note,user_id) values ('$newNote',(select user_id from users where email='$currentUserEmail'))";
          $run=mysqli_query($dbc,$addNote);
      }
     ?>
      <form class="note" action="test1.php" method="post">
        <textarea name="postInitial" class="init" placeholder="Take a note..."></textarea>
        <input type="submit" value="add note" class="close">
      </form>
    </div>
    <div class="d-flex flex-row flex-wrap insert">
      <?php
      if(!empty($newNote)){
        $displayNote="select note from notes order by note_id desc limit 1";
        $rundisplayNote=mysqli_query($dbc,$displayNote);
      }
      if ($rundisplayNote){
      echo "<div class='d-flex flex-column collection'>
      <form class='formCollection' action='test1.php' method='post'>
      <textarea name='postCollection' class='txtareaCollection'>".$displayNote."</textarea>
      <input type='submit' value='close' class='buttonCollection'></form></div>";
    }
       ?>
    </div>
</div>

</body>
</html>
