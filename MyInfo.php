<?php
/*********************************************************************************
 *       Filename: MyInfo.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// MyInfo CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// MyInfo CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "MyInfo.php";
//===============================


//===============================
// MyInfo PageSecurity begin
check_security(1);
// MyInfo PageSecurity end
//===============================

//===============================
// MyInfo Open Event begin
// MyInfo Open Event end
//===============================

//===============================
// MyInfo OpenAnyPage Event start
// MyInfo OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// MyInfo Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sFormErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Form":
    Form_action($sAction);
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
  <title>E-Car Rental - My Details</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
  <?php Form_show() ?>
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// MyInfo Show end

//===============================
// MyInfo Close Event begin
// MyInfo Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function Form_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sFormErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKmember_id = "";
  $fldmember_password = "";
  $fldname = "";
  $fldlast_name = "";
  $fldemail = "";
  $fldaddress = "";
  $fldphone = "";
  $fldnotes = "";
  $fldcard_type_id = "";
  $fldcard_number = "";
//-------------------------------

//-------------------------------
// Form Action begin
//-------------------------------
  $sActionFileName = "Reservation.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// Form BeforeCancel Event begin
// Form BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName);
  }
//-------------------------------


//-------------------------------
// Build WHERE statement
//-------------------------------
  if($sAction == "update" || $sAction == "delete")
  {
    $pPKmember_id = get_param("PK_member_id");
    if( !strlen($pPKmember_id)) return;
    $sWhere = "member_id=" . tosql($pPKmember_id, "Number");
  }
//-------------------------------


//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldUserID = get_session("UserID");
  $fldmember_password = get_param("member_password");
  $fldname = get_param("name");
  $fldlast_name = get_param("last_name");
  $fldemail = get_param("email");
  $fldaddress = get_param("address");
  $fldphone = get_param("phone");
  $fldnotes = get_param("notes");
  $fldcard_type_id = get_param("card_type_id");
  $fldcard_number = get_param("card_number");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldmember_password))
      $sFormErr .= "The value in field Password* is required.<br>";

    if(!strlen($fldname))
      $sFormErr .= "The value in field First Name* is required.<br>";

    if(!strlen($fldlast_name))
      $sFormErr .= "The value in field Last Name* is required.<br>";

    if(!strlen($fldemail))
      $sFormErr .= "The value in field Email* is required.<br>";

    if(!is_number($fldcard_type_id))
      $sFormErr .= "The value in field Credit Card Type is incorrect.<br>";

//-------------------------------
// Form Check Event begin
// Form Check Event end
//-------------------------------
    if(strlen($sFormErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "update":

//-------------------------------
// Form Update Event begin
// Form Update Event end
//-------------------------------
        $sSQL = "update members set " .
          "member_password=" . tosql($fldmember_password, "Text") .
          ",first_name=" . tosql($fldname, "Text") .
          ",last_name=" . tosql($fldlast_name, "Text") .
          ",email=" . tosql($fldemail, "Text") .
          ",address=" . tosql($fldaddress, "Text") .
          ",phone=" . tosql($fldphone, "Text") .
          ",notes=" . tosql($fldnotes, "Text") .
          ",card_type_id=" . tosql($fldcard_type_id, "Number") .
          ",card_number=" . tosql($fldcard_number, "Text");
        $sSQL .= " where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// Form BeforeExecute Event begin
// Form BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sFormErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// Form Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Form_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sFormErr;
  global $styles;

  $fldmember_id = "";
  $fldmember_login = "";
  $fldmember_password = "";
  $fldname = "";
  $fldlast_name = "";
  $fldemail = "";
  $fldaddress = "";
  $fldphone = "";
  $fldnotes = "";
  $fldcard_type_id = "";
  $fldcard_number = "";
//-------------------------------
// Form Show begin
//-------------------------------
  $sFormTitle = "MyInfo";
  $sWhere = "";
  $bPK = true;
  $scard_type_idDisplayValue = "";

?>

   <table class="table table-bordered" style="width:100%">
       <form method="POST" action="<?php echo $sFileName; ?>" name="Form">
     <thead>
       <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="2">
         <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
       </tr>
     </thead>
       <?php if ($sFormErr) { ?>
     <thead>
    		<tr>
          <th style="background-color: #FFFFFF; border-width: 1" colspan="2">
            <span style="font-size: 12pt; color: #000000"><?php echo $sFormErr; ?></span></th>
        </tr>
      </thead>
    	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sFormErr == "")
  {
  }
  else
  {
    $fldmember_id = strip(get_param("member_id"));
    $fldmember_password = strip(get_param("member_password"));
    $fldname = strip(get_param("name"));
    $fldlast_name = strip(get_param("last_name"));
    $fldemail = strip(get_param("email"));
    $fldaddress = strip(get_param("address"));
    $fldphone = strip(get_param("phone"));
    $fldnotes = strip(get_param("notes"));
    $fldcard_type_id = strip(get_param("card_type_id"));
    $fldcard_number = strip(get_param("card_number"));
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  $pmember_id = get_session("UserID");
  if( !strlen($pmember_id)) $bPK = false;

  $sWhere .= "member_id=" . tosql($pmember_id, "Number");
//-------------------------------
//-------------------------------
// Form Open Event begin
// Form Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from members where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Form") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldmember_id = $db->f("member_id");
    $fldmember_login = $db->f("member_login");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sFormErr == "")
    {
      $fldmember_password = $db->f("member_password");
      $fldname = $db->f("first_name");
      $fldlast_name = $db->f("last_name");
      $fldemail = $db->f("email");
      $fldaddress = $db->f("address");
      $fldphone = $db->f("phone");
      $fldnotes = $db->f("notes");
      $fldcard_type_id = $db->f("card_type_id");
      $fldcard_number = $db->f("card_number");
    }
//-------------------------------
// Form ShowEdit Event begin
// Form ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sFormErr == "")
    {
      $fldmember_id = tohtml(get_session("UserID"));
    }
//-------------------------------
// Form ShowInsert Event begin
// Form ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Form Show Event begin
// Form Show Event end
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
           <?php echo tohtml($fldmember_login); ?>&nbsp;</span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Password*</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="password" name="member_password" maxlength="20" value="<?php echo tohtml($fldmember_password); ?>" size="20" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">First Name*</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="name" maxlength="50" value="<?php echo tohtml($fldname); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Last Name*</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="last_name" maxlength="50" value="<?php echo tohtml($fldlast_name); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Email*</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="email" maxlength="50" value="<?php echo tohtml($fldemail); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Address</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="address" maxlength="50" value="<?php echo tohtml($fldaddress); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Phone</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="phone" maxlength="50" value="<?php echo tohtml($fldphone); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Notes</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <textarea class="form-control" name="notes" cols="50" rows="5"><?php echo tohtml($fldnotes); ?></textarea></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Credit Card Type</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000"><select class="form-control" size="1" name="card_type_id">
<?php
    echo "<option value=\"\">" . $scard_type_idDisplayValue . "</option>";
    $lookup_card_type_id = db_fill_array("select card_type_id, name from card_types order by 2");

    if(is_array($lookup_card_type_id))
    {
      reset($lookup_card_type_id);
      while(list($key, $value) = each($lookup_card_type_id))
      {
        if($key == $fldcard_type_id)
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
         <span style="font-size: 12pt; color: #000000">Credit Card Number</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="card_number" maxlength="50" value="<?php echo tohtml($fldcard_number); ?>" size="50" ></span>
       </td>
     </tr>
    <tr><td colspan="2" align="right">

<?php if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <button class="btn btn-primary" type="submit" value="Update" onclick="document.Form.FormAction.value = 'update';">Update</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.Form.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="Form">

  <input type="hidden" name="PK_member_id" value="<?php echo $pmember_id; ?>">
  <input type="hidden" name="member_id" value="<?php echo tohtml($fldmember_id); ?>">
  </td></tr>
  </form>
  </table>
<?php



//-------------------------------
// Form Close Event begin
// Form Close Event end
//-------------------------------

//-------------------------------
// Form Show end
//-------------------------------
}
//===============================
?>
