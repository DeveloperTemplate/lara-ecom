<?php

use App\Models\Setting;




function setting($type){
      return Setting::where('key', $type)->first(['id', 'key', 'value']);  
}


function textLocalSendOTP($mobile, $otp)
{

    $apiKey = urlencode('NGI1ODM0NDEzOTU4MzA0NzZjNGE3MTUwNzgzNzM0NjQ=');
    // Message details
    $numbers = array($mobile);
    $sender  = urlencode('ONCABJ');

    // $message = rawurlencode('Dear Partner%n %nThank you for choosing OnCab, Your OTP for Registration to OnCab is '.$otp.' . Valid for 10 minutes. Please do not share this OTP.');
    
    $message = rawurlencode('Thank you for choosing OnCab. Your OTP is '.$otp.', Valid for 5 minutes. Please do not share this OTP.');

    $numbers = implode(',', $numbers);
    
    // Prepare data for POST request
    $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
    // Send the POST request with cURL
    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    // Process your response here
    return $response;

}


function offer_push_notification($data)
{

    $url = 'https://fcm.googleapis.com/fcm/send';

        $msg = [
            'body'          => $data['description'],
            'title'         => $data['title'],
            'image'         => $data['img']
        ];

        $fields = array(
        'to'  => $data['device_id'],
        'notification' => $msg,
        );
  
      $fields = json_encode( $fields );

      $headers = array(
          'Content-Type:application/json',
          'Authorization:key=AAAA6oWMgaQ:APA91bEERYtlOGt1rzgKm1zX2wqOXKzVFCKhV7PBQtl8igui4vbAgNPApup7ECH5fESIhpETIQd1eAOJ6pmtYXoJyPahND_sOEDgfDB_yug3eU42hSQ2iFWFhpaHjzA7o7L_eXGgPbDN'
      );
            
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  
      $result = curl_exec($ch);
  
      if ($result === FALSE) {
          die('FCM Send Error: '. curl_error($ch));
      }
  
      curl_close($ch);
        
      return $result;
}