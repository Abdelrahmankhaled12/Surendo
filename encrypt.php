<?php

/**
 * Encrypts data using AES-256-CBC.
 *
 * @param string $data The data to encrypt.
 * @param string $key The encryption key (must be 32 bytes for AES-256).
 * @return array An array containing the encrypted data and IV in base64 format.
 */
function encrypt($data, $key)
{
    // Validate key length (must be 32 bytes for AES-256)
    if (strlen($key) !== 32) {
        throw new Exception("Key must be 32 bytes long for AES-256 encryption.");
    }

    // Generate a random initialization vector (IV)
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    // Encrypt the data
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

    // Return the encrypted data and IV in base64 format
    return [
        'encrypted_data' => base64_encode($encrypted),
        'iv' => base64_encode($iv)
    ];
}

/**
 * Decrypts data using AES-256-CBC.
 *
 * @param string $encryptedData The encrypted data in base64 format.
 * @param string $key The encryption key (must be 32 bytes for AES-256).
 * @param string $iv The initialization vector in base64 format.
 * @return string The decrypted data.
 */
function decrypt($encryptedData, $key, $iv)
{
    // Validate key length (must be 32 bytes for AES-256)
    if (strlen($key) !== 32) {
        throw new Exception("Key must be 32 bytes long for AES-256 decryption.");
    }

    // Decode the base64 encoded encrypted data and IV
    $encryptedData = base64_decode($encryptedData);
    $iv = base64_decode($iv);

    // Decrypt the data
    $decrypted = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

    return $decrypted;
}
