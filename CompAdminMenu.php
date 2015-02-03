<?php
/*********************************************************************************
 *       Filename: CompAdminMenu.php
 *       PHP 5.3.29 build 2/2/2015
 *********************************************************************************/

//-------------------------------
// CompAdminMenu CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// CompAdminMenu CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "CompCompAdminMenu.php";
//===============================

//===============================
// CompAdminMenu PageSecurity begin
check_security(2);
// CompAdminMenu PageSecurity end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// CompAdminMenu Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Admin Menu</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
  <?php Form_show() ?>
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// CompAdminMenu Show end

//===============================
// CompAdminMenu Close Event begin
// CompAdminMenu Close Event end
//===============================
//********************************************************************************

//===============================
// Display Menu Form
//-------------------------------
function Form_show()
{
  global $db;
  $sFormTitle = "Company Administration Menu";

//-------------------------------
// Form Open Event begin
// Form Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
  $fldField2 = "CompOrdersGrid.php";
  $fldField3 = "CompAdminVehicle.php";
//-------------------------------
// Form Show begin
//-------------------------------


//-------------------------------
// Form BeforeShow Event begin
// Form BeforeShow Event end
//-------------------------------

//-------------------------------
// Show fields
//-------------------------------

?>
    <table class="table table-bordered" style="width:100%">
      <thead>
        <tr style="background-color: #336699;  border-style: outset; border-width: 1">
          <th style="text-align: Center;">
            <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle ?></span></th>
        </tr>
      </thead>
     <tr>
      <td align="Center"><a href="<?php echo $fldField2; ?>">
        <span class="btn btn-success">Reservation</span></a></td>
     </tr>
     <tr>
       <td align="Center"><a href="<?php echo $fldField3; ?>">
        <span class="btn btn-success">Vehicle</span></a></td>
     </tr>
    </table>
    <br />

<?php

//-------------------------------
// Form Show end
//-------------------------------
}
//===============================

?>
