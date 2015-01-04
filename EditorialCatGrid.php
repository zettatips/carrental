<?php
/*********************************************************************************
 *       Filename: EditorialCatGrid.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// EditorialCatGrid CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// EditorialCatGrid CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "EditorialCatGrid.php";
//===============================


//===============================
// EditorialCatGrid PageSecurity begin
check_security(2);
// EditorialCatGrid PageSecurity end
//===============================

//===============================
// EditorialCatGrid Open Event begin
// EditorialCatGrid Open Event end
//===============================

//===============================
// EditorialCatGrid OpenAnyPage Event start
// EditorialCatGrid OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// EditorialCatGrid Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Reservation Details</title>
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
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// EditorialCatGrid Show end

//===============================
// EditorialCatGrid Close Event begin
// EditorialCatGrid Close Event end
//===============================
//********************************************************************************


//===============================
// Display Grid Form
//-------------------------------
function editorial_categories_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $seditorial_categoriesErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Editorial Category";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $sActionFileName = "EditorialCatRecord.php";

  $transit_params = "";
  $form_params = "";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by e.editorial_cat_name Asc";
  $iSort = get_param("Formeditorial_categories_Sorting");
  $iSorted = get_param("Formeditorial_categories_Sorted");
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
      $sSortParams = "Formeditorial_categories_Sorting=" . $iSort . "&Formeditorial_categories_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "Formeditorial_categories_Sorting=" . $iSort . "&Formeditorial_categories_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by e.editorial_cat_name" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
      <thead>
      <tr style="background-color: #336699; text-align: Center; border-style: outset; border-width: 1">
       <th style="text-align: Center" colspan="1">
         <a name="editorial_categories"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle?></span></a></th>
      </tr>
      <thead>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>Formeditorial_categories_Sorting=1&Formeditorial_categories_Sorted=<?php echo $form_sorting; ?>&">
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Name</span></a></td>
      </tr>
<?php




//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select e.editorial_cat_id as e_editorial_cat_id, " .
    "e.editorial_cat_name as e_editorial_cat_name " .
    " from editorial_categories e ";
//-------------------------------

//-------------------------------
// editorial_categories Open Event begin
// editorial_categories Open Event end
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
      <td colspan="1" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
<?php

//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="1" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">
         <a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
           <span class="btn btn-success">Insert Category</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
  $iPage = get_param("Formeditorial_categories_Page");
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
    $fldeditorial_cat_id = $db->f("e_editorial_cat_id");
    $fldeditorial_cat_name_URLLink = "EditorialCatRecord.php";
    $fldeditorial_cat_name_editorial_cat_id = $db->f("e_editorial_cat_id");
    $fldeditorial_cat_name = $db->f("e_editorial_cat_name");
    $next_record = $db->next_record();

//-------------------------------
// editorial_categories Show begin
//-------------------------------

//-------------------------------
// editorial_categories Show Event begin
// editorial_categories Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <a href="<?php echo $fldeditorial_cat_name_URLLink; ?>?editorial_cat_id=<?php echo $fldeditorial_cat_name_editorial_cat_id; ?>&<?php echo $transit_params; ?>">
             <span class="btn btn-info"><?php echo $fldeditorial_cat_name; ?></span></a>&nbsp;</span></td>
      </tr>
<?php
//-------------------------------
// editorial_categories Show end
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
     <td colspan="1" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"><a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
         <span class="btn btn-success">Insert Category</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
  // editorial_categories Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
        <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Previous</span>
<?php }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>Formeditorial_categories_Page=<?php echo $iPage - 1; ?>#editorial_categories"><span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Previous</span></a>
<?php
    }
    echo "&nbsp;[&nbsp;" . $iPage . "&nbsp;]&nbsp;";

    if (!$bEof) {
?>
        <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Next</span>
<?php
    }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>Formeditorial_categories_Page=<?php $iPage + 1; ?>#editorial_categories"><span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Next</span></a>
<?php
    }
  }

//-------------------------------
// editorial_categories Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </span></td></tr>
    </table>
  <?php


//-------------------------------
// editorial_categories Close Event begin
// editorial_categories Close Event end
//-------------------------------
}
//===============================

?>
