<?php
require_once('../model/database.php');
require('model/email_db.php');
require('model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'get_customer';
    }
}

if($action == 'get_customer') {
    include('get_customer_form.php');
} else if($action == 'create_incident_form') {
    try {
        $cleanEmail = "";
        $rawEmail = filter_input(INPUT_POST, 'customer-email', FILTER_UNSAFE_RAW);
        if($rawEmail === null || $rawEmail === false) {
            throw new Exception("Email is required.");
        } else {
            $cleanEmail = strtolower(trim($rawEmail));
            if(!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format.");
            }
        }

        $userData = find_customer_by_email($cleanEmail);
        if (empty($userData)) {
            throw new Exception("Customer not found.");
        }
        $products = get_products_by_customerId($userData['customerID']);
        if(empty($products)) {
            throw new Exception("No products found for this customer.");
        }

        include('create_incident_form.php');
    } catch (Exception $e) {
        $error = $e->getMessage();
        include('../errors/error.php');
        exit();
    }
} else if($action == 'create_incident_confirmation') {
    // Handle the creation of the incident here
}

?>