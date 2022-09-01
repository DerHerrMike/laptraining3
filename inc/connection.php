<?php
include_once 'config.php';

class Connection{


    public function connect(){

        try {
            $connection = new PDO( 'mysql:host=' . DBHOST . ';dbname=' . DBNAME . ';user=' . DBUSER . ';password=' . DBPASSWORD);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $connection;
        } catch (PDOException $e) {
            echo 'Could not connect to database: ' . $e->getMessage();
            die();
        }
    }
}