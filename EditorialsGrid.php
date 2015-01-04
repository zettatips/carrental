<?php
/*********************************************************************************
 *       Filename: EditorialsGrid.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// EditorialsGrid CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// EditorialsGrid CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "EditorialsGrid.php";
//===============================


//===============================
// EditorialsGrid PageSecurity begin
check_security(2);
// EditorialsGrid PageSecurity end
//===============================

//===============================
// EditorialsGrid Open Event begin
// EditorialsGrid Open Event end
//===============================

//===============================
// EditorialsGrid OpenAnyPage Event start
// EditorialsGrid OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// EditorialsGrid Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Editorials</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-3"></div>
<div class="col-md-6">
<?php editorials_show() ?>
</div>
<div class="col-md-3"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// EditorialsGrid Show end

//===============================
// EditorialsGrid Close Event begin
// EditorialsGrid Close Event end
//===============================
//********************************************************************************


//===============================
// Display Grid Form
//-------------------------------
function editorials_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $seditorialsErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Editorials";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $sActionFileName = "EditorialsRecord.php";

  $transit_params = "";
  $form_params = "";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by e.article_title Asc";
  $iSort = get_param("Formeditorials_Sorting");
  $iSorted = get_param("Formeditorials_Sorted");
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
      $sSortParams = "Formeditorials_Sorting=" . $iSort . "&Formeditorials_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "Formeditorials_Sorting=" . $iSort . "&Formeditorials_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by e.article_title" . $sDirection;
    if ($iSort == 2) $sOrder = " order by e1.editorial_cat_name" . $sDirection;
    if ($iSort == 3) $sOrder = " order by i.name" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
      <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <td style="text-align: Center" colspan="3">
           <a name="editorials"><span style="font-size: 12pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></td>
        </tr>
      </thead>
        <tr>
         <td style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>Formeditorials_Sorting=1&Formeditorials_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Title</span></a></td>
         <td style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>Formeditorials_Sorting=2&Formeditorials_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Editorial Category</span></a></td>
         <td style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>Formeditorials_Sorting=3&Formeditorials_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Item</span></a></td>
        </tr>
<?php




//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select e.article_id as e_article_id, " .
    "e.article_title as e_article_title, " .
    "e.editorial_cat_id as e_editorial_cat_id, " .
    "e.item_id as e_item_id, " .
    "e1.editorial_cat_id as e1_editorial_cat_id, " .
    "e1.editorial_cat_name as e1_editorial_cat_name, " .
    "i.item_id as i_item_id, " .
    "i.name as i_name " .
    " from editorials e, editorial_categories e1, items i" .
    " where e1.editorial_cat_id=e.editorial_cat_id and i.item_id=e.item_id  ";
//-------------------------------

//-------------------------------
// editorials Open Event begin
// editorials Open Event end
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
      <td colspan="3" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
<?php

//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="3" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"><a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
         <span class="btn btn-success">Insert Editorial</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
  $iPage = get_param("Formeditorials_Page");
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
    $fldarticle_id = $db->f("e_article_id");
    $fldarticle_title_URLLink = "EditorialsRecord.php";
    $fldarticle_title_article_id = $db->f("e_article_id");
    $fldarticle_title = $db->f("e_article_title");
    $fldeditorial_cat_id = $db->f("e1_editorial_cat_name");
    $flditem_id = $db->f("i_name");
    $next_record = $db->next_record();

//-------------------------------
// editorials Show begin
//-------------------------------

//-------------------------------
// editorials Show Event begin
// editorials Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldarticle_title_URLLink; ?>?article_id=<?php echo $fldarticle_title_article_id; ?>&<?php echo $transit_params; ?>">
           <span class="btn btn-info"><?php echo $fldarticle_title; ?></span></a>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
         <?php echo tohtml($fldeditorial_cat_id); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
         <?php echo tohtml($flditem_id); ?>&nbsp;</span></td>
      </tr><?php
//-------------------------------
// editorials Show end
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
     <td colspan="3" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"><a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
         <span class="btn btn-success">Insert Editorial</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
  // editorials Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
        <span class="btn btn-success">Back</span>
<?php }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>Formeditorials_Page=<?php echo $iPage - 1; ?>#editorials">
          <span class="btn btn-success">Back</span></a>
<?php
    }
    echo "&nbsp;[&nbsp;" . $iPage . "&nbsp;]&nbsp;";

    if (!$bEof) {
?>
    <span class="btn btn-success">Next</span>
<?php
    }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>Formeditorials_Page=<?php echo $iPage + 1; ?>#editorials">
          <span class="btn btn-success">Next</span></a>
<?php
    }
  }

//-------------------------------
// editorials Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </span></td></tr>
    </table>
  <?php


//-------------------------------
// editorials Close Event begin
// editorials Close Event end
//-------------------------------
}
//===============================

?>
