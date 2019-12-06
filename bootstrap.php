<?php
require_once(__DIR__.'/vendor/autoload.php');

require_once(__DIR__.'/src/model/DatabaseObject.php');
require_once(__DIR__.'/src/model/Company.php');

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/src/view');
$twig = new Twig\Environment($loader);
