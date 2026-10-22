<?php

function get_products_by_customerId(int $customerId) {
    global $db;
    $query = 'select distinct 
                prd.productCode
                , prd.name 
            from tech_support.customers cust
            inner join tech_support.registrations reg
                on cust.customerID = reg.customerID
            inner join tech_support.products prd
                on reg.productCode = prd.productCode
            where cust.customerID = :customerId'
            ;
    $statement = $db->prepare($query);
    $statement->bindValue(':customerId', $customerId);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}
?>