<?php
 session_start();
 if (!isset($_SESSION['user_logged_name'])) {
   header('location: login.php');
 }
 ?>
<h2>Hello! <?php echo $_SESSION['user_logged_name']; ?></h2> <br>
<h2>Your Email is! <?php echo $_SESSION['user_logged_email']; ?></h2> <br>
<h2>Your Email is! <?php echo $_SESSION['user_logged_password']; ?></h2> <br>
