<?php
/*********************************************************************************
 *       Filename: Contact.php
 *       PHP 4.0 build 11/30/2001
 *       PHP 5.0 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// Contact CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// Contact CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "Contact.php";
//===============================


//===============================
// Contact PageSecurity begin
// Contact PageSecurity end
//===============================

//===============================
// Contact Open Event begin
// Contact Open Event end
//===============================

//===============================
// Contact OpenAnyPage Event start
// Contact OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// Contact Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <title>E-Car Rental - Contact Us</title>
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
       <?php Contact_show() ?>


        <div align="center">
          <table class="table">
            <tr>
              <td>
                <br />
                  <p align="center">
                    UNITEN E-Car Rental is located virtually at</p>
                  <p align="center">
                    Universiti Tenaga Nasional Jalan IKRAM-UNITEN,</p>
                  <p align="center">
                    43000 Kajang, Selangor</p>
                  <p align="center">
                    Fax. 03-59555921</p>
                  <p align="center">
                    Tel. 03-5300277</p>
                  </div></td>
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

// Contact Show end

//===============================
// Contact Close Event begin
// Contact Close Event end
//===============================
//********************************************************************************


//===============================
// Display Menu Form
//-------------------------------
function Contact_show()
{
  global $db;
  global $styles;
  $sFormTitle = "Contact Us";

//-------------------------------
// Contact Open Event begin
// Contact Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
//-------------------------------
// Contact Show begin
//-------------------------------


//-------------------------------
// Contact BeforeShow Event begin
// Contact BeforeShow Event end
//-------------------------------

//-------------------------------
// Show fields
//-------------------------------

?>
    <table class="table" style="width:100%">
			<thead>
     <tr style="background-color: #336699;  border-style: outset; border-width: 1">
      <th colspan="0"  style="text-align: Center">
				<span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
     </tr>
		</thead>
    </table>
<?php

//-------------------------------
// Contact Show end
//-------------------------------
}
//===============================

?>
