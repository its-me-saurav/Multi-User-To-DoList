<?php 
include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION["email"])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo ("<script LANGUAGE='JavaScript'>
                    window. alert('Wow! User Registration Completed.');
                    window. location. href='index.php';
                    </script>");

				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo ("<script LANGUAGE='JavaScript'>
                    window. alert('Oops! Something Wrong Went.');
                    window. location. href='index.php';
                    </script>");
			}
		} else {
			echo ("<script LANGUAGE='JavaScript'>
                    window. alert('Oops! Email Already Exists.');
                    window. location. href='index.php';
                    </script>");
			
		}		
	} else {
		echo ("<script LANGUAGE='JavaScript'>
                    window. alert('Password Not Matched.');
                    window. location. href='index.php';
                    </script>");
	}

}
?>

