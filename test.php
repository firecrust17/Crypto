<?php

    require_once '../vendor/autoload.php'; // Loads the library 

	$data = json_decode(file_get_contents("https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,LTC&tsyms=INR"),true);
	// var_dump($data);die();

	$min_val = json_decode(file_get_contents("min_val.txt"),true);

    $max_array = json_decode(file_get_contents("max_val.txt"),true);
    $max_array['BTC']['INR'] = max($max_array['BTC']['INR'],$data['BTC']['INR']);
    $max_array['ETH']['INR'] = max($max_array['ETH']['INR'],$data['ETH']['INR']);
    $max_array['XRP']['INR'] = max($max_array['XRP']['INR'],$data['XRP']['INR']);
    $max_array['LTC']['INR'] = max($max_array['LTC']['INR'],$data['LTC']['INR']);
    file_put_contents("max_val.txt",json_encode($max_array));
    $percent = json_decode(file_get_contents("percent.txt"),true);
    $BTCP = $percent['BTC']['INR'];
    $ETHP = $percent['ETH']['INR'];
    $XRPP = $percent['XRP']['INR'];
    $LTCP = $percent['LTC']['INR'];

	$message = '';

	if( (date('H') == 16 && date('i') > 28 && date('i') < 32) || (date('H') == 2 && date('i') > 28 && date('i') < 32) || (date('H') == 10 && date('i') > 28 && date('i') < 32) ){
        $message .= "\nDAILY MAIL -- BTC: {$data['BTC']['INR']} ({$max_array['BTC']['INR']}) - ETH: {$data['ETH']['INR']} ({$max_array['ETH']['INR']}) - XRP: {$data['XRP']['INR']} ({$max_array['XRP']['INR']}) - LTC: {$data['LTC']['INR']} ({$max_array['LTC']['INR']}) - http://104.197.71.136/crypto/update.php";
	}

	if(($data['BTC']['INR'] < $max_array['BTC']['INR']*$BTCP) || ($data['ETH']['INR'] < $max_array['ETH']['INR']*$ETHP) || ($data['XRP']['INR'] < $max_array['XRP']['INR']*$XRPP) || ($data['LTC']['INR'] < $max_array['LTC']['INR']*$LTCP)){
        $message .= "\nPERCENT MAIL -- BTC: {$data['BTC']['INR']} ({$max_array['BTC']['INR']}) - ETH: {$data['ETH']['INR']} ({$max_array['ETH']['INR']}) - XRP: {$data['XRP']['INR']} ({$max_array['XRP']['INR']}) - LTC: {$data['LTC']['INR']} ({$max_array['LTC']['INR']}) - http://104.197.71.136/crypto/update.php";
	}

	if(($data['BTC']['INR'] < $min_val['BTC']['INR']) || ($data['ETH']['INR'] < $min_val['ETH']['INR']) || ($data['XRP']['INR'] < $min_val['XRP']['INR']) || ($data['LTC']['INR'] < $min_val['LTC']['INR'])){
        $message .= "\nMIN ORDER MAIL -- BTC: {$data['BTC']['INR']} ({$max_array['BTC']['INR']}) - ETH: {$data['ETH']['INR']} ({$max_array['ETH']['INR']}) - XRP: {$data['XRP']['INR']} ({$max_array['XRP']['INR']}) - LTC: {$data['LTC']['INR']} ({$max_array['LTC']['INR']}) - http://104.197.71.136/crypto/update.php";
	}
    
    file_put_contents("log.txt",json_encode($data)."\n",FILE_APPEND);

    if ($message != '') {

		echo $message;
		include 'testmail.php';

	}


?>