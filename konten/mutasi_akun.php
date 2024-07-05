<?php
if(!empty($_GET['id_akun'])){
    $tanggal_awal = $_GET['tanggal_awal'];
    $tanggal_akhir = $_GET['tanggal_akhir'];
    $id_akun = $_GET['id_akun'];
} else {
    $tanggal_awal = '';
    $tanggal_akhir = '';
    $id_akun = 0;
}
$nama_akun=get_nama_akun($koneksi,$id_akun);



$sql_saldo_awal = "SELECT SUM(debet-kredit) as total_transaksi from akun_mutasi,akun_jurnal where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=$id_akun and tanggal_transaksi < '$tanggal_awal'";
$query_saldo_awal = mysqli_query($koneksi, $sql_saldo_awal);
$kolom_saldo = mysqli_fetch_array($query_saldo_awal);
$saldo_awal = $kolom_saldo['total_transaksi'];
$grandtotal = $saldo_awal;

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mutasi Akun</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
                        <li class="breadcrumb-item active">Mutasi Akun</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <row>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Mutasi Akun  (<?= $nama_akun; ?>)</h3>
                        </div>
                        <div class="card-body">
                            <form action="index.php" method="get">
                                <input type="hidden" name="p" value="mutasi-akun">
                                <div class="form-row">
                                    <div class="form-group col-sm-4">
                                        <label for="id_akun">Akun</label>
                                        <select class="form-control select2bs4" name="id_akun" required>
                                            <option value="">-- Pilih Akun --</option>
                                            <?php call_option_selected($koneksi, "akun", "akun", "id_akun", "akun",$id_akun); ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="tanggal_awal">Tanggal Awal</label>
                                        <input class="form-control" type="date" value="<?= $tanggal_awal; ?>" placeholder="Tanggal Awal . . ." name="tanggal_awal" required>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="tanggal_akhir">Tanggal Akhir</label>
                                        <input class="form-control" type="date" value="<?= $tanggal_akhir; ?>" placeholder="Tanggal Akhir . . ." name="tanggal_akhir" required>
                                    </div>
                                    <div class="form-group col-sm-2 align-self-end">

                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> Cari</button>
                                    </div>

                                </div>
                            </form>

                            <table id="exportonly" class="table table-bordered table-striped">
                                <!-- Kepala Tabel -->
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Tanggal Transaksi</td>
                                        <td>Keterangan Transaksi</td>
                                        <td>Total</td>
                                        <td>Saldo</td>
                                    </tr>
                                </thead>
                                <!-- Isi Tabel -->
                                <tr>
                                    <td>#0</td>
                                    <td><?= date("d-M-Y", strtotime($tanggal_awal)) ?></td>
                                    <td>Saldo Awal</td>
                                    <td align="right"> Rp. <?= number_format($saldo_awal) ?></td>
                                    <td align="right"> Rp. <?= number_format($saldo_awal) ?></td>
                                </tr>
                                <?php
                                $sql = "SELECT akun_jurnal.id_akun_jurnal,tanggal_transaksi,deskripsi,debet-kredit as total_transaksi from akun_mutasi,akun_jurnal,akun where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=akun.id_akun and akun_mutasi.id_akun=$id_akun and (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir') ORDER BY tanggal_transaksi";
                                $query = mysqli_query($koneksi, $sql);
                                while ($kolom = mysqli_fetch_array($query)) {
                                    $grandtotal = $grandtotal + $kolom['total_transaksi'];
                                ?>
                                    <tr>
                                        <td>#<?= $kolom['id_akun_jurnal']; ?></td>
                                        <td><?= date("d-M-Y", strtotime($kolom['tanggal_transaksi'])); ?></td>
                                        <td><?= $kolom['deskripsi']; ?></td>
                                        <td align="right">Rp. <?= number_format($kolom['total_transaksi']); ?></td>
                                        <td align="right">Rp. <?= number_format($grandtotal); ?></td>

                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?= $kolom['id_akun_jurnal']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Ubah Jurnal</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="aksi/akun.php" method='post'>
                                                        <input type="hidden" name="aksi" value="ubah">
                                                        <label for="Jurnal">Jurnal</label>
                                                        <input type="hidden" name="id" value="<?= $kolom['id_akun_jurnal']; ?>">
                                                        <input type="text" value="<?= $kolom['akun']; ?>" required class="form-control" name="Jurnal">
                                                        <input type="text" name="start" value="">
                                                        <label for="Jurnal">Jurnal</label>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </table>



                        </div>
                    </div>
                </div>
            </row>


        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Untuk Tambah Jurnal -->
<!-- Modal -->
<div class="modal fade" id="tambahJurnalModal" tabindex="-1" aria-labelledby="tambahJurnalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJurnalModalLabel">Tambah Transaksi Jurnal</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="aksi/jurnal.php" method="post">
                    <input type="hidden" name="aksi" value="tambah">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="date" required class="form-control" name="tanggal_transaksi">
                    <label for="keterangan_transaksi">Keterangan
                        keterangan Transaksi</label>
                    <textarea name="keterangan_transaksi" class="form-control" rows="3"></textarea>
                    <label for="nominal">Nominal Transaksi</label>
                    <input type="number" required class="form-control" name="nominal">

                    <label for="id_debet">Debet</label>
                    <select name="id_debet" id="id_debet" class="select2bs4 form-control" required>
                        <option value="">-- Pilih Akun Debet --</option>
                        <?php
                        $sql1 = "SELECT * from akun order by akun ASC";
                        $query1 = mysqli_query($koneksi, $sql1);
                        while ($kolom1 = mysqli_fetch_array($query1)) {
                            echo "<option value='$kolom1[id_akun_jurnal]'>$kolom1[akun]</option>";
                        }

                        ?>
                    </select>

                    <label for="id_kredit">Kredit</label>
                    <select name="id_kredit" id="id_kredit" class="select2bs4 form-control" required>
                        <option value="">-- Pilih Akun Kredit --</option>
                        <?php
                        $sql1 = "SELECT * from akun order by akun ASC";
                        $query1 = mysqli_query($koneksi, $sql1);
                        while ($kolom1 = mysqli_fetch_array($query1)) {
                            echo "<option value='$kolom1[id_akun_jurnal]'>$kolom1[akun]</option>";
                        }

                        ?>
                    </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>