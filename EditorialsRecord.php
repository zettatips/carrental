<?php
/*********************************************************************************
 *       Filename: EditorialsRecord.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// EditorialsRecord CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// EditorialsRecord CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "EditorialsRecord.php";
//===============================


//===============================
// EditorialsRecord PageSecurity begin
check_security(2);
// EditorialsRecord PageSecurity end
//===============================

//===============================
// EditorialsRecord Open Event begin
// EditorialsRecord Open Event end
//===============================

//===============================
// EditorialsRecord OpenAnyPage Event start
// EditorialsRecord OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// EditorialsRecord Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$seditorialsErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "editorials":
    editorials_action($sAction);
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
  <title>E-Car Rental - Editorial Details</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
  <?php editorials_show() ?>
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// EditorialsRecord Show end

//===============================
// EditorialsRecord Close Event begin
// EditorialsRecord Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function editorials_action($sAction)
{
//-------------------------------
// Initialize variables
//-------------------------------
  global $db;

  global $sForm;
  global $seditorialsErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKarticle_id = "";
  $fldarticle_desc = "";
  $fldarticle_title = "";
  $fldeditorial_cat_id = "";
  $flditem_id = "";
//-------------------------------

//-------------------------------
// editorials Action begin
//-------------------------------
  $sActionFileName = "EditorialsGrid.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// editorials BeforeCancel Event begin
// editorials BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName);
  }
//-------------------------------


//-------------------------------
// Build WHERE statement
//-------------------------------
  if($sAction == "update" || $sAction == "delete")
  {
    $pPKarticle_id = get_param("PK_article_id");
    if( !strlen($pPKarticle_id)) return;
    $sWhere = "article_id=" . tosql($pPKarticle_id, "Number");
  }
//-------------------------------


//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldarticle_desc = get_param("article_desc");
  $fldarticle_title = get_param("article_title");
  $fldeditorial_cat_id = get_param("editorial_cat_id");
  $flditem_id = get_param("item_id");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update")
  {
    if(!strlen($fldeditorial_cat_id))
      $seditorialsErr .= "The value in field Editorial Category is required.<br>";

    if(!is_number($fldeditorial_cat_id))
      $seditorialsErr .= "The value in field Editorial Category is incorrect.<br>";

    if(!is_number($flditem_id))
      $seditorialsErr .= "The value in field Item is incorrect.<br>";

//-------------------------------
// editorials Check Event begin
// editorials Check Event end
//-------------------------------
    if(strlen($seditorialsErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction))
  {
    case "insert":
//-------------------------------
// editorials Insert Event begin
// editorials Insert Event end
//-------------------------------
        $sSQL = "insert into editorials (" .
          "article_desc," .
          "article_title," .
          "editorial_cat_id," .
          "item_id)" .
          " values (" .
          tosql($fldarticle_desc, "Text") . "," .
          tosql($fldarticle_title, "Text") . "," .
          tosql($fldeditorial_cat_id, "Number") . "," .
          tosql($flditem_id, "Number") .
          ")";
    break;
    case "update":

//-------------------------------
// editorials Update Event begin
// editorials Update Event end
//-------------------------------
        $sSQL = "update editorials set " .
          "article_desc=" . tosql($fldarticle_desc, "Text") .
          ",article_title=" . tosql($fldarticle_title, "Text") .
          ",editorial_cat_id=" . tosql($fldeditorial_cat_id, "Number") .
          ",item_id=" . tosql($flditem_id, "Number");
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
//-------------------------------
// editorials Delete Event begin
// editorials Delete Event end
//-------------------------------
        $sSQL = "delete from editorials where " . $sWhere;
    break;
  }
//-------------------------------
//-------------------------------
// editorials BeforeExecute Event begin
// editorials BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($seditorialsErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  header("Location: " . $sActionFileName);

//-------------------------------
// editorials Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function editorials_show()
{
  global $db;

  global $sAction;
  global $sForm;
  global $sFileName;
  global $seditorialsErr;
  global $styles;

  $fldarticle_id = "";
  $fldarticle_desc = "";
  $fldarticle_title = "";
  $fldeditorial_cat_id = "";
  $flditem_id = "";
//-------------------------------
// editorials Show begin
//-------------------------------
  $sFormTitle = "Editorial Details";
  $sWhere = "";
  $bPK = true;
  $sitem_idDisplayValue = "";

?>

   <table class="table table-bordered" style="width:100%">
     <form method="POST" action="<?php echo $sFileName; ?>" name="editorials">
     <thead>
       <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1">
         <td style="text-align: Center" colspan="2">
           <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span>
         </td>
       </tr>
     </thead>
        <?php if ($seditorialsErr) { ?>
		   <tr>
         <td style="background-color: #FFFFFF; border-width: 1" colspan="2">
           <span style="font-size: 12pt; color: #000000"><?php echo $seditorialsErr ?></span>
         </td>
       </tr>
	 <?php } ?>
<?php

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($seditorialsErr == "")
  {
    $fldarticle_id = get_param("article_id");
    $particle_id = get_param("article_id");
  }
  else
  {
    $fldarticle_id = strip(get_param("article_id"));
    $fldarticle_desc = strip(get_param("article_desc"));
    $fldarticle_title = strip(get_param("article_title"));
    $fldeditorial_cat_id = strip(get_param("editorial_cat_id"));
    $flditem_id = strip(get_param("item_id"));
    $particle_id = get_param("PK_article_id");
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------

  if( !strlen($particle_id)) $bPK = false;

  $sWhere .= "article_id=" . tosql($particle_id, "Number");
//-------------------------------
//-------------------------------
// editorials Open Event begin
// editorials Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from editorials where " . $sWhere;
  // Execute SQL statement
  $db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "editorials") && $db->next_record());
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldarticle_id = $db->f("article_id");
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($seditorialsErr == "")
    {
      $fldarticle_desc = $db->f("article_desc");
      $fldarticle_title = $db->f("article_title");
      $fldeditorial_cat_id = $db->f("editorial_cat_id");
      $flditem_id = $db->f("item_id");
    }
//-------------------------------
// editorials ShowEdit Event begin
// editorials ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($seditorialsErr == "")
    {
      $fldarticle_id = tohtml(get_param("article_id"));
    }
//-------------------------------
// editorials ShowInsert Event begin
// editorials ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// editorials Show Event begin
// editorials Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Article Description</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="article_desc" maxlength="200" value="<?php echo tohtml($fldarticle_desc); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Article Title</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000">
           <input class="form-control" type="text" name="article_title" maxlength="200" value="<?php echo tohtml($fldarticle_title); ?>" size="50" ></span>
       </td>
     </tr>
      <tr>
       <td>
         <span style="font-size: 12pt; color: #000000">Editorial Category</span>
       </td>
       <td>
         <span style="font-size: 12pt; color: #000000"><select class="form-control" size="1" name="editorial_cat_id">
<?php
    $lookup_editorial_cat_id = db_fill_array("select editorial_cat_id, editorial_cat_name from editorial_categories order by 2");

    if(is_array($lookup_editorial_cat_id))
    {
      reset($lookup_editorial_cat_id);
      while(list($key, $value) = each($lookup_editorial_cat_id))
      {
        if($key == $fldeditorial_cat_id)
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
         <span style="font-size: 12pt; color: #000000">Item</span>
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
    <tr><td colspan="2" align="right">
<?php if (!$bIsUpdateMode) { ?>
   <input type="hidden" value="insert" name="FormAction">
   <button class="btn btn-primary" type="submit" value="Insert" onclick="document.editorials.FormAction.value = 'insert';">Insert</button>
<?php } ?>
<?php if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <button class="btn btn-primary" type="submit" value="Update" onclick="document.editorials.FormAction.value = 'update';">Update</button>
  <button class="btn btn-primary" type="submit" value="Delete" onclick="document.editorials.FormAction.value = 'delete';">Delete</button>
<?php } ?>
  <button class="btn btn-primary" type="submit" value="Cancel" onclick="document.editorials.FormAction.value = 'cancel';">Cancel</button>
  <input type="hidden" name="FormName" value="editorials">

  <input type="hidden" name="PK_article_id" value="<?php echo $particle_id; ?>">
  <input type="hidden" name="article_id" value="<?php echo tohtml($fldarticle_id); ?>">
  </td></tr>
  </form>
  </table>
<?php



//-------------------------------
// editorials Close Event begin
// editorials Close Event end
//-------------------------------

//-------------------------------
// editorials Show end
//-------------------------------
}
//===============================
?>
