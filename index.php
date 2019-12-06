<?php
require_once(__DIR__.'/bootstrap.php');

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

$vendors_json = file_get_contents(__DIR__.'/data/vendors.json');
$vendors = json_decode($vendors_json, true);

$companies_json = file_get_contents(__DIR__.'/data/companies.json');
$companies = json_decode($companies_json, true);

$alertMsg = "";
if (!empty($_GET['do'])) {
    if ($_GET['do'] == 'search') {
        if (!empty($_POST['searchFor']) && !empty($_POST['searchBy'])) {
            $vendorsFiltered = array();
            $searchFor = $_POST['searchFor'];
            $searchBy = $_POST['searchBy'];
            foreach ($vendors as $vendor) {
                $found = false;
                if ($searchBy == 'name' && startsWith($vendor['name'], $searchFor)) {
                    $found = true;
                } elseif ($searchFor == $vendor[$searchBy]) {
                    $found = true;
                }
                if ($found) {
                    $vendorsFiltered[] = $vendor;
                }
            }
            $vendors = $vendorsFiltered;
        }
    }
    if ($_GET['do'] == 'add') {
        if (!empty($_POST['vendorDocument'])) {
            $vendorDocument = $_POST['vendorDocument'];
            $vendors[] = [
                'company' => $_POST['vendorCompany'],
                'name' => $_POST['vendorName'],
                'document' => $_POST['vendorDocument'],
                'phones' => $_POST['vendorPhones'],
                'created_at' => date('Y-m-d')
            ];
            $vendors_json = json_encode($vendors, JSON_PRETTY_PRINT, 2);
            file_put_contents(__DIR__.'/data/vendors.json', $vendors_json);
            $alertMsg = "Vendor $vendorDocument was created.";
        }
    }
    if ($_GET['do'] == 'edit') {
        if (!empty($_POST['vendorDocument'])) {
            $vendorDocument = $_POST['vendorDocument'];
            foreach ($vendors as $key => $value) {
                if ($value['document'] == $vendorDocument) {
                    $vendors[$key]['company'] = $_POST['vendorCompany'];
                    $vendors[$key]['name'] = $_POST['vendorName'];
                    $vendors[$key]['phones'] = $_POST['vendorPhones'];
                    break;
                }
            }
            $vendors_json = json_encode($vendors, JSON_PRETTY_PRINT, 2);
            file_put_contents(__DIR__.'/data/vendors.json', $vendors_json);            
            $alertMsg = "Vendor $vendorDocument was edited.";
        }
    }
    if ($_GET['do'] == 'delete') {
        if (!empty($_POST['deleteVendorDocument'])) {
            $vendorDocument = $_POST['deleteVendorDocument'];
            foreach ($vendors as $key => $value) {
                if ($value['document'] == $vendorDocument) {
                    unset($vendors[$key]);
                    break;
                }
            }
            $vendors_json = json_encode($vendors, JSON_PRETTY_PRINT, 2);
            file_put_contents(__DIR__.'/data/vendors.json', $vendors_json);            
            $alertMsg = "Vendor $vendorDocument was deleted.";
        }
    }
}

echo $twig->render('index.twig', [
            'alertMsg' => $alertMsg,
            'vendors' => $vendors,
            'companies' => $companies
        ]);
