<?php
require_once '../class/Page.php';

$pageTitle = "Strona główna";

$pg = new Page($pageTitle);

$pg->getHeader();

$pg->getNavbar();

$pg->getContent("indexCarousel");

$pg->getContent("indexContent");

$pg->getFooter();

