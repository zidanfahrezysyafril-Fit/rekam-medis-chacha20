<x-app-layout>
    <x-slot name="header">
        ChaCha20 Encryption Demonstration
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Input Form -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Input Data</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.encryption-demo.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="plaintext" class="block text-sm font-medium text-gray-700">Medical Record Text (Plaintext)</label>
                        <textarea id="plaintext" name="plaintext" rows="4" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>{{ old('plaintext', $plaintext ?? '') }}</textarea>
                    </div>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Encrypt & Decrypt Data
                    </button>
                </form>
            </div>
        </div>

        <!-- Results -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Process Results</h3>
            </div>
            <div class="p-6 space-y-6">
                @if(isset($ciphertext))
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wider mb-2">1. Encryption</h4>
                        <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                            <p class="text-xs text-gray-500 mb-1">Generated Nonce (Base64):</p>
                            <code class="text-sm text-blue-600 break-all">{{ $nonce }}</code>
                            
                            <p class="text-xs text-gray-500 mt-3 mb-1">Ciphertext (Base64 stored in DB):</p>
                            <code class="text-sm text-red-600 break-all">{{ $ciphertext }}</code>
                            
                            <p class="text-xs text-gray-500 mt-3 font-medium">Time Taken: <span class="text-green-600">{{ $encryptTime }} ms</span></p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wider mb-2">2. Decryption</h4>
                        <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                            <p class="text-xs text-gray-500 mb-1">Restored Plaintext:</p>
                            <div class="text-sm text-gray-900 whitespace-pre-wrap">{{ $decryptedText }}</div>
                            
                            <p class="text-xs text-gray-500 mt-3 font-medium">Time Taken: <span class="text-green-600">{{ $decryptTime }} ms</span></p>
                        </div>
                    </div>
                @else
                    <div class="text-center text-gray-500 text-sm py-10">
                        Submit the form to see the ChaCha20 algorithm in action.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
