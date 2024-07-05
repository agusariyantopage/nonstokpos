<?php
session_start();
include "../koneksi.php";
include "../function.php";


if (!empty($_POST)) {
    if ($_POST['aksi'] == 'tambah') {
        $deskripsi = $_POST['deskripsi'];
        $id_akun_debet = $_POST['id_akun_debet'];
        $id_akun_kredit = $_POST['id_akun_kredit'];

        $sql = "INSERT INTO akun_jurnal_template(id_akun_jurnal_template, deskripsi, id_akun_debet, id_akun_kredit, dibuat_pada, diubah_pada) VALUES (DEFAULT, '$deskripsi', $id_akun_debet, $id_akun_kredit, DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        echo $sql;
        header('location:../index.php?p=jurnal-template');
    } else if ($_POST['aksi'] == 'ubah') {
        $id_akun_jurnal_template = $_POST['id_akun_jurnal_template'];
        $deskripsi = $_POST['deskripsi'];
        $id_akun_debet = $_POST['id_akun_debet'];
        $id_akun_kredit = $_POST['id_akun_kredit'];


        $sql = "UPDATE akun_jurnal_template SET deskripsi='$deskripsi', id_akun_debet=$id_akun_debet, id_akun_kredit=$id_akun_kredit,diubah_pada=DEFAULT WHERE id_akun_jurnal_template=$id_akun_jurnal_template";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        // echo $sql;
        header('location:../index.php?p=jurnal-template');
    }
}


if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id_akun_jurnal_template = $_GET['id'];
        $sql = "DELETE from akun_jurnal_template where md5(id_akun_jurnal_template)='$id_akun_jurnal_template'";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        // echo $sql;
        header('location:../index.php?p=jurnal-template');
    }
}
