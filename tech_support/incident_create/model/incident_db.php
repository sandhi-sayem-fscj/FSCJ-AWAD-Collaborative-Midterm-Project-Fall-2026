<?php

function add_incident($customerID, $productCode, $techID, $title, $description) {
    global $db;
    $query = 'INSERT INTO incidents (customerID, productCode, techID, dateOpened, dateClosed, title, description)
              VALUES (:customer_id, :product_code, :tech_id, NOW(), NULL, :title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customerID);
    $statement->bindValue(':product_code', $productCode);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':tech_id', $techID);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

?>