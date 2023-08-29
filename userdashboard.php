<?php
session_start();
require 'database.php';
 if(!isset($_SESSION['email'])){
   header('location:login.php');
   
}



if (isset($_SESSION['email'])) {
  echo "<script>
          window.onload = function() {
              Swal.fire({
                  icon: 'success',
                  title: 'Logged In Successfully',
                  text: 'Welcome to your Dashboard!'
              });
          };
          window.onload(); // Call the function
       </script>";
}
 $sql = "SELECT * FROM user";
 $select = mysqli_query($conn, $sql);
 $email =$_SESSION['email'];
$sql = "SELECT * FROM user WHERE email = ? ";
$stm = $conn->prepare($sql);
$stm->bind_param('s', $email);
$stm->execute();
$result = $stm->get_result();
$user= $result->fetch_assoc();
if (isset($_POST['update'])) {
  $id = $_POST['idd'];
  $bvn = $_POST['bvn'];
  $phone = $_POST['phone'];
  
  $files=$_FILES['image'];
  $file_name=$_FILES['image']['name'];
  $temp_name=$_FILES['image']['tmp_name'];
  $size=$_FILES['image']['size'];
  $path='fileuploads/'.$file_name;
  $pathExt=pathinfo($path,PATHINFO_EXTENSION);
  echo $size;
  $image=$path;
  
  // Update other data
  $updateQuery = "UPDATE user SET bvn = '$bvn', phonenumber = '$phone',picture='$image' WHERE id = $id";
  if (mysqli_query($conn, $updateQuery)) {
    echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Updated Successfully',
                    text: 'Changes will be made in few seconds do not worry'
                });
            };
            window.onload(); // Call the function
         </script>";
} else {
    echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error Updating Data',
                    text: 'An error occurred while updating the data.'
                });
            };
            window.onload(); // Call the function
         </script>";
}

}

if (isset($_POST['add'])) {
  $amount = $_POST['amount'];
  $userId = $_SESSION['email'];

  $selectTotalAmountQuery = "SELECT amount, fullname, email, password, account, bvn, cardnumber, picture, phonenumber FROM user WHERE email = '$userId'";
  $result = $conn->query($selectTotalAmountQuery);

  if ($result) {
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $totalamount = intval($row['amount']);

          $requiredFields = ['fullname', 'email', 'password', 'account', 'bvn', 'cardnumber', 'picture', 'phonenumber'];
          $isComplete = true;

          foreach ($requiredFields as $field) {
              if (empty($row[$field])) {
                  $isComplete = false;
                  break;
              }
          }

          if ($isComplete) {
            $updateTotalAmountQuery = "UPDATE user SET amount = amount + $amount WHERE email = '$userId'";
            
            if (mysqli_query($conn, $updateTotalAmountQuery)) {
                echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Amount Added Successfully',
                                text: 'Refresh the Page to See Changes'
                            });
                        };
                        window.onload(); // Call the function
                     </script>";
                 
            } else {
                echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Updating Data',
                                text: '" . mysqli_error($conn) . "'
                            });
                        };
                        window.onload(); // Call the function
                     </script>";
            }
        } else {
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Incomplete Details',
                            text: 'Please complete all your details before adding money.'
                        });
                    };
                    window.onload(); // Call the function
                 </script>";
        }
      }}}        

if (isset($_POST['withdraw'])) {
  $amount = $_POST['amount'];
  $userId = $_SESSION['email'];

  $selectTotalAmountQuery = "SELECT amount, fullname, email, password, account, bvn, cardnumber, picture, phonenumber FROM user WHERE email = '$userId'";
  $result = $conn->query($selectTotalAmountQuery);

  if ($result) {
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $totalamount = intval($row['amount']);

          $requiredFields = ['fullname', 'email', 'password', 'account', 'bvn', 'cardnumber', 'picture', 'phonenumber'];
          $isComplete = true;

          foreach ($requiredFields as $field) {
              if (empty($row[$field])) {
                  $isComplete = false;
                  break;
              }
          }

          if ($isComplete) {
            if ($totalamount >= $amount) {
                $totalamount -= intval($amount);
                $updateTotalAmountQuery = "UPDATE user SET amount = '$totalamount' WHERE email = '$userId'";
                if (mysqli_query($conn, $updateTotalAmountQuery)) {
                    echo "<script>
                            window.onload = function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Withdrawal Successful',
                                    text: 'Refresh the Page to See Changes'
                                });
                            };
                            window.onload(); // Call the function
                         </script>";
                

                } else {
                    echo "<script>
                            window.onload = function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error Updating Data',
                                    text: '" . mysqli_error($conn) . "'
                                });
                            };
                            window.onload(); // Call the function
                         </script>";
                }
            } else {
                echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Insufficient Funds',
                                text: 'You do not have sufficient funds for the withdrawal.'
                            });
                        };
                        window.onload(); // Call the function
                     </script>";
            }
        } else {
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Incomplete Details',
                            text: 'Please complete all your details before making a withdrawal.'
                        });
                    };
                    window.onload(); // Call the function
                 </script>";
        }
        
      }}}        

                                     
                                      

