 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Anggota</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
             <li class="breadcrumb-item active"> Anggota</li>

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
               <h3>Data Anggota</h3>
             </div>
             <div class="card-body">
               <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                 <i class="fas fa-plus"></i> Tambah</button>
               <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
                 <i class="fas fa-file-excel"></i> Impor</button>
               <a href="aksi/anggota.php?aksi=buang-spasi"><button type="button" class="btn btn-warning mb-2">
                   <i class="fas fa-cut"></i> Buang Spasi</button></a>
               <a href="aksi/anggota.php?aksi=set-kapital"><button type="button" class="btn btn-info mb-2">
                   <i class="fas fa-font"></i> Kapital</button></a>
               <a href="aksi/anggota.php?aksi=set-proper"><button type="button" class="btn btn-danger mb-2">
                   <i class="fas fa-text-height"></i> Proper</button></a>
               <table id="example1" class="table table-bordered table-striped">
                 <!-- Kepala Tabel -->
                 <thead>
                   <tr>
                     <td>ID</td>
                     <td>Nomor Identitas</td>
                     <td>Nama</td>
                     <td>Alamat</td>
                     <td>Nomor Telepon</td>
                     <td>Email</td>
                     <td>Aksi</td>
                   </tr>
                 </thead>
                 <!-- Isi Tabel -->
                 <?php
                  $sql = "select * from anggota";
                  $query = mysqli_query($koneksi, $sql);
                  while ($kolom = mysqli_fetch_array($query)) {
                  ?>
                   <tr>
                     <td><?= $kolom['id_anggota']; ?></td>
                     <td><?= $kolom['no_identitas']; ?></td>
                     <td><?= $kolom['nama']; ?></td>
                     <td><?= $kolom['alamat']; ?></td>                    
                     <td><?= $kolom['telepon']; ?></td>                    
                     <td><?= $kolom['email']; ?></td>                    
                     <td>
                      <button type="button" class="btn btn-link ubah_anggota" data-toggle="modal" title="Ubah Anggota" data-target="#editModal" data-id="<?= $kolom['id_anggota']; ?>"><i class="fas fa-edit"></i></button>
                       <button type="button" class="btn btn-link konfirmasi_hapus_anggota" title="Hapus Anggota" data-toggle="modal" data-target="#konfirmHapusAnggota" data-id="<?= $kolom['id_anggota']; ?>"><i class="fas fa-trash"></i></button>
                     </td>
                   </tr>

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

 <!-- Modal Untuk Tambah Anggota -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Tambah Anggota</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="post" enctype="multipart/form-data" action="aksi/anggota.php">
           <input type="hidden" name="aksi" value="tambah">

           <div>
             <label for="no_identitas">Nomer Identitas</label>
             <input type="text" name="no_identitas" class="form-control">
           </div>
           <div>
             <label for="tanggal_bergabung">Tanggal Bergabung</label>
             <input type="date" name="tanggal_bergabung" class="form-control">
           </div>
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

 <!-- Modal Untuk Cek Data Terkait Sebelum Hapus  -->
 <div class="modal fade" id="konfirmHapusAnggota" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Konfirmasi Hapus Data Anggota</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <div class="isi-anggota-konfirmasi-hapus"></div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>


       </div>
     </div>
   </div>
 </div>

 <!-- Modal Edit -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Ubah Anggota</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <div class="isi-anggota-ubah"></div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>         
       </div>
     </div>
   </div>
 </div>