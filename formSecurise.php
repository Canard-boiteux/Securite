<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=test', '', '');
    foreach($db->query('SELECT * from users') as $row) {
        print_r($row);
    }
    $db = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>