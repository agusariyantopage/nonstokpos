<?php
$BASE_URL = "http://localhost/koperasi/";
session_start();
include "../koneksi.php";
$id_user = $_SESSION['backend_user_id'];

function pesan_transaksi($koneksi)
{
    $sukses = mysqli_affected_rows($koneksi);
    if ($sukses >= 1) {
        $_SESSION['status_proses'] = 'SUKSES';
    } else {
        $_SESSION['status_proses'] = 'GAGAL';
    }
}

function hitung_ulang_saldo($koneksi, $id_pinjaman)
{
    // Update Saldo Pinjaman
    $sql_update_saldo = "UPDATE pinjaman SET saldo_terakhir=jumlah_pinjaman-COALESCE((SELECT SUM(cicilan_pokok) FROM pinjaman_mutasi WHERE id_pinjaman=$id_pinjaman),0) WHERE id_pinjaman=$id_pinjaman";
    mysqli_query($koneksi, $sql_update_saldo);

    // Update Status Lunas
    $sql_update_status = "UPDATE pinjaman SET status_pinjaman='LUNAS' WHERE id_pinjaman=$id_pinjaman AND saldo_terakhir<=0";
    mysqli_query($koneksi, $sql_update_status);

    // Update Status Belum Lunas
    $sql_update_status = "UPDATE pinjaman SET status_pinjaman='AKTIF' WHERE id_pinjaman=$id_pinjaman AND saldo_terakhir>0";
    mysqli_query($koneksi, $sql_update_status);
}

