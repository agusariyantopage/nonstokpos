<?php
$BASE_URL = "http://localhost/koperasi/";
session_start();
include "../koneksi.php";
include "../function.php";

if (!empty($_POST)) {
    if ($_POST['aksi'] == 'keranjang-tambah') {
        $id_user = $_SESSION['backend_user_id'];
        $produk = $_POST['produk'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $hpp = 0;

        $sql = "insert into keranjang (id_user, produk, harga, jumlah,hpp) values($id_user, '$produk', $harga, $jumlah,$hpp)";
        mysqli_query($koneksi, $sql);

        // echo $sql;
        header('location:../index.php?p=penjualan');
    } else if ($_POST['aksi'] == 'keranjang-ubah') {
        $x0 = $_POST['id'];
        $x1 = $_POST['qty'];
        $x2 = $_POST['harga'];
        $x3 = $_POST['produk'];
        $x2 = str_replace(',', '', $x2);
        $sql = "update keranjang set jumlah=$x1,harga=$x2,produk='$x3',diubah_pada=DEFAULT where id_keranjang=$x0";
        mysqli_query($koneksi, $sql);
        header('location:../index.php?p=penjualan');
    } else if ($_POST['aksi'] == 'simpan-penjualan') {
        $id_anggota = $_POST['id_anggota'];
        $id_user = $_SESSION['backend_user_id'];
        $metode_bayar = $_POST['metode_bayar'];
        $id_akun = $_POST['id_akun'];
        $keterangan_non_tunai = $_POST['keterangan_non_tunai'];
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $total = $_POST['total'];
        $diskon = $_POST['diskon'];
        $pajak = 0;
        $terbayar = $_POST['terbayar'];
        if ($terbayar >= $total - $diskon + $pajak) {
            $status_bayar = "Lunas";
            $terbayar = $total - $diskon + $pajak;
            $sisa=0;
        } else {
            $status_bayar = "Belum Lunas";
            $sisa=($total - $diskon + $pajak)-$terbayar;
        }

        $sql = "insert into jual (id_anggota, id_user, id_akun, keterangan_non_tunai, tanggal_transaksi, total, diskon, pajak, terbayar,status_bayar, dibuat_pada, diubah_pada) values($id_anggota,$id_user,$id_akun, '$keterangan_non_tunai','$tanggal_transaksi',$total,$diskon,$pajak,$terbayar,'$status_bayar',DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);


        // Simpan Detail Jual
        $sql1 = "select * from jual where id_user=$id_user order by id_jual desc limit 1";
        $query1 = mysqli_query($koneksi, $sql1);
        $kolom1 = mysqli_fetch_array($query1);
        $id_jual = $kolom1['id_jual'];

        $sql2 = "select * from keranjang where id_user=$id_user";
        $query2 = mysqli_query($koneksi, $sql2);
        while ($kolom2 = mysqli_fetch_array($query2)) {
            $produk = $kolom2['produk'];
            $hpp = $kolom2['hpp'];
            $harga_jual = $kolom2['harga'];
            $jumlah = $kolom2['jumlah'];

            $sql3 = "insert into jual_detail(id_jual, produk, hpp, harga_jual, jumlah, dibuat_pada, diubah_pada) values($id_jual,'$produk',$hpp,$harga_jual,$jumlah,DEFAULT,DEFAULT)";
            mysqli_query($koneksi, $sql3);
        }

        // Simpan Pembayaran
        $sql_pembayaran = "INSERT INTO jual_pembayaran(id_jual_pembayaran, id_jual, id_akun, keterangan, jumlah, tanggal_transaksi, dibuat_pada, diubah_pada) VALUES (DEFAULT, $id_jual, $id_akun, '$keterangan', $terbayar, '$tanggal_transaksi', DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql_pembayaran);

        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'SUKSES SIMPAN JUAL';
        }

        $deskripsi = "Transaksi Penjualan #" . $id_jual;

        // Jika Transaksi Luna Langsung Posting 1v1 Jika Tidak Posting 1v2
        if ($status_bayar == 'Lunas') {
            posting_jurnal($koneksi, $tanggal_transaksi, $deskripsi, $deskripsi, $id_akun, 40, $total); // 40 Kode Akun Pendapatan Penjualan
        } else {
            $nomor_jurnal = '';
            $sql = "INSERT INTO akun_jurnal(id_akun_jurnal, nomor_jurnal, deskripsi,deskripsi_transaksi, tanggal_transaksi, dibuat_pada, diubah_pada) VALUES(DEFAULT,'$nomor_jurnal','$deskripsi','$deskripsi','$tanggal_transaksi',DEFAULT,DEFAULT)";
            mysqli_query($koneksi, $sql);

            $id_akun_jurnal = get_id_jurnal($koneksi);

            // Kredit
            $sql_debet = "INSERT INTO akun_mutasi(id_akun_mutasi, id_akun_jurnal, id_akun, debet, kredit, dibuat_pada, diubah_pada) VALUES(DEFAULT, $id_akun_jurnal, 40, 0,$total, DEFAULT, DEFAULT)";
            mysqli_query($koneksi, $sql_debet);
            
            // Debet
            $sql_kredit1 = "INSERT INTO akun_mutasi(id_akun_mutasi, id_akun_jurnal, id_akun, kredit, debet, dibuat_pada, diubah_pada) VALUES(DEFAULT, $id_akun_jurnal, $id_akun, 0,$terbayar, DEFAULT, DEFAULT)";
            mysqli_query($koneksi, $sql_kredit1); // Jurnal DP
            $sql_kredit2 = "INSERT INTO akun_mutasi(id_akun_mutasi, id_akun_jurnal, id_akun, kredit, debet, dibuat_pada, diubah_pada) VALUES(DEFAULT, $id_akun_jurnal, 84, 0,$sisa, DEFAULT, DEFAULT)";
            mysqli_query($koneksi, $sql_kredit2); // Jurnal Piutang ID 84

        }

        $id_akun_jurnal = get_id_jurnal($koneksi);
        $sql_update_nomor_jurnal = "UPDATE jual SET id_akun_jurnal=$id_akun_jurnal WHERE id_jual=$id_jual";
        mysqli_query($koneksi, $sql_update_nomor_jurnal);

        // Kosongkan Keranjang
        $sql4 = "delete from keranjang where id_user=$id_user";
        mysqli_query($koneksi, $sql4);
        $url_struk = $BASE_URL . "pdf/output/struk.php?token=" . md5($id_jual);

        $link = 'location:../index.php?p=penjualan&last=' . md5($id_jual);
        header($link);
    } else if ($_POST['aksi'] == 'hapus-penjualan') {
        $id_jual = $_POST['id_jual'];
        $id_akun_jurnal = $_POST['id_akun_jurnal'];
        $deskripsi_transaksi = $_POST['deskripsi_transaksi'];

        // Delete Tabel Jual
        $sql1 = "delete from jual where id_jual=$id_jual";
        mysqli_query($koneksi, $sql1);
        pesan_transaksi($koneksi);

        // Delete Tabel Jual Detail
        $sql2 = "delete from jual_detail where id_jual=$id_jual";
        mysqli_query($koneksi, $sql2);

        // Delete Tabel Pembayaran
        $sql3 = "delete from jual_pembayaran where id_jual=$id_jual";
        mysqli_query($koneksi, $sql3);

        // Delete Tabel Jurnal Mutasi
        $sql5 = "DELETE am.* FROM akun_mutasi am INNER JOIN akun_jurnal aj ON am.id_akun_jurnal=aj.id_akun_jurnal WHERE (aj.deskripsi_transaksi='$deskripsi_transaksi')";
        mysqli_query($koneksi, $sql5);

        // Delete Tabel Jurnal
        $sql4 = "delete from akun_jurnal where deskripsi_transaksi='$deskripsi_transaksi'";
        mysqli_query($koneksi, $sql4);

        // echo $sql1."<br>";
        // echo $sql2."<br>";
        // echo $sql3."<br>";
        // echo $sql4."<br>";
        // echo $sql5."<br>";

        // Redirection
        header('location:../index.php?p=daftar-penjualan');
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'keranjang-hapus') {
        $x0 = $_GET['token'];
        $sql = "delete from keranjang where md5(id_keranjang)='$x0'";
        mysqli_query($koneksi, $sql);
        header('location:../index.php?p=penjualan');
    } else if ($_GET['aksi'] == 'keranjang-tambah') {
        $token = $_GET['token'];
        $sql1 = "select * from produk where md5(id_produk)='$token'";
        $query1 = mysqli_query($koneksi, $sql1);
        $ketemu = mysqli_num_rows($query1);
        if ($ketemu >= 1) {
            $kolom1 = mysqli_fetch_array($query1);
            $id_user = $_SESSION['backend_user_id'];
            $jumlah = 1;
            $id_produk = $kolom1['id_produk'];
            $harga = $kolom1['harga_jual'];
            $hpp = $kolom1['hpp'];
            // Cek Sudah Ada Dikeranjang ??
            $sql2 = "select * from keranjang where id_produk=$id_produk and id_user=$id_user";
            $query2 = mysqli_query($koneksi, $sql2);
            $ketemu = mysqli_num_rows($query2);
            if ($ketemu <= 0) {
                $sql = "insert into keranjang (id_user, id_produk, harga, jumlah,hpp) values($id_user, $id_produk, $harga, $jumlah,$hpp)";
            } else {
                $sql = "update keranjang set jumlah=jumlah+$jumlah,diubah_pada=DEFAULT where id_produk=$id_produk and id_user=$id_user";
            }
            mysqli_query($koneksi, $sql);
        }

        header('location:../index.php?p=penjualan');
    }
}
