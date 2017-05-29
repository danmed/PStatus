<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="20">
    <title>PStatus</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
  .progress {
    margin-bottom: 0 !important;
    background-color: #DA2A2A;
    -webkit-box-shadow: none;
    box-shadow: none;
}

</style>
    </head>

  <body>

    <?PHP
include "navbar.php";
?>
     <?PHP
include "config.inc.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

$(document).ready(function(){
    $("#status td.on_off:contains('false')").css('background-color','#E05667');
    $("#status td.on_off:contains('true')").css('background-color','#56E08E');
});

</script>
<center>
<div class="container">

<?PHP
$parent = $_GET['parent'];
$device = $_GET['device'];
$ip     = $_GET['ip'];
?>

<table class="table" id="status" cellpadding="4" cellspacing="4" border="1">
<thead>
<tr><th colspan="4"><center><b><img src="icons/001-window.png">&nbsp;Service Ping Status for <?PHP
echo $device;
?></th></tr>
</thead>
<tr><td><b>DEVICE</td><td><b>PORT</td><td><b>STATUS</td></tr>
<?PHP

$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found  = mysqli_select_db($db_handle, $DBName);


if ($db_found) {
    $SQL    = "select * from services where parent = '" . $parent . "'";
    $result = mysqli_query($db_handle, $SQL);
    while ($db_field = mysqli_fetch_assoc($result)) {
        $name   = $db_field['name'];
        $port   = $db_field['port'];
        $online = servicetest($ip, $port);
        
        print "<tr><td>" . $name . "</td><td>" . $port . "</td><td class='on_off'>" . ($online ? 'true' : 'false') . "</td></tr>";
    }
    
    mysqli_close($db_handle);
    
}

function servicetest($ip, $port)
{
    $socket = @fsockopen($ip, $port, $errorNo, $errorStr, 3);
    if ($errorNo == 0) {
        return true;
    } else {
        return false;
    }
}

mysqli_close($db_handle);

?>

    </table>
    <?PHP
include "aboutmodal.php";
?>
   <?PHP
include "footer.php";
?>
   </body>
    </html>
