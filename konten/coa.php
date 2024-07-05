<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Akun Keuangan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
            <li class="breadcrumb-item active">Akun Keuangan</li>
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
              <h3>Data Akun Keuangan</h3>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i> Tambah</button>

              <table id="example1" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>ID Akun</td>
                    <td>Kode Akun</td>
                    <td>Akun</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
                <?php
                $sql = "select * from akun";
                $query = mysqli_query($koneksi, $sql);
                while ($kolom = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?= $kolom['id_akun']; ?></td>
                    <td><?= $kolom['kode']; ?></td>
                    <td><?= $kolom['akun']; ?></td>
                    <td>
                      <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_akun']; ?>"><i class="fas fa-edit"></i></button>
                      <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/akun.php?aksi=hapus&id=<?= $kolom['id_akun']; ?>"><i class="fas fa-trash"></i></a></button>
                    </td>
                  </tr>
                  <!-- Modal Edit -->
                  <div class="modal fade" id="editModal<?= $kolom['id_akun']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel">Ubah Akun</h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="aksi/akun.php" method='post'>
                            <input type="hidden" name="aksi" value="ubah">
                            <input type="hidden" name="id_akun" value="<?= $kolom['id_akun']; ?>">
                            <label for="kode">Kode Akun</label>
                            <input type="text" required class="form-control" name="kode" value="<?= $kolom['kode']; ?>" required>
                            <label for="Akun">Akun</label>                            
                            <input type="text" value="<?= $kolom['akun']; ?>" name="akun" required class="form-control" name="Akun">
                            <label for="tipe">Tipe</label>
                            <input type="text" required class="form-control" name="tipe" value="<?= $kolom['tipe']; ?>" required>
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3"><?= $kolom['keterangan']; ?></textarea>

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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/akun.php" method="post">
          <input type="hidden" name="aksi" value="tambah">
          <label for="kode">Kode Akun</label>
          <input type="text" required class="form-control" name="kode">
          <label for="akun">Akun</label>
          <input type="text" required class="form-control" name="akun">
          <label for="tipe">Tipe</label>
          <input type="text" required class="form-control" name="tipe">
          <label for="keterangan">Keterangan</label>
          <textarea name="keterangan" class="form-control" rows="3"></textarea>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>