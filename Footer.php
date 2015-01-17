<?php
//********************************************************************************


//===============================
// Display Menu Form
//-------------------------------
function Footer_show()
{
  global $db;
  global $styles;
  $sFormTitle = "";

//-------------------------------
// Footer Open Event begin
// Footer Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
  $fldField1 = "index.php";
//-------------------------------
// Footer Show begin
//-------------------------------


//-------------------------------
// Footer BeforeShow Event begin
// Footer BeforeShow Event end
//-------------------------------

//-------------------------------
// Show fields
//-------------------------------

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>UNITEN E-Car Rental Footer</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <style>

  /* Sticky footer styles
  -------------------------------------------------- */
  /* Set the fixed height of the footer here */
  #push,
  #footer {
    height: 60px;
  }

  #footer {
    background-color: #d6d6d6;
  }

  /* Lastly, apply responsive CSS fixes as necessary */
  @media (max-width: 767px) {
    #footer {
      margin-left: -20px;
      margin-right: -20px;
      padding-left: 20px;
      padding-right: 20px;
    }
  </style>

</head>
<body>
<hr>
<!-- Wrap all page content here -->
  <div id="wrap">
    <div class="container">
    </div> <!-- /container -->
  </div> <!-- /wrap -->

  <!--BEGIN FOOTER -->
<div id="footer">
  <div class="container">
    <div class="footer-size">
      <div class="footer-inner">
        <a target="_self" href="#">Terms & Conditions</a>
        |
        <a target="_self" href="<?php echo $fldField1; ?>">Privacy</a>
        |
        <a target="_self" href="<?php echo $fldField1; ?>">Security</a>
        |
        <a target="_self" href="<?php echo $fldField1; ?>">About Us</a>
        |
        <a target="_self" href="<?php echo $fldField1; ?>">Contact Us</a>
      </div>
      <div class="footer-tools">
          Copyright &#169; 2014 UNITEN E-Car Rental
      </div>
    </div>
  </div>
</div>
<!--END FOOTER -->
</body>
</html>
<?php

//-------------------------------
// Footer Show end
//-------------------------------
}
//===============================

?>
