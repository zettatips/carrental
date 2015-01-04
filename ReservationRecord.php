<?php
/*********************************************************************************
 *       Filename: ReservationRecord.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// ReservationRecord CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// ReservationRecord CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "ReservationRecord.php";
//===============================


//===============================
// ReservationRecord PageSecurity begin
check_security(1);
// ReservationRecord PageSecurity end
//===============================

//===============================
// ReservationRecord Open Event begin
// ReservationRecord Open Event end
//===============================

//===============================
// ReservationRecord OpenAnyPage Event start
// ReservationRecord OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// ReservationRecord Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sReservationRecordErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "ReservationRecord":
    ReservationRecord_action($sAction);
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
  <title>E-Car Rental - Reservation Record</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
<?php ReservationRecord_show() ?>
    <SCRIPT Language="JavaScript">
if (document.forms["ReservationRecord"])
document.ReservationRecord.onsubmit=delconf;
function delconf() {
if (document.ReservationRecord.FormAction.value == 'delete')
  return confirm('Delete record?');
}
</SCRIPT>
<br />
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// ReservationRecord Show end

//===============================
// ReservationRecord Close Event begin
// ReservationRecord Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function ReservationRecord_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sReservationRecordErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKorder_id = "";
  $fldmember_id = "";
  $fldquantity = "";
//-------------------------------

//-------------------------------
// ReservationRecord Action begin
//-------------------------------
  $sActionFileName = "Reservation.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// ReservationRecord BeforeCancel Event begin
// ReservationRecord BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName);
  }
//-------------------------------


//-------------------------------
// Build WHERE statement
//-------------------------------
  if($sAction == "update" || $sAction == "delete")
  {
    $pPKorder_id = get_param("PK_order_id");
    if( !strlen($pPKorder_id)) return;
    $sWhere = "order_id=" . tosql($pPKorder_id, "Number");
  }
//-------------------------------


//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldUserID = get_session("UserID");
  $fldmember_id = get_param("member_id");
  $fldquantity = get_param("quantity");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldquantity))
      $sReservationRecordErr .= "The value in field No. of Hour(s) is required.<br>";

    if(!is_number($fldmember_id))
      $sReservationRecordErr .= "The value in field member_id is incorrect.<br>";

    if(!is_number($fldquantity))
      $sReservationRecordErr .= "The value in field No. of Hour(s) is incorrect.<br>";

//-------------------------------
// ReservationRecord Check Event begin
// ReservationRecord Check Event end
//-------------------------------
    if(strlen($sReservationRecordErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "update":

//-------------------------------
// ReservationRecord Update Event begin
// ReservationRecord Update Event end
//-------------------------------
        $sSQL = "update orders set " .
          "member_id=" . tosql($fldmember_id, "Number") .
          ",quantity=" . tosql($fldquantity, "Number");
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
//-------------------------------
// ReservationRecord Delete Event begin
// ReservationRecord Delete Event end
//-------------------------------
        $sSQL = "delete from orders where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// ReservationRecord BeforeExecute Event begin
// ReservationRecord BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sReservationRecordErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// ReservationRecord Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function ReservationRecord_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sReservationRecordErr;
  global $styles;

  $fldorder_id = "";
  $fldmember_id = "";
  $flditem_id = "";
  $fldquantity = "";
//-------------------------------
// ReservationRecord Show begin
//-------------------------------
  $sFormTitle = "Reservation";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
     <form method="POST" action="<?php echo $sFileName; ?>" name="ReservationRecord">
     <thead>
       <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="2">
         <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
       </tr>
     </thead>
       <?php if ($sReservationRecordErr) { ?>
     <thead>
    		<tr>
          <th style="background-color: #FFFFFF; border-width: 1" colspan="2">
          <span style="font-size: 12pt; color: #000000"><?php echo $sReservationRecordErr; ?></span></th>
        </tr>
     </thead>
       <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sReservationRecordErr == "")
  {
    $porder_id = get_param("order_id");
  }
  else
  {
    $fldorder_id = strip(get_param("order_id"));
    $fldmember_id = strip(get_param("member_id"));
    $fldquantity = strip(get_param("quantity"));
    $porder_id = get_param("PK_order_id");
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  if( !strlen($porder_id)) $bPK = false;

  $sWhere .= "order_id=" . tosql($porder_id, "Number");
//-------------------------------
//-------------------------------
// ReservationRecord Open Event begin
// ReservationRecord Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from orders where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "ReservationRecord") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $flditem_id = $db->f("item_id");
    $fldmember_id = $db->f("member_id");
    $fldorder_id = $db->f("order_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sReservationRecordErr == "")
    {
      $fldquantity = $db->f("quantity");
    }
//-------------------------------
// ReservationRecord ShowEdit Event begin
// ReservationRecord ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sReservationRecordErr == "")
    {
      $fldmember_id = tohtml(get_session("UserID"));
    }
//-------------------------------
// ReservationRecord ShowInsert Event begin
// ReservationRecord ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Set lookup fields
//-------------------------------
  $flditem_id = get_db_value("SELECT name FROM items WHERE item_id=" . tosql($flditem_id, "Number"));
//-------------------------------
// ReservationRecord Show Event begin
// ReservationRecord Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Vehicle #</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($flditem_id); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">No. of Hour(s)</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" class="form-control" name="quantity" maxlength="5" value="<?php echo tohtml($fldquantity); ?>" size="5" ></span>
       </td>
     </tr>
    <tr><td colspan="2" align="right">

<?php if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <button class="btn btn-primary" type="submit" value="Update" onclick="document.ReservationRecord.FormAction.value = 'update';">Update</button>
  <button class="btn btn-primary" type="submit" value="Delete" onclick="document.ReservationRecord.FormAction.value = 'delete';">Delete</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.ReservationRecord.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="ReservationRecord">

  <input type="hidden" name="PK_order_id" value="<?php echo $porder_id; ?>">
  <input type="hidden" name="order_id" value="<?php echo tohtml($fldorder_id); ?>">
  <input type="hidden" name="member_id" value="<?php echo tohtml($fldmember_id); ?>">
  </td></tr>
  </form>
  </table>
<?php



//-------------------------------
// ReservationRecord Close Event begin
// ReservationRecord Close Event end
//-------------------------------

//-------------------------------
// ReservationRecord Show end
//-------------------------------
}
//===============================
?>
