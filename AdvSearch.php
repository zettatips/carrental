<?php
/*********************************************************************************
 *       Filename: AdvSearch.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// AdvSearch CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// AdvSearch CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "AdvSearch.php";
//===============================


//===============================
// AdvSearch PageSecurity begin
// AdvSearch PageSecurity end
//===============================

//===============================
// AdvSearch Open Event begin
// AdvSearch Open Event end
//===============================

//===============================
// AdvSearch OpenAnyPage Event start
// AdvSearch OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// AdvSearch Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Advance Search</title>
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
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// AdvSearch Show end

//===============================
// AdvSearch Close Event begin
// AdvSearch Close Event end
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
  $sFormTitle = "Advanced Search";
  $sActionFileName = "Vehicle.php";
  $scategory_idDisplayValue = "All";

//-------------------------------
// Search Open Event begin
// Search Open Event end
//-------------------------------
//-------------------------------
// Set variables with search parameters
//-------------------------------
  $fldname = strip(get_param("name"));
  $fldmodel = strip(get_param("model"));
  $fldcategory_id = strip(get_param("category_id"));
  $fldpricemin = strip(get_param("pricemin"));
  $fldpricemax = strip(get_param("pricemax"));

//-------------------------------
// Search Show begin
//-------------------------------


//-------------------------------
// Search Show Event begin
// Search Show Event end
//-------------------------------
?>
    <form method="GET" action="<?php echo $sActionFileName; ?>" name="Search">
    <input class="form-control" type="hidden" name="FormName" value="Search"><input class="form-control" type="hidden" name="FormAction" value="search">
    <table class="table table-bordered" style="width:100%">
      <thead>
       <tr style="background-color: #336699; border-style: outset; border-width: 1">
        <th style="text-align: Center" colspan="11">
          <a name="Search"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a>
        </th>
       </tr>
      </thead>
       <tr>
        <td>
          <span style="font-size: 12pt; color: #000000">Vehicle</span></td>
        <td style="background-color: #FFFFFF; border-width: 1">
          <input class="form-control" type="text" name="name" maxlength="20" value="<?php tohtml($fldname); ?>" size="20" ></td>
       </tr>
       <tr>
        <td>
          <span style="font-size: 12pt; color: #000000">Model</span></td>
        <td style="background-color: #FFFFFF; border-width: 1">
          <input class="form-control" type="text" name="model" maxlength="100" value="<?php tohtml($fldmodel); ?>" size="20" ></td>
       </tr>
       <tr>
        <td>
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
      <td><span style="font-size: 12pt; color: #000000">Rate more then</span></td>
      <td style="background-color: #FFFFFF; border-width: 1">
        <input class="form-control" type="text" name="pricemin" maxlength="10" value="<?php tohtml($fldpricemin); ?>" size="10" ></td>
     </tr>
     <tr>
      <td><span style="font-size: 12pt; color: #000000">Rate less then</span></td>
      <td style="background-color: #FFFFFF; border-width: 1">
        <input class="form-control" type="text" name="pricemax" maxlength="10" value="<?php tohtml($fldpricemax); ?>" size="10" ></td>
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

?>
