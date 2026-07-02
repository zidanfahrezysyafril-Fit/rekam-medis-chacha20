<?php

namespace App\Traits;

use App\Services\EncryptionService;

trait Encryptable
{
    /**
     * Override getAttribute to decrypt encryptable fields.
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable ?? []) && !empty($value)) {
            $nonces = json_decode($this->attributes['nonce'] ?? '{}', true);
            if (isset($nonces[$key])) {
                $encryptionService = app(EncryptionService::class);
                return $encryptionService->decrypt($value, $nonces[$key]);
            }
        }

        return $value;
    }

    /**
     * Override setAttribute to encrypt encryptable fields.
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable ?? []) && !empty($value)) {
            $encryptionService = app(EncryptionService::class);
            $encrypted = $encryptionService->encrypt($value);
            
            $nonces = json_decode($this->attributes['nonce'] ?? '{}', true);
            $nonces[$key] = $encrypted['nonce'];
            $this->attributes['nonce'] = json_encode($nonces);
            
            $value = $encrypted['ciphertext'];
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Decrypt array representation.
     */
    public function toArray()
    {
        $array = parent::toArray();
        foreach ($this->encryptable ?? [] as $key) {
            if (isset($array[$key]) && !empty($array[$key])) {
                $array[$key] = $this->getAttribute($key);
            }
        }
        return $array;
    }
}
