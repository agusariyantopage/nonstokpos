 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pemasok</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item active"> Pemasok</li>
              
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
              <h3>Data Pemasok</h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>
              <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-file-excel"></i> Impor</button>
              <a href="aksi/pemasok.php?aksi=buang-spasi"><button type="button" class="btn btn-warning mb-2">
              <i class="fas fa-cut"></i> Buang Spasi</button></a>
              <a href="aksi/pemasok.php?aksi=set-kapital"><button type="button" class="btn btn-info mb-2">
              <i class="fas fa-font"></i> Kapital</button></a>
              <a href="aksi/pemasok.php?aksi=set-proper"><button type="button" class="btn btn-danger mb-2">
              <i class="fas fa-text-height"></i> Proper</button></a>
              <table id="example1" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>ID</td>                    
                    <td>Nama</td>
                    <td>Alamat</td>
                    <td>No Telepon</td>
                    <td>Email</td>                    
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
  $sql="select * from pemasok";
  $query=mysqli_query($koneksi,$sql);
  while($kolom=mysqli_fetch_array($query)){  
?>                
                <tr>
                  <td><?= $kolom['id_pemasok']; ?></td>
                  <td><?= $kolom['nama']; ?></td>
                  <td><?= $kolom['alamat']; ?></td>
                  <td><?= $kolom['telepon']; ?></td>                  
                  <td><?= $kolom['email']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_pemasok']; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link"><a onclick="return confirm('Data yang dapat dihapus adalah data yang tidak tercatat pada transaksi toko ataupun simpan pinjam,Apakah anda yakin data ini dihapus??')" href="aksi/pemasok.php?aksi=hapus&token=<?= md5($kolom['id_pemasok']); ?>"><i class="fas fa-trash"></i></a></button>
                  </td>
                </tr>
<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $kolom['id_pemasok']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Ubah Pemasok</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data" action="aksi/pemasok.php">
        <input type="hidden" name="aksi" value="ubah">
        <div>
          <label for="id_pemasok">ID Pemasok</label>  
          <input type="text" class="form-control" readonly name="id_pemasok" value="<?= $kolom['id_pemasok']; ?>">
        </div>        
        <div>
          <label for="nama">Nama</label>
          <input type="text" name="nama" class="form-control" value="<?= $kolom['nama']; ?>">
        </div>
        <div>
          <label for="alamat">Alamat</label>
          <textarea name="alamat" id="alamat" class="form-control" rows="3"><?= $kolom['alamat']; ?></textarea>
        </div>
        <div>
          <label for="telepon">Nomor Telepon</label>
          <input type="text" name="telepon" class="form-control" value="<?= $kolom['telepon']; ?>">
        </div>  
        <div>
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" value="<?= $kolom['email']; ?>">
        </div>        
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

  <!-- Modal Untuk Tambah Pemasok -->
  
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Tambah Pemasok</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data" action="aksi/pemasok.php">
        <input type="hidden" name="aksi" value="tambah">
        <div>
          <label for="nama">Nama</label>
          <input type="text" name="nama" class="form-control">
        </div>
        <div>
          <label for="alamat">Alamat</label>
          <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
        </div>
        <div>
          <label for="telepon">Nomor Telepon</label>
          <input type="text" name="telepon" class="form-control">
        </div>  
        <div>
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control">
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>   
