<?php
function check_login($dbc, $email = '', $password = ''){

  $userLookup="SELECT user_id, user_name FROM users WHERE email='$email' AND password='$password'";
  $run=mysqli_query($dbc,$userLookup);
  echo mysqli_num_rows($run);
  if ($run){
    $record = mysqli_fetch_array($run,MYSQLI_ASSOC);
    return array (true,$record);
    }
  else{
    $e="<p>Please enter valid username and/or password.</p>";
    $errors[]=$e;
    return array(false,$e);
    }
  }

 function redirect_user ($page = 'test1.php') {
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/' . $page;
	header("Location: $url");
	exit();
  }

?>
