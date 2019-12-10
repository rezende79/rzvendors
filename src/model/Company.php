<?php

namespace RzVendors\Model;

class Company 
{
    public $cnpj;
    public $name;
    public $uf;

    public function __construct(String $cnpj, String $name, String $uf)
    {
        $this->cnpj = $cnpj;
        $this->name = $name;
        $this->uf = $uf;
    }
}

