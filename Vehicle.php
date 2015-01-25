<?php
/*********************************************************************************
 *       Filename: Vehicle.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// Vehicle CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// Vehicle CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "Vehicle.php";
//===============================


//===============================
// Vehicle PageSecurity begin
// Vehicle PageSecurity end
//===============================

//===============================
// Vehicle Open Event begin
// Vehicle Open Event end
//===============================

//===============================
// Vehicle OpenAnyPage Event start
// Vehicle OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// Vehicle Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Vehicle</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>

<div class="col-md-4">
<?php Search_show() ?>
<br />
<?php AdvMenu_show() ?>
<br />
<?php Total_show() ?>
<br />
<?php Results_show() ?>
<br />
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// Vehicle Show end

//===============================
// Vehicle Close Event begin
// Vehicle Close Event end
//===============================
//********************************************************************************


//===============================
// Display Grid Form
//-------------------------------
function Results_show()
{
//-------------------------------
// Initialize variables
//-------------------------------

  global $db;
  global $sResultsErr;
  global $sFileName;

  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Search Results";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";

  $transit_params = "category_id=" . tourl(get_param("category_id")) . "&model=" . tourl(get_param("model")) . "&name=" . tourl(get_param("name")) . "&pricemax=" . tourl(get_param("pricemax")) . "&pricemin=" . tourl(get_param("pricemin")) . "&";
  $form_params = "category_id=" . tourl(get_param("category_id")) . "&model=" . tourl(get_param("model")) . "&name=" . tourl(get_param("name")) . "&pricemax=" . tourl(get_param("pricemax")) . "&pricemin=" . tourl(get_param("pricemin")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by i.name Asc";
  $iSort = get_param("FormResults_Sorting");
  $iSorted = get_param("FormResults_Sorted");
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
      $sSortParams = "FormResults_Sorting=" . $iSort . "&FormResults_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormResults_Sorting=" . $iSort . "&FormResults_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by i.name" . $sDirection;
    if ($iSort == 2) $sOrder = " order by i.model" . $sDirection;
    if ($iSort == 3) $sOrder = " order by i.price" . $sDirection;
    if ($iSort == 4) $sOrder = " order by c.name" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
       <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="1">
           <a name="Results"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a>
         </th>
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
  $pmodel = get_param("model");

  if(strlen($pmodel))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.model like " . tosql("%".$pmodel ."%", "Text");
  }
  $pname = get_param("name");

  if(strlen($pname))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.name like " . tosql("%".$pname ."%", "Text");
  }
  $ppricemax = get_param("pricemax");
  if(is_number($ppricemax) && strlen($ppricemax))
    $ppricemax = tosql($ppricemax, "Number");
  else
    $ppricemax = "";

  if(strlen($ppricemax))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.price<" . $ppricemax;
  }
  $ppricemin = get_param("pricemin");
  if(is_number($ppricemin) && strlen($ppricemin))
    $ppricemin = tosql($ppricemin, "Number");
  else
    $ppricemin = "";

  if(strlen($ppricemin))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.price>" . $ppricemin;
  }


  if($HasParam)
    $sWhere = " AND (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select i.category_id as i_category_id, " .
    "i.image_url as i_image_url, " .
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
// Results Open Event begin
// Results Open Event end
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
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
      <td colspan="5" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
<?php

//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="1" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">
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
  $iPage = get_param("FormResults_Page");
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
    $fldcategory_id = $db->f("c_name");
    $fldimage_url = $db->f("i_image_url");
    $fldmodel = $db->f("i_model");
    $fldname_URLLink = "VehicleDetail.php";
    $fldname_item_id = $db->f("i_item_id");
    $fldname = $db->f("i_name");
    $fldprice = $db->f("i_price");
    $next_record = $db->next_record();

//-------------------------------
// Results Show begin
//-------------------------------

//-------------------------------
// Results Show Event begin
$fldname = "<img src=\"" . $fldimage_url . "\"></td><td valign=\"top\" width=\"100%\">
<table><tr><td style=\"background-color: #FFFFFF; border-style: inset; border-width: 0\">
<span style=\"font-size: 12pt; color: #CE7E00; font-weight: bold\"><b>" . $fldname . "</b>";
// Results Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
  <tr>
    <td>
      <table width="100%" style="width:100%">
          <tr>
           <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"></span></td>
          </tr>
          <tr>
           <td style="background-color: #FFFFFF; border-width: 1">
             <span style="font-size: 12pt; color: #000000">
               <a href="<?php echo $fldname_URLLink; ?>?item_id=<?php echo $fldname_item_id; ?>&<?php echo $transit_params; ?>">
                 <span style="font-size: 12pt; color: #000000"><?php echo $fldname ?></span></a>&nbsp;</span></td>
          </tr>
          <tr>
           <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Model</span></td>
          </tr>
          <tr>
           <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
          <?php echo tohtml($fldmodel); ?>&nbsp;</span></td>
          </tr>
          <tr>
           <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Out of Town Rate</span></td>
          </tr>
          <tr>
           <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
             RM <?php echo tohtml($fldprice); ?>&nbsp;</span></td>
          </tr>
          <tr>
           <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Category</span></td>
          </tr>
          <tr>
           <td style="background-color: #FFFFFF; border-width: 1">
             <span style="font-size: 12pt; color: #000000">
          <?php echo tohtml($fldcategory_id); ?>&nbsp;</span></td>
          </tr>
          <tr>
           <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
             <?php echo tohtml($fldField1); ?>&nbsp;</span></td>
          </tr>
      </table>
    </td>
  </tr>
</table>
</td></tr><?php

//-------------------------------
// Process the record separator
//-------------------------------
    if($next_record  || $iCounter == $iRecordsPerPage - 1)
    {
?>
      <tr>
       <td colspan="1" style="background-color: #FFFFFF; border-width: 1">&nbsp;</td>
      </tr>
<?php
    }
//-------------------------------
//-------------------------------
// Results Show end
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
<?php

  // Results Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
        <span class="btn btn-success">Back</span>
<?php }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>
          <?php  echo $sSortParams; ?>FormResults_Page=<?php echo $iPage - 1; ?>#Results">
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
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>
          <?php  echo $sSortParams; ?>FormResults_Page=<?php echo $iPage + 1; ?>#Results">
          <span class="btn btn-success">Next</span></a>
<?php
    }
  }

//-------------------------------
// Results Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </span></td></tr>
    </table>
  <?php


//-------------------------------
// Results Close Event begin
// Results Close Event end
//-------------------------------
}
//===============================


//===============================
// Display Search Form
//-------------------------------
function Search_show()
{
  global $db;
  global $sForm;

  $sFormTitle = "";
  $sActionFileName = "Vehicle.php";
  $scategory_idDisplayValue = "All";

//-------------------------------
// Search Open Event begin
// Search Open Event end
//-------------------------------
//-------------------------------
// Set variables with search parameters
//-------------------------------
  $fldcategory_id = strip(get_param("category_id"));
  $fldname = strip(get_param("name"));

//-------------------------------
// Search Show begin
//-------------------------------


//-------------------------------
// Search Show Event begin
// Search Show Event end
//-------------------------------
?>
    <form method="GET" action="<?php echo $sActionFileName; ?>" name="Search">
    <input type="hidden" name="FormName" value="Search"><input type="hidden" name="FormAction" value="search">
    <table class="table" style="width:100%">
     <tr>
      <td style="border-width: 1">
        <span style="font-size: 12pt; color: #000000">Category</span></td>
      <td style="background-color: #FFFFFF; border-width: 1"><select class="form-control" size="1" name="category_id">
<?php
    echo "<option value=\"\">" . $scategory_idDisplayValue . "</option>";
    $lookup_category_id = db_fill_array("select category_id, name from categories order by 2");

    if(is_array($lookup_category_id))
    {
      reset($lookup_category_id);
      while(list($key, $value) = each($lookup_category_id))
      {
        if($key == $fldcategory_id)
          $option="<option SELECTED value=\"$key\">$value";
        else
          $option="<option value=\"$key\">$value";
        echo $option;
      }
    }

?></select></td>
     </tr>
     <tr>
      <td style="border-style: inset; border-width: 0"><span style="font-size: 12pt; color: #000000">Vehicle</span></td>
      <td style="background-color: #FFFFFF; border-width: 0">
        <input class="form-control" type="text" name="name" maxlength="10" value="<?php echo tohtml($fldname); ?>" size="10" ></td>
     </tr>
     <tr>
     <td align="right" colspan="3">
       <button class="btn btn-primary" type="submit" value="Search">Search</button></td>
    </tr>
   </table>
   </form>
<?php

//-------------------------------
// Search Show end
//-------------------------------

//-------------------------------
// Search Close Event begin
// Search Close Event end
//-------------------------------
//===============================
}


//===============================
// Display Menu Form
//-------------------------------
function AdvMenu_show()
{
  global $db;

  $sFormTitle = "";

//-------------------------------
// AdvMenu Open Event begin
// AdvMenu Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
  $fldField1 = "AdvSearch.php";
//-------------------------------
// AdvMenu Show begin
//-------------------------------


//-------------------------------
// AdvMenu BeforeShow Event begin
// AdvMenu BeforeShow Event end
//-------------------------------

//-------------------------------
// Show fields
//-------------------------------

?>
    <table style="width:100%">
     <tr>
      <td style="background-color: #FFFFFF; border-width: 1"><a href="<?php echo $fldField1; ?>">
        <span style="font-size: 12pt; color: #000000">Advanced Search</span></a></td>
     </tr>
    </table>
<?php

//-------------------------------
// AdvMenu Show end
//-------------------------------
}
//===============================


//===============================
// Display Grid Form
//-------------------------------
function Total_show()
{
//-------------------------------
// Initialize variables
//-------------------------------

  global $db;
  global $sTotalErr;
  global $sFileName;

  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;

  $transit_params = "";
  $form_params = "category_id=" . tourl(get_param("category_id")) . "&model=" .     tourl(get_param("model")) . "&name=" . tourl(get_param("name")) . "&pricemax=" . tourl(get_param("pricemax")) . "&pricemin=" . tourl(get_param("pricemin")) . "&";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table style="width:100%">
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
  $pmodel = get_param("model");

  if(strlen($pmodel))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.model like " . tosql("%".$pmodel ."%", "Text");
  }
  $pname = get_param("name");

  if(strlen($pname))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.name like " . tosql("%".$pname ."%", "Text");
  }
  $ppricemax = get_param("pricemax");
  if(is_number($ppricemax) && strlen($ppricemax))
    $ppricemax = tosql($ppricemax, "Number");
  else
    $ppricemax = "";

  if(strlen($ppricemax))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.price<=" . $ppricemax;
  }
  $ppricemin = get_param("pricemin");
  if(is_number($ppricemin) && strlen($ppricemin))
    $ppricemin = tosql($ppricemin, "Number");
  else
    $ppricemin = "";

  if(strlen($ppricemin))
  {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "i.price>=" . $ppricemin;
  }


  if($HasParam)
    $sWhere = " WHERE (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select i.category_id as i_category_id, " .
    "i.item_id as i_item_id, " .
    "i.model as i_model, " .
    "i.name as i_name, " .
    "i.price as i_price " .
    " from items i ";
//-------------------------------

//-------------------------------
// Total Open Event begin
$sSQL="select count(item_id) as i_item_id from items as i";
// Total Open Event end
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
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
      <td colspan="1" style="background-color: #FFFFFF; border-width: 1">
        <span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
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
    $flditem_id = $db->f("i_item_id");
    $next_record = $db->next_record();

//-------------------------------
// Total Show begin
//-------------------------------

//-------------------------------
// Total Show Event begin
// Total Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Vehicle Items found:</span></td>
         <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
           <?php echo tohtml($flditem_id); ?>&nbsp;</span></td>
      </tr>
<?php

//-------------------------------
// Process the record separator
//-------------------------------
    if($next_record  || $iCounter == $iRecordsPerPage - 1)
    {
?>
      <tr>
       <td colspan="2" style="background-color: #FFFFFF; border-width: 1">&nbsp;</td>
      </tr>
<?php
    }
//-------------------------------
//-------------------------------
// Total Show end
//-------------------------------

//-------------------------------
// Move to the next record and increase record counter
//-------------------------------

    $iCounter++;
  }



//-------------------------------
// Finish form processing
//-------------------------------
  ?>
    </table>
  <?php


//-------------------------------
// Total Close Event begin
// Total Close Event end
//-------------------------------
}
//===============================

?>
