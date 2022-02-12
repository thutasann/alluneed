<?php

// encryption by indo tutor

function encryptown($s){

	$cryptkey = '12345678910';
	$qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptkey), $s, MCRYPT_MODE_CBC, md5(md5($cryptkey) ) ) );
	return($qEncoded);
}

function decryptown($s){

	$cryptkey = '12345678910';
	$qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptkey), base64_decode($s), MCRYPT_MODE_CBC, md5(md5($cryptkey) ) ) , "\0");
	return($qDecoded);
}

//  Encryption to replace special characters

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}


// Encryption with private secret key

function pencrypt($message, $encryption_key){
	$key = hex2bin($encryption_key);

	$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
	$nonce = openssl_random_pseudo_bytes($nonceSize);

	$ciphertext = openssl_encrypt(
	$message,
	'aes-256-ctr',
	$key,
	OPENSSL_RAW_DATA,
	$nonce
	);

	return rtrim(strtr(base64_encode($nonce.$ciphertext), '+/', '-_'), '=');
}

function pdecrypt($message,$encryption_key){
	$key = hex2bin($encryption_key);
	$message = base64_decode($message);
	$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
	$nonce = mb_substr($message, 0, $nonceSize, '8bit');
	$ciphertext = mb_substr($message, $nonceSize, null, '8bit');

	$plaintext= openssl_decrypt(
	$ciphertext,
	'aes-256-ctr',
	$key,
	OPENSSL_RAW_DATA,
	$nonce
	);

    return str_pad(strtr($plaintext, '-_', '+/'), strlen($plaintext) % 4, '=', STR_PAD_RIGHT);

}


// SSL encryption with key

function encryptthis($data,$key)
{

	$encryption_key = base64_decode($key);
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);

    return rtrim(strtr(base64_encode($encrypted . '::' . $iv), '+/', '-_'), '=');

}

function decryptthis($data,$key)
{
	$encryption_key = base64_decode($key);
	list($encrypted_data,$iv) = array_pad(explode('::',base64_decode($data),2),2,null);

    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));

}

// Encrypt / Decrypt (success)
function encrypt_decrypt($action, $string)
{
	$output = false;
    $encrypt_method = "AES-256-CBC";
	$secret_iv = 'This is my secret iv';
	$secret_key = '1f4276388ad3214c873428dbef42243f' ;
    $key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if ( $action == 'encrypt' )
	{
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);

	}
	else if( $action == 'decrypt' )
	{
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}



?>
