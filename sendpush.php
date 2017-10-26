<?php
/**
 * @author Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.1
 */

include "config.inc.php";
include('pushover.php');

$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found  = mysqli_select_db($db_handle, $DBName);

if ($db_found) {
    $SQL    = "select * from pushover where id = '1' ";
    $result = mysqli_query($db_handle, $SQL);
    while ($db_field = mysqli_fetch_assoc($result)) {

echo $db_field['setToken'] . "<br>";
echo $db_field['SetUser'] . "<br>";
echo $_GET['Title'] . "<br>";
        echo $_GET['Message'] . "<br>";
        echo $db_field['SetPriority'] . "<br>";
        echo $db_field['SetRetry'] . "<br>";
        echo $db_field['SetExpire'] . "<br>";
        echo $db_field['SetCallback'] . "<br>";
        echo $db_field['SetSound'] . "<br>";
        
$push = new Pushover();
$push->setToken($db_field['setToken']); //App Token
$push->setUser($db_field['SetUser']); // User Token

$push->setTitle($_GET['Title']);
$push->setMessage($_GET['Message']);

$push->setPriority($db_field['SetPriority']);
$push->setRetry($db_field['SetRetry']); //Used with Priority = 2; Pushover will resend the notification every 60 seconds until the user accepts.
$push->setExpire($db_field['SetExpire']); //Used with Priority = 2; Pushover will resend the notification every 60 seconds for 3600 seconds. After that point, it stops sending notifications.
$push->setCallback($db_field['SetCallback']);
$push->setTimestamp(time());
$push->setDebug(true);
$push->setSound($db_field['SetSound']);

$go = $push->send();

$receipt = $push->getReceipt();

echo '<pre>';
print_r($go);
print "Receipt: $receipt\n";
echo '</pre>';
    }
}
        
?>
