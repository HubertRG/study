<?php
require_once '../class/Page.php';

$pageTitle = "Oferta";
$pg = new Page($pageTitle);

$pg->getHeader();

$pg->getNavbar();

$pg->getPageHeader();

$pg->getContent("productContent");

$pg->getFooter();

