<?php

class DB{
    private $host="127.0.0.1";
    private $user="root";
    private $password="";
    private $database="dbrestoran";
    public $koneksi;

    public function __construct()
    {
        $this->koneksi = $this->koneksiDB();
    }

    public function koneksiDB() {
        $koneksi= mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $koneksi;
    }

    public function getALL($sql) 
    {
        $result = mysqli_query($this->koneksi, $sql);
        $data = [];
        while ($row=mysqli_fetch_assoc($result)) 
        {
            $data[]=$row;
        }
        if (!empty($data)){
            return $data;
        }
        return [];
    }

    public function getITEM($sql)  {
        $result = mysqli_query($this->koneksi, $sql);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }

    public function rowCOUNT($sql)  {
        $result = mysqli_query($this->koneksi, $sql);
        $count = mysqli_num_rows($result);

        return $count;
    }

    public function runSQL($sql)  {
        try {
            $result = mysqli_query($this->koneksi, $sql);
            return $result;
        } catch (mysqli_sql_exception $e) {
            echo "Error SQL: " . $e->getMessage();
            return false;
        }
    }

    // **Tambahan method escape untuk mencegah SQL injection**
    public function escape($string) {
        return mysqli_real_escape_string($this->koneksi, $string);
    }

    public function pesan($text) 
    {
       echo $text; 
    }
}

$db = new DB;

?>
