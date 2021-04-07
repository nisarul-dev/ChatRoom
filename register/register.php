<?php
include "../chatbox/processes/functions.php";

if(isset($_SESSION['id'])) {
	header("Location: ../chatbox");
}


if(isset($_POST['registration-submit'])) {
    $firstname = sanitizer($_POST['firstname']);
    $lastname = sanitizer($_POST['lastname']);
    $email = sanitizer($_POST['email']);
    $country_code = sanitizer($_POST['countryCode']);
    $phn_num = ( $country_code == '+880' ? ltrim( sanitizer($_POST['phone']), '0') : sanitizer($_POST['phone']) );
    $password = sanitizer($_POST['password']);
    $password_confirmation = sanitizer($_POST['passwordConfirmation']);

    if($firstname == null) {
        $error['firstname'] = "The First Name is empty!";
    } if($lastname == null) {
        $error['lastname'] = "The Last Name is empty!";
    } if($email == null) {
        $error['email'] = "The email is empty!";
    } if($email == null) {
        $error['email'] = "The email is empty!";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false){
        $error['email'] = "\"$email\" is not a valid email address";
    } elseif ($connection->query("SELECT * FROM `users` WHERE email = '$email' ")->num_rows > 0){
        $error['email'] = "\"$email\" is already registered!";
    } if($phn_num == null) {
        $error['phn_num'] = "The Phone Number is empty!";
    } elseif(ctype_digit($phn_num) == false) {
        $error['phn_num'] = "Please enter digits only!";
    } if($password == null || $password_confirmation == null) {
        $error['password'] = "The Password or Confirm Password is empty!";
    } elseif ($password != $password_confirmation) {
        $error['password'] = "The Passwords doesn't match!";
    } elseif (strlen($password) <= 5) {
        $error['password'] = "The cannot be lees than 6 characters!";
    }


    if(!isset($error)) {
        $submit_registration = $connection->query("INSERT INTO `users` (`usr_id`, `firstname`, `lastname`, `email`, `phn_num`, `password`, `created`)
        VALUES (NULL, '$firstname', '$lastname', '$email', '$country_code$phn_num', '$password', CURRENT_TIMESTAMP) ");
        custom_query_error($submit_registration);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<div class="container align-items-center d-md-flex d-block" style="height: 100vh;">

    <div class="row  align-items-center">
        <!-- For Demo Purpose -->
        <div class="col-md-6">
            <a href="../"><img style="width: 15em; display: block; margin: auto;" src="../assets/images/logo.svg" alt="logo" class="logo py-5 pt-md-0"></a>
            <img src="images/form_d9sh6m.svg" alt="" class="img-fluid mb-3 d-none d-md-block">
        </div>

        <!-- Registeration Form -->
        <div class="col-md-6 col-lg-6 ml-auto">
            <h2 class="text-center pb-4 d-block m-auto"><?php echo isset($_POST['registration-submit']) && !isset($error) ? "You're Registered. Please, <a href='../'><u>Log In</u></a>" : "Create an <u>Account</u>" ;  ?></h2>
            <form class="<?php echo isset($_POST['registration-submit']) && !isset($error) ? "d-none" : ""; ?>" action="register.php" method="POST">
                <div class="row">

                    <!-- First Name -->
                    <div class="input-group col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="firstName" type="text" name="firstname" value="<?php echo isset($firstname) && isset($error) ? $firstname : ""; ?>" placeholder="First Name" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Last Name -->
                    <div class="input-group col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="lastName" type="text" name="lastname" value="<?php echo isset($lastname) && isset($error) ? $lastname : ""; ?>" placeholder="Last Name" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Errors Printing -->
                    <div class="col-lg-6 mb-4">
                        <small class="text-danger"><?php echo isset($error['firstname']) ? $error['firstname'] : ""; ?></small>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <small class="text-danger"><?php echo isset($error['lastname']) ? $error['lastname'] : ""; ?></small>
                    </div>

                    <!-- Email Address -->
                    <div class="input-group col-lg-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" name="email" value="<?php echo isset($email) && isset($error) ? $email : ""; ?>" placeholder="Email Address" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Errors Printing -->
                    <div class="col-lg-12 mb-4">
                        <small class="text-danger"><?php echo isset($error['email']) ? $error['email'] : ""; ?></small>
                    </div>

                    <!-- Phone Number -->
                    <div class="input-group col-lg-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <select id="countryCode" name="countryCode" style="max-width: 80px" class="custom-select form-control bg-white border-left-0 border-md h-100 font-weight-bold text-muted">
                            <option value="+880">+880</option>
                            <option value="+91">+91</option>
                            <option value="+92">+92</option>
                            <option value="+1">+1</option>
                        </select>
                        <input id="phoneNumber" type="tel" name="phone" value="<?php echo isset($phn_num) && isset($error) ? $phn_num : ""; ?>" placeholder="Phone Number" class="form-control bg-white border-md border-left-0 pl-3">
                    </div>

                    <!-- Errors Printing -->
                    <div class="col-lg-12 mb-4">
                        <small class="text-danger"><?php echo isset($error['phn_num']) && isset($error) ? $error['phn_num'] : ""; ?></small>
                    </div>

                    <!-- Password -->
                    <div class="input-group col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="passwordConfirmation" type="password" name="passwordConfirmation" placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md">
                    </div>
                    <!-- Errors Printing -->
                    <div class="col-lg-12 mb-4">
                        <small class="text-danger"><?php echo isset($error['password']) && isset($error) ? $error['password'] : ""; ?></small>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" name="registration-submit" href="#" class="btn btn-dark btn-block py-2">
                            <span class="font-weight-bold">Create your account</span>
                        </button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Already Registered? <a href="../" class="text-primary ml-2">Login</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/script.js"></script>


</body>
</html>