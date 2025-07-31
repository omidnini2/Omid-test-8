<?php
// clone-voice.php
// API برای دریافت فایل صوتی و متن و ارسال به سرور هوش مصنوعی

// محدودیت حجم فایل: ۵۰ مگابایت
if ($_FILES['voice']['size'] > 50 * 1024 * 1024) {
    http_response_code(413);
    echo 'حجم فایل بیش از ۵۰ مگابایت است.';
    exit;
}

$text = $_POST['text'] ?? '';
if (mb_strlen($text) > 100000) {
    http_response_code(400);
    echo 'متن بیش از ۱۰۰,۰۰۰ کاراکتر است.';
    exit;
}

// ذخیره فایل صوتی موقت
$tmp_voice = __DIR__ . '/tmp_voice.wav';
move_uploaded_file($_FILES['voice']['tmp_name'], $tmp_voice);

// ارسال به سرور هوش مصنوعی (Flask backend)
$backend_url = 'http://localhost:5000/clone'; // آدرس سرور Flask

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $backend_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'voice' => new CURLFile($tmp_voice),
        'text' => $text
    ],
    CURLOPT_HTTPHEADER => [
        'Accept: audio/wav'
    ]
]);
$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

@unlink($tmp_voice);

if ($http_code == 200) {
    header('Content-Type: audio/wav');
    echo $response;
} else {
    http_response_code($http_code);
    echo 'خطا در ارتباط با سرور هوش مصنوعی';
}