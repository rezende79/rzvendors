<?php
namespace RzVendors\Model;

class Company extends DatabaseObject
{
    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM company');
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }    

    public function fetchSingle($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM company WHERE id = :id');
        $statement->execute(array('id' => $id));
        $shipArray = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$shipArray) {
            return null;
        }
        return $shipArray;
    }    
}