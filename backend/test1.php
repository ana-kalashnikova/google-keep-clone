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
// error_reporting(E_ALL ^ E_NOTICE);
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
  if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['email'])&&isset($_POST['pass'])){
      $email=$_POST['email'];
      $password=$_POST['pass'];
      //check in DB if this user exists:
      try {
        $userLookup="select email from users where email=$email&&password=$password";
      }catch(Exception $e){
        echo "<p id='error'>Invalid email or password.</p>";
      }
    }
  }

  // $email=$_POST['email'] ??'';
  // $password=$_POST['pass'] ?? '';

 ?>
<form class="user" action="test1.php" method="post">
  <div class="form-group">
    <label for="Email">Email address</label>
    <input type="email" name="email" class="form-control" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" name="pass" class="form-control" placeholder="Enter your password">
  </div>
  <input type="submit" class="btn btn-primary" value="Sign In">
  <input type="submit" class="btn btn-primary signup" value="Sign Up">
</form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
  if (isset($_POST['newUser'])&&isset($_POST['newEmail'])&&isset($_POST['newPass'])){
    $newUser=$_POST['newUser'];
    $newEmail=$_POST['newEmail'];
    $newPass=$_POST['newPass'];

    $addNewUserToUsers="insert into users (user_name, email, password) values ('$newUser', '$newEmail', '$newPass')";
    $run=mysqli_query($dbc,$addNewUserToUsers);

  }

}
 ?>
<div class="blur">
  <form class="register" action="test1.php" method="post">
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
</div>


<main>
<div class="container-fluid">
   <div class="d-flex flex-row flex-wrap topNote">
     <?php
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
         if (isset($_POST['postInitial'])){
          $newNote = $_POST['postInitial'];

// user_id doesn't get added ?

          if (isset($_POST['email'])){
            $currentUserEmail=$_POST['email'];
          }
          elseif (isset($_POST['newEmail'])) {
            $currentUserEmail=$_POST['newEmail'];
          }

          $addNote="insert into notes (note,user_id) values ('$newNote',(select user_id from users where email='$currentUserEmail'))";
          $run=mysqli_query($dbc,$addNote);
        }
      }
     ?>
      <form class="note" action="test1.php" method="post">
        <textarea name="postInitial" class="init" placeholder="Take a note..."></textarea>
        <input type="submit" value="add note" class="close">
      </form>
    </div>
    <div class="d-flex flex-row flex-wrap insert">
      <?php
      if(isset($newNote)){
        $displayNote="select note from notes order by note_id desc limit 1";
        $rundisplayNote=mysqli_query($dbc,$displayNote);

        if ($rundisplayNote){
          $notes_array=mysqli_fetch_array($rundisplayNote,MYSQLI_NUM);
          echo "<div class='d-flex flex-column collection'>
          <form class='formCollection' action='test1.php' method='post'>
          <textarea name='postCollection' class='txtareaCollection'>".$notes_array[0]."</textarea>
          <input type='submit' value='close' class='buttonCollection'></form></div>";
        }
      }
       ?>
    </div>
</div>
<?php mysqli_close($dbc); ?>
</body>
</html>
