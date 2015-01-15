<?php
/*********************************************************************************
 *       Filename: Contact.php
 *       PHP 5.3.29 build 10/12/2014
 *********************************************************************************/
function Contact_main()
{

//===============================
// Contact Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>

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

<?php
}
// Contact Show end

//===============================
// Display Menu Form
//-------------------------------
function Contact_show()
{
  $sFormTitle = "Contact Us";

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
