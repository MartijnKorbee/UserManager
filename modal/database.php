<?php 

namespace modal\Database;

class Database extends \mysqli {
    /*
    Database class that is responsible for and holds the connection.
    */
    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        parent::__construct(
            $_ENV['SERVER'],
            $_ENV['USER'],
            $_ENV['PASSWORD'],
            $_ENV['DATABASE']
        );
    }
}    

?>