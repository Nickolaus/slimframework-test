<?php

namespace SlimTest\Model\Mapper;

use Slim\Container;

abstract class AbstractMapper {

    /**
     * @var \PDO
     */
    protected $dbConnection;

    public function __construct(\PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;

    }
}