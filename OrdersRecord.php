<?php
/*********************************************************************************
 *       Filename: OrdersRecord.php
 *       PHP 5.3.29 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// OrdersRecord CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// OrdersRecord CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "OrdersRecord.php";
//===============================


//===============================
// OrdersRecord PageSecurity begin
check_security(2);
// OrdersRecord PageSecurity end
//===============================

//===============================
// OrdersRecord Open Event begin
// OrdersRecord Open Event end
//===============================

//===============================
// OrdersRecord OpenAnyPage Event start
// OrdersRecord OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// OrdersRecord Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sOrdersErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Orders":
    Orders_action($sAction);
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
  <title>E-Car Rental - Reservation Details</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
<?php Orders_show() ?>
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// OrdersRecord Show end

//===============================
// OrdersRecord Close Event begin
// OrdersRecord Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function Orders_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sOrdersErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sParams = "?";
  $sWhere = "";
  $bErr = false;
  $pPKorder_id = "";
  $fldmember_id = "";
  $flditem_id = "";
  $fldquantity = "";
//-------------------------------

//-------------------------------
// Orders Action begin
//-------------------------------
  $sActionFileName = "OrdersGrid.php";
  $sParams .= "item_id=" . urlencode(get_param("Trn_item_id")) . "&";
  $sParams .= "member_id=" . urlencode(get_param("Trn_member_id"));

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// Orders BeforeCancel Event begin
// Orders BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName . $sParams);
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
  $fldmember_id = get_param("member_id");
  $flditem_id = get_param("item_id");
  $fldquantity = get_param("quantity");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldmember_id))
      $sOrdersErr .= "The value in field Member is required.<br>";

    if(!strlen($flditem_id))
      $sOrdersErr .= "The value in field Vehicle # is required.<br>";

    if(!strlen($fldquantity))
      $sOrdersErr .= "The value in field No. of Hour(s) is required.<br>";

    if(!is_number($fldmember_id))
      $sOrdersErr .= "The value in field Member is incorrect.<br>";

    if(!is_number($flditem_id))
      $sOrdersErr .= "The value in field Vehicle # is incorrect.<br>";

    if(!is_number($fldquantity))
      $sOrdersErr .= "The value in field No. of Hour(s) is incorrect.<br>";

//-------------------------------
// Orders Check Event begin
// Orders Check Event end
//-------------------------------
    if(strlen($sOrdersErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// Orders Insert Event begin
// Orders Insert Event end
//-------------------------------
        $sSQL = "insert into orders (" .
          "member_id," .
          "item_id," .
          "quantity)" .
          " values (" .
          tosql($fldmember_id, "Number") . "," .
          tosql($flditem_id, "Number") . "," .
          tosql($fldquantity, "Number") .
          ")";
    break;
    case "update":

//-------------------------------
// Orders Update Event begin
// Orders Update Event end
//-------------------------------
        $sSQL = "update orders set " .
          "member_id=" . tosql($fldmember_id, "Number") .
          ",item_id=" . tosql($flditem_id, "Number") .
          ",quantity=" . tosql($fldquantity, "Number");
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
//-------------------------------
// Orders Delete Event begin
// Orders Delete Event end
//-------------------------------
        $sSQL = "delete from orders where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// Orders BeforeExecute Event begin
// Orders BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sOrdersErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName . $sParams);

//-------------------------------
// Orders Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Orders_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sOrdersErr;
  global $styles;

  $fldorder_id = "";
  $fldmember_id = "";
  $flditem_id = "";
  $fldquantity = "";
//-------------------------------
// Orders Show begin
//-------------------------------
  $sFormTitle = "Orders";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
     <form method="POST" action="<?php echo $sFileName; ?>" name="Orders">
     <thead>
       <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="2">
           <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle ?></span>
         </th>
       </tr>
     </thead>
     <?php if ($sOrdersErr) { ?>
      <thead>
    		<tr>
          <td style="background-color: #FFFFFF; border-width: 1" colspan="2">
            <span style="font-size: 12pt; color: #000000"><?php echo $sOrdersErr; ?></span>
          </td>
        </tr>
      </thead>
  	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sOrdersErr == "")
  {
    $flditem_id = get_param("item_id");
    $fldmember_id = get_param("member_id");
    $fldorder_id = get_param("order_id");
    $trn_item_id = get_param("item_id");
    $trn_member_id = get_param("member_id");
    $porder_id = get_param("order_id");
  }
  else
  {
    $fldmember_id = strip(get_param("member_id"));
    $flditem_id = strip(get_param("item_id"));
    $fldquantity = strip(get_param("quantity"));
    $trn_item_id = get_param("Trn_item_id");
    $trn_member_id = get_param("Trn_member_id");
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
// Orders Open Event begin
// Orders Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from orders where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Orders") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldorder_id = $db->f("order_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sOrdersErr == "")
    {
      $fldmember_id = $db->f("member_id");
      $flditem_id = $db->f("item_id");
      $fldquantity = $db->f("quantity");
    }
//-------------------------------
// Orders ShowEdit Event begin
// Orders ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sOrdersErr == "")
    {
      $fldorder_id = tohtml(get_param("order_id"));
      $fldmember_id = tohtml(get_param("member_id"));
      $flditem_id = tohtml(get_param("item_id"));
    }
//-------------------------------
// Orders ShowInsert Event begin
// Orders ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Orders Show Event begin
// Orders Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Reservation #</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <?php echo tohtml($fldorder_id); ?>&nbsp;</span>
       </td>
      </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Member</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000"><select class="form-control" size="1" name="member_id">
<?php
    $lookup_member_id = db_fill_array("select member_id, member_login from members order by 2");

    if(is_array($lookup_member_id))
    {
      reset($lookup_member_id);
      while(list($key, $value) = each($lookup_member_id))
      {
        if($key == $fldmember_id)
          $option="<option SELECTED value=\"$key\">$value";
        else
          $option="<option value=\"$key\">$value";
        echo $option;
      }
    }

?></select></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Vehicle #</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000"><select class="form-control" size="1" name="item_id">
<?php
    $lookup_item_id = db_fill_array("select item_id, name from items order by 2");

    if(is_array($lookup_item_id))
    {
      reset($lookup_item_id);
      while(list($key, $value) = each($lookup_item_id))
      {
        if($key == $flditem_id)
          $option="<option SELECTED value=\"$key\">$value";
        else
          $option="<option value=\"$key\">$value";
        echo $option;
      }
    }

?></select></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">No. of Hour(s)</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="quantity" maxlength="10" value="<?php echo tohtml($fldquantity); ?>" size="10" ></span>
       </td>
     </tr>
    <tr><td colspan="2" align="right">
<?php if (!$bIsUpdateMode) { ?>
   <input type="hidden" value="insert" name="FormAction">
   <button class="btn btn-primary" type="submit" value="Insert" onclick="document.Orders.FormAction.value = 'insert';">Insert</button>
<?php } ?>
<?php if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <button class="btn btn-primary" type="submit" value="Update" onclick="document.Orders.FormAction.value = 'update';">Update</button>
    <button class="btn btn-primary" type="submit" value="Delete" onclick="document.Orders.FormAction.value = 'delete';">Delete</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.Orders.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="Orders">

  <input type="hidden" name="Trn_item_id" value="<?php echo $trn_item_id; ?>">
  <input type="hidden" name="Trn_member_id" value="<?php echo $trn_member_id; ?>">
  <input type="hidden" name="PK_order_id" value="<?php echo $porder_id; ?>">
  </td></tr>
  </form>
  </table>
<?php



//-------------------------------
// Orders Close Event begin
// Orders Close Event end
//-------------------------------

//-------------------------------
// Orders Show end
//-------------------------------
}
//===============================
?>
