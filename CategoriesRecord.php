<?php
/*********************************************************************************
 *       Filename: CategoriesRecord.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// CategoriesRecord CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// CategoriesRecord CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "CategoriesRecord.php";
//===============================


//===============================
// CategoriesRecord PageSecurity begin
check_security(2);
// CategoriesRecord PageSecurity end
//===============================

//===============================
// CategoriesRecord Open Event begin
// CategoriesRecord Open Event end
//===============================

//===============================
// CategoriesRecord OpenAnyPage Event start
// CategoriesRecord OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// CategoriesRecord Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sCategoriesErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Categories":
    Categories_action($sAction);
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

<div class="col-md-4"></div>
<div class="col-md-4">
  <?php Categories_show() ?>
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// CategoriesRecord Show end

//===============================
// CategoriesRecord Close Event begin
// CategoriesRecord Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function Categories_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $sCategoriesErr;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKcategory_id = "";
  $fldname = "";
//-------------------------------

//-------------------------------
// Categories Action begin
//-------------------------------
  $sActionFileName = "CategoriesGrid.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// Categories BeforeCancel Event begin
// Categories BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName);
  }
//-------------------------------


//-------------------------------
// Build WHERE statement
//-------------------------------
  if($sAction == "update" || $sAction == "delete")
  {
    $pPKcategory_id = get_param("PK_category_id");
    if( !strlen($pPKcategory_id)) return;
    $sWhere = "category_id=" . tosql($pPKcategory_id, "Number");
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
      $sCategoriesErr .= "The value in field Name is required.<br>";

//-------------------------------
// Categories Check Event begin
// Categories Check Event end
//-------------------------------
    if(strlen($sCategoriesErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// Categories Insert Event begin
// Categories Insert Event end
//-------------------------------
        $sSQL = "insert into categories (" .
          "name)" .
          " values (" .
          tosql($fldname, "Text") .
          ")";
    break;
    case "update":

//-------------------------------
// Categories Update Event begin
// Categories Update Event end
//-------------------------------
        $sSQL = "update categories set " .
          "name=" . tosql($fldname, "Text");
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
//-------------------------------
// Categories Delete Event begin
// Categories Delete Event end
//-------------------------------
        $sSQL = "delete from categories where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// Categories BeforeExecute Event begin
// Categories BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sCategoriesErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// Categories Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function Categories_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $sCategoriesErr;

  $fldcategory_id = "";
  $fldname = "";
//-------------------------------
// Categories Show begin
//-------------------------------
  $sFormTitle = "Add Categories";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
     <form method="POST" action="<?php echo $sFileName; ?>" name="Categories">
       <thead>
       <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="2">
           <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
       </tr>
     </thead>
   <?php if ($sCategoriesErr) { ?>
		   <tr>
         <td style="background-color: #FFFFFF; border-width: 1" colspan="2">
           <span style="font-size: 13pt; color: #000000"><?php echo $sCategoriesErr ?></span></td>
       </tr>
	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sCategoriesErr == "")
  {
    $fldcategory_id = get_param("category_id");
    $pcategory_id = get_param("category_id");
  }
  else
  {
    $fldcategory_id = strip(get_param("category_id"));
    $fldname = strip(get_param("name"));
    $pcategory_id = get_param("PK_category_id");
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  if( !strlen($pcategory_id)) $bPK = false;

  $sWhere .= "category_id=" . tosql($pcategory_id, "Number");
//-------------------------------
//-------------------------------
// Categories Open Event begin
// Categories Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from categories where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "Categories") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldcategory_id = $db->f("category_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sCategoriesErr == "")
    {
      $fldname = $db->f("name");
    }
//-------------------------------
// Categories ShowEdit Event begin
// Categories ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sCategoriesErr == "")
    {
      $fldcategory_id = tohtml(get_param("category_id"));
    }
//-------------------------------
// Categories ShowInsert Event begin
// Categories ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Categories Show Event begin
// Categories Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td style="border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #000000">Name</span>
       </td>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="name" maxlength="50" value="<?php echo tohtml($fldname); ?>" size="50" ></span>
       </td>
     </tr>
     <tr>
       <td colspan="2" align="right">
      <?php if (!$bIsUpdateMode) { ?>
         <input type="hidden" value="insert" name="FormAction">
         <button class="btn btn-primary" type="submit" value="Insert" onclick="document.Categories.FormAction.value = 'insert';">Insert</button>
      <?php } ?>
      <?php if ($bIsUpdateMode) { ?>
        <input type="hidden" value="update" name="FormAction"/>
        <button class="btn btn-primary" type="submit" value="Update" onclick="document.Categories.FormAction.value = 'update';">Update</button>
        <button class="btn btn-primary" type="submit" value="Delete" onclick="document.Categories.FormAction.value = 'delete';">Delete</button>
      <?php } ?>
        <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.Categories.FormAction.value = 'cancel';">Cancel</button>
        <input type="hidden" name="FormName" value="Categories">

        <input type="hidden" name="PK_category_id" value="<?php echo $pcategory_id; ?>">
        <input type="hidden" name="category_id" value="<?php echo tohtml($fldcategory_id); ?>">
        </td>
      </tr>
  </form>
  </table>
  <br />
  <br />
<?php



//-------------------------------
// Categories Close Event begin
// Categories Close Event end
//-------------------------------

//-------------------------------
// Categories Show end
//-------------------------------
}
//===============================
?>
