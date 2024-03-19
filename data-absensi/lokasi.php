<?php 
session_start();
include '../config/koneksi.php';
include '../config/function.php';

$user_ip = $_SERVER[''] ?? '';
var_dump($user_ip)

// if(!empty($latitude) && !empty($longitude))
// {
//     $gmap = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.$longitude.'&sensor=false';
//     $ch = curl_init();

//     curl_setopt($ch, CURLOPT_URL, $gmap);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_PROXYPORT,3128);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
//     $response = curl_exec($ch);
//     curl_close($ch);
//     $data = json_decode($response);

//     if($response){
//         echo json_encode($data->results[0]->formatted_address);

//     }else{
//         echo json_encode(false);
//     }
// }

?>