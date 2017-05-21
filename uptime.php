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
	$SQL2 = "UPDATE uptime SET count = count + 1 WHERE parent = $id";
if (mysqli_query($db_handle, $sql2)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($db_handle);
}
}
}	
	
?>
