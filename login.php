<?php
session_start();
require 'db.php';
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
       <div class="container">
            <div class="row">
               <div class="col-md-6 offset-2 mt-3">
                 <h2>Login Form</h2>
                        <?php
                        $error = "";
                        $error_email ="";
                        $error_password ="";
                        if ($_SERVER['REQUEST_METHOD']=="POST") {
                          if (empty($_POST['user_email'])) {
                            $error_email= "Please Enter Your Email Address";
                          }elseif (empty($_POST['user_password'])) {
                            $error_password = "Please Input Your Password";
                          }else {
                            $user_email = $_POST['user_email'];
                            $user_password = md5($_POST['user_password']);
                            $data_read = "SELECT COUNT(*) AS jakir,email,name,password FROM users1 WHERE email ='$user_email' AND password ='$user_password'";
                            $checking_query = mysqli_query($mysqli_create,$data_read);
                            $result = mysqli_fetch_assoc($checking_query);
                            if ($result['jakir']==1) {
                                $_SESSION['user_logged_email'] = $result['email'];
                                $_SESSION['user_logged_name'] = $result['name'];
                                $_SESSION['user_logged_password'] = $result['password'];
                                header('location: dashboard.php');
                            }else {
                              $error= "Sorry your Email or password invalid";
                            }
                          }

                        }
                         ?>
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                         <div class="mb-3">
                           <label for="exampleInputEmail1" class="form-label">Email address</label>
                           <input type="text" class="form-control" name="user_email" placeholder="Please Input Your Email address">
                           <span style="color:red" ><?php echo $error; echo $error_email; ?></span>
                         </div>
                         <div class="mb-3">
                           <label for="exampleInputPassword1" class="form-label">Password</label>
                           <input type="password" class="form-control" name="user_password" placeholder="Please input a strong password" >
                           <span style="color:red" ><?php  echo $error_password; ?></span>
                         </div>
                         <div class="mb-3 form-check">
                         <button type="submit" class="btn btn-primary">Login</button>
                          <a href="regi.php" class="btn btn-success">Register</a>
                         </form>
               </div>
            </div>
       </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


  </body>
</html>
