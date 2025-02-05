<?php

class User
{
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;

    protected $userName;
    protected $passwd;
    protected $fullName;
    protected $email;
    protected $phonenumber;
    protected $date;
    protected $status;

    function __construct($userName, $fullName, $email, $phonenumber, $passwd)
    {
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->phonenumber = $phonenumber;
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
        $this->status = User::STATUS_USER;
        $this->date = (new DateTime())->format('Y-m-d');
    }

    public function saveDB($db)
    {
        $sql = "INSERT INTO users (userName, passwd, fullName, email, phonenumber, date, status) 
                VALUES ('$this->userName', '$this->passwd', '$this->fullName', '$this->email', '$this->phonenumber', '$this->date', $this->status)";
        return ($db->insert($sql));
    }

    public static function getAllUsersFromDB($db)
    {
        $sql = "SELECT id, userName, fullName, email, phonenumber, date FROM users";
        $fields = ["id", "userName", "fullName", "email", "phonenumber", "date"];
        $results = $db->select($sql, $fields);
        if (empty($results)) {
            return [];
        }

        return $results;
    }

}

