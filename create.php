<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $tempattanggallahir = isset($_POST['tempattanggallahir']) ? $_POST['tempattanggallahir'] : '';
    $jeniskelamin = isset($_POST['jeniskelamin']) ? $_POST['jeniskelamin'] : '';
    $umur = isset($_POST['umur']) ? $_POST['umur'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $telepon = isset($_POST['telepon']) ? $_POST['telepon'] : '';
    $riwayatpendidikan = isset($_POST['riwayatpendidikan']) ? $_POST['riwayatpendidikan'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO kontak VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $tempattanggallahir, $jeniskelamin, $umur, $alamat, $telepon, $riwayatpendidikan]);
    // Output message
    $msg = 'Berhasil!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Data</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label> 
        <input type="text" name="id" id="id">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        <label for="tempattanggallahir">Tempat,Tgl Lahir</label>
        <input type="text" name="tempattanggallahir" id="tempattanggallahir">
        <label for="jeniskelamin">Jenis Kelamin</label>
        <input type="text" name="jeniskelamin" id="jeniskelamin">
        <label for="umur">Umur</label>
        <input type="text" name="umur" id="umur">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat">
        <label for="telepon">Telepon</label>
        <input type="text" name="telepon" id="telepon">
        <label for="riwayatpendidikan">Riwayat Pendidikan</label>
        <input type="text" name="riwayatpendidikan" id="riwayatpendidikan">
        <input type="submit" value="Tambah">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>