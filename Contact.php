<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>CODEMasterBank.org</title>  
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
        *{
            margin:0;
            padding:0;
        }
        .all{
            background:linear-gradient(rgb(0,0,0,0.7),rgb(0,0,0,0.7)),url('https://tscfm.org/wp-content/uploads/2021/10/Banking-Course-in-Mumbai-With-placements.webp');
            height:100vh;
            width:100vw;
            background-size:cover;
            background-repeat:no-repeat;
        }
        @media(max-width:692px){
            .out{
                display:none;
            }
        }
    </style>
</head>
<body>
    <section class="all ">
           <div class="container-fluid">
           <div class="loader">
                    <img src="https://i.gifer.com/origin/13/138f4c87ed9b322952c3e0da2b264938_w200.gif"  alt="">
            </div>
         <div class="content" style="display: none;">
    <div class="container-fluid text-light">
          
      <div class="container">
       <div class="text-center">
       <h5>Contact Us</h5>
       </div>
        <p>Have questions or need assistance? We're here to help. Feel free to reach out to us using the contact details below:</p>

        <div class="row">
            <div class="col-md-6">
                <h6>Headquarters</h6>
                <p><strong>Address:</strong> Osun State University School Road, Okebaale Osun State</p> 
            </div>
            <div class="col-md-6 out">
                <h6>Customer Support</h6>
                <p><strong>Phone:</strong> +234-811-640-5518</p>
                <p><strong>Email:</strong> awofesobipeace@gmail.com</p>
            </div>
        </div>
        <small>

        </small>
                <div class="text-center">
                      <h6>Send us a Message</h6>

                </div>
                <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    $to = "awofesobipeace@gmail.com"; // Replace with your email address
    $subject = "New Contact Message";
    $headers = "From: $email";
    
    if (mail($to, $subject, $message, $headers)) {
        echo '<div class="alert alert-success" role="alert">Message sent successfully!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Message could not be sent.</div>';
    }
}
?>
  <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "./PHPMailer/src/Exception.php";
require "./PHPMailer/src/PHPMailer.php";
require "./PHPMailer/src/SMTP.php";

// Configure your SMTP settings
$smtpHost = 'smtp.gmail.com'; // Your SMTP server host
$smtpUsername = 'awofesobipeace@gmail.com'; // Your SMTP username (email)
$smtpPassword = 'gbnmkwehbmzlzlth'; // Your SMTP password
$smtpPort = 465; // Port number, typically 587 for TLS

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Create a new PHPMailer instance for sending to user
    $userMail = new PHPMailer();
    $userMail->isSMTP();
    $userMail->SMTPAuth = true;
    $userMail->Host = $smtpHost;
    $userMail->Username = $smtpUsername;
    $userMail->Password = $smtpPassword;
    $userMail->SMTPSecure = 'ssl';
    $userMail->Port = $smtpPort;

    // Set sender and recipient for user's email
    $userMail->setFrom('awofesobipeace@gmail.com', 'CODEMaster');
    $userMail->addAddress($email, $email); // Use the user's entered email

    // Email content for user
    $userMail->isHTML(true);
    $userMail->Subject = 'Thanks for contacting us';
    $userMail->Body = 'Thank you for contacting us. We have received your message and will get back to you shortly.';

    // Send email to user
    if ($userMail->send()) {
        $userMessage = 'Message sent successfully to the user!';
    } else {
        $userMessage = 'Message could not be sent to the user.';
    }

    // Create a new PHPMailer instance for sending to your email
    $yourMail = new PHPMailer();
    $yourMail->isSMTP();
    $yourMail->SMTPAuth = true;
    $yourMail->Host = $smtpHost;
    $yourMail->Username = $smtpUsername;
    $yourMail->Password = $smtpPassword;
    $yourMail->SMTPSecure = 'ssl';
    $yourMail->Port = $smtpPort;
    // Set sender and recipient for your email
    $yourMail->setFrom($email, 'User');
    $yourMail->addAddress('awofesobipeace@gmail.com', 'CODEMaster'); // Your email address

    // Email content for your email
    $yourMail->isHTML(true);
    $yourMail->Subject = 'New Contact Message from User';
    $yourMail->Body = "Message from: $email <br><br>$message";

    // Send email to your address
    if ($yourMail->send()) {
        $yourMessage = 'Message sent successfully to your email!';
    } else {
        $yourMessage = 'Message could not be sent to your email.';
    }
}
?>


<form method="post">
            <div class="mb-1">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="mb-1">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="1" placeholder="Enter your message"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
        </form>
      

     
    </div>
   

    </div>
           </div>
    </section>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loader = document.querySelector('.loader');
            const content = document.querySelector('.content');

            // Simulate content loading
            setTimeout(function () {
                loader.style.display = 'none';
                content.style.display = 'block';
            }, 2000); // Simulated delay of 2 seconds
        });
    </script>

</body>
</html>



