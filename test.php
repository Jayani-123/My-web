<?php
// Enable PHP errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$plainText = "This is a secret message";

//Load private Key
$priv_key_raw = file_get_contents("/home/kit214/private.pem");
$passphrase=trim(file_get_contents("/home/kit214/crypt_password.txt"));
$priv_key = openssl_get_privatekey($priv_key_raw, $passphrase);


// Encrypt the plain text using the private key
openssl_private_encrypt($plainText, $encryptedText, $priv_key);
echo $encryptedText;

$pub_key=file_get_contents("/home/kit214/public.pem");
openssl_public_decrypt($encryptedText, $decryptedText, $pub_key);
echo $decryptedText;


    // Load the public key for encryption
    $pub_key_raw = file_get_contents("/home/kit214/public.pem");
    $pub_key = openssl_get_publickey($pub_key_raw);

    // Encrypt the plain text using the public key
    openssl_public_encrypt($plainText, $encryptedText, $pub_key);
    // Base64 encode the encrypted text so it can be stored/transmitted as text
    $encodedText = base64_encode($encryptedText);
    echo  $encodedText;

    // Load the private key for decryption
    $priv_key_raw = file_get_contents("/home/kit214/private.pem");
    $passphrase = trim(file_get_contents("/home/kit214/crypt_password.txt"));
    $priv_key = openssl_get_privatekey($priv_key_raw, $passphrase);
   
    // Decrypt the encrypted text using the private key
    openssl_private_decrypt($encryptedText, $decryptedText, $priv_key);
       // Base64 decode the encrypted text
       $encryptedText = base64_decode($encryptedText);



?>