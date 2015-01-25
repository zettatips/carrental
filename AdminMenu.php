<?php
/*********************************************************************************
 *       Filename: AdminMenu.php
 *       PHP 5.3.29 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// AdminMenu CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// AdminMenu CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "AdminMenu.php";
//===============================


//===============================
// AdminMenu PageSecurity begin
check_security(2);
// AdminMenu PageSecurity end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// AdminMenu Show begin

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

// AdminMenu Show end

//===============================
// AdminMenu Close Event begin
// AdminMenu Close Event end
//===============================
//********************************************************************************


//===============================
// Display Menu Form
//-------------------------------
function Form_show()
{
  global $db;
  $sFormTitle = "Administration Menu";

//-------------------------------
// Form Open Event begin
// Form Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
  $fldField1 = "MembersGrid.php";
  $fldField2 = "OrdersGrid.php";
  $fldField3 = "AdminVehicle.php";
  $fldField4 = "CategoriesGrid.php";
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
      <td align="Center"><a href="<?php echo $fldField1; ?>">
        <span class="btn btn-success">Members</span></a></td>
     </tr>
     <tr>
      <td align="Center"><a href="<?php echo $fldField2; ?>">
        <span class="btn btn-success">Reservation</span></a></td>
     </tr>
     <tr>
       <td align="Center"><a href="<?php echo $fldField3; ?>">
        <span class="btn btn-success">Vehicle</span></a></td>
     </tr>
     <tr>
       <td align="Center"><a href="<?php echo $fldField4; ?>">
        <span class="btn btn-success">Vehicle Categories</span></a></td>
    </table>
    <br />

<?php

//-------------------------------
// Form Show end
//-------------------------------
}
//===============================

?>
