<?php
// Токен телеграм бота
$tg_bot_token = "6222018668:AAFchhDi7jUgFN9aWEl5YMyki76aYwzgcCM";
// ID Чата
$chat_id = "-997698514";

$text = '';
error_log('Отладочное сообщение: 1');
foreach ($_POST as $key => $val) {
    $text .= $key . ": " . $val . "\n";
}

$text .= "\n" . $_SERVER['REMOTE_ADDR'];
$text .= "\n" . date('d.m.y H:i:s');

$param = [
    "chat_id" => $chat_id,
    "text" => $text
];
error_log('Отладочное сообщение: 2');
$url = "https://api.telegram.org/bot" . $tg_bot_token . "/sendMessage?" . http_build_query($param);

var_dump($text);

file_get_contents($url);

foreach ( $_FILES as $file ) {

    $url = "https://api.telegram.org/bot" . $tg_bot_token . "/sendDocument";

    move_uploaded_file($file['tmp_name'], $file['name']);

    $document = new \CURLFile($file['name']);

    $ch = curl_init();
error_log('Отладочное сообщение: 3');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ["chat_id" => $chat_id, "document" => $document]);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $out = curl_exec($ch);

    curl_close($ch);
error_log('Отладочное сообщение: 4');
    unlink($file['name']);
}
error_log('Отладочное сообщение: 5');
die('1');
