<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PStatus</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

  <body>

<?PHP
include "navbar.php";
?>
<?PHP
include "config.inc.php";
?>

<?PHP
if (isset($_POST['updatesetting'])) {
    
    $db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
    $db_found  = mysqli_select_db($db_handle, 'status');
    if ($db_found) {
        $updateid      = $_POST['updatesetting'];
        $smtp          = $_POST['smtp'];
        $show_modal    = true;
        $smtp_port     = $_POST['smtp_port'];
        $smtp_username = $_POST['smtp_username'];
        $smtp_password = $_POST['smtp_password'];
        $admin_email   = $_POST['admin_email'];
        $refresh       = $_POST['refresh'];
        $enable_smart  = $_POST['enable_smart'];
        //$dir_username = $_POST['dir_username'];
        //$dir_password = $_POST['dir_password'];
        $alert_limit   = $_POST['alert_limit'];
        $updatesql     = "UPDATE config SET alert_limit = '" . $alert_limit . "', enablesmart = '" . $enable_smart . "', smtp = '" . $smtp . "', smtp_port = '" . $smtp_port . "', smtp_username = '" . $smtp_username . "', smtp_password = '" . $smtp_password . "', admin_email = '" . $admin_email . "', refresh = '" . $refresh . "' where id = '1'";
        if (mysqli_query($db_handle, $updatesql)) {
            $OUTPUT = "Settings Updated";
        } else {
            $OUTPUT = "Error updating settings : " . mysqli_error($db_handle);
        }
    }
}
?>

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

<center>
<div class="container">
<table class="table table-striped" id="status" cellpadding="4" cellspacing="4" border="1">
    <thead>
        <tr><th colspan="5"><center><img src="icons/email-outbox.png">&nbsp;SMTP Settings</th></tr>
        <tr><th><b>SMTP</th><th><b>PORT</th><th><b>USERNAME</th><th><b>PASSWORD</th><th><b>ADMIN EMAIL</th></tr>
</thead>
        <tbody>
<form method="POST" action="settings.php">
<input type="hidden" value="1" name="updatesetting">
<tr><td><input type="text" size="20" name="smtp" value="<?PHP
echo $smtp;
?>"</td><td><input type="text" size="20" name="smtp_port" value="<?PHP
echo $smtp_port;
?>"</td><td><input type="text" size="20" name="smtp_username" value="<?PHP
echo $smtp_username;
?>"</td><td><input type="text" size="20" name="smtp_password" value="<?PHP
echo $smtp_password;
?>"</td><td><input type="text" size="20" name="admin_email" value="<?PHP
echo $admin_email;
?>"</td></tr>
</table>

            
<table class="table table-striped" cellpadding="4" cellspacing="4" border="1">
    <thead>
    <tr><th colspan="4"><center><img src="icons/settings-cogwheel.png">&nbsp;Misc Settings</th></tr>
    </thead>
    <tr><Td><b>Enable Smart Devices</td><td><b>Default Refresh Rate</td><td><b>Email Alert Threshold</td></tr>
    <tr><td><input type="checkbox" name="enable_smart" value="1" <?php
if ($enable_smart === '1')
    echo 'checked="checked"';
?>></td><td><input type="text" size="20" name="refresh" value="<?PHP
echo $refresh;
?>"></td><td><input type="text" size="20" name="alert_limit" value="<?PHP
echo $alert_limit;
?>"></td></tr>
    </table>
<center>
<input type="submit" value="update" class="btn btn-success"></form>
            <br>

        <?PHP
include "aboutmodal.php";
?>
   <?PHP
include "footer.php";
?>
<?php
if ($show_modal):
?>
   <script type='text/javascript'>
    $(document).ready(function(){
    $('#myModal').modal('show');
    });
    </script>
<?php
endif;
?>
   
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PStatus - Action Result</h4>
      </div>
      <div class="modal-body">
        <p><?PHP
echo $OUTPUT;
?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    </body>
    </html>
