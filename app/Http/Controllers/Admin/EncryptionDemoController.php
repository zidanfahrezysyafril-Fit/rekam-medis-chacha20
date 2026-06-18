<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncryptionDemoController extends Controller
{
    public function index()
    {
        return view('admin.encryption-demo');
    }

    public function process(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'plaintext' => 'required|string',
        ]);

        $plaintext = $request->input('plaintext');
        $encryptionService = app(\App\Services\EncryptionService::class);

        // Measure Encryption Time
        $startEncrypt = microtime(true);
        $encryptedData = $encryptionService->encrypt($plaintext);
        $endEncrypt = microtime(true);
        $encryptTime = ($endEncrypt - $startEncrypt) * 1000; // in milliseconds

        // Measure Decryption Time
        $startDecrypt = microtime(true);
        $decryptedText = $encryptionService->decrypt($encryptedData['ciphertext'], $encryptedData['nonce']);
        $endDecrypt = microtime(true);
        $decryptTime = ($endDecrypt - $startDecrypt) * 1000; // in milliseconds

        return view('admin.encryption-demo', [
            'plaintext' => $plaintext,
            'ciphertext' => $encryptedData['ciphertext'],
            'nonce' => $encryptedData['nonce'],
            'decryptedText' => $decryptedText,
            'encryptTime' => round($encryptTime, 4),
            'decryptTime' => round($decryptTime, 4),
        ]);
    }
}
