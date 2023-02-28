<script>
    function redirect() {
        window.location = "masuk.php";
    }
</script>

<?php
session_start();
echo session_id();

if (isset($_POST['username']) && isset($_POST['password'])) {
    
    // mendapatkan informasi dari hasil inputan dari form dan mengenkripsi sandinya
    $username = $_POST['username'];
    $password = $_POST['password'];

    // koneksi ke database dan memilih databasenya
    $conn = mysqli_connect("localhost", "root", "", "logincrud") or die ("Koneksi gabisa");
 
    //periksa informasi di database
    $query = "SELECT * FROM logins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    //cek kondisi
    if (mysqli_num_rows($result) == 1) {
        // login berhasil, alihkan ke halaman yang ditentukan
        if($_SESSION['username'] AND $username == "psidasar"){
            header('location: psidasar/index.php');   
        }elseif($_SESSION['username'] AND $username == "psitengah"){
            header('location: psitengah/index.php');            
        }elseif($_SESSION['username'] AND $username == "psilanjut"){
            header('location: psilanjut/index.php');    
        } 
    }else {
            // login gagal, tampilkan pesan kesalahan
            echo "<script>alert('Username atau Password Anda Salah, Coba Lagi');</script>";
            echo "<script>redirect();</script>";
     }
    
}
?>
