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
    </style>
</head>
<body>
    <section class="all">
    <div class="loader">
        <img src="https://i.gifer.com/origin/13/138f4c87ed9b322952c3e0da2b264938_w200.gif"  alt="">

        </div>
    <div class="content" style="display: none;">

        <nav class="navbar navbar-expand-lg navbar-dark navbar-transparant  bg-dark">
  <div class="container">
  <a class="navbar-brand" href="index.php">CODEMasterBank</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav m-auto">
                        <li class="nav-item active">
                            <a class="nav-link"  target="iframe_a" href="Aboutus.php">About Us</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link"  target="iframe_a" href="contact.php">Contact Us</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link"target="iframe_a" href="Services.php">Services</a>
                        </li>
                    </ul>
                    <a class="btn btn-warning" href="register.php" >Join Us</a>
    </div>
  </div>
</nav>


        <div class="content mt-3" style="display: none; display: flex; align-items: center; justify-content: center; ">
            <iframe id="content-iframe" name="iframe_a" class="text-center" src="Logo.php" width="900px" height="500px" frameborder="0"></iframe>
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