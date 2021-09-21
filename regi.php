  <?php
 require 'db.php';
   ?>
  <!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

      <title>Registration</title>
    </head>
    <body>
         <div class="container">
              <div class="row">
                 <div class="col-md-6 offset-2 mt-3">
                   <h2>Registration Form</h2>
                   <?php
                   $name = $email = $password= "";
                        if ($_SERVER['REQUEST_METHOD']=="POST") {
                          if (empty($_POST['user_name'])) {
                            $name = "Please Enter Your Name is required";
                          }elseif (empty($_POST['user_email'])) {
                            $email = "Plase Input Your Email address is required";
                          } elseif (!filter_var($_POST['user_email'],FILTER_VALIDATE_EMAIL)) {
                            $email= "Plase Input Your Valid Email Address";
                          }
                          elseif (empty($_POST['user_password'])) {
                            $password= "Plase Input Your Password is required";
                          } else {
                            $user_name = $_POST['user_name'];
                            $user_email = $_POST['user_email'];
                            $user_password = md5($_POST['user_password']);

                            $email_check = "SELECT COUNT(*) AS amount FROM users1 WHERE email ='$user_email'";
                            $query_check = mysqli_query($mysqli_create,$email_check);
                            $result1 = mysqli_fetch_assoc($query_check);
                            if ($result1['amount']==1) {
                              echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>This Email Address has been Already Taken!!</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                            }else {
                              $insert_query = "INSERT INTO users1(name, email, password) VALUES ('$user_name','$user_email','$user_password')";
                              if (mysqli_query($mysqli_create,$insert_query)) {
                               echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                               <strong>Registration Successfully!!</strong>
                               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                               </div>';
                              }
                            }


                          }

                        }
                    ?>
                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <div class="mb-3">
                     <label for="exampleInputEmail1" class="form-label">User Name</label> <span style="color:red">*</span>
                     <input type="text" class="form-control" name="user_name" placeholder="Please Enter Your Name">
                     <span style="color:red"><?php echo $name; ?></span>
                          </div>
                           <div class="mb-3">
                             <label for="exampleInputEmail1" class="form-label">Email address</label> <span style="color:red">*</span>
                             <input type="text" class="form-control" name="user_email" placeholder="Please Input Your Email address">
                             <span style="color:red"><?php echo $email; ?></span>
                           </div>
                           <div class="mb-3">
                             <label for="exampleInputPassword1" class="form-label">Password</label> <span style="color:red">*</span>
                             <input type="password" class="form-control" name="user_password" placeholder="Please input a strong password" >
                             <span style="color:red"><?php echo $password; ?></span>
                           </div>
                           <div class="mb-3 form-check">
                           <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="login.php" class="btn btn-success">Login</a>
                           </form>
                 </div>
              </div>
         </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


    </body>
  </html>
