<?php

const KEY = "12345678901234567890123456789012"; // 32-byte key for AES-256

/**
 * Encrypts data using AES-256-CBC.
 *
 * @param string $data The data to encrypt.
 * @return array An array containing the encrypted data and IV in base64 format.
 */
function encrypt($data)
{
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivLength); // Generate a valid IV of the required length

    // Encrypt the data
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', KEY, OPENSSL_RAW_DATA, $iv);

    // Return encrypted data and IV, both base64-encoded
    return [
        'encrypted_data' => base64_encode($encrypted),
        'iv' => base64_encode($iv)
    ];
}

/**
 * Decrypts data using AES-256-CBC.
 *
 * @param string $encryptedData The encrypted data in base64 format.
 * @param string $iv The initialization vector in base64 format.
 * @return string The decrypted data.
 */
function decrypt($encryptedData, $iv)
{
    $iv = base64_decode($iv);
    $encryptedData = base64_decode($encryptedData);

    // Ensure IV is exactly 16 bytes
    if (strlen($iv) !== openssl_cipher_iv_length('aes-256-cbc')) {
        throw new Exception("Invalid IV length: expected 16 bytes, got " . strlen($iv));
    }

    // Decrypt the data
    return openssl_decrypt($encryptedData, 'aes-256-cbc', KEY, OPENSSL_RAW_DATA, $iv);
}