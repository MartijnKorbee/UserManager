<?php 

// CLASS DATABASE
class Database extends \mysqli {
    /*
    Database class that is responsible for and holds the connection.
    */
    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        parent::__construct(
            $_ENV['DB_SERVER'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_NAME']
        );
    }
} 

?>