<?php
require_once(__DIR__.'/bootstrap.php');

$twig = new Twig\Environment($loader);
echo $twig->render('index.twig');