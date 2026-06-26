<?php

namespace App\Services;

class EncryptionService
{
    /**
     * Encrypt a string using ChaCha20 via Libsodium.
     *
     * @param string $data
     * @return array ['ciphertext' => string, 'nonce' => string]
     */
    public function encrypt(string $data): array
    {
        // Generate a 12-byte nonce for OpenSSL ChaCha20-Poly1305
        $nonce = random_bytes(12);
        
        $key = config('app.key');
        if (str_starts_with($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $key = hash('sha256', $key, true);

        $tag = '';
        $ciphertext = openssl_encrypt($data, 'chacha20-poly1305', $key, OPENSSL_RAW_DATA, $nonce, $tag);

        // Combine ciphertext and auth tag so it can be returned as a single string
        $combinedCiphertext = $ciphertext . $tag;

        return [
            'ciphertext' => base64_encode($combinedCiphertext),
            'nonce' => base64_encode($nonce),
        ];
    }

    /**
     * Decrypt a string using ChaCha20-Poly1305 via OpenSSL.
     *
     * @param string $ciphertextBase64
     * @param string $nonceBase64
     * @return string
     */
    public function decrypt(string $ciphertextBase64, string $nonceBase64): string
    {
        $combinedCiphertext = base64_decode($ciphertextBase64);
        $nonce = base64_decode($nonceBase64);

        $key = config('app.key');
        if (str_starts_with($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $key = hash('sha256', $key, true);

        // The auth tag in Poly1305 is always 16 bytes long
        $tag = substr($combinedCiphertext, -16);
        $ciphertext = substr($combinedCiphertext, 0, -16);

        $decrypted = openssl_decrypt($ciphertext, 'chacha20-poly1305', $key, OPENSSL_RAW_DATA, $nonce, $tag);

        return $decrypted !== false ? $decrypted : '';
    }
}
