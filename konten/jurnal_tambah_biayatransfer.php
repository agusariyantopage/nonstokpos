<?php
if(!empty($_POST['deskripsi'])){
    $deskripsi=$_POST['deskripsi'];
    $id_akun_debet=$_POST['id_akun_debet'];
    $akun_debet=get_nama_akun($koneksi,$id_akun_debet);    
    $id_akun_kredit='5';
    $akun_kredit='Bank BCA';     
} else {
    $deskripsi='';
    $id_akun_debet='';
    $akun_debet=''; 
    $id_akun_kredit='5';
    $akun_kredit='Bank BCA'; 
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pencatatan Pengeluaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Pengeluaran</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="aksi/akun_mutasi.php" method="post">
                <input type="hidden" name="aksi" value="tambah-jurnal-template">
                <button type="button" class="btn btn-block btn-success mb-2" data-toggle="modal" data-target="#findJurnalModal"><i class="fas fa-search"></i> Pilih Jenis Pengeluaran</button>
                <div class="row">
                    <div class="col">
                        <label for="id_akun_debet">Akun Debet</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" required class="form-control" readonly name="id_akun_debet" value="<?= $id_akun_debet; ?>">
                            </div>
                            <div class="col-sm-9">
                                <input type="text" required class="form-control" readonly name="akun_debet" value="<?= $akun_debet; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="id_akun_kredit">Akun Kredit</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" required class="form-control" readonly name="id_akun_kredit" value="<?= $id_akun_kredit; ?>">
                            </div>
                            <div class="col-sm-9">
                                <input type="text" required class="form-control" readonly name="akun_kredit" value="<?= $akun_kredit; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                <input type="date" required class="form-control" name="tanggal_transaksi">
                <label for="nominal_transaksi">Nominal Transaksi</label>
                <input type="number" required class="form-control" name="nominal_transaksi">
                <label for="deskripsi">Keterangan Transaksi</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?= $deskripsi; ?></textarea>
                <button type="submit" <?php if($deskripsi=='') { ?> disabled <?php } ?> class="btn btn-block btn-primary mt-2"><i class="fas fa-save"></i> Simpan Jurnal</button>

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
                            <td>#</td>
                            <td>Kode</td>
                            <td>Nama Akun</td>                            
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <!-- Isi Tabel -->
                    <?php
                    $sql = "SELECT * FROM akun WHERE akun LIKE '%Biaya%' AND RIGHT(kode,1)!=0";
                    $query = mysqli_query($koneksi, $sql);
                    while ($kolom = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $kolom['id_akun']; ?></td>
                            <td><?= $kolom['kode']; ?></td>
                            <td><?= $kolom['akun']; ?></td>                            
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id_akun_debet" value="<?= $kolom['id_akun'] ?>">
                                    <input type="hidden" name="id_akun_kredit" value="3">
                                    <input type="hidden" name="deskripsi" value="<?= $kolom['akun'] ?>">
                                    <button type="submit" class="btn btn-info btn-sm btn-block"><i class="fas fa-check"></i> Pilih</button>
                                </form>
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
                    <label for="keterangan_transaksi">Keterangan
                        keterangan Transaksi</label>
                    <textarea name="keterangan_transaksi" class="form-control" rows="3"></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>