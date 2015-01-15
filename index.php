<?php
/*********************************************************************************
 *       Filename: index.php
 *       PHP 5.3.29 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// Default CustomIncludes begin
include ("./common.php");
include ("./Header.php");
include ("./Footer.php");
include ("./About.php");
include ("./Contact.php");

// Default CustomIncludes end
//-------------------------------


//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "index.php";
//===============================

// Default Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Home</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<!-- Content Row -->
  <div class="row">
    <div class="col-md-3">
      <?php About_main() ?>
    </div>
    <!-- /.col-md-3 -->

  <div class="col-md-6">
      <?php Specials_show() ?>
      <br />
  </div>
  <!-- /.col-md-6 -->

  <div class="col-md-3">
    <?php Contact_main() ?>
  </div>
  <!-- /.col-md-3 -->
</div>
<!--End Content row -->

<?php Footer_show() ?>

</body>
</html>

<?php
//===============================

function Specials_show()
{
//-------------------------------
// Initialize variables
//-------------------------------

  $sFormTitle = "Special Bulletin";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table" style="width:100%">
       <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <td style="text-align: Center;" colspan="1">
           <a name="Specials"><span style="font-size: 12pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></td>
        </tr>
      </thead>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"></span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 0">
         <span style="font-size: 12pt; color: #000000">
      <?php echo $fldarticle_title; ?>&nbsp;</span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"></span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <?php echo $fldarticle_desc; ?>&nbsp;</span></td>
      </tr>
    </table>

<?php

}
//===============================
?>
