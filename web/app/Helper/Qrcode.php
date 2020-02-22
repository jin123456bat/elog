<?php
namespace App\Helper;
class Qrcode
{
	function __construct()
	{
		$qrCode = new QrCode($url);
		$qrCode->setSize($size);
		$qrCode->setWriterByName('png')
		->setMargin(5)
		->setEncoding('UTF-8')
		->setErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
		->setForegroundColor([
			'r' => 0,
			'g' => 0,
			'b' => 0
		])
		->setBackgroundColor($bc)
		->setValidateResult(false);
		$result = base64_encode($qrCode->writeString());
		$result = 'data:image/png;base64,' . $result;
		return $result;
	}
	
	function getBase64String()
	{
		
	}
}