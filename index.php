<?php
/*********************************************************************************
 *       Filename: Default.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// Default CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// Default CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "index.php";
//===============================


//===============================
// Default PageSecurity begin
// Default PageSecurity end
//===============================

//===============================
// Default Open Event begin
// Default Open Event end
//===============================

//===============================
// Default OpenAnyPage Event start
// Default OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// Default Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Home</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<!-- Content Row -->
  <div class="row">
    <div class="col-md-3">
      <?php Search_show() ?>
      <br />
      <?php AdvMenu_show() ?>
      <br />
      <?php Categories_show() ?>
    </div>
    <!-- /.col-md-3 -->

  <div class="col-md-6">
      <?php Specials_show() ?>
      <br />
      <?php Recommended_show() ?>
  </div>
  <!-- /.col-md-6 -->

  <div class="col-md-3">
    <?php Weekly_show() ?>
    <br />
    <?php What_show() ?>
    <br />
    <?php New_show() ?>
  </div>
  <!-- /.col-md-3 -->
</div>
<!--End Content row -->

<?php Footer_show() ?>

</body>
</html>
<?php

// Default Show end

//===============================
// Default Close Event begin
// Default Close Event end
//===============================
//********************************************************************************


//===============================
// Display Search Form
//-------------------------------
function Search_show()
{
  global $db;
  global $styles;

  global $sForm;
  $sFormTitle = "Search";
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
    <thead>
       <tr style="background-color: #336699; border-style: outset; border-width: 1">
        <th style="text-align: Center" colspan="5"><a name="Search">
          <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></th>
       </tr>
    </thead>
       <tr><td style="background-color: #FFFFFF; border-width: 0"><br /></td></tr>
       <tr>
        <td style="background-color: #FFFFFF; border-width: 0">
          <span style="font-size: 12pt; color: #000000">Category</span></td>
        <td style="background-color: #FFFFFF; border-width: 0"><select class="form-control" size="1" name="category_id">
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
      <td style="background-color: #FFFFFF; border-width: 0">
        <span style="font-size: 12pt; color: #000000">Vehicle</span></td>
      <td style="background-color: #FFFFFF; border-width: 0">
        <input class="form-control" type="text" name="name" maxlength="10" value="<?php echo tohtml($fldname); ?>" size="10" ></td>
     </tr>
     <tr>
     <td style="background-color: #FFFFFF; border-width: 0" align="right" colspan="3">
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
  global $styles;
  $sFormTitle = "More Search Options";

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
    <table class="table" style="width:100%">
      <thead>
       <tr style="background-color: #336699; border-style: outset; border-width: 1">
        <th colspan="1"  style="text-align: Center">
          <span style="font-size: 12pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
       </tr>
     </thead>
     <tr><td><br /></td></tr>
     <tr>
      <td style="background-color: #FFFFFF; border-width: 0"><a href="<?php echo $fldField1; ?>">
        <span class="btn btn-info" style="font-size: 12pt; color: #FFFFFF">Advanced search</span></a></td>
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
function Recommended_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sRecommendedErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Recommended Rental Vehicles";
  $HasParam = false;
  $iRecordsPerPage = 5;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";

  $transit_params = "";
  $form_params = "";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $iSort = get_param("FormRecommended_Sorting");
  $iSorted = get_param("FormRecommended_Sorted");
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
      $sSortParams = "FormRecommended_Sorting=" . $iSort . "&FormRecommended_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormRecommended_Sorting=" . $iSort . "&FormRecommended_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by i.name" . $sDirection;
    if ($iSort == 2) $sOrder = " order by i.model" . $sDirection;
    if ($iSort == 3) $sOrder = " order by i.price" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered" style="width:100%">
      <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="1">
           <a name="Recommended"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold">
             <?php echo $sFormTitle; ?></span>
           </a>
         </th>
        </tr>
      </thead>
<?php

  $sWhere = " WHERE is_recommended=1";

//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select i.image_url as i_image_url, " .
    "i.item_id as i_item_id, " .
    "i.model as i_model, " .
    "i.name as i_name, " .
    "i.price as i_price " .
    " from items i ";
//-------------------------------

//-------------------------------
// Recommended Open Event begin
// Recommended Open Event end
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
      <td colspan="3" style="background-color: #FFFFFF; border-width: 1">
        <span style="font-size: 12pt; color: #000000">No records</span>
      </td>
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

    return;
  }

//-------------------------------

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iRecordsPerPage = 5;
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Process page scroller
//-------------------------------
  $iPage = get_param("FormRecommended_Page");
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
    $fldimage_url = $db->f("i_image_url");
    $fldmodel = $db->f("i_model");
    $fldname_URLLink = "VehicleDetail.php";
    $fldname_item_id = $db->f("i_item_id");
    $fldname = $db->f("i_name");
    $fldprice = $db->f("i_price");
    $next_record = $db->next_record();

//-------------------------------
// Recommended Show begin
//-------------------------------

//-------------------------------
// Recommended Show Event begin
$fldname = "<img style=\"border: 2px solid black\" src=\"" . $fldimage_url . "\"></td>

  <tr>
    <td style=\"background-color: #FFFFFF; border-style: inset; border-width: 0\" align=\"Center\">
    <span style=\"font-size: 12pt; color: #CE7E00; font-weight: bold\"><b>" . $fldname . "</b>";
// Recommended Show Event end
//-------------------------------

//-------------------------------
// Process the HTML controls
//-------------------------------
?>


      <tr>
       <td style="background-color: #FFFFFF; border-width: 1" align="Center"><span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldname_URLLink; ?>?item_id=<?php echo $fldname_item_id; ?>&<?php echo $transit_params; ?>">
           <span style="font-size: 12pt; color: #000000"><?php echo $fldname; ?></span></a>&nbsp;</span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 1" align="Center">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Model</span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1" align="Center"><span style="font-size: 12pt; color: #000000">
         <?php echo tohtml($fldmodel); ?>&nbsp;</span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 1" align="Center">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Rate</span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1" align="Center"><span style="font-size: 12pt; color: #000000">
         RM <?php echo tohtml($fldprice); ?>&nbsp;</span></td>
      </tr>


<?php

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
// Recommended Show end
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

  <tr><td align="right">
<?php

  // Recommended Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
        <span class="btn btn-success">Back</span>
<?php }
    else {
?>
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php  echo $sSortParams; ?>FormRecommended_Page=<?php echo $iPage - 1; ?>#Recommended">
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
        <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>FormRecommended_Page=<?php echo $iPage + 1; ?>#Recommended">
          <span class="btn btn-success">Next</span></a>
<?php
    }
  }

//-------------------------------
// Recommended Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
?>
  </td></tr>
    </table>
<?php


//-------------------------------
// Recommended Close Event begin
// Recommended Close Event end
//-------------------------------
}
//===============================


//===============================
// Display Grid Form
//-------------------------------
function What_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sWhatErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "What We're Renting";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;

  $transit_params = "";
  $form_params = "";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table" style="width:100%">
      <thead>
      <tr style="background-color: #336699; border-style: outset; border-width: 1">
       <td style="text-align: Center" colspan="1">
         <a name="What"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle ?></span></a></td>
      </tr>
      </thead>
<?php


  $sWhere = " WHERE editorial_cat_id=1";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select e.article_desc as e_article_desc, " .
    "e.article_title as e_article_title, " .
    "e.item_id as e_item_id " .
    " from editorials e ";
//-------------------------------

//-------------------------------
// What Open Event begin
// What Open Event end
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
      <td colspan="2" style="background-color: #FFFFFF; border-width: 0">
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
    $fldarticle_desc = $db->f("e_article_desc");
    $fldarticle_title_URLLink = "VehicleDetail.php";
    $fldarticle_title_item_id = $db->f("e_item_id");
    $fldarticle_title = $db->f("e_article_title");
    $flditem_id = $db->f("e_item_id");
    $next_record = $db->next_record();

//-------------------------------
// What Show begin
//-------------------------------

//-------------------------------
// What Show Event begin
$fldarticle_title = "<b>" . $fldarticle_title . "</b>";
$fldarticle_img = "<img style=\"border: 2px solid black\" align=\"middle\" border=\"1\" src=\"" . dlookup("items","image_url","item_id=" . $flditem_id) . "\">";
// What Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 0; text-align: Center">
         <span style="font-size: 12pt; color: #000000">
           <a href="<?php echo $fldarticle_title_URLLink; ?>?item_id=<?php echo $fldarticle_title_item_id; ?>&<?php echo $transit_params; ?>">
             <span style="font-size: 12pt; color: #000000"><?php echo $fldarticle_title; ?></span></a>&nbsp;</span>
        </td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 0; text-align: Center">
         <?php echo $fldarticle_img; ?>&nbsp;</td>
      </tr>
      <tr>
        <td style="background-color: #FFFFFF; border-width: 0; text-align: Center"><span style="font-size: 12pt; color: #000000;">
          <?php echo $fldarticle_desc; ?></span></td>
      </tr>

      <?php

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
// What Show end
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
// What Close Event begin
// What Close Event end
//-------------------------------
}
//===============================


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

  $transit_params = "";
  $form_params = "";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table" style="width:100%">
       <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <td style="text-align: Center" colspan="1">
           <a name="Categories"><span style="font-size: 12pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a>
         </td>
        </tr>
      </thead>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"></td>
      </tr>
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
    $fldname_URLLink = "Vehicle.php";
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
           <span class="btn btn-info"><?php echo $fldname; ?></span></a>&nbsp;</span></td>
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
// Finish form processing
//-------------------------------
  ?>
    </table>
  <?php


//-------------------------------
// Categories Close Event begin
// Categories Close Event end
//-------------------------------
}
//===============================


//===============================
// Display Grid Form
//-------------------------------
function New_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sNewErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Current News";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;

  $transit_params = "";
  $form_params = "";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table" style="width:100%">
      <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <td style="text-align: Center" colspan="1">
           <a name="New"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle?></span></a></td>
        </tr>
      </thead>
<?php


  $sWhere = " WHERE editorial_cat_id=2";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select e.article_desc as e_article_desc, " .
    "e.article_title as e_article_title, " .
    "e.item_id as e_item_id " .
    " from editorials e ";
//-------------------------------

//-------------------------------
// New Open Event begin
// New Open Event end
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
      <td colspan="2" style="background-color: #FFFFFF; border-width: 1">
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
    $fldarticle_desc = $db->f("e_article_desc");
    $fldarticle_title_URLLink = "VehicleDetail.php";
    $fldarticle_title_item_id = $db->f("e_item_id");
    $fldarticle_title = $db->f("e_article_title");
    $flditem_id = $db->f("e_item_id");
    $next_record = $db->next_record();

//-------------------------------
// New Show begin
//-------------------------------

//-------------------------------
// New Show Event begin
$fldarticle_title = "<b>" . $fldarticle_title . "</b>";
$fldarticle_img = "<img style=\"border: 2px solid black\" align=\"middle\" border=\"0\" src=\"" . dlookup("items","image_url","item_id=" . $flditem_id) . "\">";
$fldarticle_desc;
// New Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 0; text-align: Center">
         <span style="font-size: 12pt; color: #000000">
           <a href="<?php echo $fldarticle_title_URLLink; ?>?item_id=<?php echo $fldarticle_title_item_id; ?>&<?php echo $transit_params; ?>">
             <span style="font-size: 12pt; color: #000000"><?php echo $fldarticle_title; ?></span></a>&nbsp;</span>
       </td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 0; text-align: Center">
         <span style="font-size: 12pt; color: #000000">
           <?php echo $fldarticle_img; ?>&nbsp;</span></td>
      </tr>
      <tr>
        <td style="background-color: #FFFFFF; border-width: 0; text-align: Center">
          <span style="font-size: 12pt; color: #000000">
            <?php echo $fldarticle_desc; ?>&nbsp;</span></td>
      </tr>

      <?php

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
// New Show end
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
// New Close Event begin
// New Close Event end
//-------------------------------
}
//===============================


//===============================
// Display Grid Form
//-------------------------------
function Weekly_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sWeeklyErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "This Week's Featured Vehicle";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;

  $transit_params = "";
  $form_params = "";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table" style="width:100%">
      <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <th style="text-align: Center" colspan="1">
           <a name="Weekly"><span style="font-size: 12pt; color: #FFFFFF; font-weight: bold">
             <?php echo $sFormTitle; ?></span></a>
         </th>
        </tr>
      </thead>
<?php


  $sWhere = " WHERE editorial_cat_id=3";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select e.article_desc as e_article_desc, " .
    "e.article_title as e_article_title, " .
    "e.item_id as e_item_id " .
    " from editorials e ";
//-------------------------------

//-------------------------------
// Weekly Open Event begin
// Weekly Open Event end
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
      <td colspan="2" style="background-color: #FFFFFF; border-width: 1">
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
    $fldarticle_desc = $db->f("e_article_desc");
    $fldarticle_title_URLLink = "VehicleDetail.php";
    $fldarticle_title_item_id = $db->f("e_item_id");
    $fldarticle_title = $db->f("e_article_title");
    $flditem_id = $db->f("e_item_id");
    $next_record = $db->next_record();

//-------------------------------
// Weekly Show begin
//-------------------------------

//-------------------------------
// Weekly Show Event begin
$fldarticle_title = "<b>" . $fldarticle_title . "</b>";
$fldarticle_img = "<img style=\"border: 2px solid black\" align=\"middle\" border=\"0\" src=\"" . dlookup("items","image_url","item_id=" . $flditem_id) . "\">";
// Weekly Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>      <tr><td>
      <table class="table" width="100%" style="width:100%">
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"></span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 0; text-align: Center"><span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldarticle_title_URLLink; ?>?item_id=<?php echo $fldarticle_title_item_id; ?>&<?php echo $transit_params; ?>">
           <span style="font-size: 12pt; color: #000000"><?php echo $fldarticle_title; ?></span></a>&nbsp;</span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"></span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 0; text-align: Center"><span style="font-size: 12pt; color: #000000">
         <?php echo $fldarticle_img; ?>&nbsp;</span></td>
      </tr>
      </table>
        </td></tr>
      <?php

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
// Weekly Show end
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
// Weekly Close Event begin
// Weekly Close Event end
//-------------------------------
}
//===============================

//===============================
// Display Grid Form
//-------------------------------
function Specials_show()
{
//-------------------------------
// Initialize variables
//-------------------------------

  global $db;
  global $sSpecialsErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Weekly Special Bulletin";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;

  $transit_params = "";
  $form_params = "";

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table" style="width:100%">
       <thead>
        <tr style="background-color: #336699; border-style: outset; border-width: 1">
         <td style="text-align: Center;" colspan="1">
           <a name="Specials"><span style="font-size: 12pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></td>
        </tr>
      </thead>
<?php

  $sWhere = " WHERE editorial_cat_id=4";

//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select e.article_desc as e_article_desc, " .
    "e.article_title as e_article_title " .
    " from editorials e ";
//-------------------------------

//-------------------------------
// Specials Open Event begin
// Specials Open Event end
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
      <td colspan="2" style="background-color: #FFFFFF; border-width: 1">
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
    $fldarticle_desc = $db->f("e_article_desc");
    $fldarticle_title = $db->f("e_article_title");
    $next_record = $db->next_record();

//-------------------------------
// Specials Show begin
//-------------------------------

//-------------------------------
// Specials Show Event begin
// Specials Show Event end
//-------------------------------

//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"></span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 0">
         <span style="font-size: 12pt; color: #000000">
      <?php echo $fldarticle_title; ?>&nbsp;</span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-style: inset; border-width: 0">
         <span style="font-size: 12pt; color: #CE7E00; font-weight: bold"></span></td>
      </tr>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1">
         <span style="font-size: 12pt; color: #000000">
           <?php echo $fldarticle_desc; ?>&nbsp;</span></td>
      </tr><?php

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
// Specials Show end
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
// Specials Close Event begin
// Specials Close Event end
//-------------------------------
}
//===============================
?>
