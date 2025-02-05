<?php
require_once '../class/Page.php';

$pageTitle = "Kontakt";

$pg = new Page($pageTitle);

$pg->getHeader();

$pg->getNavbar();

$pg->getPageHeader();

$pg->getContent("contactCard");

require_once '../class/QuestionForm.php';
$qf = new QuestionForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $qf->checkMessage();
    if ($question !== NULL) {
        $question->saveDB($pg->getDb());
        $_SESSION['question_sucess'] = true;
        if (!headers_sent()) {
            header("Location: ../views/contact.php");
        } else {
            echo "<script>window.location.href = '../views/contact.php';</script>";
        }
        exit();
    } else {
        echo "<div class=\"container-xxl py-6 px-0 wow fadeInUp\" data-wow-delay=\"0.1s\"><h2 class=\"fw-bold mb-2 text-uppercase\" style=\"color: black; text-align: center\">Nieprawidłowe dane wiadomości</h2></div>";
    }
}

$pg->getContent("map");

$pg->getFooter();

