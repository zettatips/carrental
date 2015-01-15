<?php

/*********************************************************************************
*       Filename: Cars.php
*		   PHP 5.3.29 build 15/1/2015
*********************************************************************************/

session_start();

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");
// Cars CustomIncludes end
//-------------------------------

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "Cars.php";
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Admin Menu</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

  <?php Header_show() ?>

  <div class="col-md-3"></div>
  <div class="col-md-6">
    <?php Recommended_show() ?>
  </div>
  <div class="col-md-3"></div>

  <?php Footer_show() ?>

</body>
</html>


<?php
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

                              ?>
