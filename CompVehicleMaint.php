<?php
/*********************************************************************************
 *       Filename: CompVehicleMaint.php
 *       PHP 5.3.29 build 3/2/2015
 *********************************************************************************/

//-------------------------------
// CompVehicleMaint CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// CompVehicleMaint CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "CompVehicleMaint.php";
//===============================

//===============================
// CompVehicleMaint PageSecurity begin
check_security(2);
// CompVehicleMaint PageSecurity end
//===============================

//===============================
// CompVehicleMaint Open Event begin
// CompVehicleMaint Open Event end
//===============================

//===============================
// CompVehicleMaint OpenAnyPage Event start
// CompVehicleMaint OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// CompVehicleMaint Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sVehicleErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Vehicle":
    Vehicle_action($sAction);
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
  <title>E-Car Rental - Add Vehicle</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
 <?php Header_show() ?>
<div class="col-md-3"></div>
<div class="col-md-6">
  <?php Vehicle_show() ?>
      <SCRIPT Language="JavaScript">
  if (document.forms["Book"])
  document.Book.onsubmit=delconf;
  function delconf() {
  if (document.Book.FormAction.value == 'delete')
    return confirm('Delete record?');
  }
  </SCRIPT>
</div>
<div class="col-md-3"></div>

<?php Footer_show() ?>

</body>
</html>

<?php
// CompVehicleMaint Show end

//===============================
// CompVehicleMaint Close Event begin
// CompVehicleMaint Close Event end
//===============================
//********************************************************************************

//===============================
// Action of the Record Form
//-------------------------------
function Vehicle_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;
  global $sForm;
  global $sVehicleErr;

  $bExecSQL = true;
  $sActionFileName = "";
  $sParams = "?";
  $sWhere = "";
  $bErr = false;
  $pPKitem_id = "";
  $fldname = "";
  $fldmodel = "";
  $fldcompany_id = "";
  $fldprice = "";
  $fldimage_url = "";
  $fldnotes = "";

//-------------------------------

//-------------------------------
// Vehicle Action begin
//-------------------------------
  $sActionFileName = "CompAdminVehicle.php";
  $sParams .= "company_id=" . urlencode(get_param("Trn_company_id"));

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// Vehicle BeforeCancel Event begin
// Vehicle BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName . $sParams);
  }
//-------------------------------


//-------------------------------
// Build WHERE statement
//-------------------------------
  if($sAction == "update" || $sAction == "delete")
  {
    $pPKitem_id = get_param("PK_item_id");
    if( !strlen($pPKitem_id)) return;
    $sWhere = "item_id=" . tosql($pPKitem_id, "Number");
  }
//-------------------------------


//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldname = get_param("name");
  $fldmodel = get_param("model");
  $fldcompany_id = get_param("company_id");
  $fldprice = get_param("price");
  $fldimage_url = get_param("image_url");
  $fldnotes = get_param("notes");
  $fldis_recommended = "0";


//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldname))
      $sVehicleErr .= "The value in field Vehicle is required.<br>";

    if(!strlen($fldcompany_id))
      $sVehicleErr .= "The value in field Company is required.<br>";

    if(!strlen($fldprice))
      $sVehicleErr .= "The value in field Rate is required.<br>";

    if(!is_number($fldcompany_id))
      $sVehicleErr .= "The value in field Company is incorrect.<br>";

    if(!is_number($fldprice))
      $sVehicleErr .= "The value in field Rate is incorrect.<br>";

