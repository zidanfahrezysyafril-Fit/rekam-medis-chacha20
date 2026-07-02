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
            'action' => 'required|in:encrypt,decrypt',
        ]);

        $action = $request->input('action');
        $encryptionService = app(\App\Services\EncryptionService::class);

        if ($action === 'encrypt') {
            $request->validate(['plaintext' => 'required|string']);
            
            $startEncrypt = microtime(true);
            $encryptedData = $encryptionService->encrypt($request->input('plaintext'));
            $encryptTime = (microtime(true) - $startEncrypt) * 1000;

            return view('admin.encryption-demo', [
                'action_taken' => 'encrypt',
                'plaintext' => $request->input('plaintext'),
                'ciphertext' => $encryptedData['ciphertext'],
                'nonce' => $encryptedData['nonce'],
                'encryptTime' => round($encryptTime, 4),
            ]);
        } else {
            $request->validate([
                'ciphertext_input' => 'required|string',
                'nonce_input' => 'required|string'
            ]);
            
            try {
                $startDecrypt = microtime(true);
                $decryptedText = $encryptionService->decrypt($request->input('ciphertext_input'), $request->input('nonce_input'));
                $decryptTime = (microtime(true) - $startDecrypt) * 1000;

                return view('admin.encryption-demo', [
                    'action_taken' => 'decrypt',
                    'ciphertext_input' => $request->input('ciphertext_input'),
                    'nonce_input' => $request->input('nonce_input'),
                    'decryptedText' => $decryptedText,
                    'decryptTime' => round($decryptTime, 4),
                ]);
            } catch (\Exception $e) {
                return back()->withErrors(['decrypt_error' => 'Gagal mendekripsi data. Pastikan Ciphertext dan Nonce valid.']);
            }
        }
    }
}
