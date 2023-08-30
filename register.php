<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>CODEMasterBank_register.org</title>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <style>
        /* .loader {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        } */
        
        .loader img {
            width: 150px;
            height: 150px;
            animation: spin 1s linear infinite; 
        }
        .all{
            max-width: 350px;
            margin: auto;
            padding: 5px;
            border-radius: 5px;
            margin-top: 50px;
            border: 1px solid transparent;
            box-shadow: 5px 5px 40px grey;
            background-color:rgb(0,0,0,0.9);
            color:black;
            
        }
        body{
            background:linear-gradient(rgb(0,0,0,0.4),rgb(0,0,0,0.4)),url('https://tscfm.org/wp-content/uploads/2021/10/Banking-Course-in-Mumbai-With-placements.webp');
            height:100vh;
            width:98.5vw;
            background-size:cover;
            background-repeat:no-repeat;
        }
    </style>
</head>
<body>
    <section class="all">
        <div class="content" style="display: non;">
            <div class="text-center">
            <img src="images/CODEMasterlogo (2).png"  class="img-fluid img-cover"/>

            </div>
            <div style="font-size:20px;text-align:center">
                <h1 style="font-size:20px;color:white;">Create an account</h1>
            </div>

            <div class="container">
                <?php
                require "database.php";

                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;
                require "./PHPMailer/src/Exception.php";
                require "./PHPMailer/src/PHPMailer.php";
                require "./PHPMailer/src/SMTP.php";
                $accountNumberPrefix = 1234567890;
                $accountNumberQuery = "SELECT COUNT(*) as userCount FROM user";
                $accountNumberResult = mysqli_query($conn, $accountNumberQuery);
                $accountNumberData = mysqli_fetch_assoc($accountNumberResult);
                $userCount = $accountNumberData['userCount'];
                $accountNumber = $accountNumberPrefix + $userCount;
                $randomCardNumber = rand(1000000000000000, 9999999999999999);
                $errors =[];
                $data =array(
                    'fullname'=>'',
                    'email'=>'',
                    'password'=>'',
                    'repeatpassword'=>''
                );
                if(isset($_POST['register'])){
                    if(empty($_POST['fullname'])){
                        $errors['fullnameErr'] = "Your Fullname is required";
                    }else{
                        $data['fullname'] = $_POST['fullname'];
                    }
                    if(empty($_POST['email'])){
                        $errors['emailErr'] = "Your email is required";
                    }else{
                        $data['email'] = $_POST['email'];
                    }
                    if (empty($_POST['password'])) {
                        $errors['passwordErr'] = "Your password is required";
                    } elseif (strlen($_POST['password']) < 8) {
                        $errors['passwordErr'] = "Password must be at least 8 characters long";
                    } else {
                        $data['password'] = $_POST['password'];
                    }
                    if (empty($_POST['repeatpassword'])) {
                        $errors['repeatpasswordErr'] = "Confirm password is required";
                    } elseif ($_POST['password'] !== $_POST['repeatpassword']) {
                        $errors['repeatpasswordErr'] = "Passwords do not match";
                    } else {
                        $data['repeatpassword'] = $_POST['repeatpassword'];
                    }
                    $fullname=$data['fullname'];
                    $email = $data['email'];
                    $password = md5($data['password']);
                    $date = date("Y-m-d h:i:s a");

                    if(count($errors) == 0){
                        $sql = "SELECT fullname,email,password FROM user WHERE email ='$email' AND password='$password'";
                        $select = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($select) == 0){
                            $sql = "INSERT INTO user(fullname, email, password, dateregistered, account,cardnumber)VALUES('$fullname', '$email', '$password', '$date', '$accountNumber','$randomCardNumber')";            
                            if(mysqli_query($conn,  $sql)){
                                $mail = new PHPMailer();
                                $mail->isSMTP();
                                $mail->SMTPAuth = true;
                                $mail->Host = 'smtp.gmail.com'; 
                                $mail->Username = 'awofesobipeace@gmail.com'; 
                                $mail->Password = 'gbnmkwehbmzlzlth';
                                $mail->SMTPSecure = 'ssl'; 
                                $mail->Port = 465; 
                                $mail->isHTML(true); 
                                $mail->setFrom('CODEMasterBank.com');
                                $mail->addAddress($data['email'], $data['fullname']);
                                $mail->Subject = 'Registration Verification';
                                // Email body
$message = "
<!DOCTYPE html>
<html>
<head>
<style>
  .container {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 5px;
    text-align:center;
  }
  .header {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
  }
  .content {
    font-size: 16px;
    margin-bottom: 20px;
  }
  .highlight {
    background-color: #ffffcc;
    padding: 5px;
    border-radius: 3px;
  }
</style>
</head>
<body>
  <div class='container'>
    <div class='header'>Thank You for Registering with Us!</div>
    <div class='content'>
    <img src='https://terraacademyforarts.com/wp-content/uploads/2023/01/jgcjc.png' alt='Registration Successful' style='max-width: 100%; height: auto; margin-top: 20px;'>
  <br>
      Dear {$data['email']},
      <br>
      <p>Your account has been successfully created.</p>
      <p>Your account number is: <span class='highlight'>{$accountNumber}</span></p>
      <p>Your card number is: <span class='highlight'>{$randomCardNumber}</span></p>
      <p>Please don't forget to complete your details in your Dashboard.</p>
    </div>
  </div>
</body>
</html>
";

$mail->Body = $message;
                                $mail->send();
                               echo"
                               <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Registration Successful',
            text: 'A verification email has been sent to your registered email address.'
        }).then(() => {
            window.location.href = 'Login.php'; // Redirect to Login page after user clicks 'OK'
        });
    });
