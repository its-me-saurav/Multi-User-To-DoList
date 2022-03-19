<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['email'])) {
    header("Location: todos.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' OR username='$username'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['email'] = $row['email'];
    $_SESSION['username'] = $row['username'];
		header("Location: todos.php");
	} else {
		echo ("<script LANGUAGE='JavaScript'>
          window. alert('Oops! Email or Password is Wrong.');
          window. location. href='index.php';
        </script>");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
	<link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">
    <title>TO DOLIST</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="POST" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
			  <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <button name="submit" class="btn">Login</button>
            <p class="social-text">Designed and Developed by <a href="https://www.linkedin.com/in/saurav-kumar-66974a195/"> Saurav Kumar</a></p>
          </form>

		  <!-- Registration form -->

          <form action="register.php" method="POST" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" value="<?php echo $_POST['username']; ?>" required>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
			<div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
            </div>
            <button name="submit" class="btn">Register</button>

            <p class="social-text">Designed and Developed by <a href="https://www.linkedin.com/in/saurav-kumar-66974a195/"> Saurav Kumar</a></p>
          </form>
        </div>
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
          <h1 style="color:black; font-family:cursive;">Multi User TO DOList</h1>
          <br>
            <h1>New Here !!!</h1>
            <p>
		        	Create your Free Account to manage your TO DOLIST.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Register
            </button>
          </div>
        </div>
        <div class="panel right-panel">
          <div class="content">
          <h1 style="color:black; font-family:cursive;">Multi User TO DOList</h1>
          <br>
            <h1>One of US !!! </h1>
            <p>
			      Login to store your TO DOLIST.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Login
            </button>
          </div>
      </div>
    </div>


<script>
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
	</script>
  </body>
</html>