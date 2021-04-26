<?php
include_once('../simple_html_dom.php');
function url_get_html($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
$url = "https://www.vpnbook.com/freevpn";
$html = str_get_html(url_get_html($url));

echo $html;
?>
?>