<?php

namespace RzVendors\Controller;

use RzVendors\Model\Company;

class CompanyLoader
{
    public function getCompanies()
    {
        $json_file = file_get_contents(__DIR__.'/../../data/companies.json');
        $json_content = json_decode($json_file, true);
        $companies = array();
        foreach ($json_content as $company) {
            $companies[] = new Company($company['cnpj'], $company['name'], $company['uf']);
        }
        return $companies;
    }
}
