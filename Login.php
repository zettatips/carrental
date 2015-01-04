<?php
/*********************************************************************************
 *       Filename: Login.php
 *       PHP 4.0 build 11/30/2001
 *       PHp 5.0 build 10/12/2014
 *********************************************************************************/

//-------------------------------
// Login CustomIncludes begin

include ("./common.php");
include ("./Header.php");
include ("./Footer.php");

// Login CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "Login.php";
//===============================


//===============================
// Login PageSecurity begin
// Login PageSecurity end
//===============================

//===============================
// Login Open Event begin
// Login Open Event end
//===============================

//===============================
// Login OpenAnyPage Event start
// Login OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// Login Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sLoginErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Login":
    Login_action($sAction);
  break;
}
//===============================

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Car Rental - Login</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php Header_show() ?>

<div class="col-md-4"></div>
<div class="col-md-4">
  <?php Login_show() ?>
</div>
<div class="col-md-4"></div>

<?php Footer_show() ?>

</body>
</html>

<?php
// Login Show end

//===============================
// Login Close Event begin
// Login Close Event end
//===============================
//********************************************************************************


//===============================
// Login Form Action
//-------------------------------
function Login_action($sAction)
{
  global $db;

  global $sLoginErr;
  global $sFileName;
  global $styles;

  switch(strtolower($sAction))
  {
    case "login":

//-------------------------------
// Login Login begin
//-------------------------------
      $sLogin = get_param("Login");
      $sPassword = get_param("Password");
      $db->query("SELECT member_id,member_level FROM members WHERE member_login =" . tosql($sLogin, "Text") . " AND member_password=" . tosql($sPassword, "Text"));
      $is_passed = $db->next_record();

//-------------------------------
// Login OnLogin Event begin
// Login OnLogin Event end
//-------------------------------
      if($is_passed)
      {
//-------------------------------
// Login and password passed
//-------------------------------
        set_session("UserID", $db->f("member_id"));
        set_session("UserRights", $db->f("member_level"));
        //$_SESSION['UserID'] = $db->f("member_id");
        //$_SESSION['UserRights'] = $db->f("member_level");
        $sPage = get_param("ret_page");
        if (strlen($sPage))
        {
          header("Location: " . $sPage);
        }
        else
          header("Location: Reservation.php");
      }
      else
      {
        $sLoginErr = "Login or Password is incorrect.";
      }
//-------------------------------
// Login Login end
//-------------------------------
    break;
  }
}
//===============================


//===============================
// Display Login Form
//-------------------------------
function Login_show()
{

  global $sLoginErr;
  global $db;
  global $sFileName;
  global $styles;
  $querystring =  get_param("querystring");
  $ret_page = get_param("ret_page");

  $sFormTitle = "Login";

//-------------------------------
// Login Show begin
//-------------------------------

//-------------------------------
// Login Open Event begin
// Login Open Event end
//-------------------------------

?>
<div align="center">
  <table class="table" style="width:100%">
   <thead>
    <tr style="background-color: #336699; border-style: outset; border-width: 1">
      <th colspan="0"  style="text-align: Center">
        <span style="font-size: 13pt; color: #FFFFFF; font-weight: bold"><?php echo $sFormTitle; ?></span></th>
    </tr>
   </thead>
  </table>
</div>

    <table class="table" style="width:100%">
      <form action="<?php echo $sFileName; ?>" method="POST">
      <input type="hidden" name="FormName" value="Login">

      <?php if ($sLoginErr) { ?>
      <tr>
        <td colspan="2" style="background-color: #FFFFFF; border-width: 1">
          <span style="font-size: 12pt; color: #000000"><?php echo $sLoginErr; ?></span></td>
      </tr>
    <?php } ?>

<?php

  if(get_session("UserID") == "")
  //if($_SESSION['UserID'] == "")
  {
//-------------------------------
//- User is not logged in
//-------------------------------
?>
              <div class="container-fluid">
                <div class="row-fluid">
                  <h4>Enter Username and Password</h4>
                  <form class="form-horizontal">
                    <div class="control-group">
                      <label class="control-label" for="inputUsername">Username</label>
                      <div class="controls">
                        <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="Login" maxlength="50">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="inputPassword">Password</label>
                      <div class="controls">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="Password" maxlength="50">
                      </div>
                    </div>
                    <div class="control-group">
                      <div class="controls">
                        <br />
                        <input type="hidden" name="FormAction" value="login">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
<?php
  }
?>
  <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>">
  <input type="hidden" name="querystring" value="<?php echo $querystring; ?>"></td>
  </tr>
  </form>
</table>

<?php

//-------------------------------
// Login Close Event begin
// Login Close Event end
//-------------------------------

//-------------------------------
// Login Show end
//-------------------------------
}
//===============================
?>
