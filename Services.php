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
        .service h6{
            font-size:15px;
            color:gold;
        }
        .service li{
            font-size:13px

        }
        .service{
            line-height:0.9;
        }
        @media(max-width:692px){
            .service li{
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
    <header class="text-center text-warning">
        <h5>Welcome to CODEMaster Bank</h5>
    </header>
    
    <section id="services">
        <h6 class="text-warning">Our Services</h6>
        <small>At CODEMaster Bank, we offer a range of comprehensive banking services to meet your financial needs:</small>
        
        <div class="service">
            <h6>Personal Banking</h6>
            <ul>
                <li>Savings and Checking Accounts</li>
                <li>Online and Mobile Banking</li>
                <li>Debit and Credit Cards</li>
                <li>Personal Loans and Lines of Credit</li>
            </ul>
        </div>
        
        <div class="service">
            <h6>Business Banking</h6>
            <ul>
                <li>Business Checking and Savings Accounts</li>
                <li>Business Loans and Financing</li>
                <li>Merchant Services</li>
                <li>Cash Management Solutions</li>
            </ul>
        </div>
        
        <div class="service">
            <h6>Investment and Wealth Management</h6>
            <ul>
                <li>Investment Advisory Services</li>
                <li>Retirement Planning</li>
                <li>Estate and Wealth Transfer</li>
                <li>Asset Management</li>
            </ul>
        </div>
        
        <div class="service">
            <h6>Mortgage and Real Estate</h6>
            <ul>
                <li>Home Purchase and Refinance Loans</li>
                <li>Mortgage Pre-Approval</li>
                <li>Real Estate Investment Financing</li>
            </ul>
        </div>
        
        <div class="service">
            <h6>Financial Education</h6>
            <ul>
                <li>Personal Finance Workshops</li>
                <li>Online Financial Tools and Calculators</li>
                <li>Investment Seminars</li>
            </ul>
        </div>
       
    </section>
    
 

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
