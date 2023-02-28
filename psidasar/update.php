<script>
    function redirect() {
        window.location = "read.php";
    }
</script>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $pengadaan = isset($_POST['pengadaan']) ? $_POST['pengadaan'] : '';
        $terpakai = isset($_POST['terpakai']) ? $_POST['terpakai'] : '';
        $rusak = isset($_POST['rusak']) ? $_POST['rusak'] : '';
        $sisa= $pengadaan - $terpakai - $rusak;
        
        $stmt = $pdo->prepare('UPDATE barang SET id = ?, nama = ?, pengadaan = ?, terpakai = ?, rusak = ?, sisa = ? WHERE id = ?');
        $stmt->execute([$id, $nama, $pengadaan, $terpakai, $rusak, $sisa, $_GET['id']]);

        echo "<script>alert('Pembaruan Data Berhasil Dilakukan!');</script>";
        echo "<script>redirect();</script>";  
    }

    $stmt = $pdo->prepare('SELECT * FROM barang WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $brg = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$brg) {
        exit('Barang doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('')?>

<div class="content update">
	<h2>Memperbarui Data</h2>
    <form action="update.php?id=<?=$brg['id']?>" method="post">
        <label for="id">ID Barang</label>
        <label for="nama">Nama Barang</label>
        <input type="number" name="id" value="<?=$brg['id']?>" id="id">
        <input type="text" name="nama" value="<?=$brg['nama']?>" id="nama">

        <label for="pengadaan">Jumlah Pengadaan</label>
        <label for="terpakai">Jumlah Terpakai</label>
        <input type="number" name="pengadaan" value="<?=$brg['pengadaan']?>" id="pengadaan">
        <input type="number" name="terpakai" value="<?=$brg['terpakai']?>" id="terpakai">

        <label for="rusak">Rusak</label>
        <label></label>
        <input type="number" name="rusak" value="<?=$brg['rusak']?>" id="rusak">

        <input type="submit" value="Perbarui">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>