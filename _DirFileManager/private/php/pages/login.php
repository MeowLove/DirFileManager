<?php 
include __DIR__ . '/../../../admin/config.php';
//echo $dfm_userpasswd['guest'];

$dfm_user = 'guest';
$dfm_password = $dfm_userpasswd['guest'];

$dfm_salt = 'vtZLa&fOMe&P0$U^';

// If the cookie is empty, the POST username and password are not empty.
if(isset($_POST['username']) && isset($_POST['password'])) {
    // Verify that the entered password matches
    if(md5($_POST['username'].$_POST['password'].$dfm_salt)===md5($dfm_user.$dfm_password.$dfm_salt)) {
        // Set cookie
        setcookie('verify',md5($dfm_user.$dfm_password.$dfm_salt),time()+86400*30);
        header("location:/");
    } else {
        die('The account or password is incorrect. Please go back and try again!');
    }
}

// Check cookie
if(empty($_COOKIE['verify']) || $_COOKIE['verify']!=md5($dfm_user.$dfm_password.$dfm_salt)) {
    ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login (Unauthorized Access)</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style type="text/css">
* {
  	box-sizing: border-box;
  	font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
  	font-size: 16px;
  	-webkit-font-smoothing: antialiased;
  	-moz-osx-font-smoothing: grayscale;
}
body {
  	background-color: #00000014;
}
.login {
  	width: 400px;
  	background-color: #ffffff;
  	box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
  	margin: 100px auto;
}
.login h1 {
  	text-align: center;
  	color: #5b6574;
  	font-size: 24px;
  	padding: 20px 0 20px 0;
  	border-bottom: 1px solid #dee0e4;
}
.login form {
  	display: flex;
  	flex-wrap: wrap;
  	justify-content: center;
  	padding-top: 20px;
}
.login form label {
  	display: flex;
  	justify-content: center;
  	align-items: center;
  	width: 50px;
  	height: 50px;
  	background-color: #6000ff;
  	color: #ffffff;
}
.login form input[type="password"], .login form input[type="text"] {
  	width: 310px;
  	height: 50px;
  	border: 1px solid #dee0e4;
  	margin-bottom: 20px;
  	padding: 0 15px;
}
.login form input[type="submit"] {
  	width: 100%;
  	padding: 15px;
 	margin-top: 20px;
  	background-color: #6000ff;
  	border: 0;
  	cursor: pointer;
  	font-weight: bold;
  	color: #ffffff;
  	transition: background-color 0.2s;
}
.login form input[type="submit"]:hover {
	background-color: #00ff41f5;
  	transition: background-color 0.2s;
}
#pw-error {
	color: red;
	margin-top: 5px;
	margin-bottom: -20px;
	text-align:center;
}
    </style>
	</head>
	<body>
		<div class="login">
			<h1>Login (Unauthorized Access)</h1>
			<form action="/" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
            <p id="pw-error">Oops! You are not logged in~</p>
			<script>setTimeout(function() {document.getElementById("pw-error").style.display = "none"}, 1500);</script>
	</body>
</html>
    <?php
    die(1);
}

?>