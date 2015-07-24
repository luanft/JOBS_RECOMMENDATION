<?php

function curl_download($Url)
{		
	
	// Báº¯t Ä‘áº§u CURl
	$ch = curl_init($Url);	 
	// Thiáº¿t láº­p giáº£ láº­p trÃ¬nh duyá»‡t
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	// nghÄ©a lÃ  giáº£ máº¡o Ä‘ang gá»­i tá»« trÃ¬nh duyá»‡t nÃ o Ä‘Ã³, á»Ÿ Ä‘Ã¢y tÃ´i dÃ¹ng Firefox
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0");	 
	// Thiáº¿t láº­p tráº£ káº¿t quáº£ vá»� chá»© khÃ´ng print ra
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Thá»�i gian timeout
	curl_setopt($ch, CURLOPT_TIMEOUT, 1000);	 		 
	// Thá»±c hiá»‡n download file
	$result = curl_exec($ch);	 
	// Ä�Ã³ng CURL
	curl_close($ch);
	 
	return $result;
}

?>