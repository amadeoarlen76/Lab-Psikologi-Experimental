<?php
    //koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "crudlab");

    //query
    $query = "SELECT * FROM barang1";
    $result = mysqli_query($conn, $query);

    //nama file
    $nama_file = "hasil_export.csv";

    //membuka file
    $fp = fopen($nama_file, 'w');

    //menulis data ke dalam file
    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($fp, $row);
    }

    //menutup file
    fclose($fp);

    //redirect ke halaman download
    header("Location: $nama_file");
?>