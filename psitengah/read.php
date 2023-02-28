<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

$stmt = $pdo->prepare('SELECT * FROM barang1 ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$brang = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_brang = $pdo->query('SELECT COUNT(*) FROM barang1')->fetchColumn();
?>


<?=template_header('')?>

<div class="content read">
	<h2>Inventaris Lab. Psikologi Menengah</h2>
	<a href="create.php" class="create-contact">Masukkan Data Baru</a>
    <a href="export.php" class="export-contact">Export</a>
	<table>
        <thead>
            <tr>
                <td>ID Barang</td>
                <td>Nama Barang</td>
                <td>Jumlah Pengadaan</td>
                <td>Terpakai</td>
                <td>Rusak</td>
                <td>Sisa</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brang as $brg): ?>
            <tr>
                <td><?=$brg['id']?></td>
                <td><?=$brg['nama']?></td>
                <td><?=$brg['pengadaan']?></td>
                <td><?=$brg['terpakai']?></td>
                <td><?=$brg['rusak']?></td>
                <td><?=$brg['sisa']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$brg['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$brg['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_brang): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>