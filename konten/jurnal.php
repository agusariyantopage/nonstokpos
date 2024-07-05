<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Jurnal Keuangan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
            <li class="breadcrumb-item active">Jurnal Keuangan</li>
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
              <h3>Data Jurnal Keuangan</h3>
            </div>
            <div class="card-body">
              <a href="index.php?p=jurnal-tambah-template"><button type="button" class="btn btn-primary mb-2">
                <i class="fas fa-plus"></i> Tambah Jurnal Via Template Transaksi</button></a>
              <a href="index.php?p=jurnal-tambah"><button type="button" class="btn btn-primary mb-2">
                <i class="fas fa-plus"></i> Tambah Jurnal Mandiri</button></a>

              <table id="example1" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Deskripsi Transaksi</td>
                    <td>Tanggal Transaksi</td>
                    <td>Akun</td>
                    <td>Debet</td>
                    <td>Kredit</td>
                    <td>Hapus</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
                <?php
                $sql = "SELECT akun_jurnal.*,debet,kredit,akun FROM akun_jurnal,akun_mutasi,akun WHERE  akun_jurnal.id_akun_jurnal=akun_mutasi.id_akun_jurnal AND akun_mutasi.id_akun=akun.id_akun";
                $query = mysqli_query($koneksi, $sql);
                while ($kolom = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td>[<?= $kolom['id_akun_jurnal']; ?>] <?= $kolom['deskripsi']; ?></td>
                    <td><?= date("d-M-Y", strtotime($kolom['tanggal_transaksi'])); ?></td>
                    <td><?= $kolom['akun']; ?></td>
                    <td align="right"><?= number_format($kolom['debet']); ?></td>
                    <td align="right"><?= number_format($kolom['kredit']); ?></td>
                    <td>
                      <?php
                          if(strpos($kolom['deskripsi'],"Penjualan #")){
                            echo "";
                          } else {
                      ?>
                      <a onclick="return confirm('Yakin akan menghapus data ini?')" href="aksi/akun_mutasi.php?aksi=hapus-jurnal&token=<?= md5($kolom['id_akun_jurnal']); ?>">
                      <button type="button" class="btn btn-link" title="Hapus Jurnal" ><i class="fas fa-trash"></i></button>
                      </a>
                      <?php } ?>
                    </td>
                    
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