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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  </head>
<body>
<!-- error_reporting(E_ALL ^ E_NOTICE); -->

  <nav class="navbar navbar-expand-md navbar-light sticky-top bg-white">
    <a class="navbar-brand"><img src="google-keep.png" alt="logo" width=60 height=60>Keep</a>
    <form class="form-inline signin">
      <button class="btn btn-outline-success my-2 my-sm-0">Sign In</button>
    </form>
  </nav>

  <!-- Not sure if you wanna include the note form below on the sign in page. I think it's fine if we take it out. Delete it if you don't think we need it.  -->
  <form class="note" action="test1.php" method="post">
    <textarea name="postInitial" class="init" placeholder="Take a note..."></textarea>
    <input type="submit" value="add note" class="close">
  </form>

  <?php
  //sign in existing user
  if ($_SERVER['REQUEST_METHOD']=='POST'){
    require('keep_connect.php');
    require('funct.php');
    if (isset($_POST['email'])&&isset($_POST['pass'])){

    list ($check, $record) = check_login($dbc, $_POST['email'], $_POST['pass']);

    if ($check){
      session_start();
      $_SESSION['user_id']=$record['user_id'];
      $_SESSION['user_name']=$record['user_name'];
      redirect_user();
    }else{
      echo "Email and password do not match those on file.";
    }
  }
  mysqli_close($dbc);
}
  ?>

  <form action="test1.php" method="post" class="signinForm">
    <p><strong>Please sign in to your account</strong></p>
    <div class="form-group">
      <label for="Email">Email address</label>
      <input type="email" name="email" class="form-control" placeholder="Enter email address">
    </div>
    <div class="form-group">
      <label for="Password">Password</label>
      <input type="password" name="pass" class="form-control" placeholder="Enter your password">
    </div>
    <p id="PsigninForm">If you don't have an account, sign up below</p>
    <input type="submit" class="btn btn-primary" value="Sign In">
    <a href="signup.php" class="btn btn-primary">Sign Up</a>
  </form>





</body>
</html>
