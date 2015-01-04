<?php
/*********************************************************************************
 *       Filename: CardTypesGrid.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// CardTypesGrid CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// CardTypesGrid CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "CardTypesGrid.php";
//===============================


//===============================
// CardTypesGrid PageSecurity begin
check_security(2);
// CardTypesGrid PageSecurity end
//===============================

//===============================
// CardTypesGrid Open Event begin
// CardTypesGrid Open Event end
//===============================

//===============================
// CardTypesGrid OpenAnyPage Event start
// CardTypesGrid OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// CardTypesGrid Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Card Type</title>
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

// CardTypesGrid Show end

//===============================
// CardTypesGrid Close Event begin
// CardTypesGrid Close Event end
//===============================
//********************************************************************************


//===============================
// Display Grid Form
//-------------------------------
function CardTypes_show()
{
//-------------------------------
// Initialize variables
//-------------------------------

  global $db;
  global $sCardTypesErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Card Types";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $sActionFileName = "CardTypesRecord.php";

  $transit_params = "";
  $form_params = "";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by c.name Asc";
  $iSort = get_param("FormCardTypes_Sorting");
  $iSorted = get_param("FormCardTypes_Sorted");
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
      $sSortParams = "FormCardTypes_Sorting=" . $iSort . "&FormCardTypes_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormCardTypes_Sorting=" . $iSort . "&FormCardTypes_Sorted=" . "&";
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
           <a name="CardTypes"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a>
         </th>
        </tr>
      </thead>
        <tr>
         <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormCardTypes_Sorting=1&FormCardTypes_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Name</span></a></td>
        </tr>
<?php




//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select c.card_type_id as c_card_type_id, " .
    "c.name as c_name " .
    " from card_types c ";
//-------------------------------

//-------------------------------
// CardTypes Open Event begin
// CardTypes Open Event end
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
         <span class="btn btn-success">Add New Card Type</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
// Display grid based on recordset
//-------------------------------
  while($next_record  && $iCounter < $iRecordsPerPage)
  {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldname_URLLink = "CardTypesRecord.php";
    $fldname_card_type_id = $db->f("c_card_type_id");
    $fldname = $db->f("c_name");
    $next_record = $db->next_record();

//-------------------------------
// CardTypes Show begin
//-------------------------------

//-------------------------------
// CardTypes Show Event begin
// CardTypes Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldname_URLLink; ?>?card_type_id=<?php echo $fldname_card_type_id; ?>&<?php echo $transit_params; ?>">
           <span class="btn btn-info"><?php echo $fldname; ?></span></a>&nbsp;</span></td>
      </tr><?php
//-------------------------------
// CardTypes Show end
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
         <span class="btn btn-success">Add New Card Type</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </span></td></tr>
    </table>
  <?php


//-------------------------------
// CardTypes Close Event begin
// CardTypes Close Event end
//-------------------------------
}
//===============================

?>
