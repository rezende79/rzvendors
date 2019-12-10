<?php

use \RzVendors\Model\Vendor;

require_once(__DIR__.'/vendor/autoload.php');

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/src/view');
$twig = new Twig\Environment($loader);

$companyLoader = new \RzVendors\Controller\CompanyLoader();
$vendorManager = new \RzVendors\Controller\VendorManager();

$companies = $companyLoader->getCompanies();
$vendors = $vendorManager->getVendors();    

$alertMsg = "";

$action = (!empty($_GET['do'])) ? $_GET['do'] : '';

switch ($action) {
    case 'search':
        if (!empty($_POST['searchFor'])) {
            $vendors = $vendorManager->search($_POST['searchFor'], $_POST['searchBy']);
        } else {
            $alertMsg = "Please, type your search.";
        }
        break;
    case 'add':
        if (!empty($_POST['vendorDocument'])) {
            $vendor = new Vendor(
                $_POST['vendorCompany'],
                $_POST['vendorName'],
                $_POST['vendorDocument'],
                $_POST['vendorPhones'],
                date('Y-m-d')
            );
            $vendors = $vendorManager->add($vendor);
            $alertMsg = "Vendor ".$_POST['vendorDocument']." was created.";
        }
        break;
    case 'edit':
        if (!empty($_POST['vendorDocument'])) {
            $vendors = $vendorManager->edit(
                $_POST['vendorDocument'],
                $_POST['vendorCompany'],
                $_POST['vendorName'],
                $_POST['vendorPhones']
            );
            $alertMsg = "Vendor ".$_POST['vendorDocument']." was edited.";
        }
        break;
    case 'delete':
        if (!empty($_POST['deleteVendorDocument'])) {
            $vendors = $vendorManager->delete($_POST['deleteVendorDocument']);
            $alertMsg = "Vendor ".$_POST['deleteVendorDocument']." was deleted.";
        }
        break;
}

echo $twig->render('index.twig', [
    'alertMsg' => $alertMsg,
    'vendors' => $vendors,
    'companies' => $companies
    ]);
