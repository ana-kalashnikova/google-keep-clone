<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../frontend/styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../frontend/script.js"></script>
    <link rel="icon" href="google-keep.png" type="image/ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">  </head>

<body>
  <?php session_start(); ?>
  <nav class="navbar navbar-expand-md navbar-light sticky-top bg-white">
    <a class="navbar-brand"><img src="google-keep.png" alt="logo" width=60 height=60>Keep</a>
    <form class="form-inline">
      <?php
      if (isset($_SESSION['user_name'])){
        echo "<p class='nav-item' style='font-size:20px; position:absolute; top:4px; right:7em;'>".$_SESSION['user_name']."</p>";
      }
      ?>
      <input type="submit" class="btn btn-outline-success my-2 my-sm-0 signout" value="Sign Out">
    </form>
  </nav>

<!-- error_reporting(E_ALL ^ E_NOTICE); -->

<?php
require('keep_connect.php');
?>

<main>
<div class="container-fluid">
   <div class = "d-flex flex-row flex-wrap topNote">
   <?php
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
       if (isset($_POST['postInitial'])){
        $newNote = $_POST['postInitial'];

        if (isset($_SESSION['user_id'])){
          $userId = $_SESSION['user_id'];
        }
        // signin.php is prolly not working cause it's not recognizing $userID
        $addNote = "INSERT INTO notes (note, user_id) VALUES ('$newNote', '$userId')";
        $run = mysqli_query($dbc,$addNote);
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