?>

  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>CODEMasterBank_DashBoard.org</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      *{
        margin:0;
        padding:0;
        box-sizing:border-box;
      }
      .progress-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.progress-circle-svg {
    width: 100px;
    height: 100px;
}

@media (max-width: 1200px) {
    .progress-circle-svg {
        width: 80px;
        height: 80px;
    }
}

@media (max-width: 992px) {
    .progress-circle-svg {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 768px) {
    .progress-circle-svg {
        width: 50px;
        height: 50px;
    }
}

@media (max-width: 576px) {
    .progress-circle-svg {
        width: 40px;
        height: 40px;
    }
}

@media (max-width: 400px) {
    .progress-circle-svg {
        width: 30px;
        height: 30px;
    }
}

@media (max-width: 320px) {
    .progress-circle-svg {
        width: 20px;
        height: 20px;
    }
}


        .card{
            width:280px;
            height:150px;
            background-image:url('https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2020/02/Usign-Gradients-Featured-Image.jpg');
            background-size:cover;
            background-repeat:no-repeat;
        }
        .cards{
            width:280px;
            margin-left:5px;
            height:150px;
            background-image:url('https://t3.ftcdn.net/jpg/02/42/77/22/360_F_242772256_PRwokoyoXkDCIISNjfj9N3If0TPFtje8.jpg');
            background-size:cover;
            background-repeat:no-repeat;
        }
        .truth{
      font-weight:900;
    }
        .treat{
            display:flex;
            justify-content:space-between;
        }
        .blue{
          width:300px;
          height:150px;
          border:1px solid transparent;
          background-color:white;
          margin:5px 0px 0px 20px;
          border-radius:10px;
          align-items:center;
          text-align:center;
          display:flex;
          justify-content:center;

        }
        .bluetooth{
          display:flex;
        }
        .bala{
          display:flex;
          justify-content:space-around;
        }
        .skill{
          width:100px;
          height:100px;
          position:relative;
        }
        .outer{
          height:100px;
          width:100px;
          border-radius:50%;
          padding:9px;
          box-shadow:6px 6px 10px -1px rgba(0,0,0,0.15),
          -6px -6px 10px -1px rgba(255,255,255,0.7)
        }
        #number{
          font-weight:600;
          color:#555;

        }
        .ghost{
          display:none;
        }
        @keyframes anim{
          100%{
            stroke-dashoffset:85.75;
          }
        }
        .bg-circle {
  fill: none;
  stroke: #e0e0e0;
  stroke-width: 8;
}

.progress-circle {
  fill: none;
  stroke: #007bff; 
  stroke-width: 8;
  stroke-dasharray: 251.2;
  stroke-dashoffset: 0; 
  transition: stroke-dashoffset 0.5s ease; 
}

     
@media (max-width: 991px) {
    .col-1,
    .col-4,
    .col-7 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .bluetooth{
      display:flex;
      flex-direction:column;
      justify-content:center;
    }
    .blue{
      width:100%;
      margin:5px 0px 0px 0px;

    }
}

