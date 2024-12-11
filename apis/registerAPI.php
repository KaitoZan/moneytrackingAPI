<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); //GET = check getAll , POST = insert , PUT = update , DELETE = delete
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");
require_once "./../connectdb.php";
require_once "./../models/user.php";
$connDB = new ConnectDB();
$user = new User($connDB->getConnectionDB());
$data = json_decode(file_get_contents("php://input"));
$user->userFullName = $data->userFullName;
$user->userBirthDate = $data->userBirthDate;
$user->userName = $data->userName; 
$user->userPassword = $data->userPassword; 
$user->userImage = $data->userImage;
$picture_temp = $data->userImage;
$picture_filename = "ProfilePic_" . uniqid() . "_" . round(microtime(true)*1000) . ".jpg";
file_put_contents( "./../picupload/user/".$picture_filename, base64_decode(string: $picture_temp));
$user->userImage = $picture_filename;
$result = $user ->registerAPI();

if ($result == true){
    $resultArray = array("message" => "1");
    echo json_encode(  $resultArray, JSON_UNESCAPED_UNICODE);   
}else{
    $resultArray = array("message" => "0");  
    echo json_encode(  $resultArray, JSON_UNESCAPED_UNICODE); 
    
}