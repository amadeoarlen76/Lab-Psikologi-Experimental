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
    $stmt = $pdo->prepare('SELECT * FROM barang2 WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $brg = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$brg) {
        exit('Barang doesn\'t exist with that ID!');
    }
    
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM barang2 WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            echo "<script>alert('Data Berhasil Di Hapus!');</script>";
            echo "<script>redirect();</script>";
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('')?>

<div class="content delete">
	<h2>Menghapus Data</h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Apakah Anda Yakin Untuk Menghapus Barang: <?=$brg['nama']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$brg['id']?>&confirm=yes">Ya</a>
        <a href="delete.php?id=<?=$brg['id']?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>