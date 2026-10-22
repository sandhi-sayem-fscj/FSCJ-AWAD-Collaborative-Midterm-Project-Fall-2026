<?php

function get_products_by_customerId($customerId) {
    global $db;
    $query = 'SELECT DISTINCT 
                prd.productCode
                , prd.name 
            FROM tech_support.customers cust
            INNER JOIN tech_support.registrations reg
                ON cust.customerID = reg.customerID
            INNER JOIN tech_support.products prd
                ON reg.productCode = prd.productCode
            WHERE cust.customerID = :customerId'
            ;
    $statement = $db->prepare($query);
    $statement->bindValue(':customerId', $customerId);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}
?>