<?php

class Baza
{
    private $mysqli;

    public function __construct($serwer, $user, $pass, $baza)
    {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);

        if ($this->mysqli->connect_errno) {
            printf("Nie udało się połączenie z serwerem: %s\n", $this->mysqli->connect_error);
            exit();
        }

        $this->mysqli->set_charset("utf8");
    }

    function __destruct()
    {
        $this->mysqli->close();
    }

    public function select($sql, $pola)
    {
        $wyniki = [];
        if ($result = $this->mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $pojedynczyWynik = [];
                foreach ($pola as $pole) {
                    $pojedynczyWynik[$pole] = $row[$pole];
                }
                $wyniki[] = $pojedynczyWynik;
            }
            $result->close();
        }
        return $wyniki;
    }

    public function insert($sql)
    {
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($sql)
    {
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMysqli()
    {
        return $this->mysqli;
    }

    public function selectUser($login, $passwd, $tabela)
    {
        $id = -1;
        $sql = "SELECT * FROM $tabela WHERE userName='$login'";
        if ($result = $this->mysqli->query($sql)) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object();
                $hash = $row->passwd;
                if (password_verify($passwd, $hash)) {
                    $id = $row->id;
                }
            }
        }
        return $id;
    }

    public function sanitize($value)
    {
        return mysqli_real_escape_string($this->mysqli, $value);
    }

    public function update($sql)
    {
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }


}
