<?php

namespace RzVendors\Model;

class DatabaseObject
{
    public $pdo;
    private $configuration;

    public function __construct()
    {
        $jsonConfig = file_get_contents(__DIR__.'/../../config.json');
        $this->configuration = json_decode($jsonConfig);
        $this->pdo = $this->getPDO();
    }

    /**
     * @return \PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new \PDO(
                $this->configuration->database->dsn,
                $this->configuration->database->user,
                $this->configuration->database->pass
            );

            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }
}
