<?php

require "../konfig/conn.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $cek = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_fetch_array(mysqli_query($conn, $cek));

    if (isset($result)) {
        $response['value'] = 1;
        $response['message'] = "Login Berhasil";
        $response['email'] = $result['email'];
        $response['name'] = $result['name'];
        echo json_encode($response);
    } else {
        $response['value'] = 0;
        $response['message'] = "Login Gagal";
        echo json_encode($response);
    }
}
