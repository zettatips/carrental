<?php
/*********************************************************************************
 *       Filename: MembersInfo.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// MembersInfo CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// MembersInfo CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "MembersInfo.php";
//===============================


//===============================
// MembersInfo PageSecurity begin
check_security(2);
// MembersInfo PageSecurity end
//===============================

//===============================
// MembersInfo Open Event begin
// MembersInfo Open Event end
//===============================

//===============================
// MembersInfo OpenAnyPage Event start
// MembersInfo OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// MembersInfo Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sRecordErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Record":
    Record_action($sAction);
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
  <title>E-Car Rental - Members</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php  Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
  <?php  Record_show() ?>
  <?php
    if(!$_SESSION['admin'])
    Orders_show();
  ?>
</div>
<div class="col-md-4"></div>

<?php  Footer_show() ?>

</body>
</html>
<?php

// MembersInfo Show end

//===============================
// MembersInfo Close Event begin
// MembersInfo Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function Record_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sRecordErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKmember_id = "";
//-------------------------------

//-------------------------------
// Record Action begin
//-------------------------------
  $sActionFileName = "AdminMenu.php";

//-------------------------------
// Load all form fields into variables
//-------------------------------
//-------------------------------
// Record BeforeExecute Event begin
// Record BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sRecordErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// Record Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Record_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sRecordErr;
  global $styles;

  $fldmember_id = "";
  $fldmember_login = "";
  $fldmember_level = "";
  $fldname = "";
  $fldlast_name = "";
  $fldemail = "";
  $fldphone = "";
  $fldaddress = "";
  $fldnotes = "";
//-------------------------------
// Record Show begin
//-------------------------------
  $sFormTitle = "Member Info";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
     <form method="POST" action="<?php echo $sFileName; ?>" name="Record">
    <thead>
       <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="2">
           <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle ?></span>
         </th>
      </tr>
    </thead>
   <?php  if ($sRecordErr) { ?>
     <thead>
		   <tr>
         <th style="background-color: #FFFFFF; border-width: 1" colspan="2">
           <span style="font-size: 12pt; color: #000000"><?php echo $sRecordErr; ?></span>
         </th>
       </tr>
     </thead>
	 <?php  } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sRecordErr == "")
  {
    $pmember_id = get_param("member_id");
  }
  else
  {
    $fldmember_id = strip(get_param("member_id"));
    $pmember_id = get_param("PK_member_id");
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  if( !strlen($pmember_id)) $bPK = false;

  $sWhere .= "member_id=" . tosql($pmember_id, "Number");
//-------------------------------
//-------------------------------
// Record Open Event begin
// Record Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from members where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Record") && $db->next_record());
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
    $fldmember_level = $db->f("member_level");
    $fldmember_login_URLLink = "MembersRecord.php";
    $fldmember_login_member_id = $db->f("member_id");
    $fldmember_login = $db->f("member_login");
    $fldnotes = $db->f("notes");
    $fldphone = $db->f("phone");
//-------------------------------
// Record ShowEdit Event begin
// Record ShowEdit Event end
//-------------------------------
  }
  else
  {
//-------------------------------
// Record ShowInsert Event begin
// Record ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Record Show Event begin
// Record Show Event end
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
           <a href="<?php echo   $fldmember_login_URLLink; ?>?member_id=<?php echo $fldmember_login_member_id; ?>&<?php echo $transit_params; ?>">
             <span class="btn btn-info"><?php echo $fldmember_login; ?></span></a>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Level</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldmember_level); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">First Name</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldname); ?>&nbsp;</span>
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
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Address</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldaddress); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Notes</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldnotes); ?>&nbsp;</span>
       </td>
     </tr>
  <input type="hidden" name="FormName" value="Record">
  <input type="hidden" name="PK_member_id" value="<?php echo $pmember_id; ?>">
  <input type="hidden" name="member_id" value="<?php echo tohtml($fldmember_id); ?>">
  </form>
  </table>
<?php



//-------------------------------
// Record Close Event begin
// Record Close Event end
//-------------------------------

//-------------------------------
// Record Show end
//-------------------------------
}
//===============================

//===============================
// Display Grid Form
//-------------------------------
function Orders_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sOrdersErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Reservation";
  $HasParam = false;
  $bReq = true;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";

  $transit_params = "member_id=" . tourl(get_param("member_id")) . "&";
  $form_params = "member_id=" . tourl(get_param("member_id")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $iSort = get_param("FormOrders_Sorting");
  $iSorted = get_param("FormOrders_Sorted");
  if(!$iSort)
  {
    $form_sorting = "";
  }
  else
  {
    if($iSort == $iSorted)
    {
      $form_sorting = "";
      $sDirection = " DESC";
      $sSortParams = "FormOrders_Sorting=" . $iSort . "&FormOrders_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormOrders_Sorting=" . $iSort . "&FormOrders_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by o.order_id" . $sDirection;
    if ($iSort == 2) $sOrder = " order by i.name" . $sDirection;
    if ($iSort == 3) $sOrder = " order by o.quantity" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
      <thead>
        <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="3">
           <a name="Orders"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></th>
        </tr>
        <tr>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params?>FormOrders_Sorting=1&FormOrders_Sorted=<?php echo  $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Reservation #</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormOrders_Sorting=2&FormOrders_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Vehicle #</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormOrders_Sorting=3&FormOrders_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">No. of  Hour(s)</span></a></th>
        </tr>
      </thead>
<?php

//-------------------------------
// Build WHERE statement
//-------------------------------
  $pmember_id = get_param("member_id");
  if(is_number($pmember_id) && strlen($pmember_id))
    $pmember_id = tosql($pmember_id, "Number");
  else
    $pmember_id = "";

  if(strlen($pmember_id))
  {
    $HasParam = true;
    $sWhere = $sWhere . "o.member_id=" . $pmember_id;
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
  $sSQL = "select o.item_id as o_item_id, " .
    "o.member_id as o_member_id, " .
    "o.order_id as o_order_id, " .
    "o.quantity as o_quantity, " .
    "i.item_id as i_item_id, " .
    "i.name as i_name " .
    " from orders o, items i" .
    " where i.item_id=o.item_id  ";
//-------------------------------

//-------------------------------
// Orders Open Event begin
// Orders Open Event end
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
      <td colspan="3" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
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
      <td colspan="3" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
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
    $flditem_id = $db->f("i_name");
    $fldorder_id_URLLink = "OrdersRecord.php";
    $fldorder_id_order_id = $db->f("o_order_id");
    $fldorder_id = $db->f("o_order_id");
    $fldquantity = $db->f("o_quantity");
    $next_record = $db->next_record();

//-------------------------------
// Orders Show begin
//-------------------------------

//-------------------------------
// Orders Show Event begin
// Orders Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldorder_id_URLLink; ?>?order_id=<?php echo $fldorder_id_order_id; ?>&<?php echo $transit_params; ?>">
           <span class="btn btn-info"><?php echo $fldorder_id; ?></span></a>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($flditem_id); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldquantity); ?>&nbsp;</span></td>
      </tr><?php
//-------------------------------
// Orders Show end
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
// Orders Close Event begin
// Orders Close Event end
//-------------------------------
}
//===============================

?>
