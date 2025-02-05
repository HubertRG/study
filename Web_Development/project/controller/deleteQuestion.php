<?php
require_once '../class/Page.php';

$pageTitle = "Potwierdzenie usunięcia";
$pg = new Page($pageTitle);

//Check if the question id was sent in the url and if the currently logged user is the admin
$questionId = isset($_GET['question_id']) ? intval($_GET['question_id']) : null;
if (!$pg->isAdmin() || !$questionId) {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

$db = $pg->getDb();

$sql = "DELETE FROM questions WHERE id = $questionId";
if ($db->delete($sql)) {
    $_SESSION['delete_question'] = true;
    if (!headers_sent()) {
        header("Location: ../views/admin.php");
    } else {
        echo "<script>window.location.href = '../views/admin.php';</script>";
    }
} else {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
}
exit();



