<?php
    require_once "Database.php";

    $errors=array();
    $data=array();
    if(empty($_POST['first_name'])){
        $array['field']="first_name";
        $array['msg']="This field can't be empty.";
        $errors[]=$array;
    }
    if(empty($_POST['last_name'])){
        $array['field']="last_name";
        $array['msg']="This field can't be empty.";
        $errors[]=$array;
    }
    if(empty($_POST['email'])){
        $array['field']="email";
        $array['msg']="This field can't be empty.";
        $errors[]=$array;
    }
    if(empty($_POST['phone'])){
        $array['field']="phone";
        $array['msg']="This field can't be empty.";
        $errors[]=$array;
    }
    if(empty($_POST['city'])){
        $array['field']="city";
        $array['msg']="This field can't be empty.";
        $errors[]=$array;
    }
    if(empty($_POST['zip'])){
        $array['field']="state";
        $array['msg']="This field can't be empty.";
        $errors[]=$array;
    }
    if(empty($errors)) {
        $data['first_name'] = $_POST['first_name'];
        $data['last_name'] = $_POST['last_name'];
        $data['email'] = $_POST['email'];
        $data['phone'] = $_POST['phone'];
        $data['city'] = $_POST['city'];
        $data['state'] = $_POST['state'];
        $data['street'] = $_POST['street'];
        $data['zip'] = $_POST['zip'];
        $data['skills'] = $_POST['skills'];
        $db = new Database();
        if ($db->saveUser($data)) {
            $msg = "Thank you for applying.\nWe have got your details and will contact you soon.";
            $msg = wordwrap($msg,70);
            $headers = "From: jyotichd21@gmail.com";
            @mail($data['email'],"Confirmation Email from Fictive Personal Agency", $msg, $headers);
            echo 'success';
        }
    }else{
        echo json_encode($errors);
    }