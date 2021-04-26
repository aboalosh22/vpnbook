<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://raw.githubusercontent.com/aboalosh22/vpnbook/main/dom/example/freevpn1.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
		"accept-language: ar,en-US;q=0.9,en;q=0.8",
    "cache-control: no-cache",
    "sec-fetch-dest: empty",
    "sec-fetch-mode: cors",
    "sec-fetch-site: none",
    "user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4174.0 Safari/537.36"
  ),

));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);


if ($err) {
echo $err;
} else {
echo $response;
file_put_contents(__DIR__.'/Password.txt',$response);
}
?>
