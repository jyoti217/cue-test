<?php
require_once "Database.php";

/* echo "<pre>";
 print_r($skill_sets)*/


/*echo "<pre>";
print_r($_POST);*/

$data['first_name'] = $_POST['first_name'];
$data['last_name']  = $_POST['last_name'];
$data['email']  = $_POST['email'];
$data['phone']  = $_POST['phone'];
$data['city']  = $_POST['city'];
$data['state']  = $_POST['state'];
$data['street']  = $_POST['street'];
$data['zip']  = $_POST['zip'];
$data['skills']  = $_POST['skills'];
$db = new Database();
if($db->saveUser($data)){
    echo 'success';
}