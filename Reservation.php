<?php
/*********************************************************************************
 *       Filename: Reservation.php
 *       PHP 4.0 build 11/30/2001
 *       PHP 5.0 build 15/12/2014
 *********************************************************************************/

//-------------------------------
// Reservation CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// Reservation CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "Reservation.php";
//===============================


//===============================
// Reservation PageSecurity begin
check_security(1);
// Reservation PageSecurity end
//===============================

//===============================
// Reservation Open Event begin
// Reservation Open Event end
//===============================

//===============================
// Reservation OpenAnyPage Event start
// Reservation OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// Reservation Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sMemberErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Member":
    Member_action($sAction);
  break;
}
//===============================

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Reservation</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>
<div class="col-md-3"></div>
<div class="col-md-6">
  <?php Member_show() ?>
  <br />
  <?php Items_show() ?>
  <br />
  <?php Total_show() ?>
  <br />
</div>
<div class="col-md-3"></div>

<?php Footer_show() ?>

</body>
</html>

<?php

// Reservation Show end

//===============================
// Reservation Close Event begin
// Reservation Close Event end
//===============================
//********************************************************************************


//===============================
// Display Grid Form
//-------------------------------
function Items_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sItemsErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Vehicle Items";
  $HasParam = false;
  $bReq = true;
  $iRecordsPerPage = 20;
  $iCounter = 0;

  $transit_params = "";
  $form_params = "";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
       <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="6">
           <a name="Items"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></th>
        </tr>
      </thead>
        <tr>
         <td>
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Details</span></td>
         <td>
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Reservation #</span></td>
         <td>
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Vehicle</span></td>
         <td>
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Rate (RM)</span></td>
         <td>
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">No. of Hour(s)</span></td>
         <td>
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Total (RM)</span></td>
        </tr>
<?php

//-------------------------------
// Build WHERE statement
//-------------------------------
  $pUserID = get_session("UserID");
  //$pUserID = $_SESSION['UserID'];
  if(is_number($pUserID) && strlen($pUserID))
    $pUserID = tosql($pUserID, "Number");
  else
    $pUserID = "";

  if(strlen($pUserID))
  {
    $HasParam = true;
    $sWhere = $sWhere . "member_id=" . $pUserID;
  }
  else
  {
    $bReq = false;
  }


  if($HasParam)
    $sWhere = " AND (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "SELECT order_id, name, if(orders.reservation_type <> 'Out of Town', 250, price), quantity, member_id, quantity * if(orders.reservation_type <> 'Out of Town', 250, price) as sub_total FROM items, orders WHERE orders.item_id=items.item_id";
  $sOrder = " ORDER BY order_id";
//-------------------------------

//-------------------------------
// Items Open Event begin
// Items Open Event end
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
//-------------------------------



//-------------------------------
// Process if form has all required parameters
//-------------------------------
  if(!$bReq)
  {
?>
     <tr>
      <td colspan="6" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
    </table>
<?php
    return;
  }
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  $db->query($sSQL);
  $next_record = $db->next_record();
//-------------------------------
// Process empty recordset
//-------------------------------
  if(!$next_record)
  {
?>
     <tr>
      <td colspan="6" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
<?php

?>
  </table>
<?php

    return;
  }

//-------------------------------

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iRecordsPerPage = 20;
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Display grid based on recordset
//-------------------------------
  while($next_record  && $iCounter < $iRecordsPerPage)
  {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldField1_URLLink = "ReservationRecord.php";
    $fldField1_order_id = $db->f("order_id");
    $fldprice = $db->f("if(orders.reservation_type <> 'Out of Town', 250, price)");
    $flditem_id = $db->f("name");
    $fldorder_id = $db->f("order_id");
    $fldquantity = $db->f("quantity");
    $fldsub_total = $db->f("sub_total");
    $fldField1= "Details";
    $next_record = $db->next_record();

//-------------------------------
// Items Show begin
//-------------------------------

//-------------------------------
// Items Show Event begin
// Items Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
    <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldField1_URLLink; ?>?order_id=<?php echo $fldField1_order_id; ?>&<?php echo  $transit_params; ?>">
           <span class="btn btn-info"><?php echo $fldField1; ?></span></a>&nbsp;</span></td>
       <td><span style="font-size: 12pt; color: #000000">
         <?php echo  tohtml($fldorder_id); ?>&nbsp;</span></td>
       <td><span style="font-size: 12pt; color: #000000">
         <?php echo tohtml($flditem_id); ?>&nbsp;</span></td>
       <td><span style="font-size: 12pt; color: #000000">
         <?php echo tohtml($fldprice); ?>&nbsp;</span></td>
       <td><span style="font-size: 12pt; color: #000000">
         <?php echo tohtml($fldquantity); ?>&nbsp;</span></td>
       <td><span style="font-size: 12pt; color: #000000">
         <?php echo tohtml($fldsub_total); ?>&nbsp;</span></td>
    </tr>
    <?php
//-------------------------------
// Items Show end
//-------------------------------

//-------------------------------
// Move to the next record and increase record counter
//-------------------------------

    $iCounter++;
  }



//-------------------------------
// Finish form processing
//-------------------------------
  ?>
    </table>
  <?php


//-------------------------------
// Items Close Event begin
// Items Close Event end
//-------------------------------
}
//===============================


//===============================
// Display Grid Form
//-------------------------------
function Total_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sTotalErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "";
  $HasParam = false;
  $bReq = true;
  $iRecordsPerPage = 20;
  $iCounter = 0;

  $transit_params = "";
  $form_params = "";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
      <tr>
       <td><span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Total (RM)</td>
      </tr>
<?php

