<?php
require_once '../class/Page.php';

$pageTitle = "Potwierdzenie usunięcia";
$pg = new Page($pageTitle);

//Check if the admin is logged-in and if the question id was sent in the url
$questionId = isset($_GET['question_id']) ? intval($_GET['question_id']) : null;
if (!$pg->isAdmin() || !$questionId) {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

$pg->getHeader();

?>

<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h2 class="fw-bold mb-2 text-uppercase" style="color: white">Czy na pewno chcesz usunąć
                                    to
                                    pytanie?</h2>
                                <p>Tej operacji nie można cofnąć.</p>
                                <div class="d-flex justify-content-around mt-4">
                                    <a href="deleteQuestion.php?question_id=<?php echo $questionId; ?>"
                                       class="btn btn-danger">Tak,
                                        usuń</a>
                                    <a href="../views/admin.php" class="btn btn-secondary">Nie, powrót</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $pg->getFooter(); ?>


