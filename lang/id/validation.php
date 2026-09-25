<?php

return [
    'password' => [
        'letters'       => 'Kata sandi harus mengandung minimal satu huruf.',
        'mixed'         => 'Kata sandi harus mengandung minimal satu huruf besar (uppercase) dan satu huruf kecil (lowercase).',
        'numbers'       => 'Kata sandi harus mengandung minimal satu angka.',
        'symbols'       => 'Kata sandi harus mengandung minimal satu simbol/karakter khusus (!@#$%^&*).',
        'uncompromised' => 'Kata sandi ini telah ditemukan dalam kebocoran data. Harap pilih kata sandi lain.',
    ],
    'min' => [
        'string' => 'Isian :attribute harus minimal :min karakter.',
    ],
    'required' => 'Isian :attribute wajib diisi.',
    'email'    => 'Isian :attribute harus berupa alamat email yang valid.',
    'confirmed'=> 'Konfirmasi :attribute tidak cocok.',
];
