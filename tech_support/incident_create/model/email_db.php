<?php

function find_email(String $cleanEmail) {
    global $db;
    $query = 'SELECT 
                customerID, 
                CONCAT(firstName, \' \', lastName) AS fullName
            FROM customers 
            WHERE lower(email) = :email
            LIMIT 1';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $cleanEmail);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}
?>