</script>
                               ";

                            }else{
                                echo "Something went wrong" . mysqli_error($conn);
                            }
                        } else {
                            $errors['emailErr'] = "Email already exists";
                        }
                    }
                }
                ?>
               <form action="" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name" name="fullname"value="<?php echo array_key_exists('fullname', $data) ? $data['fullname'] : '' ?>">
                    <label for="floatingInput">FullName</label>
                  </div>
                  <span style="color:red">
   <?php echo array_key_exists('fullnameErr', $errors) ? '<div class="alert alert-danger" role="alert">' . $errors['fullnameErr'] . '</div>' : ''; ?>
</span>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?php echo array_key_exists('email', $data) ? $data['email'] : '' ?>">
                    <label for="floatingInput">Email address</label>
                  </div>
                  <span style="color:red">
    <?php echo array_key_exists('emailErr', $errors) ? '<div class="alert alert-danger" role="alert">' . $errors['emailErr'] . '</div>' : ''; ?>
</span>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="<?php echo array_key_exists('password', $data) ? $data['password'] : '' ?>">
                    <label for="floatingPassword">Password</label>
                    <span style="color:red">
    <?php echo array_key_exists('passwordErr', $errors) ? '<div class="alert alert-danger" role="alert">' . $errors['passwordErr'] . '</div>' : ''; ?>
</span> 
                </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="RepeatPassword" name="repeatpassword" value="<?php echo array_key_exists('repeatpassword', $data) ? $data['repeatpassword'] : '' ?>">
                    <label for="floatingPassword">Confirm Password</label>
                  </div>
                  <span style="color:red">
    <?php echo array_key_exists('repeatpasswordErr', $errors) ? '<div class="alert alert-danger" role="alert">' . $errors['repeatpasswordErr'] . '</div>' : ''; ?>
</span>
                  <div class="d-grid gap-2 col-6 mx-auto my-4">
                    <input class="btn btn-warning" type="submit" value="Register" name="register">
                  </div>
                  <div class="text-center text-light">
                    <p>Already have an account? <a href="Login.php"><span><i>Sign In</i></span></a></p>
                  </div>
            </form>

            </div>
        </div>
    </section>


    <script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
