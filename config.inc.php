<?PHP

/* MYSQL Configuration */
$DBServer	= 	'dbaddress';
$DBName     = 	'dbname';
$DBUser		= 	'dbuser';
$DBPassword     = 	'dbpass';

$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, $DBName);
if ($db_found) 
{
$config_sql = "select * from config where id = 1"	;
$config_result = mysqli_query($db_handle, $config_sql);
while ($db_field = mysqli_fetch_assoc($config_result))
{
/* Display Smart Devices */
$enable_smart = $db_field['enablesmart'];
/* Default refresh rate for index page */
$refresh = $db_field['refresh'];
/* SMTP Details for admin emails */
$smtp = $db_field['smtp'];
$smtp_port = $db_field['smtp_port'];
$smtp_username = $db_field['smtp_username'];
$smtp_username = $db_field['smtp_username'];
$smtp_password = $db_field['smtp_password'];
$admin_email = $db_field['admin_email'];
/* Credentials for PHP_Curl */
$dir_username = $db_field['dir_username'];
$dir_password = $db_field['dir_password'];
 /* Email Alert Down Limit */
$alert_limit = $db_field['alert_limit'];
}
}

?>
