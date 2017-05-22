<?PHP
include "config.inc.php";
$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, 'status');
if ($db_found) 
{
$SQL = "select * from servers";
$result = mysqli_query($db_handle, $SQL);
while ($db_field = mysqli_fetch_assoc($result))
{
	$id = $db_field['id'];
  	$ip = $db_field['ip'];
	$date = date("Y-m-d H:i:s");
	$up = pingtest($ip);
	$online = $up ? 'online' : 'offline';
	if ($online == 'online'){
	$SQL2 = "UPDATE servers SET count = count + 1, ups = ups + 1, lastup = '" . $date . "' WHERE id = '" . $id . "'";
	}
	else
	{
	$SQL2 = "UPDATE servers SET count = count + 1, downs = downs + 1, lastdown = '" . $date . "' WHERE id = '" . $id . "'";
	}
	
if (mysqli_query($db_handle, $SQL2)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($db_handle);
}
}
	$SQL3 = "select * from services";
$result = mysqli_query($db_handle, $SQL3);
while ($db_field = mysqli_fetch_assoc($result))
{
	$id = $db_field['id'];
  	$ip = $db_field['ip'];
	$date = date("Y-m-d H:i:s");
	$up = pingtest($ip);
	$online = $up ? 'online' : 'offline';
	if ($online == 'online'){
	$SQL4 = "UPDATE services SET count = count + 1, ups = ups + 1, lastup = '" . $date . "' WHERE id = '" . $id . "'";
	}
	else
	{
	$SQL4 = "UPDATE services SET count = count + 1, downs = downs + 1, lastdown = '" . $date . "' WHERE id = '" . $id . "'";
	}
	
if (mysqli_query($db_handle, $SQL4)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($db_handle);
}
}
}	
	function pingtest($ip) {
    
	exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($ip)), $errorNo, $errorStr);
	return $errorStr === 0;
}	
?>
