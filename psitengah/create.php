<script>
    function redirect() {
        window.location = "read.php";
    }
</script>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $pengadaan = isset($_POST['pengadaan']) ? $_POST['pengadaan'] : '';
    $terpakai = isset($_POST['terpakai']) ? $_POST['terpakai'] : '';
    $rusak = isset($_POST['rusak']) ? $_POST['rusak'] : '';
    $sisa = isset($_POST['sisa']) ? $_POST['sisa'] : '';

    $stmt = $pdo->prepare('INSERT INTO barang1 VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $pengadaan, $terpakai, $rusak, $sisa]);

    echo "<script>alert('Data Berhasil Di Tambahkan!');</script>";
    echo "<script>redirect();</script>";  
}
?>


<?=template_header('')?>

<div class="content update">
	<h2>Data Baru</h2>
    <form action="create.php" method="post">
        <label for="id">ID Barang</label>
        <label for="nama">Nama Barang</label>
        <input type="number" name="id" id="id" required>
        <input type="text" name="nama" id="nama"required>
        <label for="pengadaan">Pengadaan</label>
        <label for="terpakai">Terpakai</label>
        <input type="number" name="pengadaan" id="pengadaan"required>
        <input type="number" name="terpakai" id="terpakai">
        <label for="rusak">Rusak</label>
        <label for="sisa">Sisa</label>
        <input type="number" name="rusak" id="rusak">
        <input type="number" name="sisa" id="sisa"required>
        <input type="submit" value="Tambah">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>