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
        // Generate a unique nonce
        $nonce = random_bytes(SODIUM_CRYPTO_STREAM_XCHACHA20_NONCEBYTES);
        
        // Ensure the key is exactly the length required by xchacha20
        // We'll use the APP_KEY or generate a specific one. Let's use a hashed version of APP_KEY to guarantee 32 bytes.
        $key = config('app.key');
        if (str_starts_with($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $key = hash('sha256', $key, true);

        // Encrypt the data
        $ciphertext = sodium_crypto_stream_xchacha20_xor($data, $nonce, $key);

        return [
            'ciphertext' => base64_encode($ciphertext),
            'nonce' => base64_encode($nonce),
        ];
    }

    /**
     * Decrypt a string using ChaCha20 via Libsodium.
     *
     * @param string $ciphertextBase64
     * @param string $nonceBase64
     * @return string
     */
    public function decrypt(string $ciphertextBase64, string $nonceBase64): string
    {
        $ciphertext = base64_decode($ciphertextBase64);
        $nonce = base64_decode($nonceBase64);

        $key = config('app.key');
        if (str_starts_with($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $key = hash('sha256', $key, true);

        $decrypted = sodium_crypto_stream_xchacha20_xor($ciphertext, $nonce, $key);

        return $decrypted;
    }
}
