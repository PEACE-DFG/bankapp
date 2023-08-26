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
    <section class="all ">
           <div class="container-fluid">
           <div class="loader">
                    <img src="https://i.gifer.com/origin/13/138f4c87ed9b322952c3e0da2b264938_w200.gif"  alt="">
            </div>
         <div class="content" style="display: none;">
    <div class="container-fluid text-light">
            <div class="text-center">
            <h2><i>About CODEMasterBank</i></h2>
            </div>
       
        <p>Welcome to CODEMasterBank, your trusted banking partner for a brighter financial future. At CODEMasterBank, we are dedicated to delivering exceptional banking services tailored to your needs.</p>
        
        <p>Our mission is to empower individuals, families, and businesses with financial solutions that pave the way for growth and prosperity. With decades of experience in the banking industry, we bring expertise, innovation, and reliability to every interaction.</p>
        
        <p>What sets us apart:</p>
        <ul>
            <li>Customer-Centric Approach: Our customers are at the heart of everything we do. We prioritize your financial well-being and offer personalized solutions to help you achieve your goals.</li>
            <li>Secure and Modern Technology: We leverage cutting-edge technology to provide secure, convenient, and efficient banking services. Your financial data is safeguarded with the utmost care.</li>
            <li>Experienced Team: Our team of banking professionals is here to guide you through every financial decision. Whether you're saving for the future, managing investments, or planning for retirement, we have the expertise to assist you.</li>
            <li>Community Commitment: We are proud to be an integral part of the communities we serve. Through philanthropy and community engagement, we strive to make a positive impact beyond banking.</li>
        </ul>
        
        <p>Join us on the journey towards financial success.</p>
        
       
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
