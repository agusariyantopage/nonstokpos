<?php
session_start();
include "../koneksi.php";
include "../function.php";

if (!empty($_POST)) {    
    if ($_POST['aksi'] == 'tambah') {
        $id_jual = $_POST['id_jual'];
        $id_akun = $_POST['id_akun'];        
        $jumlah = $_POST['jumlah'];
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $deskripsi = "Transaksi Penjualan #" . $id_jual;
        $keterangan = "Pembayaran Sisa Tagihan ".$deskripsi;
       
        // Simpan Pembayaran
        $sql_pembayaran = "INSERT INTO jual_pembayaran(id_jual_pembayaran, id_jual, id_akun, keterangan, jumlah, tanggal_transaksi, dibuat_pada, diubah_pada) VALUES (DEFAULT, $id_jual, $id_akun, '$keterangan', $jumlah, '$tanggal_transaksi', DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql_pembayaran);
        echo $sql_pembayaran;
        pesan_transaksi($koneksi);
        
        posting_jurnal($koneksi, $tanggal_transaksi, $keterangan, $deskripsi, $id_akun, 84, $jumlah); // 84 Piutang Penjualan

        cek_status_lunas_penjualan($koneksi,$id_jual);        

        $link = 'location:../index.php?p=daftar-penjualan';
        header($link);
        
    } else if ($_POST['aksi'] == 'hapus-penjualan') {
        
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'keranjang-hapus') {
       
        header('location:../index.php?p=penjualan');
    } 
}
