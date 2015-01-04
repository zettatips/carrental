<?php
/*********************************************************************************
 *       Filename: EditorialCatRecord.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// EditorialCatRecord CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// EditorialCatRecord CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "EditorialCatRecord.php";
//===============================


//===============================
// EditorialCatRecord PageSecurity begin
check_security(2);
// EditorialCatRecord PageSecurity end
//===============================

//===============================
// EditorialCatRecord Open Event begin
// EditorialCatRecord Open Event end
//===============================

//===============================
// EditorialCatRecord OpenAnyPage Event start
// EditorialCatRecord OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// EditorialCatRecord Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$seditorial_categoriesErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "editorial_categories":
    editorial_categories_action($sAction);
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
  <title>E-Car Rental - Editorial Categories</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
  <?php editorial_categories_show() ?>
  <br /><br />
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// EditorialCatRecord Show end

//===============================
// EditorialCatRecord Close Event begin
// EditorialCatRecord Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function editorial_categories_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $seditorial_categoriesErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKeditorial_cat_id = "";
  $fldeditorial_cat_name = "";
//-------------------------------

//-------------------------------
// editorial_categories Action begin
//-------------------------------
  $sActionFileName = "EditorialCatGrid.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// editorial_categories BeforeCancel Event begin
// editorial_categories BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName);
  }
//-------------------------------


//-------------------------------
// Build WHERE statement
//-------------------------------
  if($sAction == "update" || $sAction == "delete")
  {
    $pPKeditorial_cat_id = get_param("PK_editorial_cat_id");
    if( !strlen($pPKeditorial_cat_id)) return;
    $sWhere = "editorial_cat_id=" . tosql($pPKeditorial_cat_id, "Number");
  }
//-------------------------------


//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldeditorial_cat_name = get_param("editorial_cat_name");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
//-------------------------------
// editorial_categories Check Event begin
// editorial_categories Check Event end
//-------------------------------
    if(strlen($seditorial_categoriesErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// editorial_categories Insert Event begin
// editorial_categories Insert Event end
//-------------------------------
        $sSQL = "insert into editorial_categories (" .
          "editorial_cat_name)" .
          " values (" .
          tosql($fldeditorial_cat_name, "Text") .
          ")";
    break;
    case "update":

//-------------------------------
// editorial_categories Update Event begin
// editorial_categories Update Event end
//-------------------------------
        $sSQL = "update editorial_categories set " .
          "editorial_cat_name=" . tosql($fldeditorial_cat_name, "Text");
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
//-------------------------------
// editorial_categories Delete Event begin
// editorial_categories Delete Event end
//-------------------------------
        $sSQL = "delete from editorial_categories where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// editorial_categories BeforeExecute Event begin
// editorial_categories BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($seditorial_categoriesErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// editorial_categories Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function editorial_categories_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $seditorial_categoriesErr;
  global $styles;

  $fldeditorial_cat_id = "";
  $fldeditorial_cat_name = "";
//-------------------------------
// editorial_categories Show begin
//-------------------------------
  $sFormTitle = "Editorial Categories";
  $sWhere = "";
  $bPK = true;

?>

   <table class="table table-bordered" style="width:100%">
   <form method="POST" action="<?php echo $sFileName; ?>" name="editorial_categories">
    <thead>
       <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1">
         <td style="text-align: Center" colspan="2">
           <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span>
         </td>
       </tr>
    </thead>
   <?php if ($seditorial_categoriesErr) { ?>
		<thead>
        <tr>
          <td style="background-color: #FFFFFF; border-width: 1" colspan="2">
            <span style="font-size: 12pt; color: #000000"><?php echo $seditorial_categoriesErr;  ?></span>
          </td>
        </tr>
    </thead>
	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($seditorial_categoriesErr == "")
  {
    $fldeditorial_cat_id = get_param("editorial_cat_id");
    $peditorial_cat_id = get_param("editorial_cat_id");
  }
  else
  {
    $fldeditorial_cat_id = strip(get_param("editorial_cat_id"));
    $fldeditorial_cat_name = strip(get_param("editorial_cat_name"));
    $peditorial_cat_id = get_param("PK_editorial_cat_id");
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  if( !strlen($peditorial_cat_id)) $bPK = false;

  $sWhere .= "editorial_cat_id=" . tosql($peditorial_cat_id, "Number");
//-------------------------------
//-------------------------------
// editorial_categories Open Event begin
// editorial_categories Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from editorial_categories where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "editorial_categories") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldeditorial_cat_id = $db->f("editorial_cat_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($seditorial_categoriesErr == "")
    {
      $fldeditorial_cat_name = $db->f("editorial_cat_name");
    }
//-------------------------------
// editorial_categories ShowEdit Event begin
// editorial_categories ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($seditorial_categoriesErr == "")
    {
      $fldeditorial_cat_id = tohtml(get_param("editorial_cat_id"));
    }
//-------------------------------
// editorial_categories ShowInsert Event begin
// editorial_categories ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// editorial_categories Show Event begin
// editorial_categories Show Event end
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
           <input type="text" class="form-control" name="editorial_cat_name" maxlength="50" value="<?php echo tohtml($fldeditorial_cat_name); ?>" size="50" ></span>
       </td>
     </tr>
    <tr><td colspan="2" align="right">
<?php if (!$bIsUpdateMode) { ?>
   <input type="hidden" value="insert" name="FormAction">
   <button class="btn btn-primary" type="submit" value="Insert" onclick="document.editorial_categories.FormAction.value = 'insert';">Insert</button>
<?php } ?>
<?php if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <button class="btn btn-primary" type="submit" value="Update" onclick="document.editorial_categories.FormAction.value = 'update';">Update</button>
  <button class="btn btn-primary" type="submit" value="Delete" onclick="document.editorial_categories.FormAction.value = 'delete';">Delete</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.editorial_categories.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="editorial_categories">

  <input type="hidden" name="PK_editorial_cat_id" value="<?php echo $peditorial_cat_id; ?>">
  <input type="hidden" name="editorial_cat_id" value="<?php echo tohtml($fldeditorial_cat_id); ?>">
  </td></tr>
  </form>
  </table>
<?php



//-------------------------------
// editorial_categories Close Event begin
// editorial_categories Close Event end
//-------------------------------

//-------------------------------
// editorial_categories Show end
//-------------------------------
}
//===============================
?>