if (!empty($_POST)) {
    if ($_POST['aksi'] == 'simpan-pinjaman') { // Input pinjaman yang dibayarkan per-bulan (TAHARA & SIDIDIK)
        $id_anggota = $_POST['id_anggota'];
        $tanggal_transaksi = $_POST['tanggal_awal_kontrak'];
        $tanggal_awal_kontrak = $_POST['tanggal_awal_kontrak'];
        $tanggal_akhir_kontrak = $_POST['tanggal_akhir_kontrak'];
        $durasi_kontrak_bulan = $_POST['durasi_kontrak_bulan'];
        $bunga_tahunan = $_POST['bunga_tahunan'];
        $jumlah_pinjaman = $_POST['jumlah_pinjaman'];
        $pagu_bulanan = $_POST['pagu_bulanan'];
        $jaminan = $_POST['jaminan'];
        $nilai_jaminan = $_POST['nilai_jaminan'];

        $sql = "insert into pinjaman (id_anggota, id_user, tanggal_transaksi, tanggal_awal_kontrak, tanggal_akhir_kontrak, durasi_kontrak_bulan, bunga_tahunan, jumlah_pinjaman, jaminan, nilai_jaminan, pagu_bulanan, saldo_terakhir, dibuat_pada, diubah_pada, status_pinjaman) values($id_anggota, $id_user, '$tanggal_transaksi', '$tanggal_awal_kontrak', '$tanggal_akhir_kontrak', $durasi_kontrak_bulan, $bunga_tahunan, $jumlah_pinjaman, '$jaminan', $nilai_jaminan, $pagu_bulanan,$jumlah_pinjaman,DEFAULT,DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);

        // Simpan Pinjaman Detail
        $sql1 = "select * from pinjaman where id_user=$id_user order by id_pinjaman desc limit 1";
        $query1 = mysqli_query($koneksi, $sql1);
        $kolom1 = mysqli_fetch_array($query1);

        for ($i = 0; $i < $durasi_kontrak_bulan; $i++) {
            $id_pinjaman = $kolom1['id_pinjaman'];
            $urut = $_POST['urut'][$i];
            $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'][$i];
            $anggaran_pembayaran = $_POST['anggaran_pembayaran'][$i];
            $bunga_persentase = $_POST['bunga_persentase'][$i];
            $bunga_nominal = $_POST['bunga_nominal'][$i];
            $anggaran_saldo_akhir = $_POST['anggaran_saldo_akhir'][$i];
            $sql2 = "insert into pinjaman_detail(id_pinjaman, urut, tanggal_jatuh_tempo, tanggal_realisasi_bayar, anggaran_pembayaran, realisasi_pembayaran, bunga_persentase, bunga_nominal, anggaran_saldo_akhir, realisasi_saldo_akhir, dibuat_pada, diubah_pada, diterima_oleh) values($id_pinjaman, $urut, '$tanggal_jatuh_tempo', DEFAULT, $anggaran_pembayaran, DEFAULT, $bunga_persentase, $bunga_nominal, $anggaran_saldo_akhir, DEFAULT, DEFAULT, DEFAULT, DEFAULT)";
            //echo $sql2."<br>";
            mysqli_query($koneksi, $sql2);
        }

        pesan_transaksi($koneksi);
        header('location:../index.php?p=pinjaman');
    } else if ($_POST['aksi'] == 'pinjaman-input-bayar') {

        $id_pinjaman = $_POST['id_pinjaman'];
        $urut = $_POST['urut'];
        $tanggal_transaksi = $_POST['tanggal_realisasi_bayar'];
        $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];
        $jenis_transaksi = "Pembayaran";
        $cicilan_pokok = str_replace(',', '', $_POST['cicilan_pokok']);
        $bunga = str_replace(',', '', $_POST['bunga']);
        $bunga_persentase = 0;
        $saldo = 0;
        $keterangan = "Pembayaran Cicilan Pinjaman Ke-" . $urut;


        $sql = "INSERT INTO pinjaman_mutasi(id_pinjaman, urut, tanggal_transaksi, jenis_transaksi, cicilan_pokok, bunga_persentase, bunga_nominal, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES($id_pinjaman, $urut, '$tanggal_transaksi', '$jenis_transaksi', $cicilan_pokok, $bunga, $bunga, -$cicilan_pokok+(SELECT saldo_terakhir FROM pinjaman WHERE id_pinjaman=$id_pinjaman), '$keterangan', $id_user, DEFAULT, DEFAULT)";
        mysqli_query($koneksi, $sql);

        $sql = "UPDATE pinjaman_detail SET tanggal_realisasi_bayar='$tanggal_transaksi',realisasi_pembayaran=$cicilan_pokok,realisasi_saldo_akhir=-$cicilan_pokok+(SELECT saldo_terakhir FROM pinjaman WHERE id_pinjaman=$id_pinjaman),diubah_pada=DEFAULT WHERE id_pinjaman=$id_pinjaman AND urut=$urut";
        echo $sql;
        mysqli_query($koneksi, $sql);

        pesan_transaksi($koneksi);
        hitung_ulang_saldo($koneksi, $id_pinjaman);

        $link = 'location:../index.php?p=pinjaman-mutasi&id=' . $id_pinjaman;
        header($link);
    } else if ($_POST['aksi'] == 'autopay') {
        $periode_mulai = $_POST['periode_mulai'];
        $periode_selesai = $_POST['periode_selesai'];
        $tanggal_transaksi = $_POST['tanggal_transaksi'];

        $sql = "SELECT pinjaman_detail.*,pinjaman.potong_otomatis,pinjaman.durasi_kontrak_bulan,pinjaman.bunga_tahunan,anggota.nama FROM pinjaman_detail,pinjaman,anggota WHERE pinjaman_detail.id_pinjaman=pinjaman.id_pinjaman AND pinjaman.id_anggota=anggota.id_anggota AND pinjaman_detail.tanggal_jatuh_tempo <= '$periode_selesai' AND pinjaman_detail.tanggal_realisasi_bayar IS NULL AND pinjaman.potong_otomatis=1";
        $query = mysqli_query($koneksi, $sql);
        while ($kolom = mysqli_fetch_array($query)) {
            $id_pinjaman = $kolom['id_pinjaman'];
            $urut = $kolom['urut'];
            $tanggal_jatuh_tempo = $kolom['tanggal_jatuh_tempo'];
            $jenis_transaksi = "Pembayaran";
            $cicilan_pokok = $kolom['anggaran_pembayaran'];
            $bunga = $kolom['bunga_nominal'];
            $bunga_persentase = $kolom['bunga_tahunan'] / $kolom['durasi_kontrak_bulan'];
            $keterangan = "Pembayaran Cicilan Pinjaman Ke-" . $urut;

            // Insert Ke Mutasi Pinjaman
            $sql = "INSERT INTO pinjaman_mutasi(id_pinjaman, urut, tanggal_transaksi, jenis_transaksi, cicilan_pokok, bunga_persentase, bunga_nominal, saldo, keterangan, id_user, dibuat_pada, diubah_pada) VALUES($id_pinjaman, $urut, '$tanggal_transaksi', '$jenis_transaksi', $cicilan_pokok, $bunga_persentase, $bunga, -$cicilan_pokok+(SELECT saldo_terakhir FROM pinjaman WHERE id_pinjaman=$id_pinjaman), '$keterangan', $id_user, DEFAULT, DEFAULT)";
            // echo $sql."<br>";
            //mysqli_query($koneksi, $sql);


            // Update Anggaran Pembayaran
            $sql = "UPDATE pinjaman_detail SET tanggal_realisasi_bayar='$tanggal_transaksi',realisasi_pembayaran=$cicilan_pokok,realisasi_saldo_akhir=-$cicilan_pokok+(SELECT saldo_terakhir FROM pinjaman WHERE id_pinjaman=$id_pinjaman),auto_pay=1,diubah_pada=DEFAULT WHERE id_pinjaman=$id_pinjaman AND urut=$urut";            
            mysqli_query($koneksi, $sql);

            hitung_ulang_saldo($koneksi, $id_pinjaman);
        }
        pesan_transaksi($koneksi);
        header('location:../index.php?p=pinjaman');
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'rekalkulasi-mutasi') {
        $id_pinjaman = $_GET['id'];

        $sql_loop = "SELECT * FROM pinjaman_mutasi WHERE id_pinjaman=$id_pinjaman ORDER BY urut";
        $query_loop = mysqli_query($koneksi, $sql_loop);
        $saldo = 0;
        while ($data_loop = mysqli_fetch_array($query_loop)) {
            $id_pinjaman_mutasi = $data_loop['id_pinjaman_mutasi'];
            $urut = $data_loop['urut'];
            $sql_update_saldo = "UPDATE pinjaman_mutasi SET saldo=(SELECT jumlah_pinjaman FROM pinjaman WHERE id_pinjaman=$id_pinjaman)-(SELECT SUM(cicilan_pokok) FROM pinjaman_mutasi WHERE id_pinjaman=$id_pinjaman AND urut<=$urut) WHERE id_pinjaman_mutasi=$id_pinjaman_mutasi";

            mysqli_query($koneksi, $sql_update_saldo);
        }
        pesan_transaksi($koneksi);
        hitung_ulang_saldo($koneksi, $id_pinjaman);
        // echo $sql_update_saldo;       

        $link = 'location:../index.php?p=pinjaman-mutasi&id=' . $id_pinjaman;
        header($link);
    }
}
