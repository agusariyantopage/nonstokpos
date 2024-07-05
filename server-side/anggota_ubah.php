<?php
include "../koneksi.php";
$id_anggota = $_POST['id_anggota'];

$sql_anggota = "SELECT * FROM anggota WHERE id_anggota=$id_anggota";
$query_anggota = mysqli_query($koneksi, $sql_anggota);
$kolom = mysqli_fetch_array($query_anggota);


?>

<form method="post" enctype="multipart/form-data" action="aksi/anggota.php">
    <input type="hidden" name="aksi" value="ubah">
    <div>
        <label for="id_anggota">ID Anggota</label>
        <input type="text" class="form-control" readonly name="id_anggota" value="<?= $kolom['id_anggota']; ?>">
    </div>
    <div>
        <label for="no_identitas">Nomer Identitas</label>
        <input type="text" name="no_identitas" class="form-control" value="<?= $kolom['no_identitas']; ?>">
    </div>
    <div>
        <label for="tanggal_bergabung">Tanggal Bergabung</label>
        <input type="date" name="tanggal_bergabung" class="form-control" value="<?= $kolom['tanggal_bergabung']; ?>">
    </div>
    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $kolom['nama']; ?>">
    </div>
    <div>
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" rows="3"><?= $kolom['alamat']; ?></textarea>
    </div>
    <div>
        <label for="telepon">Nomor Telepon</label>
        <input type="text" name="telepon" class="form-control" value="<?= $kolom['telepon']; ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="<?= $kolom['email']; ?>">
    </div>
    
    <button type="submit" class="btn btn-primary btn-block mt-2">Ubah</button>
</form>