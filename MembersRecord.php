<?php
/*********************************************************************************
 *       Filename: MembersRecord.php
 *       PHP 5.3.29 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// MembersRecord CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// MembersRecord CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "MembersRecord.php";
//===============================


//===============================
// MembersRecord PageSecurity begin
check_security(2);
// MembersRecord PageSecurity end
//===============================

//===============================
// MembersRecord Open Event begin
// MembersRecord Open Event end
//===============================

//===============================
// MembersRecord OpenAnyPage Event start
// MembersRecord OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// MembersRecord Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sMembersErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Members":
    Members_action($sAction);
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
  <title>E-Car Rental - Add Members</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-3"></div>
<div class="col-md-6">
  <?php Members_show() ?>
  <SCRIPT Language="JavaScript">
    if (document.forms["Members"])
      document.Members.onsubmit=delconf;
    function delconf() {
      if (document.Members.FormAction.value == 'delete')
        return confirm('Delete record?');
    }
  </SCRIPT>
</div>
<div class="col-md-3"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// MembersRecord Show end

//===============================
// MembersRecord Close Event begin
// MembersRecord Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function Members_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sMembersErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sParams = "?";
  $sWhere = "";
  $bErr = false;
  $pPKmember_id = "";
  $fldmember_login = "";
  $fldmember_password = "";
  $fldmember_level = "";
  $fldname = "";
  $fldlast_name = "";
  $fldemail = "";
  $fldphone = "";
  $fldaddress = "";
  $fldnotes = "";
//-------------------------------

//-------------------------------
// Members Action begin
//-------------------------------
  $sActionFileName = "MembersGrid.php";
  $sParams .= "member_login=" . urlencode(get_param("Trn_member_login"));

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// Members BeforeCancel Event begin
// Members BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName . $sParams);
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
  $fldmember_level = get_param("member_level");
  $fldname = get_param("name");
  $fldlast_name = get_param("last_name");
  $fldemail = get_param("email");
  $fldphone = get_param("phone");
  $fldaddress = get_param("address");
  $fldnotes = get_param("notes");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldmember_login))
      $sMembersErr .= "The value in field Username* is required.<br>";

    if(!strlen($fldmember_password))
      $sMembersErr .= "The value in field Password* is required.<br>";

    if(!strlen($fldmember_level))
      $sMembersErr .= "The value in field Level* is required.<br>";

    if(!strlen($fldname))
      $sMembersErr .= "The value in field First Name* is required.<br>";

    if(!strlen($fldlast_name))
      $sMembersErr .= "The value in field Last Name* is required.<br>";

    if(!strlen($fldemail))
      $sMembersErr .= "The value in field Email* is required.<br>";

    if(!is_number($fldmember_level))
      $sMembersErr .= "The value in field Level* is incorrect.<br>";

    if(strlen($fldmember_login) )
    {
      $iCount = 0;

      if($sAction == "insert")
        $iCount = get_db_value("SELECT count(*) FROM members WHERE member_login=" . tosql($fldmember_login, "Text"));
      else if($sAction == "update")
        $iCount = get_db_value("SELECT count(*) FROM members WHERE member_login=" . tosql($fldmember_login, "Text") . " and not(" . $sWhere . ")");
      if($iCount > 0)
        $sMembersErr .= "The value in field Username* is already in database.<br>";
    }

//-------------------------------
// Members Check Event begin
// Members Check Event end
//-------------------------------
    if(strlen($sMembersErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// Members Insert Event begin
// Members Insert Event end
//-------------------------------
        $sSQL = "insert into members (" .
          "member_login," .
          "member_password," .
          "member_level," .
          "first_name," .
          "last_name," .
          "email," .
          "phone," .
          "address," .
          "notes)" .
          " values (" .
          tosql($fldmember_login, "Text") . "," .
          tosql($fldmember_password, "Text") . "," .
          tosql($fldmember_level, "Number") . "," .
          tosql($fldname, "Text") . "," .
          tosql($fldlast_name, "Text") . "," .
          tosql($fldemail, "Text") . "," .
          tosql($fldphone, "Text") . "," .
          tosql($fldaddress, "Text") . "," .
          tosql($fldnotes, "Text") .
          ")";
    break;
    case "update":

//-------------------------------
// Members Update Event begin
// Members Update Event end
//-------------------------------
        $sSQL = "update members set " .
          "member_login=" . tosql($fldmember_login, "Text") .
          ",member_password=" . tosql($fldmember_password, "Text") .
          ",member_level=" . tosql($fldmember_level, "Number") .
          ",first_name=" . tosql($fldname, "Text") .
          ",last_name=" . tosql($fldlast_name, "Text") .
          ",email=" . tosql($fldemail, "Text") .
          ",phone=" . tosql($fldphone, "Text") .
          ",address=" . tosql($fldaddress, "Text") .
          ",notes=" . tosql($fldnotes, "Text");
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
//-------------------------------
// Members Delete Event begin
// Members Delete Event end
//-------------------------------
        $sSQL = "delete from members where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// Members BeforeExecute Event begin
// Members BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sMembersErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName . $sParams);

//-------------------------------
// Members Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Members_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sMembersErr;
  global $styles;

  $fldmember_id = "";
  $fldmember_login = "";
  $fldmember_password = "";
  $fldmember_level = "";
  $fldname = "";
  $fldlast_name = "";
  $fldemail = "";
  $fldphone = "";
  $fldaddress = "";
  $fldnotes = "";

//-------------------------------
// Members Show begin
//-------------------------------
  $sFormTitle = "Members";
  $sWhere = "";
  $bPK = true;
  $scard_type_idDisplayValue = "";

?>

   <table class="table table-bordered" style="width:100%">
     <form method="POST" action="<?php echo $sFileName; ?>" name="Members">
       <thead>
         <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1" >
           <td style="text-align: Center" colspan="2">
             <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span>
           </td>
          </tr>
       </thead>
  <?php if ($sMembersErr) { ?>
      <thead>
		      <tr>
            <td style="background-color: #FFFFFF; border-width: 1" colspan="2">
              <span style="font-size: 12pt; color: #000000"><?php echo $sMembersErr; ?></span>
            </td>
          </tr>
      </thead>
	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sMembersErr == "")
  {
    $fldmember_login = get_param("member_login");
    $fldmember_id = get_param("member_id");
    $trn_member_login = get_param("member_login");
    $pmember_id = get_param("member_id");
  }
  else
  {
    $fldmember_id = strip(get_param("member_id"));
    $fldmember_login = strip(get_param("member_login"));
    $fldmember_password = strip(get_param("member_password"));
    $fldmember_level = strip(get_param("member_level"));
    $fldname = strip(get_param("name"));
    $fldlast_name = strip(get_param("last_name"));
    $fldemail = strip(get_param("email"));
    $fldphone = strip(get_param("phone"));
    $fldaddress = strip(get_param("address"));
    $fldnotes = strip(get_param("notes"));
    $fldcard_type_id = strip(get_param("card_type_id"));
    $fldcard_number = strip(get_param("card_number"));
    $trn_member_login = get_param("Trn_member_login");
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
// Members Open Event begin
// Members Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from members where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Members") && $db->next_record());
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
    if($sMembersErr == "")
    {
      $fldmember_login = $db->f("member_login");
      $fldmember_password = $db->f("member_password");
      $fldmember_level = $db->f("member_level");
      $fldname = $db->f("first_name");
      $fldlast_name = $db->f("last_name");
      $fldemail = $db->f("email");
      $fldphone = $db->f("phone");
      $fldaddress = $db->f("address");
      $fldnotes = $db->f("notes");

    }
//-------------------------------
// Members ShowEdit Event begin
// Members ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sMembersErr == "")
    {
      $fldmember_id = tohtml(get_param("member_id"));
      $fldmember_login = tohtml(get_param("member_login"));
    }
//-------------------------------
// Members ShowInsert Event begin
// Members ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Members Show Event begin
// Members Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td >
         <span style="font-size: 12pt; color: #000000">Username*</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <input type="text" class="form-control" name="member_login" maxlength="20" value="<?php echo tohtml($fldmember_login); ?>" size="20" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Password*</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <input type="password" class="form-control" name="member_password" maxlength="20" value="<?php echo tohtml($fldmember_password); ?>" size="20" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Level*</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000"><select size="1" class="form-control" name="member_level">
<?php
    $LOV = explode(";", "1;Member;2;Administrator");

    if(sizeof($LOV)%2 != 0)
      $array_length = sizeof($LOV) - 1;
    else
      $array_length = sizeof($LOV);

    for($i = 0; $i < $array_length; $i = $i + 2)
    {
      if($LOV[$i] == $fldmember_level)
        $option="<option SELECTED value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];
      else
        $option="<option value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];

      echo $option;
    }
?></select></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">First Name*</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input type="text" class="form-control" name="name" maxlength="50" value="<?php echo tohtml($fldname); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Last Name*</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input type="text" class="form-control" name="last_name" maxlength="50" value="<?php echo tohtml($fldlast_name); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Email*</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input type="text" class="form-control" name="email" maxlength="50" value="<?php echo tohtml($fldemail); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Phone</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input type="text" class="form-control" name="phone" maxlength="50" value="<?php echo tohtml($fldphone); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Address</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input type="text" class="form-control" name="address" maxlength="50" value="<?php echo tohtml($fldaddress); ?>" size="50" ></span>
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

    <tr><td colspan="2" align="right">
<?php if (!$bIsUpdateMode) { ?>
   <input type="hidden" value="insert" name="FormAction">
   <button class="btn btn-primary" type="submit" value="Insert" onclick="document.Members.FormAction.value = 'insert';">Insert</button>
<?php } ?>
<?php if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <button class="btn btn-primary" type="submit" value="Update" onclick="document.Members.FormAction.value = 'update';">Update</button>
  <button class="btn btn-primary" type="submit" value="Delete" onclick="document.Members.FormAction.value = 'delete';">Delete</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.Members.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="Members">

  <input type="hidden" name="Trn_member_login" value="<?php echo $trn_member_login; ?>">
  <input type="hidden" name="PK_member_id" value="<?php echo $pmember_id; ?>">
  <input type="hidden" name="member_id" value="<?php echo tohtml($fldmember_id); ?>">
  </td></tr>
  </form>
  </table>


<?php
//-------------------------------
// Members Close Event begin
// Members Close Event end
//-------------------------------

//-------------------------------
// Members Show end
//-------------------------------
}
//===============================
?>