@media (max-width: 767px) {
    .container {
        padding: 0 15px;
    }

    .treat {
        flex-direction: column;
    }

    .card,
    .cards {
        width: 100%;
        margin: 10px 0;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .blue,
    .cards {
        width: 100%;
    }
}

@media (max-width: 575px) {
    .card,
    .cards {
        height: auto;
        padding: 10px;
    }

    .cards {
        margin-left: 0;
    }

    .treat {
        flex-direction: column;
    }
    .truth{
      font-size:15px;
      font-weight:900;
    }
}

@media (max-width: 576px) {
    .modal-dialog {
        max-width: 90%;
    }
}
@media (max-width: 479px) {
    .bg-circle,
    .progress-circle {
        stroke-width: 6;
    }
    .ghost{
      display:block;
    }
    .mew{
      display:none;
    }
}
body{
            background:linear-gradient(rgb(0,0,0,0.4),rgb(0,0,0,0.4)),url('https://tscfm.org/wp-content/uploads/2021/10/Banking-Course-in-Mumbai-With-placements.webp');
            height:100vh;
            width:98.5vw;
            background-attachment:fixed;
            background-size:cover;
            background-repeat:no-repeat;
        }

    </style>
</head>
<body >

            


    <section class="all">
     
        <div class="content" > 
        <!-- Structure -->
        <section class="container">
            <section class="row " >
                <section class="col-1 g-2 " style="background-color:rgb(203,220,203,0.7);1px solid transparent;box-shadow:5px 5px 10px #D3D3D3;border-radius:10px">
                    <div class="mt-2 text-center">
                    <img src="images/CODEMasterlogo (2).png" class="img-fluid img-cover"/>

                    </div>
                    <div class="mt-4 text-center">
                      <a href="index.php">
                    <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Home">
                    <i class="fa-solid fa-bars" style=" color:orange"></i>
                      </button>
                      </a>
                    </div>
                    <div class="mt-3 text-center"  >
                    <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Reward">
                  <i class="fa-solid fa-shield " style=" color:orange"></i>
                      </button>
                    </div>
                    <div class="mt-3 text-center"  >
                    <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Finance">
                    <i class="fa-solid fa-chart-line " style=" color:orange"></i>
                      </button>
                    </div>
                    <div class="mt-3 text-center"  >
                    <a href="userdashboard.php">
                    <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="DashBoard">
                    <i class="fa-solid fa-user " style=" color:orange"></i>
                      </button>
                    </a>
                    
                    </div>


                    <div class="mt-2 text-center" style="padding-top:40px"  >
                    <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings">
                    <i class="fa-solid fa-gear " style=" color:orange"></i>
                      </button>

                      
                    </div>

                    <div class="mt-3  text-center" style="padding-top:0px"  >
                    <?php
// Assuming $user['picture'] holds the image path
$userPicture = $user['picture']; 
$defaultPicture = 'https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_1280.png'; // Path to default image

// Checking if the user has uploaded an image
if (!empty($userPicture) && file_exists($userPicture)) {
    // Displaying the uploaded image
    echo '<img src="' . $userPicture . '" width="50px" style="border-radius: 50%;" alt="User Image">';
} else {
    // Displaying the default image
    echo '<img src="' . $defaultPicture . '" width="50px" style="border-radius: 50%;" alt="Default Image">';
}
?>

                    <?php
                        echo'   <p class="text-center mt-2"><a class="dropdown-item px-1 py-2 m-auto text-light" style="border: none; border-radius:10px;font-size:10px;font-family:Arial, Helvetica, sans-serif;font-weight:900;box-shadow:10px 10px 30px grey;background-color:red" href="logout.php">
                        LOG OUT
                      </a></p>'
                      ?>

                      
                    </div>
                    

                </section>
               
                <section class="col-7 g-2" style="1px solid transparent; background-color:rgb(0,0,0,0.6);">
                    <div class="mt-3 pt-2 mx-3 bg-light px-4" style="border-radius:10px">
                      <div style="display:flex;justify-content:space-between;font-family:Arial" >
                      <div >
                       <h5 class='truth'>
                            Hello,<?php  echo  $user['fullname']?>
                        </h5>
                            <i class="text-success"><small>Date Registered: <?php echo $user['dateregistered']?></small></i>
                            <br>
                            <small class="text-info">
                                  Your BVN:<?php echo $user['bvn']?>
                            </small>||
                            <small class="text-secondary">
                                  Your Phone Number:<?php echo $user['phonenumber']?>
                            </small><br>
                            || <small class="text-secondary">
                                  Your Account Number:<?php echo $user['account']?>
                            </small>
                       </div>
                       <div >
                        <h3 class='truth'>DashBoard</h3>
                       </div>
                      </div>

                      <!-- cards section -->
                    <div class="mt-3" style="display:flex;justify-content:space-between">
                        <div style="color:orange" class="pb-2">
                            <h6> <span><i class="fa-solid fa-circle fa-fade" style="color:orange"></i></span> My Balance: # <span><?php echo $user['amount'] ?></span> </h6>
                        </div>
                        <div style="color:orange" class="pb-2">
                            <h6>My Cards <span class="ms-2"><i class="fa-solid fa-circle-plus fa-fade"></i></span></h6>
                        </div>
                    </div>
                    <!-- card design -->
                    <div class="treat py-2">
                        <div class="card" >
                            <span>
                                <span class="text-light m-2">
                                Card Number: <span><?php  echo  $user['cardnumber']?></span>

                            </span>
                            </span>
                              <span style="display:flex;justify-content:right" class="m-2">
                                 <img src="https://seeklogo.com/images/M/master-card-logo-5806741801-seeklogo.com.png" width="60px" style="border-radius:10px" alt="">
                            </span>
                            <div class="mx-2" style="display:flex;justify-content:space-between;align-items:center;color:white">
                                <div>
                                <img src="https://gitea.osmocom.org/avatars/43854724e3fef0f8e93be3753055c77a?size=280" width="50px" alt="">

                                </div>
                                <div class="mx-2">
                                    <span style="font-size:10px;font-weight:900">Name:<?php  echo  $user['fullname']?></span>
                                </div>
                            </div>

                        </div>
                        <div class="cards">
                      
                            <span>
                            <span>
                                <span class="text-light m-2">
                                Card Number: <span><?php  echo  $user['cardnumber']?></span>

                            </span>
                                   </span>
                            <span style="display:flex;justify-content:right" class="m-2">
                            <img src="https://e7.pngegg.com/pngimages/618/512/png-clipart-visa-logo-mastercard-credit-card-payment-visa-blue-company.png" width="60px" style="border-radius:10px" alt="">

                                          </span>
                            <div class="mx-2" style="display:flex;justify-content:space-between;align-items:center;color:white">
                                <div>
                                <img src="https://gitea.osmocom.org/avatars/43854724e3fef0f8e93be3753055c77a?size=280" width="50px" alt="">

                                </div>
                                <div class="mx-2">
                                    <span style="font-size:10px;font-weight:900">Name:<?php  echo  $user['fullname']?></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>
                    <section>
                      <div class="bluetooth">
                        <div class="blue">
                          <div class="bala ">
                          <div class="mx-2 text-center"  >
                          <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addMoneyModal">
          <i class="fa-solid fa-arrow-up-from-bracket" style="color: orange;"></i><br>
          <small>Add Money</small>
        </button>

        <div class="modal fade" id="addMoneyModal" tabindex="-1" aria-labelledby="addMoneyModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addMoneyModalLabel">ADD MONEY</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              
                <h5>Add Money From Your Bank</h5>
                <form method="post" action="">
                <div class="form-floating mb-3">
                      <input input type="text" name="amount" class="form-control" id="floatingInput" placeholder="Amount">
                      <label for="floatingInput">Amount</label>
                    </div>
                  
                  <div class="modal-footer">
                  <input type="submit" name="add" class="bg-warning px-3 py-2" style="border:none;border-radius:5px;" value="Submit">

              </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="text-center">
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#transferModal">
          <i class="fa-solid fa-arrow-right-arrow-left" style="color: orange;"></i><br>
          <small>Transfer</small>
        </button>

        <div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="transferModalLabel">Transfer Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center">
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#withdrawModal">
          <i class="fa-solid fa-arrow-down-short-wide" style="color: orange;"></i><br>
          <small>Withdraw</small>
        </button>

        <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="withdrawModalLabel">Withdraw Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h2>Withdraw Your Money</h2>
                <form method="post" action="">
                <div class="form-floating mb-3">
                      <input type="text" name="amount" class="form-control" id="floatingInput" placeholder="Amount">
                      <label for="floatingInput">Amount</label>
                    </div>
                  <div class="modal-footer">
                  <input type="submit" name="withdraw" class="bg-warning px-3 py-2" style="border:none;border-radius:5px;" value="Submit">

              </div>
                </form>
              </div>
             
            </div>
                            </div>
                          </div>
                                              </div>
                          </div>
                        </div>
                        <div class="blue">
                          <div>
                            <h6>Personal Details</h6>
                            <hr>
                          </div>
                          <!-- ################################################## -->
                          <!-- #####################################################-->
             
                          <?php


$userID = $user['id']; 

$query = "SELECT fullname, email, password, account, bvn, cardnumber, picture, phonenumber FROM user WHERE id = $userID";
$result = $conn->query($query);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $totalFields = count($row); 
    $completedFields = 0;

    foreach ($row as $field => $value) {
      if (!empty($value)) {
          $completedFields++;
      }
  }

  
    $progressPercentage = ($completedFields / ($totalFields )) * 100;
  
     $integerProgress = intval($progressPercentage);  
     


    echo '<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
    echo '<circle class="bg-circle" cx="50" cy="50" r="40" />';
    echo '<circle class="progress-circle" cx="50" cy="50" r="40" style="stroke-dashoffset: ' . (251.2 - (2.512 * $progressPercentage)) . ';" />';
    echo '<text x="50" y="50" text-anchor="middle" alignment-baseline="middle" font-size="18"font-weight="900" fill="#333">' . $integerProgress . '%</text>';
    echo '</svg>';
} else {
    echo "User not found or multiple users found.";
}

