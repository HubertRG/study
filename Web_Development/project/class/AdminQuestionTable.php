<?php

require_once '../class/Question.php';

class AdminQuestionTable
{

    protected $db;

    public function __construct($db)
    { ?>
        <div id="question_table" class="container-xxl py-6">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">Lista Pytań</h1>
            </div>
            <div id="questionsTable" class="col-md-12 table-responsive">
                <table class="table table-bordered mt-3">
                    <thead>
                    <tr>
                        <th>Imię i Nazwisko</th>
                        <th>Email</th>
                        <th>Temat</th>
                        <th>Wiadomość</th>
                        <th>Data</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody id="questionsTableBody">
                    <?php
                    $data = Question::getAllQuestionsFromDB($db);
                    if (!empty($data)) {
                        foreach ($data as $info) {
                            ?>
                            <tr>
                                <td><?php echo "{$info['fullName']}"; ?></td>
                                <td><?php echo "{$info['email']}"; ?></td>
                                <td><?php echo "{$info['subject']}"; ?></td>
                                <td><?php echo "{$info['message']}"; ?></td>
                                <td><?php echo "{$info['formatted_date']}"; ?></td>
                                <td>
                                    <a href=../controller/questionConfirmDelete.php?question_id=<?php echo urlencode($info['id']); ?>
                                       class="btn btn-danger btn-sm">Usuń</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center'>Brak pytań do wyświetlenia.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['delete_question']) && $_SESSION['delete_question'] === true) {
                echo '<div class="alert alert-success">Pytanie zostało usunięte.</div>';
                unset($_SESSION['delete_question']);
            }
            ?>
        </div>
        <?php
    }
}