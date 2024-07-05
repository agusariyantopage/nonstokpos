<?php
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Template Transaksi Jurnal Keuangan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
                        <li class="breadcrumb-item active">Template Transaksi Jurnal Keuangan</li>
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
                            <h3>Data Template Transaksi Jurnal Keuangan</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahJurnalModal">
                                <i class="fas fa-plus"></i> Tambah</button>

                            <table id="example1" class="table table-bordered table-striped">
                                <!-- Kepala Tabel -->
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Deskripsi Transaksi</td>
                                        <td>Akun Debet</td>
                                        <td>Akun Kredit</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <!-- Isi Tabel -->
                                <?php
                                $sql = "SELECT * FROM akun_jurnal_template";
                                $query = mysqli_query($koneksi, $sql);
                                while ($kolom = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?= $kolom['id_akun_jurnal_template']; ?></td>
                                        <td><?= $kolom['deskripsi']; ?></td>
                                        <td><?= "[" . $kolom['id_akun_debet'] . "] " . get_nama_akun($koneksi, $kolom['id_akun_debet']); ?></td>
                                        <td><?= "[" . $kolom['id_akun_kredit'] . "] " . get_nama_akun($koneksi, $kolom['id_akun_kredit']); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_akun_jurnal_template']; ?>"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/akun_jurnal_template.php?aksi=hapus&id=<?= md5($kolom['id_akun_jurnal_template']); ?>"><i class="fas fa-trash"></i></a></button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?= $kolom['id_akun_jurnal_template']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Ubah Akun</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="aksi/akun_jurnal_template.php" method='post'>
                                                        <input type="hidden" name="aksi" value="ubah">
                                                        <input type="hidden" name="id_akun_jurnal_template" value="<?= $kolom['id_akun_jurnal_template']; ?>">
                                                        <label for="deskripsi">Keterangan</label>
                                                        <textarea name="deskripsi" class="form-control" rows="3" required><?= $kolom['deskripsi']; ?></textarea>
                                                        <label for="id_akun_debet">Kode Akun Debet</label>
                                                        <select class="form-control" name="id_akun_debet" required>
                                                            
                                                            <?php call_option_selected($koneksi, "akun", "akun", "id_akun", "akun",$kolom['id_akun_debet']); ?>
                                                        </select>
                                                        <label for="id_akun_kredit">Kode Akun Kredit</label>
                                                        <select class="form-control" name="id_akun_kredit" required>
                                                            
                                                            <?php call_option_selected($koneksi, "akun", "akun", "id_akun", "akun",$kolom['id_akun_kredit']); ?>
                                                        </select>
                                                        <br><i>Terakhir diubah pada <?= $kolom['diubah_pada']; ?></i>

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

<!-- Modal Untuk Tambah Akun -->
<!-- Modal -->
<div class="modal fade" id="tambahJurnalModal" tabindex="-1" aria-labelledby="tambahJurnalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJurnalModalLabel">Tambah Template Transaksi Jurnal Baru</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="aksi/akun_jurnal_template.php" method="post">
                    <input type="hidden" name="aksi" value="tambah">
                    <label for="deskripsi">Keterangan</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    <label for="id_akun_debet">Kode Akun Debet</label>
                    <select class="form-control" name="id_akun_debet" id="id_debet" required>
                        <option value="">-- Pilih Akun Debet --</option>
                        <?php call_option($koneksi, "akun", "akun", "id_akun", "akun"); ?>
                    </select>
                    <label for="id_akun_kredit">Kode Akun Kredit</label>
                    <select class="form-control" name="id_akun_kredit" id="id_kredit" required>
                        <option value="">-- Pilih Akun Kredit --</option>
                        <?php call_option($koneksi, "akun", "akun", "id_akun", "akun"); ?>
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