<?php
/*********************************************************************************
 *       Filename: VehicleDetail.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// VehicleDetail CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// VehicleDetail CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "VehicleDetail.php";
//===============================


//===============================
// VehicleDetail PageSecurity begin
check_security(1);
// VehicleDetail PageSecurity end
//===============================

//===============================
// VehicleDetail Open Event begin
// VehicleDetail Open Event end
//===============================

//===============================
// VehicleDetail OpenAnyPage Event start
// VehicleDetail OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// VehicleDetail Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sDetailErr = "";
$sOrderErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Detail":
    Detail_action($sAction);
  break;
  case "Order":
    Order_action($sAction);
  break;
}
//===============================

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<?php Header_show() ?>

<div class="col-md-3"></div>
 <div class="col-md-6">
<?php Detail_show() ?>


<?php Order_show() ?>


<?php TermsCondition_show() ?>
    <table width="778" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="377" valign="top"><table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="372"></td>
        </tr>
      </table>

      <table width="355" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#3399CC">
        <tr>
          <td>
            <p align="center"><span color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>TERMS AND CONDITIONS</b> </span></p>
          </td>
        </tr>
      </table>
      <table width="355" border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
          <td width="15" valign="top"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">1</span></td>
          <td width="340"><div align="justify"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Reservations shall be confirmes three (3) days before the departure date</span></div></td>
        </tr>
        <tr>
          <td valign="top"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">2</span></td>
          <td><div align="justify"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Downpayment of fifty percent (50%) of the contract amount (fare) shall be paid prior to the departure date</span></div></td>
        </tr>
        <tr>
          <td valign="top"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">3</span></td>
          <td><div align="justify"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"> If and when cancellation of trips shall be made on or before the date of departure, fifty percent (50%) downpayment shall be forfeited.</span></div></td>
        </tr>
        <tr>
          <td valign="top"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">4</span></td>
          <td><div align="justify"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"> Toll fee, parking fee and entrance fee shall be charged to the customers.</span></div></td>
        </tr>
      </table>
      <table width="355" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#3399CC">
        <tr>
          <td>
            <p align="center"><span color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>Rental
            Policy</b> </span></p>
          </td>
        </tr>
      </table>
      <table width="355" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="justify"><span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Important
              Policy Information: All rentals require a clean driving record.
              A valid driver's license or any valid and recent ID in the name
              of the renter will be required at the time of rental. Customers
              planning to rent with cash must bring the following documentation
              to the rental counter: valid Driver's License or any valid and recent
              ID, verifiable employment, verifiable home phone number or a current
              verifiable gas or electric bill with the renter's name and address.
              All documentation must be in the renter's name. A cash deposit will
              be required in addition to the cost of rental. </span></div></td>
        </tr>
      </table>
      <table width="355" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#3399CC">
        <tr>
          <td>
            <p align="center"><span color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>Complete
            your Reservation</b></span></p>
          </td>
        </tr>
      </table>
      <table width="355" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><form name="form1" method="post" action="">
              <div align="center">
                <input type="checkbox" name="checkbox" value="checkbox">
                <span color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">I Agree with the Terms and Conditions </span></div>
          </form></td>
        </tr>
      </table>
 </td>
  </tr>
</table>
<br />
<br />
</div>
<div class="col-md-3"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// VehicleDetail Show end

//===============================
// VehicleDetail Close Event begin
// VehicleDetail Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function Detail_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;
  global $sForm;
  global $sDetailErr;

  $bExecSQL = true;
  $sActionFileName = "";
  $sParams = "?";
  $sWhere = "";
  $bErr = false;
  $pPKitem_id = "";
//-------------------------------

//-------------------------------
// Detail Action begin
//-------------------------------
  $sActionFileName = "Reservation.php";
  $sParams .= "item_id=" . urlencode(get_param("Trn_item_id"));

//-------------------------------
// Load all form fields into variables
//-------------------------------
//-------------------------------
// Detail BeforeExecute Event begin
// Detail BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sDetailErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName . $sParams);

//-------------------------------
// Detail Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Detail_show()
{
  global $db;
  global $sAction;
  global $sForm;
  global $sFileName;
  global $sDetailErr;

  $flditem_id = "";
  $fldname = "";
  $fldmodel = "";
  $fldcategory_id = "";
  $fldprice = "";
  $fldimage_url = "";
  $fldnotes = "";
  $fldproduct_url = "";
//-------------------------------
// Detail Show begin
//-------------------------------
  $sFormTitle = "S E L E C T E D - V E H I C L E - I T E M - D E T A I L S";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
     <form method="POST" action="<?php echo $sFileName; ?>" name="Detail">
     <thead>
       <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="2">
           <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
       </tr>
     </thead>
     <?php if ($sDetailErr) { ?>
  		<tr><td style="background-color: #FFFFFF; border-width: 1" colspan="2">
        <span style="font-size: 12pt; color: #000000"><?php echo $sDetailErr; ?></span></td></tr>
  	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sDetailErr == "")
  {
    $flditem_id = get_param("item_id");
    $trn_item_id = get_param("item_id");
    $pitem_id = get_param("item_id");
  }
  else
  {
    $flditem_id = strip(get_param("item_id"));
    $trn_item_id = get_param("Trn_item_id");
    $pitem_id = get_param("PK_item_id");
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  if( !strlen($pitem_id)) $bPK = false;

  $sWhere .= "item_id=" . tosql($pitem_id, "Number");
//-------------------------------
//-------------------------------
// Detail Open Event begin
// Detail Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from items where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Detail") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldcategory_id = $db->f("category_id");
    $fldimage_url_URLLink = $db->f("product_url");
    $fldimage_url = $db->f("image_url");
    $flditem_id = $db->f("item_id");
    $fldmodel = $db->f("model");
    $fldname = $db->f("name");
    $fldnotes = $db->f("notes");
    $fldprice = $db->f("price");
    $fldproduct_url_URLLink = $db->f("product_url");
    $fldproduct_url = $db->f("product_url");
//-------------------------------
// Detail ShowEdit Event begin
// Detail ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sDetailErr == "")
    {
      $flditem_id = tohtml(get_param("item_id"));
    }
//-------------------------------
// Detail ShowInsert Event begin
// Detail ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Set lookup fields
//-------------------------------
  $fldcategory_id = get_db_value("SELECT name FROM categories WHERE category_id=" . tosql($fldcategory_id, "Number"));
  if($sDetailErr == "")
  {
//-------------------------------
// Detail Show Event begin
$fldimage_url="<img style=\"border: 1px solid black\" src=" . $fldimage_url . ">";
$fldproduct_url="Review this Vehicle on Philmar.com";
// Detail Show Event end
//-------------------------------
  }

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Vehicle</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldname); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Model</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldmodel); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Category</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldcategory_id); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Out of Town Rate</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
      RM <?php echo tohtml($fldprice); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Picture</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <a href="<?php echo $fldimage_url_URLLink; ?>">
             <span style="font-size: 12pt; color: #000000"><?php echo $fldimage_url; ?>
             </span></a>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Notes</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
      <?php echo $fldnotes; ?>&nbsp;</span>
       </td>
     </tr>

  <input type="hidden" name="FormName" value="Detail">

  <input type="hidden" name="Trn_item_id" value="<?php echo $trn_item_id; ?>">
  <input type="hidden" name="Rqd_item_id" value="<?php echo $rqd_item_id; ?>">
  <input type="hidden" name="PK_item_id" value="<?php echo $pitem_id; ?>">
  <input type="hidden" name="item_id" value="<?php echo tohtml($flditem_id); ?>">

  </form>
  </table>
<?php



//-------------------------------
// Detail Close Event begin
// Detail Close Event end
//-------------------------------

//-------------------------------
// Detail Show end
//-------------------------------
}
//===============================

//===============================
// Action of the Record Form
//-------------------------------
function Order_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;
  global $sForm;
  global $sOrderErr;

  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKorder_id = "";
  $flditem_id = "";
  $fldreservation_type = "";
  $fldquantity = "";
  $fldlocation = "";
  $fldpulocation = "";
  $fldpudate = "";
  $fldpuday = "";
  $fldputime = "";
  $flddolocation = "";
  $flddodate = "";
  $flddoday = "";
  $flddotime = "";
//-------------------------------

//-------------------------------
// Order Action begin
//-------------------------------
  $sActionFileName = "Reservation.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// Order BeforeCancel Event begin
// Order BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName);
  }
//-------------------------------

//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldUserID = get_session("UserID");
  $flditem_id = get_param("item_id");
  $fldreservation_type = get_param("reservation_type");
  $fldquantity = get_param("quantity");
  $fldlocation = get_param("location");
  $fldpulocation = get_param("pulocation");
  $fldpudate = get_param("pudate");
  $fldpuday = get_param("puday");
  $fldputime = get_param("putime");
  $flddolocation = get_param("dolocation");
  $flddodate = get_param("dodate");
  $flddoday = get_param("doday");
  $flddotime = get_param("dotime");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldreservation_type))
      $sOrderErr .= "The value in field Reservation Type * is required.<br>";

    if(!strlen($fldquantity))
      $sOrderErr .= "The value in field No. of Hour(s) * is required.<br>";

    if(!strlen($fldlocation))
      $sOrderErr .= "The value in field Destination Location * is required.<br>";

    if(!strlen($fldpulocation))
      $sOrderErr .= "The value in field Pick-Up Location * is required.<br>";

    if(!strlen($fldpudate))
      $sOrderErr .= "The value in field Pick-Up Date (Month/Year) * is required.<br>";

    if(!strlen($fldpuday))
      $sOrderErr .= "The value in field Pick-Up Date (Day) * is required.<br>";

    if(!strlen($fldputime))
      $sOrderErr .= "The value in field Pick-Up Time * is required.<br>";

    if(!strlen($flddolocation))
      $sOrderErr .= "The value in field Drop-Off Location * is required.<br>";

    if(!strlen($flddodate))
      $sOrderErr .= "The value in field Drop-Off Date (Month/Year) * is required.<br>";

    if(!strlen($flddoday))
      $sOrderErr .= "The value in field Drop-Off Date (Day) * is required.<br>";

    if(!strlen($flddotime))
      $sOrderErr .= "The value in field Drop-Off Time * is required.<br>";

    if(!is_number($flditem_id))
      $sOrderErr .= "The value in field Vehicle # is incorrect.<br>";

    if(!is_number($fldquantity))
      $sOrderErr .= "The value in field No. of Hour(s) * is incorrect.<br>";

//-------------------------------
// Order Check Event begin
// Order Check Event end
//-------------------------------
    if(strlen($sOrderErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// Order Insert Event begin
// Order Insert Event end
//-------------------------------
        $sSQL = "insert into orders (" .
          "member_id," .
          "item_id," .
          "reservation_type," .
          "quantity," .
          "location," .
          "pulocation," .
          "pudate," .
          "puday," .
          "putime," .
          "dolocation," .
          "dodate," .
          "doday," .
          "dotime)" .
          " values (" .
          tosql($fldUserID, "Number") . "," .
          tosql($flditem_id, "Number") . "," .
          tosql($fldreservation_type, "Text") . "," .
          tosql($fldquantity, "Number") . "," .
          tosql($fldlocation, "Text") . "," .
          tosql($fldpulocation, "Text") . "," .
          tosql($fldpudate, "Text") . "," .
          tosql($fldpuday, "Text") . "," .
          tosql($fldputime, "Text") . "," .
          tosql($flddolocation, "Text") . "," .
          tosql($flddodate, "Text") . "," .
          tosql($flddoday, "Text") . "," .
          tosql($flddotime, "Text") .
          ")";
    break;
  }
//-------------------------------
//-------------------------------
// Order BeforeExecute Event begin
// Order BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sOrderErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// Order Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Order_show()
{
  global $db;
  global $sAction;
  global $sForm;
  global $sFileName;
  global $sOrderErr;


  $fldorder_id = "";
  $flditem_id = "";
  $fldreservation_type = "";
  $fldquantity = "";
  $fldlocation = "";
  $fldpulocation = "";
  $fldpudate = "";
  $fldpuday = "";
  $fldputime = "";
  $flddolocation = "";
  $flddodate = "";
  $flddoday = "";
  $flddotime = "";
//-------------------------------
// Order Show begin
//-------------------------------
  $sFormTitle = "R E S E R V A T I O N  -  E N T R Y";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
       <form method="POST" action="<?php echo $sFileName; ?>" name="Order">
     <thead>
       <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <td style="text-align: Center" colspan="2">
           <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold">
             <?php echo $sFormTitle; ?></span></td>
       </tr>
     </thead>
       <?php if ($sOrderErr) { ?>
    		<tr>
          <td style="background-color: #FFFFFF; border-width: 1" colspan="2">
            <span style="font-size: 12pt; color: #000000">
              <?php echo $sOrderErr; ?></span></td></tr>
    	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sOrderErr == "")
  {
    $flditem_id = get_param("item_id");
    $porder_id = get_param("order_id");
  }
  else
  {
    $fldorder_id = strip(get_param("order_id"));
    $flditem_id = strip(get_param("item_id"));
    $fldreservation_type = strip(get_param("reservation_type"));
    $fldquantity = strip(get_param("quantity"));
    $fldlocation = strip(get_param("location"));
    $fldpulocation = strip(get_param("pulocation"));
    $fldpudate = strip(get_param("pudate"));
    $fldpuday = strip(get_param("puday"));
    $fldputime = strip(get_param("putime"));
    $flddolocation = strip(get_param("dolocation"));
    $flddodate = strip(get_param("dodate"));
    $flddoday = strip(get_param("doday"));
    $flddotime = strip(get_param("dotime"));
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
// Order Open Event begin
// Order Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from orders where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Order") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $flditem_id = $db->f("item_id");
    $fldorder_id = $db->f("order_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sOrderErr == "")
    {
      $fldreservation_type = $db->f("reservation_type");
      $fldquantity = $db->f("quantity");
      $fldlocation = $db->f("location");
      $fldpulocation = $db->f("pulocation");
      $fldpudate = $db->f("pudate");
      $fldpuday = $db->f("puday");
      $fldputime = $db->f("putime");
      $flddolocation = $db->f("dolocation");
      $flddodate = $db->f("dodate");
      $flddoday = $db->f("doday");
      $flddotime = $db->f("dotime");
    }
//-------------------------------
// Order ShowEdit Event begin
// Order ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sOrderErr == "")
    {
      $flditem_id = tohtml(get_param("item_id"));
      $fldquantity= "1";
    }
//-------------------------------
// Order ShowInsert Event begin
// Order ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Order Show Event begin
// Order Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Reservation Type *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
<?php
    $lookup_reservation_type = db_fill_array("select reservation_type, reservation_type from reservation_type order by 2");

    if(is_array($lookup_reservation_type))
    {
      reset($lookup_reservation_type);
      while(list($key, $value) = each($lookup_reservation_type))
      {
        if($key == $fldreservation_type)
          $option="<input type=\"radio\" name=\"reservation_type\" value=\"$key\" checked > <span " ."style=\"font-size: 12pt; color: #000000\""." >$value</span><br>";
        else
          $option="<input type=\"radio\" name=\"reservation_type\" value=\"$key\" > <span " ."style=\"font-size: 12pt; color: #000000\""." >$value</span><br>";
        echo $option;
      }
    }


?></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">No. of Hour(s) *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="quantity" maxlength="10" value="<?php echo tohtml($fldquantity); ?>" size="10" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Destination Location *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="location" maxlength="50" value="<?php echo tohtml($fldlocation); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Pick-Up Location *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000"><select class="form-control" name="pulocation">
<?php
    $lookup_pulocation = db_fill_array("select location, location from location order by 2");

    if(is_array($lookup_pulocation))
    {
      reset($lookup_pulocation);
      while(list($key, $value) = each($lookup_pulocation))
      {
        if($key == $fldpulocation)
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
         <span style="font-size: 12pt; color: #000000">Pick-Up Date (Month/Year) *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000"><select class="form-control" name="pudate">
<?php
    $lookup_pudate = db_fill_array("select dates, dates from dates order by 2");

    if(is_array($lookup_pudate))
    {
      reset($lookup_pudate);
      while(list($key, $value) = each($lookup_pudate))
      {
        if($key == $fldpudate)
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
         <span style="font-size: 12pt; color: #000000">Pick-Up Date (Day) *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000"><select class="form-control" name="puday">
<?php
    $lookup_puday = db_fill_array("select days, days from days order by 2");

    if(is_array($lookup_puday))
    {
      reset($lookup_puday);
      while(list($key, $value) = each($lookup_puday))
      {
        if($key == $fldpuday)
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
         <span style="font-size: 12pt; color: #000000">Pick-Up Time *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000"><select class="form-control" name="putime">
<?php
    $lookup_putime = db_fill_array("select times, times from times order by 2");

    if(is_array($lookup_putime))
    {
      reset($lookup_putime);
      while(list($key, $value) = each($lookup_putime))
      {
        if($key == $fldputime)
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
         <span style="font-size: 12pt; color: #000000">Drop-Off Location *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000"><select class="form-control" name="dolocation">
<?php
    $lookup_dolocation = db_fill_array("select location, location from location order by 2");

    if(is_array($lookup_dolocation))
    {
      reset($lookup_dolocation);
      while(list($key, $value) = each($lookup_dolocation))
      {
        if($key == $flddolocation)
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
         <span style="font-size: 12pt; color: #000000">Drop-Off Date (Month/Year) *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000"><select class="form-control" name="dodate">
<?php
    $lookup_dodate = db_fill_array("select dates, dates from dates order by 2");

    if(is_array($lookup_dodate))
    {
      reset($lookup_dodate);
      while(list($key, $value) = each($lookup_dodate))
      {
        if($key == $flddodate)
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
         <span style="font-size: 12pt; color: #000000">Drop-Off Date (Day) *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000"><select class="form-control" name="doday">
<?php
    $lookup_doday = db_fill_array("select days, days from days order by 2");

    if(is_array($lookup_doday))
    {
      reset($lookup_doday);
      while(list($key, $value) = each($lookup_doday))
      {
        if($key == $flddoday)
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
         <span style="font-size: 12pt; color: #000000">Drop-Off Time *</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000"><select class="form-control" name="dotime">
<?php
    $lookup_dotime = db_fill_array("select times, times from times order by 2");

    if(is_array($lookup_dotime))
    {
      reset($lookup_dotime);
      while(list($key, $value) = each($lookup_dotime))
      {
        if($key == $flddotime)
          $option="<option SELECTED value=\"$key\">$value";
        else
          $option="<option value=\"$key\">$value";
        echo $option;
      }
    }

?></select></span>
       </td>
     </tr>
    <tr><td colspan="2" align="right">
<?php if (!$bIsUpdateMode) { ?>
   <input type="hidden" value="insert" name="FormAction">
   <button class="btn btn-primary" type="submit" value="Add to Reservation" onclick="document.Order.FormAction.value = 'insert';">Insert</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.Order.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="Order">

  <input type="hidden" name="PK_order_id" value="<?php echo $porder_id; ?>">
  <input type="hidden" name="order_id" value="<?php echo tohtml($fldorder_id); ?>">
  <input type="hidden" name="item_id" value="<?php echo tohtml($flditem_id); ?>">
  </td></tr>
  </form>
  </table>
<?php



//-------------------------------
// Order Close Event begin
// Order Close Event end
//-------------------------------

//-------------------------------
// Order Show end
//-------------------------------
}
//===============================

//===============================
// Display Menu Form
//-------------------------------
function TermsCondition_show()
{
  global $db;

  $sFormTitle = "";

//-------------------------------
// TermsCondition Open Event begin
// TermsCondition Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
//-------------------------------
// TermsCondition Show begin
//-------------------------------


//-------------------------------
// TermsCondition BeforeShow Event begin
// TermsCondition BeforeShow Event end
//-------------------------------

//-------------------------------
// Show fields
//-------------------------------

?>

<?php

//-------------------------------
// TermsCondition Show end
//-------------------------------
}
//===============================

?>
