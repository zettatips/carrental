<?php
/*********************************************************************************
 *       Filename: About.php
 *       PHP 4.0 build 11/30/2001
 *		   PHP 5.0 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// About CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// About CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "About.php";
//===============================


//===============================
// About PageSecurity begin
// About PageSecurity end
//===============================

//===============================
// About Open Event begin
// About Open Event end
//===============================

//===============================
// About OpenAnyPage Event start
// About OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// About Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - About Us</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
 <?php Header_show() ?>
 <table class="table">
<tr>
  <td align="center">
   <table>
    <tr>
     <td valign="top">
       <?php About_show() ?>

          <div align="center">
            <table class="table">
              <tr>
                <td>
                    <br />
                    <p align="center">UNITEN
                      E-Car Rental is located virtually at Universiti Tenaga Nasional,</span></p>
                    <p align="center"> is a service type of business
                      that lends automobiles and offers travelling services</p>
                    <p align="center">for airport trips out of town trips and other occasional
                      purposes.</p>
                    <p align="center">It
                      is a sole proprietorship, which is running since year 2014.</p>
                </td>
              </tr>
            </table>
          </div>

     </td>
    </tr>
   </table>

</td>
</tr>
</table>

  <?php Footer_show() ?>

</body>
</html>
<?php

// About Show end

//===============================
// About Close Event begin
// About Close Event end
//===============================
//********************************************************************************


//===============================
// Display Menu Form
//-------------------------------
function About_show()
{
  global $db;
  global $styles;
  $sFormTitle = "About Us";

//-------------------------------
// About Open Event begin
// About Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
//-------------------------------
// About Show begin
//-------------------------------


//-------------------------------
// About BeforeShow Event begin
// About BeforeShow Event end
//-------------------------------

//-------------------------------
// Show fields
//-------------------------------

?>
    <table class="table" style="width:100%">
      <thead>
     <tr style="background-color: #336699; border-style: outset; border-width: 1">
      <th colspan="0"  style="text-align: Center">
        <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
     </tr>
   </thead>
    </table>
<?php

//-------------------------------
// About Show end
//-------------------------------
}
//===============================

?>
