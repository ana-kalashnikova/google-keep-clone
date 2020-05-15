<?php
function check_login($dbc, $email = '', $password = ''){
  require('keep_connect.php');
  $userLookup = "SELECT user_id, user_name FROM users WHERE email='$email' AND password=SHA1('$password')";
  $run = mysqli_query($dbc,$userLookup);

  $result = mysqli_fetch_array($run,MYSQLI_ASSOC);
  echo "{$result['user_id']},{$result['user_name']}";

  if (mysqli_num_rows($run) == 1){
    $record = mysqli_fetch_array($run,MYSQLI_ASSOC);
    return array (true,$record);
  }
  else{
    $e = "<p>Please enter valid username and/or password.</p>";
    $errors[] = $e;
    return array(false,$e);
  }
}
 ?>
