<?php
/*********************************************************************************
 *       Filename: Registration.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// Registration CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// Registration CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "Registration.php";
//===============================


//===============================
// Registration PageSecurity begin
// Registration PageSecurity end
//===============================

//===============================
// Registration Open Event begin
// Registration Open Event end
//===============================

//===============================
// Registration OpenAnyPage Event start
// Registration OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// Registration Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sRegErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Reg":
    Reg_action($sAction);
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
  <title>E-Car Rental - Registration</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php Header_show() ?>
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <?php Reg_show() ?>
  </div>
  <div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>

<?php
// Registration Show end

//===============================
// Registration Close Event begin
// Registration Close Event end
//===============================
//********************************************************************************

//===============================
// Action of the Record Form
//-------------------------------
function Reg_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sRegErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKmember_id = "";
  $fldmember_login = "";
  $fldmember_password = "";
  $fldmember_password2 = "";
  $fldfirst_name = "";
  $fldlast_name = "";
  $fldemail = "";
  $fldaddress = "";
  $fldphone = "";
  $fldcard_type_id = "";
  $fldcard_number = "";
//-------------------------------

//-------------------------------
// Reg Action begin
//-------------------------------
  $sActionFileName = "index.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// Reg BeforeCancel Event begin
// Reg BeforeCancel Event end
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
  $fldmember_login = get_param("member_login");
  $fldmember_password = get_param("member_password");
  $fldmember_password2 = get_param("member_password2");
  $fldfirst_name = get_param("first_name");
  $fldlast_name = get_param("last_name");
  $fldemail = get_param("email");
  $fldaddress = get_param("address");
  $fldphone = get_param("phone");
  $fldcard_type_id = get_param("card_type_id");
  $fldcard_number = get_param("card_number");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldmember_login))
      $sRegErr .= "The value in field Username* is required.<br>";

    if(!strlen($fldmember_password))
      $sRegErr .= "The value in field Password* is required.<br>";

    if(!strlen($fldmember_password2))
      $sRegErr .= "The value in field Confirm Password* is required.<br>";

    if(!strlen($fldfirst_name))
      $sRegErr .= "The value in field First Name* is required.<br>";

    if(!strlen($fldlast_name))
      $sRegErr .= "The value in field Last Name* is required.<br>";

    if(!strlen($fldemail))
      $sRegErr .= "The value in field Email* is required.<br>";

    if(!is_number($fldcard_type_id))
      $sRegErr .= "The value in field Credit Card Type is incorrect.<br>";

    if(strlen($fldmember_login) )
    {
      $iCount = 0;

      if($sAction == "insert")
        $iCount = get_db_value("SELECT count(*) FROM members WHERE member_login=" . tosql($fldmember_login, "Text"));
      else if($sAction == "update")
        $iCount = get_db_value("SELECT count(*) FROM members WHERE member_login=" . tosql($fldmember_login, "Text") . " and not(" . $sWhere . ")");
      if($iCount > 0)
        $sRegErr .= "The value in field Username* is already in database.<br>";
    }

//-------------------------------
// Reg Check Event begin
if (get_param("member_password") != get_param("member_password2"))
  $sRegErr .= "\nPassword and Confirm Password fields don't match";
// Reg Check Event end
//-------------------------------
    if(strlen($sRegErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// Reg Insert Event begin
// Reg Insert Event end
//-------------------------------
        $sSQL = "insert into members (" .
          "member_login," .
          "member_password," .
          "first_name," .
          "last_name," .
          "email," .
          "address," .
          "phone," .
          "card_type_id," .
          "card_number)" .
          " values (" .
          tosql($fldmember_login, "Text") . "," .
          tosql($fldmember_password, "Text") . "," .
          tosql($fldfirst_name, "Text") . "," .
          tosql($fldlast_name, "Text") . "," .
          tosql($fldemail, "Text") . "," .
          tosql($fldaddress, "Text") . "," .
          tosql($fldphone, "Text") . "," .
          tosql($fldcard_type_id, "Number") . "," .
          tosql($fldcard_number, "Text") .
          ")";
    break;
    case "update":

//-------------------------------
// Reg Update Event begin
// Reg Update Event end
//-------------------------------
        $sSQL = "update members set " .
          "member_login=" . tosql($fldmember_login, "Text") .
          ",member_password=" . tosql($fldmember_password, "Text") .
          ",first_name=" . tosql($fldfirst_name, "Text") .
          ",last_name=" . tosql($fldlast_name, "Text") .
          ",email=" . tosql($fldemail, "Text") .
          ",address=" . tosql($fldaddress, "Text") .
          ",phone=" . tosql($fldphone, "Text") .
          ",card_type_id=" . tosql($fldcard_type_id, "Number") .
          ",card_number=" . tosql($fldcard_number, "Text");
        $sSQL .= " where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// Reg BeforeExecute Event begin
// Reg BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sRegErr))
    return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// Reg Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Reg_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sRegErr;
  global $styles;

  $fldmember_id = "";
  $fldmember_login = "";
  $fldmember_password = "";
  $fldfirst_name = "";
  $fldlast_name = "";
  $fldemail = "";
  $fldaddress = "";
  $fldphone = "";
  $fldcard_type_id = "";
  $fldcard_number = "";
//-------------------------------
// Reg Show begin
//-------------------------------
  $sFormTitle = "Registration";
  $sWhere = "";
  $bPK = true;
  $scard_type_idDisplayValue = "";

?>

   <table class="table" style="width:100%">
   <form method="POST" action="<?php echo $sFileName; ?>" name="Reg">
     <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
           <th style="text-align: Center" colspan="2">
             <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span>
          </th>
        </tr>
      </thead>
       <?php if ($sRegErr) { ?>
        <thead>
      		<tr>
            <th style="background-color: #FFFFFF; border-width: 1" colspan="2">
              <span style="font-size: 13pt; color: #000000"><?php echo $sRegErr; ?></span>
            </th>
          </tr>
        </thead>
    	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sRegErr == "")
  {
  }
  else
  {
    $fldmember_id = strip(get_param("member_id"));
    $fldmember_login = strip(get_param("member_login"));
    $fldmember_password = strip(get_param("member_password"));
    $fldfirst_name = strip(get_param("first_name"));
    $fldlast_name = strip(get_param("last_name"));
    $fldemail = strip(get_param("email"));
    $fldaddress = strip(get_param("address"));
    $fldphone = strip(get_param("phone"));
    $fldcard_type_id = strip(get_param("card_type_id"));
    $fldcard_number = strip(get_param("card_number"));
  }
//-------------------------------

//-------------------------------
// Load all form fields

  $fldmember_password2 = get_param("member_password2");
//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  $pmember_id = get_session("UserID");
  if( !strlen($pmember_id))
    $bPK = false;

  $sWhere .= "member_id=" . tosql($pmember_id, "Number");
//-------------------------------
//-------------------------------
// Reg Open Event begin
// Reg Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from members where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Reg") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldmember_id = $db->f("member_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sRegErr == "")
    {
      $fldmember_login = $db->f("member_login");
      $fldmember_password = $db->f("member_password");
      $fldfirst_name = $db->f("first_name");
      $fldlast_name = $db->f("last_name");
      $fldemail = $db->f("email");
      $fldaddress = $db->f("address");
      $fldphone = $db->f("phone");
      $fldcard_type_id = $db->f("card_type_id");
      $fldcard_number = $db->f("card_number");
    }
//-------------------------------
// Reg ShowEdit Event begin
// Reg ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sRegErr == "")
    {
      $fldmember_id = tohtml(get_session("UserID"));
    }
//-------------------------------
// Reg ShowInsert Event begin
// Reg ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Reg Show Event begin
// Reg Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
?>
  <tr>
    <td>
    <br />
    <fieldset>

      <div class="control-group">
        <!-- Username -->
        <label class="control-label"  for="username">Username</label>
        <div class="controls">
          <input type="text" class="form-control" id="username" name="member_login" value="<?php echo tohtml($fldmember_login); ?>" placeholder="" class="input-xlarge">
          <p class="help-block">Username can contain any letters or numbers, without spaces</p>
        </div>
      </div>

      <div class="control-group">
        <!-- First Name -->
        <label class="control-label"  for="username">First Name</label>
        <div class="controls">
          <input type="text" class="form-control" id="FirstName" name="first_name" value="<?php echo tohtml($fldfirst_name); ?>" placeholder="" class="input-xlarge">
          <p class="help-block">First Name can contain any letters, with spaces</p>
        </div>
      </div>

      <div class="control-group">
        <!-- Last Name -->
        <label class="control-label"  for="LastName">Last Name</label>
        <div class="controls">
          <input type="text" class="form-control" id="LastName" name="last_name" value="<?php echo tohtml($fldlast_name); ?>" placeholder="" class="input-xlarge">
          <p class="help-block">Last Name can contain any letters, with spaces</p>
        </div>
      </div>

      <div class="control-group">
        <!-- E-mail -->
        <label class="control-label" for="email">E-mail</label>
        <div class="controls">
          <input type="text" class="form-control" id="email" name="email" value="<?php echo tohtml($fldemail); ?>" placeholder="" class="input-xlarge">
          <p class="help-block">Please provide your E-mail</p>
        </div>
      </div>

      <div class="control-group">
        <!-- Password-->
        <label class="control-label" for="password">Password</label>
        <div class="controls">
          <input type="password" class="form-control" id="password" name="member_password" value="<?php echo tohtml($fldmember_password); ?>" placeholder="" class="input-xlarge">
          <p class="help-block">Password should be at least 4 characters</p>
        </div>
      </div>

      <div class="control-group">
        <!-- Password -->
        <label class="control-label"  for="password_confirm">Password (Confirm)</label>
        <div class="controls">
          <input type="password" class="form-control" id="password_confirm" name="member_password2" value="<?php echo tohtml($fldmember_password2); ?>" placeholder="" class="input-xlarge">
          <p class="help-block">Please confirm password</p>
        </div>
      </div>

      <div class="control-group">
        <!-- Address -->
        <label class="control-label"  for="AddressLine1">Address</label>
        <div class="controls">
          <input type="text" class="form-control" id="AddressLine1" name="address" value="<?php echo tohtml($fldaddress); ?>" placeholder="" class="input-xlarge" size="50">
          <p class="help-block">Address can contain any letters or numbers, with spaces</p>
        </div>
      </div>

      <div class="control-group">
        <!-- Phone -->
        <label class="control-label"  for="Phone">Phone</label>
        <div class="controls">
          <input type="text" class="form-control" id="Phone" name="phone" maxlength="50" value="<?php echo tohtml($fldphone); ?>" placeholder="" class="input-xlarge">
          <p class="help-block">Phone can contain only numbers, without spaces</p>
        </div>
      </div>

      <div class="control-group">
      <!-- Credit Card Type -->
      <label class="control-label"  for="CreditCard">Credit Card Type</label>
        <div class="controls">
          <select class="form-control" name="card_type_id">
            <?php
            $lookup_card_type_id = db_fill_array("select card_type_id, name from card_types order by 2");

            if(is_array($lookup_card_type_id))
            {
              reset($lookup_card_type_id);
              while(list($key, $value) = each($lookup_card_type_id))
              {
                if($key == $fldcard_type_id)
                $option="<option SELECTED value=\"$key\">$value</option>";
                else
                $option="<option value=\"$key\">$value</option>";
                echo $option;
              }
            }
            ?>
          </select>
          <p class="help-block">Please select one Credit Card Type</p>
        </div>
      </div>

      <div class="control-group">
        <!-- Credit Card Number -->
        <label class="control-label"  for="CreditCardNumber">Credit Card Number</label>
        <div class="controls">
          <input type="text" class="form-control" id="Phone" name="card_number" value="<?php echo tohtml($fldcard_number); ?>" placeholder="" class="input-xlarge">
          <p class="help-block">Credit Card Number can contain only numbers, without spaces</p>
        </div>
      </div>

      <?php if (!$bIsUpdateMode) { ?>
        <input type="hidden" value="insert" name="FormAction">
        <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button class="btn btn-success" onclick="document.Reg.FormAction.value = 'insert';">Register</button>
          </div>
        </div>

        <?php } ?>
        <?php if ($bIsUpdateMode) { ?>
          <input type="hidden" value="update" name="FormAction"/>
          <div class="control-group">
            <!-- Button -->
            <div class="controls">
              <button class="btn btn-success" onclick="document.Reg.FormAction.value = 'update';">Update</button>
            </div>
          </div>
          <?php } ?>

          <input type="hidden" name="FormName" value="Reg">
          <input type="hidden" name="PK_member_id" value="<?php echo $pmember_id; ?>">
          <input type="hidden" name="member_id" value="<?php echo tohtml($fldmember_id); ?>">

    </fieldset>
    </td>
  </tr>
  <tr>
    <td><br /></td>
  </tr>
      </form>
    </table>

<?php

//-------------------------------
// Reg Close Event begin
// Reg Close Event end
//-------------------------------

//-------------------------------
// Reg Show end
//-------------------------------
}
//===============================
?>