//-------------------------------
// Vehicle Check Event begin
// Vehicle Check Event end
//-------------------------------
    if(strlen($sVehicleErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// Vehicle Insert Event begin
// Vehicle Insert Event end
//-------------------------------
        $sSQL = "insert into items (" .
          "name," .
          "model," .
          "company_id," .
          "price," .
          "product_url," .
          "image_url," .
          "notes," .
          "is_recommended)" .
          " values (" .
          tosql($fldname, "Text") . "," .
          tosql($fldmodel, "Text") . "," .
          tosql($fldcompany_id, "Number") . "," .
          tosql($fldprice, "Number") . "," .
          tosql($fldimage_url, "Text") . "," .
          tosql($fldnotes, "Text") . "," .
          $fldis_recommended .
          ")";
    break;
    case "update":

//-------------------------------
// Vehicle Update Event begin
// Vehicle Update Event end
//-------------------------------
        $sSQL = "update items set " .
          "name=" . tosql($fldname, "Text") .
          ",model=" . tosql($fldmodel, "Text") .
          ",company_id=" . tosql($fldcompany_id, "Number") .
          ",price=" . tosql($fldprice, "Number") .
          ",image_url=" . tosql($fldimage_url, "Text") .
          ",notes=" . tosql($fldnotes, "Text") .
          ",is_recommended=" . $fldis_recommended;
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
//-------------------------------
// Vehicle Delete Event begin
// Vehicle Delete Event end
//-------------------------------
        $sSQL = "delete from items where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// Vehicle BeforeExecute Event begin
// Vehicle BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sVehicleErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName . $sParams);

//-------------------------------
// Vehicle Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Vehicle_show()
{
  global $db;
  global $sAction;
  global $sForm;
  global $sFileName;
  global $sVehicleErr;

  $flditem_id = "";
  $fldname = "";
  $fldmodel = "";
  $fldcompany_id = "";
  $fldprice = "";
  $fldimage_url = "";
  $fldnotes = "";
  $fldis_recommended = "";
//-------------------------------
// Vehicle Show begin
//-------------------------------
  $sFormTitle = "Vehicle";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
   <form method="POST" action="<?php echo $sFileName; ?>" name="Vehicle">
     <thead>
       <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="2">
           <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
       </tr>
     </thead>
     <?php if ($sVehicleErr) { ?>
      <thead>
          <tr><td style="background-color: #FFFFFF; border-width: 1" colspan="2">
            <span style="font-size: 12pt; color: #000000"><?php echo $sVehicleErr ?></span></td>
          </tr>
      </thead>
     <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sVehicleErr == "")
  {
    $fldcompany_id = get_param("company_id");
    $flditem_id = get_param("item_id");
    $trn_company_id = get_param("company_id");
    $pitem_id = get_param("item_id");
  }
  else
  {
    $flditem_id = strip(get_param("item_id"));
    $fldname = strip(get_param("name"));
    $fldmodel = strip(get_param("model"));
    $fldcompany_id = strip(get_param("company_id"));
    $fldprice = strip(get_param("price"));
    $fldimage_url = strip(get_param("image_url"));
    $fldnotes = strip(get_param("notes"));
    $fldis_recommended = "0";
    $trn_company_id = get_param("Trn_company_id");
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
// Vehicle Open Event begin
// Vehicle Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from items where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Vehicle") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $flditem_id = $db->f("item_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sVehicleErr == "")
    {
      $fldname = $db->f("name");
      $fldmodel = $db->f("model");
      $fldcompany_id = $db->f("company_id");
      $fldprice = $db->f("price");
      $fldimage_url = $db->f("image_url");
      $fldnotes = $db->f("notes");
      $fldis_recommended = $db->f("is_recommended");
    }
//-------------------------------
// Vehicle ShowEdit Event begin
// Vehicle ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sVehicleErr == "")
    {
      $flditem_id = tohtml(get_param("item_id"));
      $fldcompany_id = tohtml(get_param("company_id"));
      $fldis_recommended= "0";
    }
//-------------------------------
// Vehicle ShowInsert Event begin
// Vehicle ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Vehicle Show Event begin
// Vehicle Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Vehicle</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="name" maxlength="100" value="<?php echo tohtml($fldname); ?>" size="30" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Model</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="model" maxlength="100" value="<?php echo tohtml($fldmodel); ?>" size="30" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Company</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000"><select class="form-control"  size="1" name="company_id">
<?php
    $lookup_company_id = db_fill_array("select company_id, company_name from companies order by 2");

    if(is_array($lookup_company_id))
    {
      reset($lookup_company_id);
      while(list($key, $value) = each($lookup_company_id))
      {
        if($key == $fldcompany_id)
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
         <span style="font-size: 12pt; color: #000000">Rate</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="price" maxlength="10" value="<?php echo tohtml($fldprice); ?>" size="10" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Image URL</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="image_url" maxlength="100" value="<?php echo tohtml($fldimage_url); ?>" size="40" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Notes</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <textarea class="form-control" name="notes" cols="60" rows="8"><?php echo tohtml($fldnotes); ?></textarea></span>
       </td>
     </tr>

    <tr><td colspan="2" align="right">
<?php if (!$bIsUpdateMode) { ?>
   <input type="hidden" value="insert" name="FormAction">
   <button class="btn btn-primary" type="submit" value="Add" onclick="document.Vehicle.FormAction.value = 'insert';">Insert</button>
<?php } ?>
<?php if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <button class="btn btn-primary" type="submit" value="Update" onclick="document.Vehicle.FormAction.value = 'update';">Update</button>
  <button class="btn btn-primary" type="submit" value="Delete" onclick="document.Vehicle.FormAction.value = 'delete';">Delete</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.Vehicle.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="Vehicle">

  <input type="hidden" name="Trn_company_id" value="<?php echo $trn_company_id; ?>">
  <input type="hidden" name="PK_item_id" value="<?php echo $pitem_id; ?>">
  <input type="hidden" name="item_id" value="<?php echo tohtml($flditem_id); ?>">
  </td></tr>
  </form>
  </table>
<?php



//-------------------------------
// Vehicle Close Event begin
// Vehicle Close Event end
//-------------------------------

//-------------------------------
// Vehicle Show end
//-------------------------------
}
//===============================
?>
