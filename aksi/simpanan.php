<?php
$BASE_URL = "http://localhost/koperasi/";
session_start();
include "../koneksi.php";
$id_user = $_SESSION['backend_user_id'];

if (!empty($_POST)) {
    if ($_POST['aksi'] == 'keranjang-tambah') {
        header('location:../index.php?p=penjualan');
    } else if ($_POST['aksi'] == 'keranjang-ubah') {
        header('location:../index.php?p=penjualan');
    } else if ($_POST['aksi'] == 'simpan-simpanan') { // Input simpanan yang dibayarkan per-bulan (TAHARA & SIDIDIK)
        $id_anggota = $_POST['id_anggota'];
        $id_user = $_SESSION['backend_user_id'];
        $id_simpanan_jenis = $_POST['id_simpanan_jenis'];
        $tanggal_transaksi = $_POST['tanggal_awal_kontrak'];
        $tanggal_awal_kontrak = $_POST['tanggal_awal_kontrak'];
        $durasi_kontrak_bulan = $_POST['durasi_kontrak_bulan'];
        $tanggal_akhir_kontrak = $_POST['tanggal_jatuh_tempo'][$durasi_kontrak_bulan - 1];
        $bunga_tahunan = $_POST['bunga_tahunan'];
        $jumlah_simpanan = $_POST['jumlah_simpanan'];

        $sql = "insert into simpanan (id_anggota, id_user, id_simpanan_jenis, tanggal_transaksi, tanggal_awal_kontrak, tanggal_akhir_kontrak, durasi_kontrak_bulan, bunga_tahunan, jumlah_simpanan, dibuat_pada, diubah_pada, status_simpanan) values($id_anggota, $id_user, '$id_simpanan_jenis', '$tanggal_transaksi', '$tanggal_awal_kontrak', '$tanggal_akhir_kontrak', $durasi_kontrak_bulan, $bunga_tahunan, $jumlah_simpanan,DEFAULT,DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);
        //echo $sql;
        // Simpan Detail Jual
        $sql1 = "select * from simpanan where id_user=$id_user order by id_simpanan desc limit 1";
        $query1 = mysqli_query($koneksi, $sql1);
        $kolom1 = mysqli_fetch_array($query1);
        //$id_jual=$kolom1['id_jual'];
        for ($i = 0; $i < $durasi_kontrak_bulan; $i++) {
            $id_simpanan = $kolom1['id_simpanan'];
            $urut = $_POST['urut'][$i];
            $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'][$i];
            $anggaran_pembayaran = $_POST['anggaran_pembayaran'][$i];
            $bunga_persentase = $_POST['bunga_persentase'][$i];
            $bunga_nominal = $_POST['bunga_nominal'][$i];
            $anggaran_saldo_akhir = $_POST['anggaran_saldo_akhir'][$i];
            $sql2 = "insert into simpanan_detail(id_simpanan, urut, tanggal_jatuh_tempo, tanggal_realisasi_bayar, anggaran_pembayaran, realisasi_pembayaran, bunga_persentase, bunga_nominal, anggaran_saldo_akhir, realisasi_saldo_akhir, dibuat_pada, diubah_pada, diterima_oleh) values($id_simpanan, $urut, '$tanggal_jatuh_tempo', DEFAULT, $anggaran_pembayaran, DEFAULT, $bunga_persentase, $bunga_nominal, $anggaran_saldo_akhir, DEFAULT, DEFAULT, DEFAULT, DEFAULT)";
            //echo $sql2."<br>";
            mysqli_query($koneksi, $sql2);
        }
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'SUKSES';
        }

        header('location:../index.php?p=simpanan');
    } else if ($_POST['aksi'] == 'simpan-simpanan-sw') {
        $id_anggota = $_POST['id_anggota'];
        $id_user = $_SESSION['backend_user_id'];
        $id_simpanan_jenis = $_POST['id_simpanan_jenis'];
        $tanggal_transaksi = $_POST['tanggal_awal_kontrak'];
        $tanggal_awal_kontrak = $_POST['tanggal_awal_kontrak'];
        $saldo_terakhir = $_POST['saldo_terakhir'];

        $sql = "insert into simpanan (id_anggota, id_user, id_simpanan_jenis, tanggal_transaksi, tanggal_awal_kontrak, tanggal_akhir_kontrak, durasi_kontrak_bulan, bunga_tahunan, saldo_terakhir, dibuat_pada, diubah_pada, status_simpanan) values($id_anggota, $id_user, '$id_simpanan_jenis', '$tanggal_transaksi', '$tanggal_awal_kontrak', DEFAULT, DEFAULT, DEFAULT, $saldo_terakhir,DEFAULT,DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);
        //echo $sql;

        // Input Data Setoran Awal Ke Mutasi Rekening (simpanan_mutasi)
        $sql_get_id_simpanan = "SELECT * FROM simpanan WHERE id_anggota=$id_anggota AND id_simpanan_jenis=$id_simpanan_jenis ORDER BY id_simpanan DESC LIMIT 1";
        $query_get_id_simpanan = mysqli_query($koneksi, $sql_get_id_simpanan);
        $data_get_id_simpanan = mysqli_fetch_array($query_get_id_simpanan);
        $id_simpanan = $data_get_id_simpanan['id_simpanan'];
        $sql_input_mutasi = "INSERT INTO simpanan_mutasi (id_simpanan, tanggal_transaksi, jenis_transaksi, jumlah, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES ($id_simpanan, '$tanggal_transaksi', 'Setoran', $saldo_terakhir, $saldo_terakhir, 'Setoran Awal', $id_user, DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql_input_mutasi);
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'SUKSES';
        }
        //echo $sql_input_mutasi;
        header('location:../index.php?p=simpanan');
    } else if ($_POST['aksi'] == 'simpanan-input-bayar') {
        $id_simpanan_detail = $_POST['id_simpanan_detail'];
        $id_simpanan = $_POST['id_simpanan'];
        $tanggal_realisasi_bayar = $_POST['tanggal_realisasi_bayar'];
        $realisasi_pembayaran = $_POST['realisasi_pembayaran'];
        $urut = $_POST['urut'];

        // Variabel Untuk Input Ke Simpanan Mutasi
        $tanggal_transaksi = $tanggal_realisasi_bayar;
        $jumlah = $realisasi_pembayaran;
        $jenis_transaksi = "Setoran";
        $keterangan = "Pembayaran Simpanan Ke-" . $urut;

        $sql_ambil_bunga = "SELECT * FROM simpanan_detail WHERE id_simpanan_detail=$id_simpanan_detail";
        $data_bunga = mysqli_fetch_array(mysqli_query($koneksi, $sql_ambil_bunga));
        $bunga_nominal = $data_bunga['bunga_nominal'];
        $jenis_transaksi_bunga = "Bunga";
        $keterangan_bunga = "Pembayaran Bunga Simpanan Ke-" . $urut;


        $sql = "UPDATE simpanan_detail SET tanggal_realisasi_bayar='$tanggal_realisasi_bayar',realisasi_pembayaran=realisasi_pembayaran+$realisasi_pembayaran,diubah_pada=DEFAULT WHERE id_simpanan_detail=$id_simpanan_detail";
        mysqli_query($koneksi, $sql);

        // Input Mutasi Setoran
        $sql = "INSERT INTO simpanan_mutasi(id_simpanan, tanggal_transaksi, jenis_transaksi, jumlah, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES ($id_simpanan, '$tanggal_transaksi', '$jenis_transaksi', $jumlah, $jumlah+(SELECT saldo_terakhir FROM simpanan WHERE id_simpanan=$id_simpanan), '$keterangan', $id_user, DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql);
        // Update Saldo Simpanan &
        $sql_update_saldo = "UPDATE simpanan SET saldo_terakhir=(SELECT SUM(jumlah) FROM simpanan_mutasi WHERE id_simpanan=$id_simpanan) WHERE id_simpanan=$id_simpanan";
        mysqli_query($koneksi, $sql_update_saldo);

        // Input Mutasi Bunga
        $sql = "INSERT INTO simpanan_mutasi(id_simpanan, tanggal_transaksi, jenis_transaksi, jumlah, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES ($id_simpanan, '$tanggal_transaksi', '$jenis_transaksi_bunga', $bunga_nominal, $bunga_nominal+(SELECT saldo_terakhir FROM simpanan WHERE id_simpanan=$id_simpanan), '$keterangan_bunga', $id_user, DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql);
        // Update Saldo Simpanan &
        $sql_update_saldo = "UPDATE simpanan SET saldo_terakhir=(SELECT SUM(jumlah) FROM simpanan_mutasi WHERE id_simpanan=$id_simpanan) WHERE id_simpanan=$id_simpanan";
        mysqli_query($koneksi, $sql_update_saldo);

        //echo $sql;
        $link = 'location:../index.php?p=simpanan-mutasi&id=' . $id_simpanan;
        header($link);
    } else if ($_POST['aksi'] == 'tambah-mutasi') {

        $id_simpanan = $_POST['id_simpanan'];
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $jenis_transaksi = $_POST['jenis_transaksi'];

        if ($jenis_transaksi == 'Tarikan' || $jenis_transaksi == 'Biaya') {
            $jumlah = $_POST['jumlah'] * -1;
        } else {
            $jumlah = $_POST['jumlah'];
        }

        $keterangan = $_POST['keterangan'];
        $id_user = $_SESSION['backend_user_id'];

        $sql = "INSERT INTO simpanan_mutasi(id_simpanan, tanggal_transaksi, jenis_transaksi, jumlah, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES ($id_simpanan, '$tanggal_transaksi', '$jenis_transaksi', $jumlah, $jumlah+(SELECT saldo_terakhir FROM simpanan WHERE id_simpanan=$id_simpanan), '$keterangan', $id_user, DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql);
        //echo $sql;

        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'SUKSES';
        }

        // Update Saldo Simpanan &
        $sql_update_saldo = "UPDATE simpanan SET saldo_terakhir=(SELECT SUM(jumlah) FROM simpanan_mutasi WHERE id_simpanan=$id_simpanan) WHERE id_simpanan=$id_simpanan";
        mysqli_query($koneksi, $sql_update_saldo);

        //echo $sql;
        $link = 'location:../index.php?p=simpanan-mutasi&id=' . $id_simpanan;
        header($link);
    } else if ($_POST['aksi'] == 'proses-bunga') {

        $id_simpanan = $_POST['id_simpanan'];
        $tanggal_awal = $_POST['tanggal_awal'];
        $tanggal_akhir = $_POST['tanggal_akhir'];
        $bunga = $_POST['bunga'];
        $jenis_transaksi = "Bunga";
        $id_user = $_SESSION['backend_user_id'];
        $keterangan = "Bunga " . $bunga . "% Periode " . $tanggal_awal . " S/D " . $tanggal_akhir;

        $sql_cek = "SELECT * FROM simpanan_mutasi WHERE tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND id_simpanan=$id_simpanan AND jenis_transaksi='BUNGA'";

        $query_cek = mysqli_query($koneksi, $sql_cek);
        $ketemu = mysqli_num_rows($query_cek);
        if ($ketemu >= 1) {
            echo "Proses Gagal Karena , Bunga Sudah Dibayarkan";
        } else {
            // echo "Proses Dilanjutkan";

            // Ambil Saldo Terendah
            $sql_get_saldo1 = "SELECT * FROM simpanan_mutasi WHERE tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND id_simpanan=$id_simpanan ORDER BY saldo ASC LIMIT 1";
            $query_get_saldo1 = mysqli_query($koneksi, $sql_get_saldo1);
            $ketemu_get_saldo1 = mysqli_num_rows($query_get_saldo1);
            if ($ketemu_get_saldo1 >= 1) {
                $data_get_saldo1 = mysqli_fetch_array($query_get_saldo1);
                $saldo_hitung_bunga = $data_get_saldo1['saldo'];
            } else {
                $sql_get_saldo2 = "SELECT * FROM simpanan_mutasi WHERE tanggal_transaksi < '$tanggal_awal' AND id_simpanan=$id_simpanan ORDER BY tanggal_transaksi DESC LIMIT 1";
                $query_get_saldo2 = mysqli_query($koneksi, $sql_get_saldo2);
                $data_get_saldo2 = mysqli_fetch_array($query_get_saldo2);
                $saldo_hitung_bunga = $data_get_saldo2['saldo'];
            }

            $bunga_nominal = ($bunga / 100) * $saldo_hitung_bunga;

            //echo number_format($bunga_nominal);

            if ($bunga_nominal > 0) {
                $sql = "INSERT INTO simpanan_mutasi(id_simpanan, tanggal_transaksi, jenis_transaksi, jumlah, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES ($id_simpanan, '$tanggal_akhir', '$jenis_transaksi', $bunga_nominal, $bunga_nominal+(SELECT saldo_terakhir FROM simpanan WHERE id_simpanan=$id_simpanan), '$keterangan', $id_user, DEFAULT, DEFAULT)";
                mysqli_query($koneksi, $sql);
                $sukses = mysqli_affected_rows($koneksi);
                if ($sukses >= 1) {
                    $_SESSION['status_proses'] = 'SUKSES';
                }

                $sql_update_saldo = "UPDATE simpanan SET saldo_terakhir=(SELECT SUM(jumlah) FROM simpanan_mutasi WHERE id_simpanan=$id_simpanan) WHERE id_simpanan=$id_simpanan";
                mysqli_query($koneksi, $sql_update_saldo);
            }
        }


        //echo $sql;
        $link = 'location:../index.php?p=simpanan-mutasi&id=' . $id_simpanan;
        header($link);
    } else if ($_POST['aksi'] == 'autopay') {
        // Looping Data Pada Transaksi Yang Terpilih Berdasarkan Tanggal
        $periode_mulai = $_POST['periode_mulai'];
        $periode_selesai = $_POST['periode_selesai'];
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $sql = "SELECT simpanan_detail.*,simpanan.id_simpanan_jenis,simpanan.potong_otomatis,anggota.nama,simpanan_jenis.jenis_simpanan FROM simpanan_detail,simpanan,anggota,simpanan_jenis WHERE simpanan_detail.id_simpanan=simpanan.id_simpanan AND simpanan.id_anggota=anggota.id_anggota AND simpanan.id_simpanan_jenis=simpanan_jenis.id_simpanan_jenis AND simpanan_detail.tanggal_jatuh_tempo BETWEEN '$periode_mulai' AND '$periode_selesai' AND simpanan_detail.tanggal_realisasi_bayar IS NULL AND simpanan.potong_otomatis=1";
        $query = mysqli_query($koneksi, $sql);
        while ($kolom = mysqli_fetch_array($query)) {
            $tanggal_realisasi_bayar = $tanggal_transaksi;
            $id_simpanan = $kolom['id_simpanan'];
            $id_simpanan_detail = $kolom['id_simpanan_detail'];
            $realisasi_pembayaran = $kolom['anggaran_pembayaran'];
            $urut=$kolom['urut'];

            $sql_update_simpanan_detail = "UPDATE simpanan_detail SET tanggal_realisasi_bayar='$tanggal_realisasi_bayar',realisasi_pembayaran=realisasi_pembayaran+$realisasi_pembayaran,auto_pay=1,diubah_pada=DEFAULT WHERE id_simpanan_detail=$id_simpanan_detail";
            //echo $sql_update_simpanan_detail,"<br>";
            mysqli_query($koneksi,$sql_update_simpanan_detail);

            // Input Ke Mutasi Simpanan
            $jumlah = $realisasi_pembayaran;
            $jenis_transaksi = "Setoran";
            $keterangan = "Pembayaran Simpanan Ke-" . $urut;
            $bunga_nominal = $kolom['bunga_nominal'];
            $jenis_transaksi_bunga = "Bunga";
            $keterangan_bunga = "Pembayaran Bunga Simpanan Ke-" . $urut;


            // Input Mutasi Setoran
            $sql = "INSERT INTO simpanan_mutasi(id_simpanan, tanggal_transaksi, jenis_transaksi, jumlah, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES ($id_simpanan, '$tanggal_transaksi', '$jenis_transaksi', $jumlah, $jumlah+(SELECT saldo_terakhir FROM simpanan WHERE id_simpanan=$id_simpanan), '$keterangan', $id_user, DEFAULT, DEFAULT)";
            echo $sql."<br>";
            mysqli_query($koneksi, $sql);

            // // Update Saldo Simpanan &
            $sql_update_saldo = "UPDATE simpanan SET saldo_terakhir=(SELECT SUM(jumlah) FROM simpanan_mutasi WHERE id_simpanan=$id_simpanan) WHERE id_simpanan=$id_simpanan";
            mysqli_query($koneksi, $sql_update_saldo);

            // Input Mutasi Bunga
            $sql = "INSERT INTO simpanan_mutasi(id_simpanan, tanggal_transaksi, jenis_transaksi, jumlah, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES ($id_simpanan, '$tanggal_transaksi', '$jenis_transaksi_bunga', $bunga_nominal, $bunga_nominal+(SELECT saldo_terakhir FROM simpanan WHERE id_simpanan=$id_simpanan), '$keterangan_bunga', $id_user, DEFAULT, DEFAULT)";
            echo $sql."<br>";
            mysqli_query($koneksi, $sql);
            
            // // Update Saldo Simpanan &
            $sql_update_saldo = "UPDATE simpanan SET saldo_terakhir=(SELECT SUM(jumlah) FROM simpanan_mutasi WHERE id_simpanan=$id_simpanan) WHERE id_simpanan=$id_simpanan";
            mysqli_query($koneksi, $sql_update_saldo);
        }
        header('location:../index.php?p=simpanan');
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'rekalkulasi-mutasi') {
        $id_simpanan = $_GET['id'];

        $sql_loop = "SELECT * FROM simpanan_mutasi WHERE id_simpanan=$id_simpanan";
        $query_loop = mysqli_query($koneksi, $sql_loop);
        $saldo = 0;
        while ($data_loop = mysqli_fetch_array($query_loop)) {
            $id_simpanan_mutasi = $data_loop['id_simpanan_mutasi'];
            $saldo = $saldo + $data_loop['jumlah'];
            $sql_update_saldo = "UPDATE simpanan_mutasi SET saldo=$saldo WHERE id_simpanan_mutasi=$id_simpanan_mutasi";
            //echo $sql_update_saldo."<br>";

            mysqli_query($koneksi, $sql_update_saldo);
        }
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'SUKSES';
        } else {
            $_SESSION['status_proses'] = 'GAGAL';
        }

        $sql_update_saldo = "UPDATE simpanan SET saldo_terakhir=(SELECT SUM(jumlah) FROM simpanan_mutasi WHERE id_simpanan=$id_simpanan) WHERE id_simpanan=$id_simpanan";
        mysqli_query($koneksi, $sql_update_saldo);

        $link = 'location:../index.php?p=simpanan-mutasi&id=' . $id_simpanan;
        header($link);
    }
}
