<?php
function unique_file($fileName)
{
    return time() . uniqid().'-'.$fileName;
}
function Firebase_notifications_fcm($tokens, $data)
{
    $google_api_key = 'AAAAVluzkcw:APA91bEdEM0uRXYKxDbLtQVOGYnHYoKT8z-GmvEYAqUPl5p8Q1huDfk2HqDE2rb5JrF6C8wfYqUYeNhCK9ggvvEfU2tZ53ZnPH7LlcZNtJTGqjt__CRHV0DgLdHASyupt0PF2-JamdcR';
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'registration_ids' =>   $tokens,
        'data' => $data,
    );
    define("GOOGLE_API_KEY", $google_api_key );
    $headers = array(
        'Authorization: key=' . GOOGLE_API_KEY,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}