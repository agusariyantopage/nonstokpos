 <?php
  // Hitung Nilai Umum 

  // Jumlah dan Total Transaksi
  $sql1 = "select count(id_jual) as jumlah_transaksi,sum(total) as total_transaksi from jual";
  $query1 = mysqli_query($koneksi, $sql1);
  $data1 = mysqli_fetch_array($query1);
  $jumlah_transaksi = $data1['jumlah_transaksi'];
  $total_transaksi = $data1['total_transaksi'];

  $sql2 = "select count(id_anggota) as jumlah_anggota from anggota";
  $query2 = mysqli_query($koneksi, $sql2);
  $data2 = mysqli_fetch_array($query2);
  $jumlah_anggota = $data2['jumlah_anggota'];

  $sql3 = "select count(id_pemasok) as jumlah_pemasok from pemasok";
  $query3 = mysqli_query($koneksi, $sql3);
  $data3 = mysqli_fetch_array($query3);
  $jumlah_pemasok = $data3['jumlah_pemasok'];

  $sql4 = "SELECT count(id_produk) as jumlah_produk from produk";
  $query4 = mysqli_query($koneksi, $sql4);
  $data4 = mysqli_fetch_array($query4);
  $jumlah_produk = $data4['jumlah_produk'];


  // $sql41 = "SELECT sum(hpp*qty) as nilai_inventaris_toko from produk WHERE servis=0 AND konsinyasi=0 AND qty>0";
  // $query41 = mysqli_query($koneksi, $sql41);
  // $data41 = mysqli_fetch_array($query41);
  // $nilai_inventaris_toko = $data41['nilai_inventaris_toko'];

  $sql5 = "select sum(total) as total_beli from beli";
  $query5 = mysqli_query($koneksi, $sql5);
  $data5 = mysqli_fetch_array($query5);
  $total_beli = $data5['total_beli'];

  $sql6 = "select sum(debet-kredit) as total_bca from akun_mutasi where id_akun=5";
  $query6 = mysqli_query($koneksi, $sql6);
  $data6 = mysqli_fetch_array($query6);
  $total_bca = $data6['total_bca'];

  $sql6 = "select sum(debet-kredit) as total_kas from akun_mutasi where id_akun=3";
  $query6 = mysqli_query($koneksi, $sql6);
  $data6 = mysqli_fetch_array($query6);
  $total_kas = $data6['total_kas'];

  $sql6 = "select sum(debet-kredit) as total_piutang from akun_mutasi where id_akun=84";
  $query6 = mysqli_query($koneksi, $sql6);
  $data6 = mysqli_fetch_array($query6);
  $total_piutang = $data6['total_piutang'];

  // Pendapatan Hari Ini
  $hari_ini=date("Y-m-d");
  $sql_pendapatan_hari_ini="SELECT COALESCE(SUM(total-diskon+pajak),0) AS total_pendapatan_hari_ini FROM jual WHERE tanggal_transaksi='$hari_ini'";
  $query_pendapatan_hari_ini=mysqli_query($koneksi,$sql_pendapatan_hari_ini);
  $data_pendapatan_hari_ini=mysqli_fetch_array($query_pendapatan_hari_ini);
  $total_pendapatan_hari_ini=$data_pendapatan_hari_ini['total_pendapatan_hari_ini'];

  $sql_pendapatan_hari_ini="SELECT SUM(IF(id_akun=5,jumlah,0)) AS total_bca_hari_ini,SUM(IF(id_akun=3,jumlah,0)) AS total_kas_hari_ini FROM jual_pembayaran WHERE tanggal_transaksi='$hari_ini'";
  $query_pendapatan_hari_ini=mysqli_query($koneksi,$sql_pendapatan_hari_ini);
  $data_hari_ini=mysqli_fetch_array($query_pendapatan_hari_ini);
  $total_kas_hari_ini=$data_hari_ini['total_kas_hari_ini'];
  $total_bca_hari_ini=$data_hari_ini['total_bca_hari_ini'];

  // Biaya Hari Ini
  $sql_biaya_hari_ini="SELECT SUM(IF((SELECT id_akun FROM akun_mutasi WHERE a.id_akun_jurnal=akun_mutasi.id_akun_jurnal AND a.id_akun!=akun_mutasi.id_akun)=3,a.debet-a.kredit,0)) AS total_pengeluaran_kas,SUM(IF((SELECT id_akun FROM akun_mutasi WHERE a.id_akun_jurnal=akun_mutasi.id_akun_jurnal AND a.id_akun!=akun_mutasi.id_akun)=5,a.debet-a.kredit,0)) AS total_pengeluaran_transfer from akun_mutasi a,akun_jurnal,akun where a.id_akun_jurnal=akun_jurnal.id_akun_jurnal and a.id_akun=akun.id_akun and akun.akun LIKE '%Biaya%' AND tanggal_transaksi='$hari_ini'";
  $query_biaya_hari_ini=mysqli_query($koneksi,$sql_biaya_hari_ini);
  $data_biaya_hari_ini=mysqli_fetch_array($query_biaya_hari_ini);
  $total_pengeluaran_kas=$data_biaya_hari_ini['total_pengeluaran_kas'];
  $total_pengeluaran_transfer=$data_biaya_hari_ini['total_pengeluaran_transfer'];
  
  // SELECT akun_jurnal.id_akun_jurnal,a.id_akun,tanggal_transaksi,deskripsi,a.debet-a.kredit as total_transaksi,(SELECT id_akun FROM akun_mutasi WHERE a.id_akun_jurnal=akun_mutasi.id_akun_jurnal AND a.id_akun!=akun_mutasi.id_akun) AS total_pengeluaran_kas from akun_mutasi a,akun_jurnal,akun where a.id_akun_jurnal=akun_jurnal.id_akun_jurnal and a.id_akun=akun.id_akun and akun.akun LIKE '%Biaya%'


  ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Dashboard</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item active"><a href="#">Home</a></li>

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
           <div class="small-box bg-info">
             <div class="inner">
               <h4><?= number_format($jumlah_transaksi); ?></h4>

               <p>Transaksi Toko</p>
             </div>
             <div class="icon">
               <i class="fas fa-shopping-basket"></i>
             </div>
             <a href="index.php?p=daftar-penjualan&filter=semua" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-success">
             <div class="inner">
               <h4><?= "Rp. " . number_format($total_transaksi); ?></sup></h4>

               <p>Total Penjualan</p>
             </div>
             <div class="icon">
               <i class="fas fa-cash-register"></i>
             </div>
             <a href="index.php?p=daftar-penjualan&filter=semua" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-purple">
             <div class="inner">
               <h4><?= number_format($jumlah_anggota); ?></h4>

               <p>Pelanggan Terdaftar</p>
             </div>
             <div class="icon">
               <i class="fas fa-address-card"></i>
             </div>
             <a href="index.php?p=anggota" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-danger">
             <div class="inner">
               <h4><?= number_format($jumlah_pemasok); ?></h4>

               <p>Pemasok Terdaftar</p>
             </div>
             <div class="icon">
               <i class="fas fa-address-card"></i>
             </div>
             <a href="index.php?p=pemasok" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
       </div>
       <!-- /.row -->
       <!-- Small boxes (Stat box) -->
       <div class="row">
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-info">
             <div class="inner">
               <h4><?= number_format($jumlah_produk); ?></h4>

               <p>Produk Toko</p>
             </div>
             <div class="icon">
               <i class="fas fa-tags"></i>
             </div>
             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-success">
             <div class="inner">
               <h4><?= "Rp. " . number_format($total_bca); ?></sup></h4>

               <p>Saldo Bank BCA</p>
             </div>
             <div class="icon">
               <i class="fas fa-credit-card"></i>
             </div>
             <a href="index.php?p=mutasi-akun&id_akun=5&tanggal_awal=<?= $hari_ini; ?>&tanggal_akhir=<?= $hari_ini; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-purple">
             <div class="inner">
               <h4><?= "Rp. " . number_format($total_kas); ?></h4>

               <p>Saldo Kas Toko</p>
             </div>
             <div class="icon">
               <i class="fas fa-wallet"></i>
             </div>
             <a href="index.php?p=mutasi-akun&id_akun=3&tanggal_awal=<?= $hari_ini; ?>&tanggal_akhir=<?= $hari_ini; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-danger">
             <div class="inner">
               <h4><?= "Rp. " . number_format($total_piutang); ?></h4>

               <p>Saldo Piutang</p>
             </div>
             <div class="icon">
               <i class="fas fa-money-bill-alt"></i>
             </div>
             <a href="index.php?p=mutasi-akun&id_akun=84&tanggal_awal=<?= $hari_ini; ?>&tanggal_akhir=<?= $hari_ini; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
       </div>
       <!-- /.row -->

       <div class="row">
         <div class="col-md-6">

           <div class="card card-success">
             <div class="card-header">
               <h3 class="card-title">Pendapatan Hari Ini</h3>

               <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                   <i class="fas fa-minus"></i>
                 </button>
                 <button type="button" class="btn btn-tool" data-card-widget="remove">
                   <i class="fas fa-times"></i>
                 </button>
               </div>
             </div>
             <div class="card-body">
               <div class="row">
                 <div class="col-md-6">Pendapatan Kas</div>
                 <div class="col-md-6 text-right">Rp. <?= number_format($total_kas_hari_ini); ?></div>
               </div>
               <div class="row">
                 <div class="col-md-6">Pendapatan Transfer BCA</div>
                 <div class="col-md-6 text-right">Rp. <?= number_format($total_bca_hari_ini); ?></div>
               </div>
               <div class="row">
                 <div class="col-md-6">Pendapatan Piutang</div>
                 <div class="col-md-6 text-right">Rp. <?= number_format($total_pendapatan_hari_ini-$total_kas_hari_ini-$total_bca_hari_ini); ?></div>
               </div>
               <div class="row">
                 <div class="col-md-12"><hr></div>                 
               </div>
               <div class="row">
                 <div class="col-md-6">Total Pendapatan</div>
                 <div class="col-md-6 text-right">Rp. <?= number_format($total_pendapatan_hari_ini); ?></div>
               </div>
             </div>
           </div>
         </div>

         <div class="col-md-6">
           <!-- BAR CHART -->
           <div class="card card-danger">
             <div class="card-header">
               <h3 class="card-title">Pengeluaran Hari Ini</h3>

               <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                   <i class="fas fa-minus"></i>
                 </button>
                 <button type="button" class="btn btn-tool" data-card-widget="remove">
                   <i class="fas fa-times"></i>
                 </button>
               </div>
             </div>
             <div class="card-body">
               <div class="row">
                 <div class="col-md-6">Pengeluaran Kas</div>
                 <div class="col-md-6 text-right">Rp. <?= number_format($total_pengeluaran_kas); ?></div>
               </div>
               <div class="row">
                 <div class="col-md-6">Pengeluaran Transfer BCA</div>
                 <div class="col-md-6 text-right">Rp. <?= number_format($total_pengeluaran_transfer); ?></div>
               </div>
               <div class="row">
                 <div class="col-md-6">&nbsp;</div>
                 <div class="col-md-6">&nbsp;</div>
               </div>
               <div class="row">
                 <div class="col-md-12"><hr></div>                 
               </div>
               <div class="row">
                 <div class="col-md-6">Total Pengeluaran</div>
                 <div class="col-md-6 text-right">Rp. <?= number_format($total_pengeluaran_kas+$total_pengeluaran_transfer); ?></div>
               </div>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
       </div>

       <div class="row">
         <div class="col-md-6">

           <div class="card card-dark">
             <div class="card-header">
               <h3 class="card-title">Status Pembayaran Transaksi</h3>

               <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                   <i class="fas fa-minus"></i>
                 </button>
                 <button type="button" class="btn btn-tool" data-card-widget="remove">
                   <i class="fas fa-times"></i>
                 </button>
               </div>
             </div>
             <div class="card-body">
               <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
             </div>
           </div>
         </div>

         <div class="col-md-6">
           <!-- BAR CHART -->
           <div class="card card-dark">
             <div class="card-header">
               <h3 class="card-title">Omset Penjualan Per Bulan</h3>

               <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                   <i class="fas fa-minus"></i>
                 </button>
                 <button type="button" class="btn btn-tool" data-card-widget="remove">
                   <i class="fas fa-times"></i>
                 </button>
               </div>
             </div>
             <div class="card-body">
               <div class="chart">
                 <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
               </div>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
       </div>

     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->