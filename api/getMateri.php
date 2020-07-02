<?php

include "../konfig/conn.php";

$response = array();

$sql = mysqli_query($conn, "SELECT*FROM materi order by id desc");
while ($a = mysqli_fetch_array($sql)) {
    $key['id'] = $a['id'];
    $key['judul'] = $a['judul'];
    $key['namafile'] = $a['namafile'];
    $key['kelas'] = $a['kelas'];
    $key['jurusan'] = $a['jurusan'];
    $key['isactive'] = $a['isactive'];

    array_push($response, $key);
}

echo json_encode($response);