$conn->close();
?>

                        </div>
                    
                      </div>

                      <div class="d-grid my-3 gap-2 col-6 mx-auto">
    <button class="btn btn-light text-warning" style="font-weight: 900;" type="button" data-bs-toggle="modal" data-bs-target="#updateDetailsModal">Update Details</button>
</div>

                      <div class="modal fade" id="updateDetailsModal" tabindex="-1" aria-labelledby="updateDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-warning " id="updateDetailsModalLabel">Update Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <br>
      <div class="modal-body" style="max-width:300px;margin:auto;border:1px solid transparent; box-shadow:5px 5px 10px grey;padding:10px 0px;text-align:center;">
       

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idd" value="<?php echo $user['id'] ?>" >
    
    <p >
    <div class="form-floating mb-3">
  <input type="text" name="bvn" value="<?php echo $user['bvn'] ?>" class="form-control " id="floatingInput">
  <label for="floatingInput">BVN</label>
</div>
      
    </p>
    
    <p class="text-center">
        <label for="image">Choose an image:</label>
        <input type="file" name="image" id="image" class="ms-5" accept="image/*" required>
    </p>
    
    <p>
    <div class="form-floating mb-3">
  <input type="tel" name="phone" value="<?php echo $user['phonenumber'] ?>" class="form-control" id="floatingInput" >
  <label for="floatingInput">Phone Number</label>
