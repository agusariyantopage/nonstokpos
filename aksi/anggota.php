<?php
session_start();
include "../koneksi.php";
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
    if ($_POST['aksi'] == 'tambah') {
        $no_identitas = $_POST['no_identitas'];
        $tanggal_bergabung = $_POST['tanggal_bergabung'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];
       

        $sql = "insert into anggota (no_identitas, tanggal_bergabung, nama, alamat, telepon, email, dibuat_pada, diubah_pada) values('$no_identitas', '$tanggal_bergabung', '$nama', '$alamat', '$telepon', '$email', DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        //echo $sql;
        header('location:../index.php?p=anggota');
    } else if ($_POST['aksi'] == 'ubah') {
        $id_anggota = $_POST['id_anggota'];
        $no_identitas = $_POST['no_identitas'];
        $tanggal_bergabung = $_POST['tanggal_bergabung'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];
        

        $sql = "update anggota set no_identitas='$no_identitas', tanggal_bergabung='$tanggal_bergabung', nama='$nama', alamat='$alamat', telepon='$telepon', email='$email', dibuat_pada=dibuat_pada, diubah_pada=DEFAULT where id_anggota=$id_anggota";
        // echo $sql;
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        header('location:../index.php?p=anggota');
    } else if ($_POST['aksi'] == 'hapus') {
        $x0 = $_POST['id_anggota'];
        $sql = "delete from anggota where id_anggota='$x0'";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);

        header('location:../index.php?p=anggota');
    } else if ($_POST['aksi'] == 'proses-poin') {
        $tanggal_awal = $_POST['tanggal_awal'];
        $tanggal_akhir = $_POST['tanggal_akhir'];
        $tanggal=date('Y-m-d');
        $poin = $_POST['poin'];

        $sql_while = "select jual.id_anggota,nama,alamat,is_individual,sum(total) as kontribusi from jual,anggota where is_individual=1 and jual.id_anggota=anggota.id_anggota and (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir') group by jual.id_anggota";
        $query_while=mysqli_query($koneksi, $sql_while);
        while($data_while=mysqli_fetch_array($query_while)){
            $id_anggota=$data_while['id_anggota'];
            $jumlah=$data_while['kontribusi'] / $poin;
            $keterangan="Poin Belanja Periode $tanggal_awal S/D $tanggal_akhir";

            $sql1="INSERT INTO anggota_mutasi_saldo(id_anggota,tanggal,jumlah,keterangan) VALUES($id_anggota,'$tanggal',$jumlah,'$keterangan')";
            $sql2="UPDATE anggota SET saldo=saldo+$jumlah WHERE id_anggota=$id_anggota";
            
            mysqli_query($koneksi,$sql1);
            mysqli_query($koneksi,$sql2);
            // echo $sql1."<br>";
            // echo $sql2."<br>";
        }
        pesan_transaksi($koneksi);
        header('location:../index.php?p=anggota');
    }
}

if (!empty($_GET['aksi'])) {

    if ($_GET['aksi'] == 'buang-spasi') {
        $sql = "update anggota set nama=trim(nama)";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        //echo $sql;
        header('location:../index.php?p=anggota');
    }
    if ($_GET['aksi'] == 'set-kapital') {
        $sql = "update anggota set nama=upper(nama)";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        //echo $sql;
        header('location:../index.php?p=anggota');
    }
    if ($_GET['aksi'] == 'set-proper') {
        $sql = "UPDATE anggota SET nama = CONCAT(UPPER(SUBSTRING(nama, 1, 1)), LOWER(SUBSTRING(nama FROM 2)))";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        //echo $sql;
        header('location:../index.php?p=anggota');
    }
    if ($_GET['aksi'] == 'balancing-saldo') {
        $id_anggota = $_GET['token'];
        $akumulasi = $_GET['akumulasi'];
        $sql = "UPDATE anggota SET saldo=$akumulasi WHERE md5(id_anggota)='$id_anggota'";
        mysqli_query($koneksi, $sql);
        pesan_transaksi($koneksi);
        //echo $sql;
        $link = "location:../index.php?p=anggota-saldo-individu&token=" . $id_anggota;
        header($link);
    }
}
