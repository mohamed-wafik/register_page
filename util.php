<?php 
function validation($first_name,$last_name,$address,$country,$gender,$username,$password,$department,$skills) {
    $errors = array();
    if (empty($first_name) || strlen($first_name) < 3 || strlen($first_name) > 20) {
        $errors["first_name"] = "First name must be between 3 and 20 characters";
    }

    if (empty($last_name) || strlen($last_name) < 3 || strlen($last_name) > 20) {
        $errors["last_name"] = "Last name must be between 3 and 20 characters";
    }

    if (empty($address) || strlen($address) < 5 || strlen($address) > 50) {
        $errors["address"] = "Address must be between 5 and 50 characters";
    }

    if (empty($country) || strlen($country) < 2 || strlen($country) > 30) {
        $errors["country"] = "Country must be between 2 and 30 characters";
    }

    if (empty($gender) || !in_array(strtolower($gender), ['male', 'female'])) {
        $errors["gender"] = "Invalid gender value.";
    }

    if (empty($username) || strlen($username) < 4 || strlen($username) > 15 ) {
        $errors["username"] = "Username must be between 4 and 15 characters";
    }

    if (empty($password) || strlen($password) < 6 || strlen($password) > 20) {
        $errors["password"] = "Password must be between 6 and 20 characters";
    }

    if(empty($skills)) {
        $errors["skills"] = "skils at least one skill";
    }

    return $errors;
}