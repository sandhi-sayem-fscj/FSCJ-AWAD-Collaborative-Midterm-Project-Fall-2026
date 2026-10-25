<?php
require_once('../model/database.php');
require('model/email_db.php');
require('model/product_db.php');
require('model/technician_db.php');
require('model/incident_db.php');

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
        $clean_email = "";
        $raw_email = filter_input(INPUT_POST, 'customer-email', FILTER_UNSAFE_RAW);
        if($raw_email === null || $raw_email === false) {
            throw new Exception("Email is required.");
        } else {
            $clean_email = strtolower(trim($raw_email));
            if(!filter_var($clean_email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format.");
            }
        }

        $user_data = find_customer_by_email($clean_email);
        if (empty($user_data)) {
            throw new Exception("Customer not found.");
        }
        $user_products = get_products_by_customerId($user_data['customerID']);
        if(empty($user_products)) {
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
    try {
        $incident_customer_id = filter_input(INPUT_POST, 'incident-customer-id');
        $incident_product_code = filter_input(INPUT_POST, 'incident-product');
        $incident_title = filter_input(INPUT_POST, 'incident-title');
        $incident_description = filter_input(INPUT_POST, 'incident-description');

        if (empty($incident_customer_id) || empty($incident_product_code) || empty($incident_title) || empty($incident_description)) {
            throw new Exception("All fields are required.");
        }

        $technicians = get_all_technicians();
        $random_technician = $technicians[array_rand($technicians)];
        $assigned_technician_id = $random_technician['techID'];

        add_incident($incident_customer_id, $incident_product_code, $assigned_technician_id, $incident_title, $incident_description);

        header('Location: create_incident_confirmation.php');
    } catch (Exception $e) {
        $error = $e->getMessage();
        include('../errors/error.php');
        exit();
    }
}

?>