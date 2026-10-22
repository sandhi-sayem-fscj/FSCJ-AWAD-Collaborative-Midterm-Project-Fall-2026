<?php

function get_all_technicians() {
    global $db;
    $query = 'SELECT 
                techID
            FROM technicians';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}
?>