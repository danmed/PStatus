<?php
/**
 * @author Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.1
 */

include('pushover.php');

$push = new Pushover();
$push->setToken('a5im31tiwpg4go2pofecu7dq1bbnot'); //App Token
$push->setUser('usbm8QEU6TrCvFZgcYZPRZmGpLuWsx'); // User Token

$push->setTitle('PStatus');
$push->setMessage('Hello world! ' .time());
$push->setUrl('http://chris.schalenborgh.be/blog/');
$push->setUrlTitle('cool php blog');

$push->setDevice('iPhone');
$push->setPriority(2);
$push->setRetry(60); //Used with Priority = 2; Pushover will resend the notification every 60 seconds until the user accepts.
$push->setExpire(3600); //Used with Priority = 2; Pushover will resend the notification every 60 seconds for 3600 seconds. After that point, it stops sending notifications.
$push->setCallback('http://chris.schalenborgh.be/');
$push->setTimestamp(time());
$push->setDebug(true);
$push->setSound('bike');

$go = $push->send();

$receipt = $push->getReceipt();

echo '<pre>';
print_r($go);
print "Receipt: $receipt\n";
echo '</pre>';
?>
