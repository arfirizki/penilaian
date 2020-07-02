<?php

require "../konfig/conn.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $name = $_POST['name'];

    $cek = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_fetch_array(mysqli_query($conn, $cek));

    if (isset($result)) {
        $response['value'] = 2;
        $response['message'] = "Username telah digunakan";
        echo json_encode($response);
    } else {
        $insert = "INSERT INTO user VALUE(NULL,'$email','default.jpg','$password','1','$name','1',NOW())";
        if (mysqli_query($conn, $insert)) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Berhasil ditambahkan";
            echo json_encode($response);
        } else {
            # code...
            $response['value'] = 0;
            $response['message'] = "Gagal ditambahkan";
            echo json_encode($response);
        }
    }
}
