<?php

function encrypt($data){
    // Store the cipher method
    $ciphering = "AES-128-CTR";
    
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
    
    // Store the encryption key
    $encryption_key = "GeeksforGeeks";
    
    // Use openssl_encrypt() function to encrypt the data
    $encryptpassword = openssl_encrypt($data, $ciphering, $encryption_key, $options, $encryption_iv);

    return $encryptpassword;
    

}

function decrypt($data){
    // Store the cipher method
    $ciphering = "AES-128-CTR";
        
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
            
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
            
    // Store the decryption key
    $decryption_key = "GeeksforGeeks";
            
    // Use openssl_decrypt() function to decrypt the data
    $decryptpasword = openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);
    
    return $decryptpasword;
    
}

?>
