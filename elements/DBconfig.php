<?php
//  Database connection
DEFINE("DB_USER", "root"); // username database
DEFINE("DB_PASS", ""); // password database
try {
    $db = new PDO("mysql:host=localhost;dbname=inlog", DB_USER, DB_PASS); //host & database name
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
