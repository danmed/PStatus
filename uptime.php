<?PHP
include "config.inc.php";
$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found  = mysqli_select_db($db_handle, $DBName);
if ($db_found) {
    $SQL    = "select * from servers";
    $result = mysqli_query($db_handle, $SQL);
    while ($db_field = mysqli_fetch_assoc($result)) {
        $id         = $db_field['id'];
        $device     = $db_field['device'];
        $ip         = $db_field['ip'];
        $downs      = $db_field['downs'];
        $Email_sent = $db_field['Email_Sent'];
        $date       = date("Y-m-d H:i:s");
        $up         = pingtest($ip);
        $online     = $up ? 'online' : 'offline';
        if ($online == 'online') {
            if ($Email_sent == 'yes') {
                error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
                set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
                require_once "Mail.php";
                $host          = "ssl://" . $smtp;
                $port          = $smtp_port;
                $to            = $admin_email;
                $email_from    = $smtp_username;
                $email_subject = "PStatus - Device Up - " . $device;
                $email_body    = $device . " has recovered";
                $email_address = "noreply@pstatus.com";
                $headers       = array(
                    'From' => $email_from,
                    'To' => $to,
                    'Subject' => $email_subject,
                    'Reply-To' => $email_address
                );
                $params = array('debug'=>true,'host'=>$host,'port'=>$port,'auth'=>true,'username'=>$username,'password'=>$password);
                $smtp          = Mail::factory('smtp', $params, array(
                    'host' => $host,
                    'port' => $port,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password
                ));
                $mail          = $smtp->send($to, $headers, $email_body);
            } else {
                $SQL2 = "UPDATE servers SET count = count + 1, ups = ups + 1, downs = '0', lastup = '" . $date . "' WHERE id = '" . $id . "'";
            }
        } else {
            if ($downs + 1 >= $alert_limit) {
                $SQL2 = "UPDATE servers SET count = count + 1, downs = downs + 1, Email_Sent = 'yes', lastdown = '" . $date . "' WHERE id = '" . $id . "'";
                error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
                set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
                require_once "Mail.php";
                $host          = "ssl://" . $smtp;
                $port          = $smtp_port;
                $to            = $admin_email;
                $email_from    = $smtp_username;
                $email_subject = "PStatus - Device Down - " . $device;
                $email_body    = $device . " has not replied to " . $alert_limit . " ping request(s)";
                $email_address = "noreply@pstatus.com";
                $headers       = array(
                    'From' => $email_from,
                    'To' => $to,
                    'Subject' => $email_subject,
                    'Reply-To' => $email_address
                );
                $params = array('debug'=>true,'host'=>$host,'port'=>$port,'auth'=>true,'username'=>$username,'password'=>$password);
                $smtp          = Mail::factory('smtp', $params, array(
                    'host' => $host,
                    'port' => $port,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password
                ));
                $mail          = $smtp->send($to, $headers, $email_body);
            } else {
                $SQL2 = "UPDATE servers SET count = count + 1, downs = downs + 1, lastdown = '" . $date . "' WHERE id = '" . $id . "'";
            }
        }
        
        if (mysqli_query($db_handle, $SQL2)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($db_handle);
        }
    }
    $SQL3   = "select * from smartdevices";
    $result = mysqli_query($db_handle, $SQL3);
    while ($db_field = mysqli_fetch_assoc($result)) {
        $id     = $db_field['id'];
        $ip     = $db_field['ip'];
        $date   = date("Y-m-d H:i:s");
        $up     = pingtest($ip);
        $online = $up ? 'online' : 'offline';
        if ($online == 'online') {
            $SQL4 = "UPDATE smartdevices SET count = count + 1, ups = ups + 1, lastup = '" . $date . "' WHERE id = '" . $id . "'";
        } else {
            $SQL4 = "UPDATE smartdevices SET count = count + 1, downs = downs + 1, lastdown = '" . $date . "' WHERE id = '" . $id . "'";
        }
        
        if (mysqli_query($db_handle, $SQL4)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($db_handle);
        }
    }
}
function pingtest($ip)
{
    
    exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($ip)), $errorNo, $errorStr);
    return $errorStr === 0;
}
?>
