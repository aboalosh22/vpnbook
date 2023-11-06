<?php
date_default_timezone_set('UTC');

function generateRandomString($length = 10) {
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $randomString;
}

function generateIpUser($lengthn = 5) {
  $numbers = '0123456789';
  $randomIp = '';
  for ($n = 0; $n < $lengthn; $n++) {
    $randomIp .= $numbers[rand(0, strlen($numbers) - 1)];
  }
  return $randomIp;
}

$t = "<br>";
// $timestamp = time();
// $currentDate = date('Y-m-d', $timestamp);
$tanggal = date('Y-m-d', time());
$tanggalEnd = date('Y-m-d', strtotime('+5 days', strtotime($tanggal)));
$Waktu = "23:09:27";
$first = rand(10,100); //generateIpUser(2); //"6";
$second = rand(100,200); //generateIpUser(2); //112
$sumfs = $first + $second;
$human_verifier = $sumfs; //"118";
$id_server = "78";
$id_servernegara = "america";
// $ipone = int(generateIpUser(3));
// $iptwo = int(generateIpUser(2));
// $ipthre = int(generateIpUser(3));
// $ipfore = int(generateIpUser(2));

$ipone = rand(10,200);
sleep(1);
$iptwo = rand(20,150);
sleep(1);
$ipthre = rand(30,250);
sleep(1);
$ipfore = rand(40,175);
sleep(1);
$ipuser=$ipone.".".$iptwo.".".$ipthre.".".$ipfore;
$randomString = generateRandomString(4);
$randomNumber = generateIpUser(3);
sleep(2);
$password = "Naj".$randomString.$randomNumber;
//$second=112
$submit = "";
$username = "Naj".$randomString.$randomNumber;

// $querystring = "{\"Tanggal\":".$tanggal.",\"TanggalEnd\":".$tanggalEnd.",\"Waktu\":".$Waktu.",\"first\":".$first.",\"human-verifier\":".$human_verifier.",\"id_server\":".$id_server.",\"id_servernegara\":".$id_servernegara.",\"ipuser\":".$ipuser.",\"password\":".$password.",\"second\":".$second.",\"submit\":".$submit.",\"username\":".$username."}";

$post_data = array(
  'Tanggal' => $tanggal,
  'TanggalEnd' => $tanggalEnd,
  'Waktu' => $Waktu,
  'first' => $first,
  'human-verifier' => $human_verifier,
  'id_server' => $id_server,
  'id_servernegara' => $id_servernegara,
  'ipuser' => $ipuser,
  'password' => $password,
  'second' => $second,
  'submit' => '',
  'username' => $username,
);


sleep(3);
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.vpnkeep.com/create-canada-l2tp-vpn-account",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $post_data,
  CURLOPT_HTTPHEADER => array(
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

// Check the response for success
if ($err) {
  echo 'The generate vpn is failed.'.$err;
} else {
  // The login was successful.
  // $dom = new DOMDocument();
  // @$dom->loadHTML($response);
  // $username_element = $dom->querySelector('#myInput');
  // $password_element = $dom->querySelector('#myInput2');
  // $enddate_element = $dom->querySelector('#top > section.py-2 > div > div > div:nth-child(5) > p.text-center.p-2.mt-3');
  // $username_text = $username_element->textContent;
  // $password_text = $password_element->textContent;
  // $enddate_text = $enddate_element->textContent;
  
  $response_data = array(
    'vpn_username' => $username,
    'vpn_password' => $password,
	'vpn_hostname' => 'ca-l2tp.vpnkeep.com',
	'vpn_ipserver' => '149.56.47.103',
    'vpn_enddate' => $tanggalEnd,
  );
  echo json_encode($response_data);
  //echo "successfully save response username ".$username." and password ".$password.$t;
  $filename = "my_json_".$username."_file.json";
  
  file_put_contents(__DIR__.'/json/'.$filename,json_encode($response_data));
  // The login failed.
  
}

?>
