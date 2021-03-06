<?php

header('Content-Type: application/json');

include_once '../start.php';

use \Bazaar\Classes\User;
use \Bazaar\Classes\Company;

if(!empty($_POST)){

    $user = new User();
    $user->setEmail($_POST['email']);

    if(!$user->userExists()){

        $company = new Company();
        $company->setEmail($_POST['email']);

        if(!$company->companyExists()) {
            $feedback = [
                'code' => 200,
                'userExists' => false
            ];
        } else {
            $feedback = [
                'code' => 200,
                'userExists' => true
            ];
        }
    } else {

            $feedback = [
                'code' => 200,
                'userExists' => true
            ];

    }

    echo json_encode($feedback);

}