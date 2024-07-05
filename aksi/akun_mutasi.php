<?php
session_start();
include "../koneksi.php";
function get_id_jurnal($koneksi)
{
    $sql = "SELECT * FROM akun_jurnal ORDER BY id_akun_jurnal DESC LIMIT 1";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
    return $data['id_akun_jurnal'];
}
function pesan_transaksi($koneksi)
{
    $sukses = mysqli_affected_rows($koneksi);
    if ($sukses >= 1) {
        $_SESSION['status_proses'] = 'SUKSES';
    } else {
        $_SESSION['status_proses'] = 'GAGAL';
    }
}


if (!empty($_POST)) {
    if ($_POST['aksi'] == 'tambah-jurnal-template') {
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $nominal_transaksi = $_POST['nominal_transaksi'];
        $deskripsi = $_POST['deskripsi'];
        $nomor_jurnal = ""; // $_POST['nomor_jurnal'];

        $sql = "INSERT INTO akun_jurnal(id_akun_jurnal, nomor_jurnal, deskripsi, tanggal_transaksi, dibuat_pada, diubah_pada) VALUES(DEFAULT,'$nomor_jurnal','$deskripsi','$tanggal_transaksi',DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);
        
        $id_akun_jurnal = get_id_jurnal($koneksi);

        $id_akun_debet = $_POST['id_akun_debet'];        
        $sql_debet = "INSERT INTO akun_mutasi(id_akun_mutasi, id_akun_jurnal, id_akun, debet, kredit, dibuat_pada, diubah_pada) VALUES(DEFAULT, $id_akun_jurnal, $id_akun_debet, $nominal_transaksi, 0, DEFAULT, DEFAULT)";
        mysqli_query($koneksi,$sql_debet);

        $id_akun_kredit = $_POST['id_akun_kredit'];        
        $sql_kredit = "INSERT INTO akun_mutasi(id_akun_mutasi, id_akun_jurnal, id_akun, kredit, debet, dibuat_pada, diubah_pada) VALUES(DEFAULT, $id_akun_jurnal, $id_akun_kredit, $nominal_transaksi, 0, DEFAULT, DEFAULT)";
        mysqli_query($koneksi,$sql_kredit);

        pesan_transaksi($koneksi);
        header('location:../index.php?p=jurnal-tambah-biaya');
    } else if ($_POST['aksi'] == 'tambah-jurnal') {
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $deskripsi = $_POST['deskripsi'];
        $nomor_jurnal = ""; // $_POST['nomor_jurnal'];

        $sql = "INSERT INTO akun_jurnal(id_akun_jurnal, nomor_jurnal, deskripsi, tanggal_transaksi, dibuat_pada, diubah_pada) VALUES(DEFAULT,'$nomor_jurnal','$deskripsi','$tanggal_transaksi',DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);
        $id_akun_jurnal = get_id_jurnal($koneksi);
        $jumlah = count($_SESSION['jurnal_temporer']);
        for ($row = 0; $row < $jumlah; $row++) {
            $id_akun = $_SESSION['jurnal_temporer'][$row][0];
            $debet = $_SESSION['jurnal_temporer'][$row][2];
            $kredit = $_SESSION['jurnal_temporer'][$row][3];
            $sql_mutasi = "INSERT INTO akun_mutasi(id_akun_mutasi, id_akun_jurnal, id_akun, debet, kredit, dibuat_pada, diubah_pada) VALUES(DEFAULT, $id_akun_jurnal, $id_akun, $debet, $kredit, DEFAULT, DEFAULT)";
            mysqli_query($koneksi, $sql_mutasi);
            //echo $sql_mutasi."<br>";

        }
        $_SESSION['jurnal_temporer'] = array();
        pesan_transaksi($koneksi);
        header('location:../index.php?p=jurnal');
    } else if ($_POST['aksi'] == 'tambah-jurnal-temporer') {
        if (empty($_SESSION['jurnal_temporer'])) {
            $_SESSION['jurnal_temporer'] = array();
        }
        $id_akun = $_POST['id_akun'];
        $akun = $_POST['akun'];

        $posisi = $_POST['posisi'];
        if ($posisi == 'Debet') {
            $debet = $_POST['nominal'];
            $kredit = 0;
        } else {
            $debet = 0;
            $kredit = $_POST['nominal'];
        }

        $new_element = array($id_akun, $akun, $debet, $kredit);
        // $new_element=array(1,2,3);

        array_push($_SESSION['jurnal_temporer'], $new_element);
        $jumlah = count($_SESSION['jurnal_temporer']);
        for ($row = 0; $row < $jumlah; $row++) {
            echo $_SESSION['jurnal_temporer'][$row][0] . ",";
            echo $_SESSION['jurnal_temporer'][$row][1] . ",";
            echo $_SESSION['jurnal_temporer'][$row][2] . ",";
            echo $_SESSION['jurnal_temporer'][$row][3];
        }
        header('location:../index.php?p=jurnal-tambah');
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $x0 = $_GET['token'];
        // Jalankan Prosedur Cek Data
        $sql = "delete from akun_mutasi where md5(id_akun_mutasi)='$x0'";
        mysqli_query($koneksi, $sql);
        //echo $sql;
        header('location:../index.php?p=penjualan-info-kas');
    } else if ($_GET['aksi'] == 'reset-jurnal-temporer') {
        $_SESSION['jurnal_temporer'] = array();
        header('location:../index.php?p=jurnal-tambah');
    } else if ($_GET['aksi'] == 'delete-jurnal-temporer') {
        $_SESSION['jurnal_temporer'] = array();
        header('location:../index.php?p=jurnal-tambah');
    } else if($_GET['aksi'] == 'hapus-jurnal') {
        $x0 = $_GET['token'];
        // Jalankan Prosedur Cek Data
        $sql = "DELETE from akun_mutasi where md5(id_akun_jurnal)='$x0'";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        
        header('location:../index.php?p=jurnal');
    }
}