</div>
    </p>
 
  

      </div>
      <br>
      <div class="modal-footer">
    <input type="submit" name="update" class="text-light bg-warning p-2" style="border:none;font-weight:900;border-radius:3px;" value="Update">
        
      </div>
      <div id="update-message"></div>
</form>

    </div>

  </div>
</div>

                      
                    </section>
                  
                 
            </section>

                <section class="col-4 g-2 " style="background-color:rgb(203,220,203,0.7);1px solid transparent;box-shadow:5px 5px 10px #D3D3D3;border-radius:10px">
                <div class="m-2" style="display:flex;justify-content:space-between">
                    <div>
                    <?php
$userPicture = $user['picture']; 
$defaultPicture = 'https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_1280.png'; 

if (!empty($userPicture) && file_exists($userPicture)) {
    echo '<img src="' . $userPicture . '" width="50px" style="border-radius: 50%;" alt="User Image">';
} else {
    echo '<img src="' . $defaultPicture . '" width="50px" style="border-radius: 50%;" alt="Default Image">';
}
?>
                    </div>
                    <div>
                    <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Notifications">
                   <i class="fa-solid fa-bell fs-2" style="color:orange"></i>

                      </button>
                    </div>
                </div>
          <div class="bot">
          <div>
          <div class="text-center  ">
                    <h6>CODEMaster Bank Branches In Nigeria</h6>
                </div>
                <div id="chartd" class="mew">

                </div>
<hr>
               
                <div id="char" class="ghost">

                </div>
           </div>
           <div class="text-center">
                  <h6>Dollar Rise and Fall Nigeria,2023</h6>
                </div>
               <div>
               <div id=chart>

</div>
               
               </div>
          </div>
            </section>
               
            </section>
        </section>
      
        </div>
     
       

    </section>
    <script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





    

    <script>



var options = {
          series: [{
          name: 'Inflation',
          data: [2.3, 3.1, 3.6, 3.2, 2.3,5.2, 6.0, 9.1, 10.0, 11.4, 12.8, 13.5 ]
        }],
          chart: {
          height: 250,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', 
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          text: 'Monthly Currency fall-rise in Nigeria,2023',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


        
        var options = {
          series: [44, 55, 13, 43, 22],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Abuja Branch', 'Ondo Branch', 'Kano Branch', 'Lagos Branch', 'Osun Branch'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 100
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chartd"), options);
        chart.render();


        var options = {
          series: [44, 55, 67, 83],
          chart: {
          height: 350,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            dataLabels: {
              name: {
                fontSize: '22px',
              },
              value: {
                fontSize: '16px',
              },
              total: {
                show: true,
                label: 'Total',
                formatter: function (w) {
                  return 249
                }
              }
            }
          }
        },
        labels: ['Lagos', 'Abuja', 'Portharcout', 'Osun'],
        };

        var chart = new ApexCharts(document.querySelector("#char"), options);
        chart.render();
      
      

    </script>
    <script>

    </script>
</body>
</html>