<!DOCTYPE html>
<html>
<head>
	<title>LOGIN I-Present | By USIM MOBILE</title>
	<link rel="icon" type="image/png" href="./logo.jpg">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="bubbles-container">
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
</div>

     <form action="login.php" method="post">
	 <div class="center">
        <div class="image-container">
            <img src="https://usimmobile.usim.edu.my/student/img/512x512-icon.png" alt="Avatar" class="avatar">
</div>
</div>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Username</label>
     	<input type="int" name="uname" placeholder="Your Matric Number"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Your i-Student Password"><br>
		
     	<button class="login-btn" type="submit"name="login">Login</button>
     </form>
</body>
</html>