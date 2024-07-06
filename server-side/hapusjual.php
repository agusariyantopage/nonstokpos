<?php
session_start();
$backend_level=$_SESSION['backend_level'];
include "../function.php";
include "../koneksi.php";
$id_jual = $_POST['idjual'];
$sql1 = "SELECT jual.*,anggota.nama as napel,akun.akun from jual,anggota,akun where jual.id_akun=akun.id_akun and jual.id_anggota=anggota.id_anggota and id_jual='$id_jual'";

$query1 = mysqli_query($koneksi, $sql1);
$kolom1 = mysqli_fetch_array($query1);

echo '

<div class="row">
		<div class="col-md-3 col-sm-6">No Transaksi</div>
		<div class="col-md-3 col-sm-6">: #' . $kolom1['id_jual'] . ' </div>
		<div class="col-md-3 col-sm-6">Tanggal Transaksi</div>
		<div class="col-md-3 col-sm-6">: ' . $kolom1['tanggal_transaksi'] . '</div>
</div>
<div class="row">
		<div class="col-md-3">Anggota</div>
		<div class="col-md-3">: ' . $kolom1['napel'] . ' </div>
		<div class="col-md-3">Metode Pembayaran</div>
		<div class="col-md-3">: ' . $kolom1['status_bayar'] . '</div>
</div><br><b>DAMPAK PENGHAPUSAN</b>';
?>
<form action="aksi/penjualan.php" method="post">
    <table class="table table-bordered table-striped" style="width:100%;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Data Saat Ini</th>
                <th scope="col">Perubahan</th>
                <th scope="col">Menjadi</th>
            </tr>
        </thead>
        <tbody>

            <input type="hidden" name="aksi" value="hapus-penjualan">
            <input type="hidden" name="id_jual" value="<?= $kolom1['id_jual']; ?>">
            <input type="hidden" name="id_akun_jurnal" value="<?= $kolom1['id_akun_jurnal']; ?>">
            <input type="hidden" name="id_anggota" value="<?= $kolom1['id_anggota']; ?>">

            <tr>
                <td>1</td>
                <td><b>Penghapusan Data Jual Detail</b></td>
                <td align=right><?= get_jumlah_data($koneksi,'jual_detail','id_jual',$id_jual); ?> Data</td>
                <td align=right style='width:150px;'>-- Dihapus --</td>
                <td align=right>-- Terhapus --</td>
            </tr>

            <tr>
                <td>2</td>
                <td><b>Penghapusan Data Pembayaran</b></td>
                <td align=right><?= get_jumlah_data($koneksi,'jual_pembayaran','id_jual',$id_jual); ?> Data</td>
                <td align=right style='width:150px;'>-- Dihapus --</td>
                <td align=right>-- Terhapus --</td>
            </tr>
            <tr>
                <td>3</td>
                <td><b>Penghapusan Data Jurnal Keuangan</b></td>
                <td align=right><?= get_jumlah_data($koneksi,'akun_jurnal','deskripsi_transaksi','Transaksi Penjualan #'.$id_jual); ?> Data</td>
                <td align=right style='width:150px;'>-- Dihapus --</td>
                <td align=right>-- Terhapus --</td>
            </tr>
            <tr>
                <td>4</td>
                <td><b>Penghapusan Data Mutasi Jurnal Keuangan</b></td>
                <td align=right>
                    <?php
                     $deskripsi_transaksi='Transaksi Penjualan #'.$id_jual;
                     $sql2="SELECT akun_mutasi.* FROM akun_jurnal,akun_mutasi WHERE akun_jurnal.id_akun_jurnal=akun_mutasi.id_akun_jurnal AND akun_jurnal.deskripsi_transaksi='$deskripsi_transaksi'"; 
                     $jumlah=mysqli_num_rows(mysqli_query($koneksi,$sql2));
                    //  echo $sql2;
                     ?> 
                    <?= $jumlah; ?> Data
                </td>
                <td align=right style='width:150px;'>-- Dihapus --</td>
                <td align=right>-- Terhapus --</td>
            </tr>
            <input type="hidden" name="deskripsi_transaksi" value="<?= $deskripsi_transaksi; ?>">


            

        </tbody>

    </table>

    <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data transaksi ini?')" <?php if($backend_level>1){?>disabled <?php } ?>><i class="fas fa-trash"></i> Proses Hapus</button>
</form>