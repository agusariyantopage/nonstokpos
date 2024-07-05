 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Laporan</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item active"><a href="#">Laporan</a></li>

           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <!-- Small boxes (Stat box) -->
       <div class="row">       

         <div class="col-lg-3 col-6">
           <!-- small box -->
           <a href="#" data-target="#laporanPenjualanModal" data-toggle="modal">
             <div class="small-box bg-dark">
               <div class="inner">
                 <h3>Cetak</h3>

                 <p>Laporan Penjualan</p>
               </div>
               <div class="icon">
                 <i class="fas fa-file"></i>
               </div>
             </div>
           </a>
         </div>
         <!-- ./col -->

         <div class="col-lg-3 col-6">
           <!-- small box -->
           <a href="#" data-target="#laporanKasToko" data-toggle="modal">
             <div class="small-box bg-dark">
               <div class="inner">
                 <h3>Cetak</h3>

                 <p>Laporan Mutasi Akun</p>
               </div>
               <div class="icon">
                 <i class="fas fa-file"></i>
               </div>
             </div>
           </a>
         </div>
         <!-- ./col -->
         
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <a href="#" data-target="#laporanLabaRugi" data-toggle="modal">
             <div class="small-box bg-dark">
               <div class="inner">
                 <h3>Cetak</h3>

                 <p>Laporan Laba Rugi</p>
               </div>
               <div class="icon">
                 <i class="fas fa-file"></i>
               </div>
             </div>
           </a>
         </div>
         <!-- ./col -->
       </div>
       <!-- /.row -->
      

     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <!-- Modal Laporan Pembelian -->
 <div class="modal fade" id="laporanPembelianModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Pilih Periode Laporan Pembelian</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="get" target="blank" action="pdf/output/lap_pembelian_umum.php">
           <div>
             <label for="tanggal_awal">Tanggal Awal</label>
             <input type="date" name="tanggal_awal" class="form-control" required>
           </div>
           <div>
             <label for="tanggal_akhir">Tanggal AKhir</label>
             <input type="date" name="tanggal_akhir" class="form-control" required>
           </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Cetak</button>
         </form>
       </div>
     </div>
   </div>
 </div>

 <!-- Modal Laporan Penjualan -->
 <div class="modal fade" id="laporanPenjualanModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Pilih Periode Laporan Penjualan</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="get" target="blank" action="pdf/output/lap_penjualan_umum.php">
           <div>
             <label for="tanggal_awal">Tanggal Awal</label>
             <input type="date" name="tanggal_awal" class="form-control" required>
           </div>
           <div>
             <label for="tanggal_akhir">Tanggal AKhir</label>
             <input type="date" name="tanggal_akhir" class="form-control" required>
           </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Cetak</button>
         </form>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal Laporan Kontribusi Belanja -->
 <div class="modal fade" id="laporanKontribusiBelanja" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Pilih Periode Laporan Kontribusi Belanja</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="get" target="blank" action="pdf/output/lap_kontribusi_belanja.php">
           <div>
             <label for="tanggal_awal">Tanggal Awal</label>
             <input type="date" name="tanggal_awal" class="form-control" required>
           </div>
           <div>
             <label for="tanggal_akhir">Tanggal AKhir</label>
             <input type="date" name="tanggal_akhir" class="form-control" required>
           </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Cetak</button>
         </form>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal Laporan Laba Rugi -->
 <div class="modal fade" id="laporanLabaRugi" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Pilih Periode Laporan Laba Rugi</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="get" target="blank" action="pdf/output/lap_laba_rugi.php">
           <div>
             <label for="tanggal_awal">Tanggal Awal</label>
             <input type="date" name="tanggal_awal" class="form-control" required>
           </div>
           <div>
             <label for="tanggal_akhir">Tanggal AKhir</label>
             <input type="date" name="tanggal_akhir" class="form-control" required>
           </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Cetak</button>
         </form>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal Laporan Belanja Lembaga -->
 <div class="modal fade" id="laporanBelanjaLembaga" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Pilih Periode Laporan Belanja Lembaga</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="get" target="blank" action="pdf/output/lap_penjualan_per_lembaga.php">
           <div>
             <label for="tanggal_awal">Tanggal Awal</label>
             <input type="date" name="tanggal_awal" class="form-control" required>
           </div>
           <div>
             <label for="tanggal_akhir">Tanggal AKhir</label>
             <input type="date" name="tanggal_akhir" class="form-control" required>
           </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Cetak</button>
         </form>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal Laporan Kas Toko -->
 <div class="modal fade" id="laporanKasToko" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Pilih Periode Laporan Per Akun</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="get" target="blank" action="pdf/output/lap_kas_toko.php">
           <div>
             <label for="id_akun">Akun</label>
             <select name="id_akun" id="id_akun" class="form-control" required>
               <?php call_option_selected($koneksi, "akun", "id_akun", "id_akun", "akun", 3); ?>
             </select>
           </div>
           <div>
             <label for="tanggal_awal">Tanggal Awal</label>
             <input type="date" name="tanggal_awal" class="form-control" required>
           </div>
           <div>
             <label for="tanggal_akhir">Tanggal Akhir</label>
             <input type="date" name="tanggal_akhir" class="form-control" required>
           </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Cetak</button>
         </form>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal Laporan Belanja Individu -->
 <div class="modal fade" id="laporanBelanjaIndividu" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Pilih Periode & Anggota</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="get" target="blank" action="pdf/output/lap_penjualan_per_individu.php">
           <div>
             <label for="tanggal_awal">Tanggal Awal</label>
             <input type="date" name="tanggal_awal" class="form-control" required>
           </div>
           <div>
             <label for="tanggal_akhir">Tanggal AKhir</label>
             <input type="date" name="tanggal_akhir" class="form-control" required>
           </div>
           <div>
             <label for="id_anggota">Anggota</label>
             <select name="id_anggota" class="form-control" required>
               <?php
                $sql = "select * from anggota order by nama";
                $query = mysqli_query($koneksi, $sql);
                while ($kolom = mysqli_fetch_array($query)) {
                  echo "<option value='$kolom[id_anggota]'>$kolom[nama]</option>";
                }
                ?>
             </select>
           </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Cetak</button>
         </form>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal Laporan Item Out -->
 <div class="modal fade" id="laporanItemOut" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Pilih Periode</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="get" target="blank" action="pdf/output/lap_item_out.php">
           <div>
             <label for="tanggal_awal">Tanggal Awal</label>
             <input type="date" name="tanggal_awal" class="form-control" required>
           </div>
           <div>
             <label for="tanggal_akhir">Tanggal AKhir</label>
             <input type="date" name="tanggal_akhir" class="form-control" required>
           </div>
          

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Cetak</button>
         </form>
       </div>
     </div>
   </div>
 </div>