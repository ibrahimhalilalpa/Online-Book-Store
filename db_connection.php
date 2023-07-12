<?php

#server name
$sName = "localhost";

# user name
$uName = "root";

#password
$pass = "";

#database name
$db_name = "online_book_store_db";

//creating database connection using The PHP Data Object (PDO) //PHP Data Object (PDO) kullanarak veritabanı bağlantısı oluşturma 

try
{
    $conn = new PDO("mysql:host=$sName;dbname=$db_name",$uName,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: ".$e->getMessage();
}



$db = mysqli_connect($sName, $uName, $pass, $db_name) or die("Could not connect database");

?>