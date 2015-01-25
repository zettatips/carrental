<?php
/*********************************************************************************
 *       Filename: OrdersGrid.php
 *       PHP 5.3.29 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// OrdersGrid CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// OrdersGrid CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "OrdersGrid.php";
//===============================


//===============================
// OrdersGrid PageSecurity begin
check_security(2);
// OrdersGrid PageSecurity end
//===============================

//===============================
// OrdersGrid Open Event begin
// OrdersGrid Open Event end
//===============================

//===============================
// OrdersGrid OpenAnyPage Event start
// OrdersGrid OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// OrdersGrid Show begin

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
<div class="col-md-4"></div>
<div class="col-md-4">
  <?php Orders_show() ?>
  <br />
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// OrdersGrid Show end

//===============================
// OrdersGrid Close Event begin
// OrdersGrid Close Event end
//===============================
//********************************************************************************

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

  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Orders";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $sActionFileName = "OrdersRecord.php";

  $transit_params = "item_id=" . tourl(get_param("item_id")) . "&member_id=" . tourl(get_param("member_id")) . "&";
  $form_params = "item_id=" . tourl(get_param("item_id")) . "&member_id=" . tourl(get_param("member_id")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by o.order_id Asc";
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
    if ($iSort == 1) $sOrder = " order by i.name" . $sDirection;
    if ($iSort == 2) $sOrder = " order by m.member_login" . $sDirection;
    if ($iSort == 3) $sOrder = " order by o.quantity" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
      <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="4"><a name="Orders">
           <span style="font-size: 12pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></th>
        </tr>
      </thead>
        <tr>
         <td style="background-color: #FFFFFF; border-style: inset; border-width: 1"><a >
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Edit</span></a></td>
         <td style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormOrders_Sorting=1&FormOrders_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Vehicle #</span></a></td>
         <td style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormOrders_Sorting=2&FormOrders_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Member</span></a></td>
         <td style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormOrders_Sorting=3&FormOrders_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">No. of Hour(s)</span></a></td>
        </tr>
<?php

//-------------------------------
// Build WHERE statement
//-------------------------------
  $pitem_id = get_param("item_id");
  if(is_number($pitem_id) && strlen($pitem_id))
    $pitem_id = tosql($pitem_id, "Number");
  else
    $pitem_id = "";

  if(strlen($pitem_id))
  {
    $HasParam = true;
    $sWhere = $sWhere . "o.item_id=" . $pitem_id;
  }
  $pmember_id = get_param("member_id");
  if(is_number($pmember_id) && strlen($pmember_id))
    $pmember_id = tosql($pmember_id, "Number");
  else
    $pmember_id = "";

  if(strlen($pmember_id))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "o.member_id=" . $pmember_id;
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
    "i.name as i_name, " .
    "m.member_id as m_member_id, " .
    "m.member_login as m_member_login " .
    " from orders o, items i, members m" .
    " where i.item_id=o.item_id and m.member_id=o.member_id  ";
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
// Process the link to the record page
//-------------------------------
  $form_action = $sActionFileName;
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
      <td colspan="4" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
<?php

//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="4" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"><a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
         <span class="btn btn-success">Insert Reservation</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
// Process page scroller
//-------------------------------
  $iPage = get_param("FormOrders_Page");
  if(!strlen($iPage)) $iPage = 1; else $iPage = intval($iPage);

  if(($iPage - 1) * $iRecordsPerPage != 0)
  {
    do
    {
      $iCounter++;
    } while ($iCounter < ($iPage - 1) * $iRecordsPerPage && $db->next_record());
    $next_record = $db->next_record();
  }

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
    $fldField1_URLLink = "OrdersRecord.php";
    $fldField1_order_id = $db->f("o_order_id");
    $flditem_id = $db->f("i_name");
    $fldmember_id = $db->f("m_member_login");
    $fldorder_id = $db->f("o_order_id");
    $fldquantity = $db->f("o_quantity");
    $fldField1= "Edit";
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
         <a href="<?php echo $fldField1_URLLink; ?>?order_id=<?php echo $fldField1_order_id; ?>&<?php echo $transit_params; ?>">
           <span class="btn btn-info"><?php echo $fldField1; ?></span></a>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($flditem_id); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldmember_id); ?>&nbsp;</span></td>
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
//  Grid. The insert link and record navigator.
//-------------------------------
?>
    <tr>
     <td colspan="4" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">
         <a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
           <span class="btn btn-success">Insert Reservation</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
  // Orders Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
        <span class="btn btn-success">Back</span>
<?php }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php  echo $sSortParams; ?>FormOrders_Page=<?php echo $iPage - 1; ?>#Orders">
          <span class="btn btn-success">Back</span></a>
<?php
    }
    echo "&nbsp;[&nbsp;" . $iPage . "&nbsp;]&nbsp;";

    if (!$bEof) {
?>
          <span class="btn btn-success">Next</span>
<?php
    }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>FormOrders_Page=<?php echo $iPage + 1; ?>#Orders">
          <span class="btn btn-success">Next</span></a>
<?php
    }
  }

//-------------------------------
// Orders Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </span></td></tr>
    </table>
  <?php


//-------------------------------
// Orders Close Event begin
// Orders Close Event end
//-------------------------------
}
//===============================

?>
