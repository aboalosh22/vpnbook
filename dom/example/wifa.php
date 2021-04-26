<?php
include_once('../simple_html_dom.php');
// размер символа
$wchar = 9;
$hchar = 13;
$strDict = '0123456789 ';
$imgDict = imagecreatetruecolor(2 + strlen($strDict)* $wchar, $hchar);
$bg = imagecolorallocate($imgDict, 0xF6, 0xF6, 0xF6);
$textcolor = imagecolorallocate($imgDict, 0x4C, 0x4C, 0x4C);
imagefill($imgDict, 0, 0, $bg);
imagestring($imgDict, 2, 2, 0, $strDict, $textcolor);


// инициализируем cURL
$ch = curl_init();
// устанавливаем url, с которого будем получать данные
curl_setopt($ch, CURLOPT_URL, 'http://www.wi-fa.org/userman/captcha.php');
// устанавливаем опцию, чтобы содержимое вернулось нам в string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); // also, this seems wise considering output is image.
// выполняем запрос
$output = curl_exec($ch);
// закрываем cURL
curl_close($ch);

$imgOCR = imagecreatefromstring($output);
// $imgOCR = imageCreateFromPng('password.png');
// в текущее изображение может поместиться 10 полных символов. 2 + 10*9 = 92 < 100
$maxchar = floor((imagesx($imgOCR) - 2) / 9);
$imgBox = imagecreatetruecolor($wchar, $hchar);
$hashDict = Array();

// генерируем словарь
for ($k = 0; $k < strlen($strDict) ; $k++) {
	imagecopy($imgBox, $imgDict, 0, 0, 2 + $k * $wchar, 0, $wchar, $hchar);
	$hashStr = "";
	for($y = 0; $y < $hchar ; $y++)
		for($x = 0; $x < $wchar; $x++) $hashStr .= (imagecolorat($imgBox, $x, $y) != 0xF6F6F6)? '1': '0';
	$hashDict[$hashStr] = $strDict[$k];
}

// ищем символы по словарю
for ($k = 0; $k < $maxchar ; $k++) {
	imagecopy($imgBox, $imgOCR, 0, 0, 2 + $k * $wchar, 0, $wchar, $hchar);
	$hashStr = "";
	for($y = 0; $y < $hchar ; $y++)
		for($x = 0; $x < $wchar; $x++) $hashStr .= (imagecolorat($imgBox, $x, $y) != 0xF6F6F6)? '1': '0';
	$tempchar = $hashDict[$hashStr];
	if ($tempchar==' ') break;
	print($tempchar);
}

/*header('Content-type: image/png');
imagepng($imgOCR);
*/
//var_dump($hashDict);
imagedestroy($imgDict);
imagedestroy($imgOCR);
imagedestroy($imgBox);
?>