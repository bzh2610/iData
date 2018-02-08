<?php

// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 0);

// Set to 0 once you're ready to go live
define("USE_SANDBOX", 0);


define("LOG_FILE", "./ipn.log");


// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
        } else {
                $value = urlencode($value);
        }
        $req .= "&$key=$value";
}

// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data

if(USE_SANDBOX == true) {
        $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
        $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}

$ch = curl_init($paypal_url);
if ($ch == FALSE) {
        return FALSE;
}

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

if(DEBUG == true) {
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}

// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.

//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);

$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
        {
        if(DEBUG == true) {        
                error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
        }
        curl_close($ch);
        exit;

} else {
                // Log the entire HTTP response if debug is switched on.
                if(DEBUG == true) {
                        error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
                        error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);

                        // Split response headers and payload
                        list($headers, $res) = explode("\r\n\r\n", $res, 2);
                }
                curl_close($ch);
}

// Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
        // check whether the payment_status is Completed
        // check that txn_id has not been previously processed
        // check that receiver_email is your PayPal email
        // check that payment_amount/payment_currency are correct
        // process payment and mark item as paid.

        // assign posted variables to local variables
        //$item_name = $_POST['item_name'];
        $item_number = $_POST['item_number'];
        //$payment_status = $_POST['payment_status'];
        $payment_amount = $_POST['mc_gross'];
        $payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];
		
			try//connexion a la bdd
			{
			$bdd = new PDO('mysql:host=localhost;dbname=idata', 'root', 'YOUR_PASSWORD');
			}
			catch(Exception $e)
			{
			die('Erreur : '.$e->getMessage());
			}
			
		$req = $bdd->prepare('SELECT End FROM premium WHERE Txn_id = ?');
		$req->execute(array($txn_id));
		$donnees = $req->fetch();
		
		if($donnees['End'] > 100)
		{
		echo 'Transaction déjà traitee';
		}
		
		else
		{
		
			if($receiver_email=="evan.ollivier@gmail.com" AND $payment_currency=="USD"){
		
					// Instructions à suivre après le don (mise à jour de la BDD,...)

			$one=60*60*24*30;
			$two=60*60*24*60;
			$three=60*60*24*90;
			$six=60*60*24*180;
			$year=60*60*24*365;
			$code = uniqid(null,true);

			
				if ($payment_amount==0.75 AND $item_number == '50'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 50000,
				'End' => $one,
				'Txn_id' =>$txn_id
				));
				}
            	elseif ($payment_amount==1.5 AND $item_number == '50'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 50000,
				'End' => $two,
				'Txn_id' =>$txn_id
				));
				}
				elseif ($payment_amount==2.25 AND $item_number == '50'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 50000,
				'End' => $three,
				'Txn_id' =>$txn_id
				));
				}
				elseif ($payment_amount==4.5 AND $item_number == '50'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 50000,
				'End' => $six,
				'Txn_id' =>$txn_id
				));
				}
				elseif ($payment_amount==9 AND $item_number == '50'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 50000,
				'End' => $year,
				'Txn_id' =>$txn_id
				));
				}
				
				
				
				
				elseif ($payment_amount==1.49 AND $item_number == '100'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 100000,
				'End' => $one,
				'Txn_id' =>$txn_id
				));
				}
				elseif ($payment_amount==2.98 AND $item_number == '100'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 100000,
				'End' => $two,
				'Txn_id' =>$txn_id
				));
				}
				elseif ($payment_amount==4.47 AND $item_number == '100'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 100000,
				'End' => $three,
				'Txn_id' =>$txn_id
				));
				}
				elseif ($payment_amount==8.94 AND $item_number == '100'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 100000,
				'End' => $six,
				'Txn_id' =>$txn_id
				));
				}
				elseif ($payment_amount==17.88 AND $item_number == '100'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 100000,
				'End' => $year,
				'Txn_id' =>$txn_id
				));
				}
				
				
				
						
				elseif ($payment_amount==2.99 AND $item_number == '200'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 200000,
				'End' => $one,
				'Txn_id' =>$txn_id
				));
				}
				
				elseif ($payment_amount==5.98 AND $item_number == '200'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 200000,
				'End' => $two,
				'Txn_id' =>$txn_id
				));
				}
				
				elseif ($payment_amount==8.97 AND $item_number == '200'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 200000,
				'End' => $three,
				'Txn_id' =>$txn_id
				));
				}
				
				elseif ($payment_amount==17.94 AND $item_number == '200'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 200000,
				'End' => $six,
				'Txn_id' =>$txn_id
				));
				}
				
				elseif ($payment_amount==35.88 AND $item_number == '200'){
				$req = $bdd->prepare('INSERT INTO premium (Code, Used, Taille, End, Txn_id) VALUES (:Code, :Used, :Taille, :End, :Txn_id)');
				$req->execute(array(
				'Code' => $code,
				'Used' => 1,
				'Taille' => 200000,
				'End' => $year,
				'Txn_id' =>$txn_id
				));
				}
				
				
unlink("sendcode.sh");
$monfichier = fopen('sendcode.sh', 'a+');
fputs($monfichier, 'echo "Hello \n\nThank you for buy an iData plan !\nYour code is : '.$code.'\nYou can only use this code once.\n To get your iData Premuim plan :\n 1: Sign into your iData account.\n 2:Go to http://idata.no-ip.info/activatepremium.php and paste the code on the top of this e-mail.\n 3: Follow the instructions on your screen.\n\nThank you !\n\niData\'s team." | mail -r noreply@idata.no-ip.info -s "Account Confirmation" -- '.$payer_email.'');
fclose($monfichier);	
shell_exec('chmod 777 /var/www/sendcode.sh');
shell_exec('/var/www/sendcode.sh'); 
unlink("sendcode.sh");	

		
		
        
        if(DEBUG == true) {
                error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
        }
}}} else if (strcmp ($res, "INVALID") == 0) {
echo 'FAIL';
        // log for manual investigation
        // Add business logic here which deals with invalid IPN messages
        if(DEBUG == true) {
                error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
        }
}

?>