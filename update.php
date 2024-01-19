<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $tempattanggallahir = isset($_POST['tempattanggallahir']) ? $_POST['tempattanggallahir'] : '';
        $jeniskelamin = isset($_POST['jeniskelamin']) ? $_POST['jeniskelamin'] : '';
        $umur = isset($_POST['umur']) ? $_POST['umur'] : '';
        $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
        $telepon = isset($_POST['telepon']) ? $_POST['telepon'] : '';
        $riwayatpendidikan = isset($_POST['riwayatpendidikan']) ? $_POST['riwayatpendidikan'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE kontak SET id = ?, nama = ?, email = ?, notelp = ?, alamat = ?, riwayatpendidikan = ? WHERE id = ?');
        $stmt->execute([$id, $nama, $tempattanggallahir, $jeniskelamin, $umur, $alamat, $telepon, $riwayatpendidikan, $_GET['id']]);
        $msg = 'Update Sukses!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update ID = #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="<?=$contact['nama']?>" id="nama">
        <label for="tempattanggallahir">Tempat,Tgl Lahir</label>
        <input type="text" name="tempattanggallahir" value="<?=$contact['tempattanggallahir']?>" id="tempattanggallahir">
        <label for="jeniskelamin">Jenis Kelamin</label>
        <input type="text" name="jeniskelamin" value="<?=$contact['jeniskelamin']?>" id="jeniskelamin">
        <label for="umur">Umur</label>
        <input type="text" name="umur" value="<?=$contact['umur']?>" id="umur">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?=$contact['alamat']?>" id="alamat">
        <label for="telepon">Telepon</label>
        <input type="text" name="telepon" value="<?=$contact['telepon']?>" id="telepon">
        <label for="riwayatpendidikan">Riwayat Pendidikan</label>
        <input type="text" name="riwayatpendidikan" value="<?=$contact['riwayatpendidikan']?>" id="riwayatpendidikan">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>