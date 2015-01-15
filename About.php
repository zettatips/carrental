<?php
/*********************************************************************************
 *       Filename: About.php
 *		   PHP 5.3.29 build 10/12/2014
 *********************************************************************************/

function About_main()
{
//===============================
// About Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>

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

<?php
}
// About Show end

//===============================
// Display Menu Form
//-------------------------------
function About_show()
{

  $sFormTitle = "About Us";

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

?>
