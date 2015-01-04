<?php
/*********************************************************************************
 *       Filename: MembersGrid.php
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// MembersGrid CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// MembersGrid CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "MembersGrid.php";
//===============================


//===============================
// MembersGrid PageSecurity begin
check_security(2);
// MembersGrid PageSecurity end
//===============================

//===============================
// MembersGrid Open Event begin
// MembersGrid Open Event end
//===============================

//===============================
// MembersGrid OpenAnyPage Event start
// MembersGrid OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// MembersGrid Show begin

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
  <span style="face: arial; font-size: 12pt "  > Enter full or partial login, first or last name</span>
    <?php Search_show() ?>
  <br />
    <?php Members_show() ?>
  <br />
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>
<?php

// MembersGrid Show end

//===============================
// MembersGrid Close Event begin
// MembersGrid Close Event end
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
  $sFormTitle = "";
  $sActionFileName = "MembersGrid.php";

//-------------------------------
// Search Open Event begin
// Search Open Event end
//-------------------------------
//-------------------------------
// Set variables with search parameters
//-------------------------------
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
    <table style="width:100%">
     <tr>
      <td style="border-style: inset; border-width: 0"><span style="font-size: 12pt; color: #000000">Username :</span></td>
      <td style="background-color: #FFFFFF; border-width: 1">
        <input class="form-control" type="text" name="name" maxlength="10" value="<?php echo tohtml($fldname); ?>" size="10" ></td>
     <td ><button class="btn btn-primary" type="submit" value="Search">Search</td>
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
// Display Grid Form
//-------------------------------
function Members_show()
{
//-------------------------------
// Initialize variables
//-------------------------------


  global $db;
  global $sMembersErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Members";
  $HasParam = false;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $sActionFileName = "MembersRecord.php";

  $transit_params = "name=" . tourl(get_param("name")) . "&";
  $form_params = "name=" . tourl(get_param("name")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by m.member_login Asc";
  $iSort = get_param("FormMembers_Sorting");
  $iSorted = get_param("FormMembers_Sorted");
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
      $sSortParams = "FormMembers_Sorting=" . $iSort . "&FormMembers_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormMembers_Sorting=" . $iSort . "&FormMembers_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by m.member_login" . $sDirection;
    if ($iSort == 2) $sOrder = " order by m.first_name" . $sDirection;
    if ($iSort == 3) $sOrder = " order by m.last_name" . $sDirection;
    if ($iSort == 4) $sOrder = " order by m.member_level" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="table table-bordered"  style="width:100%">
      <thead>
        <tr style="background-color: #336699;  border-style: outset; border-width: 1" >
         <th style="text-align: Center; " colspan="4">
           <a name="Members"><span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></a></th>
        </tr>
        <tr>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormMembers_Sorting=1&FormMembers_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Username</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormMembers_Sorting=2&FormMembers_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">First Name</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormMembers_Sorting=3&FormMembers_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Last Name</span></a></th>
         <th style="background-color: #FFFFFF; border-style: inset; border-width: 1">
           <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?>FormMembers_Sorting=4&FormMembers_Sorted=<?php echo $form_sorting; ?>&">
             <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">Level</span></a></th>
        </tr>
      </thead>
<?php

//-------------------------------
// Build WHERE statement
//-------------------------------
  $pname = get_param("name");
  if(strlen($pname))
  {
    $HasParam = true;
    $sWhere = "m.member_login like " . tosql("%".$pname ."%", "Text") . " or " . "m.first_name like " . tosql("%".$pname ."%", "Text") . " or " . "m.last_name like " . tosql("%".$pname ."%", "Text");
  }


  if($HasParam)
    $sWhere = " WHERE (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select m.first_name as m_first_name, " .
    "m.last_name as m_last_name, " .
    "m.member_id as m_member_id, " .
    "m.member_level as m_member_level, " .
    "m.member_login as m_member_login " .
    " from members m ";
//-------------------------------

//-------------------------------
// Members Open Event begin
// Members Open Event end
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
      <td colspan="4" style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">No records</span></td>
     </tr>
<?php

//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="4" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">
         <a href="<?php echo $form_action; ?>?<?php echo  $transit_params; ?>">
           <span class="btn btn-success">Insert Members</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

  $amember_level = explode(";", "1;Member;2;Administrator");
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
  $iPage = get_param("FormMembers_Page");
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
    $fldname = $db->f("m_first_name");
    $fldlast_name = $db->f("m_last_name");
    $fldmember_level = $db->f("m_member_level");
    $fldmember_login_URLLink = "MembersInfo.php";
    $fldmember_login_member_id = $db->f("m_member_id");
    $fldmember_login = $db->f("m_member_login");
    $next_record = $db->next_record();

//-------------------------------
// Members Show begin
//-------------------------------

//-------------------------------
// Members Show Event begin
// Members Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
         <a href="<?php echo $fldmember_login_URLLink; ?>?member_id=<?php echo $fldmember_login_member_id; ?>&<?php echo $transit_params; ?>">
           <span class="btn btn-info"><?php echo $fldmember_login; ?></span></a>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldname); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php echo tohtml($fldlast_name); ?>&nbsp;</span></td>
       <td style="background-color: #FFFFFF; border-width: 1"><span style="font-size: 12pt; color: #000000">
      <?php $fldmember_level = get_lov_value($fldmember_level, $amember_level); ?>
      <?php echo tohtml($fldmember_level); ?>&nbsp;</span></td>
      </tr>

      <?php
//-------------------------------
// Members Show end
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
     <td colspan="4" style="background-color: #FFFFFF; border-style: inset; border-width: 0">
       <span style="font-size: 12pt; color: #CE7E00; font-weight: bold">
         <a href="<?php echo  $form_action; ?>?<?php echo  $transit_params; ?>">
           <span class="btn btn-success">Insert Members</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
  // Members Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
            <span class="btn btn-success">Back</span>
<?php }
    else {
?>
            <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>FormMembers_Page=<?php echo $iPage - 1; ?>#Members">
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
            <a href="<?php echo $sFileName; ?>?<?php echo $form_params; ?><?php echo $sSortParams; ?>FormMembers_Page=<?php echo $iPage + 1; ?>#Members">
              <span class="btn btn-success">Next</span></a>
<?php
    }
  }

//-------------------------------
// Members Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </span></td></tr>
    </table>
  <?php


//-------------------------------
// Members Close Event begin
// Members Close Event end
//-------------------------------
}
//===============================

?>
