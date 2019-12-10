<?php

namespace RzVendors\Controller;

use RzVendors\Model\Vendor;

class VendorManager
{
    public function getVendors()
    {
        $json_file = file_get_contents(__DIR__.'/../../data/vendors.json');
        $json_content = json_decode($json_file, true);
        $vendors = array();
        foreach ($json_content as $vendor) {
            $vendors[] = new Vendor(
                $vendor['company'],
                $vendor['name'],
                $vendor['document'],
                $vendor['phones'],
                $vendor['created_at']
            );
        }
        return $vendors;
    }

    public function add(Vendor $vendor)
    {
        $vendors = $this->getVendors();
        $vendors[] = $vendor;
        $vendors_json = json_encode($vendors, JSON_PRETTY_PRINT, 2);
        file_put_contents(__DIR__.'/../../data/vendors.json', $vendors_json);
        return $vendors;
    }

    public function edit(String $document, $company_cnpj, $name, $phones)
    {
        $vendors = $this->getVendors();
        foreach ($vendors as $key => $value) {
            if ($value->document == $document) {
                $value->company = $company_cnpj;
                $value->name = $name;
                $value->phones = $phones;
                break;
            }
        }
        $vendors_json = json_encode($vendors, JSON_PRETTY_PRINT, 2);
        file_put_contents(__DIR__.'/../../data/vendors.json', $vendors_json);            
        return $vendors;
    }

    public function delete(String $document)
    {
        $vendors = $this->getVendors();
        foreach ($vendors as $key => $value) {
            if ($value->document == $document) {
                unset($vendors[$key]);
                break;
            }
        }
        $vendors_json = json_encode($vendors, JSON_PRETTY_PRINT, 2);
        file_put_contents(__DIR__.'/../../data/vendors.json', $vendors_json);
        return $vendors;
    }

    public function search(String $searchFor, String $searchBy)
    {
        $vendorsFiltered = array();
        $vendors = $this->getVendors();
        foreach ($vendors as $vendor) {
            $found = false;
            if ($searchBy == 'name' && $this->startsWith($vendor->name, $searchFor)) {
                $found = true;
            } elseif ($searchFor == $vendor->$searchBy) {
                $found = true;
            }
            if ($found) {
                $vendorsFiltered[] = $vendor;
            }
        }
        return $vendorsFiltered;
    }

    private function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }    
}
