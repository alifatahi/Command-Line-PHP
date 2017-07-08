<?php
/**
 * Created by PhpStorm.
 * User: west
 * Date: 7/8/2017
 * Time: 11:44 AM
 */

namespace Acme;

use PDO;
class DatabaseAdapter
{
    protected $connection;

    //Build Connection Using PDO
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    
    //Fetch All Method for get Data From Table
    public function fetchAll($tableName)
    {
        return $this->connection->query(' SELECT * FROM ' . $tableName)->fetchAll();
    }

    public function query($sql,$parameters)
    {
        return $this->connection->prepare($sql)->execute($parameters);
    }
}