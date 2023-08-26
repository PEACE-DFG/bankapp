<?php
session_start();
if(isset($_SESSION['email'])){
    header('location:register.php');
}
?>

<?php
require "database.php";

if(isset($_POST['login'])){
    if(empty($_POST['email'])){
        $errors['emailErr'] = "Your email is required";
        }else{
            $data['email'] = $_POST['email'];
        }
        if (empty($_POST['password'])) {
          $errors['passwordErr'] = "Your password is required";
        }else{
            $data['password'] = $_POST['password'];

        }
$email = $_POST['email'];
$password = md5($_POST['password']);
 
$sql = "SELECT * FROM user WHERE email='$email'";
 $select= $conn->query($sql);
 if($select->num_rows > 0){
    $result = $select->fetch_assoc();
    if(strcmp($password, $result['password'])==0){
        $_SESSION['email'] = $result['email'];
        if(isset($_SESSION['email'])){
            header('location:userdashboard.php');
        }
    }else{
        echo "<div class='alert alert-danger' role='alert'>
        Invalid Details!
      </div>";
        }
 }else{
    // echo "<div class='alert alert-danger' role='alert'>
    //     Invalid Email!
    //   </div>";
 }
   

}
?>
       
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>CODEMasterBank_login.org</title>
    <style>
        .loader {
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
        }
        
        .loader img {
            width: 150px;
            height: 150px;
            animation: spin 1s linear infinite; 
        }
        .all {
            max-width: 350px;
            margin: auto;
            padding: 5px;
            border-radius: 5px;
            margin-top: 50px;
            border: 1px solid transparent;
            box-shadow: 5px 5px 40px grey;
            background-color:rgb(0,0,0,0.9);

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
        <div class="loader">
        <img src="https://i.gifer.com/origin/13/138f4c87ed9b322952c3e0da2b264938_w200.gif"  alt="">

        </div>
        <div class="content" style="display: none;">
            <?php
            require "database.php";
            
            $errors = ""; // Initialize the error message variable
            
            if (isset($_POST['login'])) {
                if (empty($_POST['email'])) {
                    $errors = "Your email is required";
                } else {
                    $email = $_POST['email'];
                }
                
                if (empty($_POST['password'])) {
                    $errors = "Your password is required";
                } else {
                    $password = $_POST['password'];
                    
                    
                    $sql = "SELECT * FROM user WHERE email='$email'";
                    $select = $conn->query($sql);
                    
                    if ($select->num_rows > 0) {
                        $result = $select->fetch_assoc();
                        
                        if (password_verify($password, $result['password'])) {
                            $_SESSION['email'] = $result['email'];
                            header('location: dashboard.php');
                            exit();
                        } else {
                            $errors = "Invalid Details!";
                        }
                    } else {
                        $errors = "Invalid Email!";
                    }
                }
            }
            ?>
            
        
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors; ?>
                </div>
            <?php endif; ?>
            
            <div class="text-center">
            <img src="images/CODEMasterlogo (2).png"  class="img-fluid  img-cover"/>


            </div>
            <div style="font-size:20px;text-align:center">
                <h1 style="font-size:20px;color:white">Welcome Back</h1>
            </div>

            <div class="container">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto my-4">
                        <input class="btn btn-warning" type="submit" name="login" value="Login">
                    </div>
                    <div class="text-center text-light">
                        <p>Don't have an account? <a href="register.php"><span><i>Sign Up</i></span></a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loader = document.querySelector('.loader');
            const content = document.querySelector('.content');

            
            setTimeout(function () {
                loader.style.display = 'none';
                content.style.display = 'block';
            }, 2000); 
        });
    </script>
</body>
</html>
