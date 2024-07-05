<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Jurnal Keuangan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
                        <li class="breadcrumb-item"><a href="index.php?p=jurnal">Jurnal Keuangan</a></li>
                        <li class="breadcrumb-item active">Tambah</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <label for="id_debet">Detail Transaksi</label>
            <div class="row">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-block btn-success mb-2" data-toggle="modal" data-target="#findJurnalModal"><i class="fas fa-plus"></i> Tambah</button>
                </div>
                <div class="col-sm-6">
                    <a href="aksi/akun_mutasi.php?aksi=reset-jurnal-temporer"><button type="button" class="btn btn-block btn-danger mb-2"><i class="fas fa-trash"></i> Reset</button></a>
                </div>
            </div>
            <table class="table">
                <tr>

                    <td>Akun</td>
                    <td>Debet</td>
                    <td>Kredit</td>
                </tr>
                <?php
                $total_debet = 0;
                $total_kredit = 0;
                $jumlah = count($_SESSION['jurnal_temporer']);
                for ($row = 0; $row < $jumlah; $row++) {
                    $total_debet = $total_debet + $_SESSION['jurnal_temporer'][$row][2];
                    $total_kredit = $total_kredit + $_SESSION['jurnal_temporer'][$row][3];

                ?>
                    <tr>

                        <td><?= $_SESSION['jurnal_temporer'][$row][1]; ?></td>
                        <td align="right"><?= number_format($_SESSION['jurnal_temporer'][$row][2]); ?></td>
                        <td align="right"><?= number_format($_SESSION['jurnal_temporer'][$row][3]); ?></td>
                    </tr>
                <?php } ?>
            </table>
            <?php
            if ($total_debet == $total_kredit && $total_debet > 0) {
                //echo '<button type="submit" class="btn btn-block btn-primary mt-3 mb-3"><i class="fas fa-save"></i> Simpan</button>';
                echo '<button type="button" class="btn btn-block btn-primary mt-2 mb-2" data-toggle="modal" data-target="#simpanJurnalModal"><i class="fas fa-save"></i> Tambah</button>';
            }
            ?>

            </form>
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Temukan Akun -->
<div class="modal fade" id="findJurnalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pencarian Akun Transaksi</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="finditem" class="table table-bordered table-striped" style="width:100%;">
                    <!-- Kepala Tabel -->
                    <thead>
                        <tr>

                            <td>Akun</td>
                            <td>Posisi</td>
                            <td>Nominal</td>
                            <td>Pilih</td>
                        </tr>
                    </thead>
                    <!-- Isi Tabel -->
                    <?php
                    $sql = "SELECT * FROM akun";
                    $query = mysqli_query($koneksi, $sql);
                    while ($kolom = mysqli_fetch_array($query)) {
                    ?>
                        <tr>

                            <td><?= "[" . $kolom['kode'] . "] " . $kolom['akun']; ?></td>
                            <td>
                                <form action="aksi/akun_mutasi.php" method="post">
                                    <input type="hidden" name="aksi" value="tambah-jurnal-temporer">
                                    <input type="hidden" name="id_akun" value="<?= $kolom['id_akun']; ?>">
                                    <input type="hidden" name="akun" value="<?= $kolom['akun']; ?>">
                                    <select name="posisi" class="form-control form-control-sm" required="">
                                        <option value="">-- Posisi Transaksi --</option>
                                        <option>Debet</option>
                                        <option>Kredit</option>
                                    </select>
                            </td>
                            <td><input type="number" class="form-control form-control-sm" placeholder="Nominal . . ." name="nominal" required></td>
                            <td>
                                <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-check"></i> Pilih</button></form>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Simpan Transaksi -->
<div class="modal fade" id="simpanJurnalModal" tabindex="-1" aria-labelledby="simpanJurnalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="simpanJurnalModalLabel">Simpan Transaksi Jurnal</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="aksi/akun_mutasi.php" method="post">
                    <input type="hidden" name="aksi" value="tambah-jurnal">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="date" required class="form-control" name="tanggal_transaksi">
                    <label for="deskripsi">Deskripsi Transaksi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>