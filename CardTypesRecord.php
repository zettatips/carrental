<?php
/*********************************************************************************
 *       Filename: CardTypesRecord.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// CardTypesRecord CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// CardTypesRecord CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "CardTypesRecord.php";
//===============================


//===============================
// CardTypesRecord PageSecurity begin
check_security(2);
// CardTypesRecord PageSecurity end
//===============================

//===============================
// CardTypesRecord Open Event begin
// CardTypesRecord Open Event end
//===============================

//===============================
// CardTypesRecord OpenAnyPage Event start
// CardTypesRecord OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// CardTypesRecord Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sCardTypesErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "CardTypes":
    CardTypes_action($sAction);
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
  <title>E-Car Rental - Card Type Details</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
  <?php CardTypes_show() ?>
  <br /><br />
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// CardTypesRecord Show end

//===============================
// CardTypesRecord Close Event begin
// CardTypesRecord Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function CardTypes_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sCardTypesErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKcard_type_id = "";
  $fldname = "";
//-------------------------------

//-------------------------------
// CardTypes Action begin
//-------------------------------
  $sActionFileName = "CardTypesGrid.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// CardTypes BeforeCancel Event begin
// CardTypes BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName);
  }
//-------------------------------


//-------------------------------
// Build WHERE statement
//-------------------------------
  if($sAction == "update" || $sAction == "delete")
  {
    $pPKcard_type_id = get_param("PK_card_type_id");
    if( !strlen($pPKcard_type_id)) return;
    $sWhere = "card_type_id=" . tosql($pPKcard_type_id, "Number");
  }
//-------------------------------


//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldname = get_param("name");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldname))
      $sCardTypesErr .= "The value in field Name is required.<br>";

//-------------------------------
// CardTypes Check Event begin
// CardTypes Check Event end
//-------------------------------
    if(strlen($sCardTypesErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// CardTypes Insert Event begin
// CardTypes Insert Event end
//-------------------------------
        $sSQL = "insert into card_types (" .
          "name)" .
          " values (" .
          tosql($fldname, "Text") .
          ")";
    break;
    case "update":

//-------------------------------
// CardTypes Update Event begin
// CardTypes Update Event end
//-------------------------------
        $sSQL = "update card_types set " .
          "name=" . tosql($fldname, "Text");
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
//-------------------------------
// CardTypes Delete Event begin
// CardTypes Delete Event end
//-------------------------------
        $sSQL = "delete from card_types where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// CardTypes BeforeExecute Event begin
// CardTypes BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sCardTypesErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// CardTypes Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function CardTypes_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sCardTypesErr;
  global $styles;

  $fldcard_type_id = "";
  $fldname = "";
//-------------------------------
// CardTypes Show begin
//-------------------------------
  $sFormTitle = "Card Type";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
   <form method="POST" action="<?php echo $sFileName; ?>" name="CardTypes">
     <thead>
      <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1">
        <th style="text-align: Center" colspan="2">
          <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span>
        </th>
      </tr>
    </thead>
   <?php if ($sCardTypesErr) { ?>
     <thead>
		  <tr>
        <td style="background-color: #FFFFFF; border-width: 1" colspan="2">
          <span style="font-size: 12pt; color: #000000"><?php echo $sCardTypesErr ?></span>
        </td>
      </tr>
    </thead>
	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sCardTypesErr == "")
  {
    $fldcard_type_id = get_param("card_type_id");
    $pcard_type_id = get_param("card_type_id");
  }
  else
  {
    $fldcard_type_id = strip(get_param("card_type_id"));
    $fldname = strip(get_param("name"));
    $pcard_type_id = get_param("PK_card_type_id");
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  if( !strlen($pcard_type_id)) $bPK = false;

  $sWhere .= "card_type_id=" . tosql($pcard_type_id, "Number");
//-------------------------------
//-------------------------------
// CardTypes Open Event begin
// CardTypes Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from card_types where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "CardTypes") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldcard_type_id = $db->f("card_type_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sCardTypesErr == "")
    {
      $fldname = $db->f("name");
    }
//-------------------------------
// CardTypes ShowEdit Event begin
// CardTypes ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sCardTypesErr == "")
    {
      $fldcard_type_id = tohtml(get_param("card_type_id"));
    }
//-------------------------------
// CardTypes ShowInsert Event begin
// CardTypes ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// CardTypes Show Event begin
// CardTypes Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Name</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input type="text" class="form-control" name="name" maxlength="50" value="<?php echo tohtml($fldname); ?>" size="50" ></span>
       </td>
     </tr>
    <tr><td colspan="2" align="right">
<?php if (!$bIsUpdateMode) { ?>
   <input type="hidden" value="insert" name="FormAction">
   <button class="btn btn-primary" type="submit" value="Insert" onclick="document.CardTypes.FormAction.value = 'insert';">Insert</button>
<?php } ?>
<?php if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <button class="btn btn-primary" type="submit" value="Update" onclick="document.CardTypes.FormAction.value = 'update';">Update</button>
  <button class="btn btn-primary" type="submit" value="Delete" onclick="document.CardTypes.FormAction.value = 'delete';">Delete</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.CardTypes.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="CardTypes">

  <input type="hidden" name="PK_card_type_id" value="<?php echo $pcard_type_id; ?>">
  <input type="hidden" name="card_type_id" value="<?php echo tohtml($fldcard_type_id); ?>">
  </td></tr>
  </form>
  </table>
<?php



//-------------------------------
// CardTypes Close Event begin
// CardTypes Close Event end
//-------------------------------

//-------------------------------
// CardTypes Show end
//-------------------------------
}
//===============================
?>
