<?php
/*********************************************************************************
*       Filename: header.php
*       PHP 5.3.29 build 10/12/2014
*********************************************************************************/

session_start();
//===============================
// Display Menu Form
//-------------------------------
function Header_show()
{
  global $db;
  global $styles;
  $sFormTitle = "";

  //-------------------------------
  // Menu Open Event begin
  // Menu Open Event end
  //-------------------------------

  //-------------------------------
  // Set URLs
  //-------------------------------
  $fldReg = "Registration.php";
  $fldShop = "Reservation.php";
  $fldField1 = "Login.php";
  $fldAdmin = "AdminMenu.php";
  $fldCars = "Cars.php";
  //-------------------------------
  // Menu Show begin
  //-------------------------------

  //-------------------------------
  // Menu BeforeShow Event begin
  // Menu BeforeShow Event end
  //-------------------------------

  //-------------------------------
  // Show fields
  //-------------------------------

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>UNITEN E-Car Rental</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/business-frontpage.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Home</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo $fldCars; ?>">Cars</a></li>
          <li><a href="<?php echo $fldShop; ?>">Reservation</a></li>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
            if(get_session("UserRights") > 1)
            {
              echo "<li><a href=\" $fldAdmin \">Admin</a></li>";
            }
            else
              echo "";
          ?>
          <?php
            if (get_session("UserID") == "")
              echo "<li><a href=\" $fldReg \">Register</a></li>";
            else
              echo "";
          ?>

          <?php
            if (get_session("UserID") == "")
              echo "<li><a href=\" $fldField1 \">Login</a></li>";
            else
            {
              echo "<li><a href=\" Logout.php \">Logout</a></li>";
            }
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>

  <!-- Image Background Page Header -->
  <!-- Note: The background image is set within the business-casual.css file. -->
  <header class="business-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="tagline">UNITEN E-CAR RENTAL SERVICES</h1>
          <h3 class="tagline">Your Perfect Companion</h3>
          <h4 class="tagline">Low Rates | Instant Quotes | Superb Services</h4>
        </div>
      </div>
    </div>
  </header>

  <hr>

</body>
</html>
<?php

//-------------------------------
// Header Show end
//-------------------------------
}
//===============================

?>
