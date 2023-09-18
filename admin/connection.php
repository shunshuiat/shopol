<?php
$hosting = "localhost";
$username = "root";
$password = "";
$database = "shopbangiay";

function get_connection()
{
    global $hosting, $username, $password, $database;

    $cnn = new mysqli($hosting, $username, $password, $database);
    if ($cnn->error) {
        die("disconnect");
    }
    return $cnn;
}

$conn = mysqli_connect($hosting, $username, $password, $database);

function select_database($sql)
{
    $connect = get_connection();
    $result = $connect->query($sql);
    return $result;
}

function insert_or_update($sql)
{
    $connect = get_connection();
    $isOk = false;
    try {
        $isOk = $connect->query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $isOk;
}

function get_last_insert_id() {
    $cnn = get_connection();

    $lastId = mysqli_insert_id($cnn);

    $cnn->close();

    return $lastId;
}