//-------------------------------
// Build WHERE statement
//-------------------------------
  $pUserID = get_session("UserID");
  //$pUserID = $_SESSION['UserID'];
  if(is_number($pUserID) && strlen($pUserID))
    $pUserID = tosql($pUserID, "Number");
  else
    $pUserID = "";

  if(strlen($pUserID))
  {
    $HasParam = true;
    $sWhere = $sWhere . "member_id=" . $pUserID;
  }
  else
  {
    $bReq = false;
  }


  if($HasParam)
    $sWhere = " AND (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "SELECT member_id, sum(quantity * if(orders.reservation_type <> 'Out of Town', 250, price)) as sub_total FROM items, orders WHERE orders.item_id=items.item_id";
  $sOrder = " GROUP BY member_id";
//-------------------------------

//-------------------------------
// Total Open Event begin
// Total Open Event end
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
//-------------------------------



//-------------------------------
// Process if form has all required parameters
//-------------------------------
  if(!$bReq)
  {
?>
     <tr>
      <td colspan="1" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
    </table>
<?php
    return;
  }
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  $db->query($sSQL);
  $next_record = $db->next_record();
//-------------------------------
// Process empty recordset
//-------------------------------
  if(!$next_record)
  {
?>
     <tr>
      <td colspan="1" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
<?php

?>
  </table>
<?php

    return;
  }

//-------------------------------

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iRecordsPerPage = 20;
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Display grid based on recordset
//-------------------------------
  while($next_record  && $iCounter < $iRecordsPerPage)
  {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldsub_total = $db->f("sub_total");
    $next_record = $db->next_record();

//-------------------------------
// Total Show begin
//-------------------------------

//-------------------------------
// Total Show Event begin
// Total Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldsub_total) ?>&nbsp;</span></td>
    </tr>
    <?php
//-------------------------------
// Total Show end
//-------------------------------

//-------------------------------
// Move to the next record and increase record counter
//-------------------------------

    $iCounter++;
  }



//-------------------------------
// Finish form processing
//-------------------------------
  ?>
    </table>
  <?php


//-------------------------------
// Total Close Event begin
// Total Close Event end
//-------------------------------
}
//===============================


//===============================
// Action of the Record Form
//-------------------------------
function Member_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sMemberErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sParams = "?";
  $sWhere = "";
  $bErr = false;
  $pPKmember_id = "";
//-------------------------------

//-------------------------------
// Member Action begin
//-------------------------------
  $sActionFileName = "AdminMenu.php";
  $sParams .= "UserID=" . urlencode(get_param("Trn_UserID"));

//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldUserID = get_session("UserID");
  //$fldUserID = $_SESSION['UserID'];
//-------------------------------
// Member BeforeExecute Event begin
// Member BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sMemberErr))
    return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName . $sParams);

//-------------------------------
// Member Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Member_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sMemberErr;
  global $styles;

  $fldmember_id = "";
  $fldmember_login = "";
  $fldname = "";
  $fldlast_name = "";
  $fldaddress = "";
  $fldemail = "";
  $fldphone = "";
//-------------------------------
// Member Show begin
//-------------------------------
  $sFormTitle = "User Information";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
     <form method="POST" action="<?php echo $sFileName; ?>" name="Member">
   <thead>
     <tr style="background-color: #336699; border-style: outset; border-width: 1">
       <th style="text-align: Center" colspan="2">
       <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
     </tr>
   </thead>
     <?php if ($sMemberErr) { ?>
    <thead>
  		<tr><td style="background-color: #FFFFFF; border-width: 1" colspan="2">
        <span style="font-size: 12pt; color: #000000"><?php echo $sMemberErr; ?></span></td>
      </tr>
    </thead>
  	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sMemberErr == "")
  {
  }
  else
  {
    $fldmember_id = strip(get_param("member_id"));
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  $pmember_id = get_session("UserID");
  //$pmember_id = $_SESSION['UserID'];
  if( !strlen($pmember_id))
    $bPK = false;

  $sWhere .= "member_id=" . tosql($pmember_id, "Number");
//-------------------------------
//-------------------------------
// Member Open Event begin
// Member Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from members where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Member") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldaddress = $db->f("address");
    $fldemail = $db->f("email");
    $fldname = $db->f("first_name");
    $fldlast_name = $db->f("last_name");
    $fldmember_id = $db->f("member_id");
    $fldmember_login_URLLink = "MyInfo.php";
    $fldmember_login = $db->f("member_login");
    $fldphone = $db->f("phone");
//-------------------------------
// Member ShowEdit Event begin
// Member ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sMemberErr == "")
    {
      $fldmember_id = tohtml(get_session("UserID"));
      //$fldmember_id = tohtml($_SESSION['UserID']);
    }
//-------------------------------
// Member ShowInsert Event begin
// Member ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Member Show Event begin
// Member Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Username</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <a href="<?php echo $fldmember_login_URLLink; ?>?<?php echo $transit_params; ?>">
             <span class="btn btn-info"><?php echo $fldmember_login; ?></span></a>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">First Name</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <?php  echo tohtml($fldname); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Last Name</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <?php echo tohtml($fldlast_name); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Address</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <?php echo  tohtml($fldaddress); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Email</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <?php echo tohtml($fldemail); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Phone</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <?php echo tohtml($fldphone); ?>&nbsp;</span>
       </td>
     </tr>

  <input type="hidden" name="FormName" value="Member">

  <input type="hidden" name="Trn_UserID" value="<?php echo $trn_UserID; ?>">
  <input type="hidden" name="PK_member_id" value="<?php echo $pmember_id; ?>">
  <input type="hidden" name="member_id" value="<?php echo tohtml($fldmember_id); ?>">

  </form>
  </table>
<?php



//-------------------------------
// Member Close Event begin
// Member Close Event end
//-------------------------------

//-------------------------------
// Member Show end
//-------------------------------
}
//===============================
?>
