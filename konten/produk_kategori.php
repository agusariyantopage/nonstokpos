
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kategori Produk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item active">Kategori Produk</li>
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
              <h3>Data Kategori Produk</h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>
              
              <table id="example1" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>ID Kategori</td>
                    <td>Kategori</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select * from produk_kategori";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                 
                <tr>
                  <td><?= $kolom['id_produk_kategori']; ?></td>
                  <td><?= $kolom['produk_kategori']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_produk_kategori']; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/produk_kategori.php?aksi=hapus&id=<?= $kolom['id_produk_kategori']; ?>"><i class="fas fa-trash"></i></a></button>
                  </td>
                </tr>
<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $kolom['id_produk_kategori']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Ubah Kategori</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/produk_kategori.php" method='post'>
          <input type="hidden" name="aksi" value="ubah">
          <label for="kategori">Kategori</label>
          <input type="hidden" name="id" value="<?= $kolom['id_produk_kategori']; ?>">
          <input type="text" value="<?= $kolom['produk_kategori']; ?>" required class="form-control" name="kategori">
        
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

  <!-- Modal Untuk Tambah Kategori -->
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/produk_kategori.php" method="post">
          <input type="hidden" name="aksi" value="tambah">
          <label for="kategori">Kategori</label>
          <input type="text" required class="form-control" name="kategori">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
