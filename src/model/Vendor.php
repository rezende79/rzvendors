<?php

namespace RzVendors\Model;

class Vendor
{
    public $company;
    public $name;
    public $document;
    public $phones;
    public $created_at;

    public function __construct($company_cnpj, $name, $document, $phones, $created_at)
    {
        $this->company = $company_cnpj;
        $this->name = $name;
        $this->document = $document;
        $this->phones = $phones;
        $this->created_at = $created_at;
    }
}
