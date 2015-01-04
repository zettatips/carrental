<?php
/*********************************************************************************
 *       Filename: CategoriesGrid.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// CategoriesGrid CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// CategoriesGrid CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "CategoriesGrid.php";
//===============================


//===============================
// CategoriesGrid PageSecurity begin
check_security(2);
// CategoriesGrid PageSecurity end
//===============================

//===============================
// CategoriesGrid Open Event begin
// CategoriesGrid Open Event end
//===============================

//===============================
// CategoriesGrid OpenAnyPage Event start
// CategoriesGrid OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// CategoriesGrid Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Members</title>
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

// CategoriesGrid Show end

//===============================
// CategoriesGrid Close Event begin
// CategoriesGrid Close Event end
//===============================
//********************************************************************************


//===============================
// Display Grid Form
//-------------------------------
function Categories_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sCategoriesErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Categories";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $sActionFileName = "CategoriesRecord.php";

  $transit_params = "";
  $form_params = "";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by c.name Asc";
  $iSort = get_param("FormCategories_Sorting");
  $iSorted = get_param("FormCategories_Sorted");
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
      $sSortParams = "FormCategories_Sorting=" . $iSort . "&FormCategories_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormCategories_Sorting=" . $iSort . "&FormCategories_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by c.name" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
      <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="1">
           <a name="Categories"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></th>
        </tr>
        <tr>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 0">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormCategories_Sorting=1&FormCategories_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Name</span></a></th>
        </tr>
      </thead>
<?php


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select c.category_id as c_category_id, " .
    "c.name as c_name " .
    " from categories c ";
//-------------------------------

//-------------------------------
// Categories Open Event begin
// Categories Open Event end
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
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"><a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Insert Categories</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
  $iPage = get_param("FormCategories_Page");
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
    $fldname_URLLink = "CategoriesRecord.php";
    $fldname_category_id = $db->f("c_category_id");
    $fldname = $db->f("c_name");
    $next_record = $db->next_record();

//-------------------------------
// Categories Show begin
//-------------------------------

//-------------------------------
// Categories Show Event begin
// Categories Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldname_URLLink; ?>?category_id=<?php echo $fldname_category_id; ?>&<?php echo $transit_params; ?>">
           <span class="btn btn-info"><?php echo $fldname?></span></a>&nbsp;</span></td>
      </tr><?php
//-------------------------------
// Categories Show end
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
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">
         <a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
           <span class="btn btn-success">Insert Categories</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
  // Categories Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
        <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Previous</span>
<?php }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php $sSortParams; ?>FormCategories_Page=<?php $iPage - 1; ?>#Categories"><span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Previous</span></a>
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
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>FormCategories_Page=<?php echo $iPage + 1; ?>#Categories"><span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Next</span></a>
<?php
    }
  }

//-------------------------------
// Categories Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </span></td></tr>
    </table>
  <?php


//-------------------------------
// Categories Close Event begin
// Categories Close Event end
//-------------------------------
}
//===============================

?>
