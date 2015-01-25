<?php
/*********************************************************************************
 *       Filename: AdminVehicle.php
 *       PHP 5.3.29 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// AdminVehicle CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// AdminVehicle CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "AdminVehicle.php";
//===============================


//===============================
// AdminVehicle PageSecurity begin
check_security(2);
// AdminVehicle PageSecurity end
//===============================

//===============================
// AdminVehicle Open Event begin
// AdminVehicle Open Event end
//===============================

//===============================
// AdminVehicle OpenAnyPage Event start
// AdminVehicle OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// AdminVehicle Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Admin Vehicle</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php Header_show() ?>

<div class="col-md-3"></div>
<div class="col-md-6">
  <?php Items_show() ?>
<br />
</div>
<div class="col-md-3"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// AdminVehicle Show end

//===============================
// AdminVehicle Close Event begin
// AdminVehicle Close Event end
//===============================
//********************************************************************************

//===============================
// Display Grid Form
//-------------------------------
function Items_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sItemsErr;
  global $sFileName;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Vehicle";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $sActionFileName = "VehicleMaint.php";

  $transit_params = "category_id=" . tourl(get_param("category_id")) . "&is_recommended=" . tourl(get_param("is_recommended")) . "&";
  $form_params = "category_id=" . tourl(get_param("category_id")) . "&is_recommended=" . tourl(get_param("is_recommended")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $iSort = get_param("FormItems_Sorting");
  $iSorted = get_param("FormItems_Sorted");
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
      $sSortParams = "FormItems_Sorting=" . $iSort . "&FormItems_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormItems_Sorting=" . $iSort . "&FormItems_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by i.name" . $sDirection;
    if ($iSort == 2) $sOrder = " order by i.model" . $sDirection;
    if ($iSort == 3) $sOrder = " order by i.price" . $sDirection;
    if ($iSort == 4) $sOrder = " order by c.name" . $sDirection;
    if ($iSort == 5) $sOrder = " order by i.is_recommended" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
      <thead>
        <tr style="background-color: #336699;  border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="6">
           <a name="Items"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></th>
        </tr>
        <tr>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1"><a>
           <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Edit</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormItems_Sorting=1&FormItems_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Vehicle</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormItems_Sorting=2&FormItems_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Model</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormItems_Sorting=3&FormItems_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Rate (RM)</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormItems_Sorting=4&FormItems_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Category</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormItems_Sorting=5&FormItems_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Recommended</span></a></th>
        </tr>
      </thead>
<?php

//-------------------------------
// Build WHERE statement
//-------------------------------
  $pcategory_id = get_param("category_id");
  if(is_number($pcategory_id) && strlen($pcategory_id))
    $pcategory_id = tosql($pcategory_id, "Number");
  else
    $pcategory_id = "";

  if(strlen($pcategory_id))
  {
    $HasParam = true;
    $sWhere = $sWhere . "i.category_id=" . $pcategory_id;
  }
  $pis_recommended = get_param("is_recommended");
  if(is_number($pis_recommended) && strlen($pis_recommended))
    $pis_recommended = tosql($pis_recommended, "Number");
  else
    $pis_recommended = "";

  if(strlen($pis_recommended))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.is_recommended=" . $pis_recommended;
  }


  if($HasParam)
    $sWhere = " AND (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select i.category_id as i_category_id, " .
    "i.is_recommended as i_is_recommended, " .
    "i.item_id as i_item_id, " .
    "i.model as i_model, " .
    "i.name as i_name, " .
    "i.price as i_price, " .
    "c.category_id as c_category_id, " .
    "c.name as c_name " .
    " from items i, categories c" .
    " where c.category_id=i.category_id  ";
//-------------------------------

//-------------------------------
// Items Open Event begin
// Items Open Event end
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
      <td colspan="6" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
<?php

//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="6" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"><a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
         <span class="btn btn-success">Add New</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
?>
  </table>
<?php

    return;
  }

//-------------------------------

//-------------------------------
// Prepare the lists of values
//-------------------------------

  $ais_recommended = explode(";", "0;No;1;Yes");
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
  $iPage = get_param("FormItems_Page");
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
    $fldField1_URLLink = "VehicleMaint.php";
    $fldField1_item_id = $db->f("i_item_id");
    $fldcategory_id = $db->f("c_name");
    $fldis_recommended = $db->f("i_is_recommended");
    $fldmodel = $db->f("i_model");
    $fldname = $db->f("i_name");
    $fldprice = $db->f("i_price");
    $fldField1= "Edit";
    $next_record = $db->next_record();

//-------------------------------
// Items Show begin
//-------------------------------

//-------------------------------
// Items Show Event begin
// Items Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldField1_URLLink; ?>?item_id=<?php echo $fldField1_item_id; ?>&<?php echo $transit_params; ?>">
           <span class="btn btn-info"><?php echo $fldField1; ?></span></a>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldname); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldmodel); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldprice); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldcategory_id); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php $fldis_recommended = get_lov_value($fldis_recommended, $ais_recommended); ?>
      <?php echo tohtml($fldis_recommended); ?>&nbsp;</span></td>
      </tr><?php
//-------------------------------
// Items Show end
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
     <td colspan="6" style="background-color: #FFFFFF; border-style: inset; border-width: 0"><span style="font-size: 12pt; color: #CE7E00; font-weight: bold">
       <a href="<?php echo $form_action; ?>?<?php echo $transit_params; ?>">
         <span class="btn btn-success">Add New</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
  // Items Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
        <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Previous</span>
<?php }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>FormItems_Page=<?php echo $iPage - 1; ?>#Items"><span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Previous</span></a>
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
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>FormItems_Page=<?php echo $iPage + 1; ?>#Items"><span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Next</span></a>
<?php
    }
  }

//-------------------------------
// Items Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </span></td></tr>
    </table>
  <?php


//-------------------------------
// Items Close Event begin
// Items Close Event end
//-------------------------------
}
//===============================

?>
