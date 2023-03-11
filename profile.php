<?php
require '../vendor/autoload.php';
$client = new MongoDB\Client('mongodb+srv://hakashsathya01:cosmosisdatabase@cluster0.waibwbm.mongodb.net/?retryWrites=true&w=majority');
$db = $client -> selectDatabase('cosmosis');
$collection = $db -> selectCollection('user_details');

//--------FROM MONGO DATABASE-----//
if(isset($_POST['get_mongo'])){
    unset($_POST['get_mongo']);
    $sesstion_email = $_POST['userEmail'];
    $find_email = array('email'=>$sesstion_email);
    $found = $collection ->find($find_email);
    foreach ($found as $key) {
        $userEmail = $key['email'];
        $uaerName = $key['name'];
        $dateOfBirth = $key['dateOfBirth'];
        $uaerAge = $key['age'];
        $contact = $key['contact'];
    }
    echo $userEmail,'*',$uaerName,'*',$dateOfBirth,'*',$uaerAge,'*',$contact;
}

//--------UPDATE MONGO DATABASE-----//
if(isset($_POST['Update_mongo'])){
    
    $session_email =  $_POST['update_email'];
    $new_name =$_POST['to_edit_name'];
    $new_dob = $_POST['to_edit_dob'];
    $new_age = $_POST['to_edit_age'];
    $new_contact = $_POST['to_edit_contact'];
    $condition = array('email' => $session_email);
    $newdata = array('$set' => array('name'=>$new_name, 'dateOfBirth'=>$new_dob, 'age'=>$new_age, 'contact'=>$new_contact));
    $update_status = $collection -> updateOne($condition,$newdata);
    unset($_POST['Update_mongo']);
    
}
?>