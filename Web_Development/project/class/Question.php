<?php

class Question
{
    protected $fullName;
    protected $email;
    protected $subject;
    protected $message;
    protected $date;

    public function __construct($fullName, $email, $subject, $message)
    {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->date = (new DateTime())->format('Y-m-d');
    }

    public function saveDB($db)
    {
        $sql = "INSERT INTO questions (fullName, email, subject, message, date) 
                VALUES ('$this->fullName', '$this->email', '$this->subject', '$this->message','$this->date')";
        if ($db->insert($sql)) {
            echo "<div class=\"container-xxl py-6\">
                    <div class=\"text-center mx-auto mb-5 wow fadeInUp\" data-wow-delay=\"0.1s\" style=\"max-width: 500px;\">
                        <h1 class=\"display-6 mb-4\" style='color: black'>Pytanie zostało poprawnie przesłane</h1>  
                    </div>
                   </div>";
        } else {
            echo "<div class=\"container-xxl py-6\">
                    <div class=\"text-center mx-auto mb-5 wow fadeInUp\" data-wow-delay=\"0.1s\" style=\"max-width: 500px;\">
                        <h1 class=\"display-6 mb-4\" style='color: black'>Błąd przy przesyłaniu pytania</h1>
                    </div>
                   </div>";
        }
    }

    public static function getAllQuestionsFromDB($db)
    {
        $sql = "SELECT id, fullName, email, subject, message, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date FROM questions";
        $fields = ['id', 'fullName', 'email', 'subject', 'message', 'formatted_date'];
        $results = $db->select($sql, $fields);

        if (empty($results)) {
            return [];
        }

        return $results;
    }


}