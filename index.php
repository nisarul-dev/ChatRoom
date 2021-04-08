<?php
include "chatbox/processes/functions.php";

if(isset($_SESSION['id'])) {
	header("Location: chatbox");
}


if(isset($_POST['login'])) {

    $username = sanitizer($_POST['email']);
    $password = sanitizer($_POST['password']);

    if ($username == null) {
        $error = "Email or Phone Number is empty!";
    } elseif ($password == null) {
        $error = "Password is empty!";
    }


    $phone = substr($username, -9);
    if(!isset($error)) {
      $login_table = $connection->query("SELECT * FROM `users` WHERE (`email`='$username' OR `phn_num` LIKE '%$phone') AND `password`='$password' ");
      $log_in = $login_table->num_rows;
      if($log_in > 0) {
        $login_table_obj = $login_table->fetch_object();
        $_SESSION['id'] = $login_table_obj->usr_id;
        $_SESSION['firstname'] = $login_table_obj->firstname;
        $_SESSION['lastname'] = $login_table_obj->lastname;
        $_SESSION['email'] = $login_table_obj->email;
        $_SESSION['profile_img'] = $login_table_obj->profile_img;
        header("Location: chatbox");
      } else {
        $error = "Email or Phone Number or password is incorrect !";
      }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ChatRoom by Nisarul</title>
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form action="index.php" method="POST">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" value="<?php echo isset($username) && isset($error) ? $username : ""; ?>" id="email" class="form-control" placeholder="Email address or Phone number">
                  </div>
                  <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                  </div>
                  <!-- Errors Printing -->
                  <div class="col-lg-12 mb-4">
                      <small class="text-danger"><?php echo isset($error) ? $error : ""; ?></small>
                  </div>
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                </form>
                <!-- <a href="#!" class="forgot-password-link">Forgot password?</a> -->
                <p class="login-card-footer-text">Don't have an account? <a href="register/register.php" class="text-reset">Register here</a></p>
                <nav class="login-card-footer-nav">
                  <a href="#!">Terms of use.</a>
                  <a href="#!">Privacy policy</a>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
