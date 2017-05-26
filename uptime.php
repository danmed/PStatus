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
	$device = $db_field['device'];
  	$ip = $db_field['ip'];
	$downs = $db_field['downs'];
	$date = date("Y-m-d H:i:s");
	$up = pingtest($ip);
	$online = $up ? 'online' : 'offline';
	if ($online == 'online'){
	$SQL2 = "UPDATE servers SET count = count + 1, ups = ups + 1, downs = '0', lastup = '" . $date . "' WHERE id = '" . $id . "'";
	}
	else
	{
	if ($downs + 1 >= $alert_limit){
	$SQL2 = "UPDATE servers SET count = count + 1, downs = '0', lastdown = '" . $date . "' WHERE id = '" . $id . "'";
	//extract data from the post
	//set POST variables
	$url = 'http://web.danmed.co.uk/status/mail.php';
	$fields = array(
	'subject' => urlencode('PStatus - Device Down - ' . $device),
	'body' => urlencode($device . ' has not responded to ' . $downs . ' ping request(s)'),
	);

	//url-ify the data for the POST
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	//curl_setopt($ch, CURLOPT_USERPWD, $dir_username . ":" . $dir_password);

	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);
	}
		else
		{
			$SQL2 = "UPDATE servers SET count = count + 1, downs = downs + 1, lastdown = '" . $date . "' WHERE id = '" . $id . "'";
		}
	}
	
if (mysqli_query($db_handle, $SQL2)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($db_handle);
}
}
	$SQL3 = "select * from smartdevices";
$result = mysqli_query($db_handle, $SQL3);
while ($db_field = mysqli_fetch_assoc($result))
{
	$id = $db_field['id'];
  	$ip = $db_field['ip'];
	$date = date("Y-m-d H:i:s");
	$up = pingtest($ip);
	$online = $up ? 'online' : 'offline';
	if ($online == 'online'){
	$SQL4 = "UPDATE smartdevices SET count = count + 1, ups = ups + 1, lastup = '" . $date . "' WHERE id = '" . $id . "'";
	}
	else
	{
	$SQL4 = "UPDATE smartdevices SET count = count + 1, downs = downs + 1, lastdown = '" . $date . "' WHERE id = '" . $id . "'";
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
