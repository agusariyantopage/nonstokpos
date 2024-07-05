 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Produksi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Item In</a></li>
              <li class="breadcrumb-item active">Produksi</li>
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
          <div class="btn-group mb-3" role="group" aria-label="Basic example">
            <a href="index.php?p=daftar-produksi&filter=hari"><button type="button" class="btn btn-secondary mr-1">Hari Ini</button></a>
            <a href="index.php?p=daftar-produksi&filter=bulan"><button type="button" class="btn btn-secondary mr-1">Bulan Ini</button></a>
            <a href="index.php?p=daftar-produksi&filter=tahun"><button type="button" class="btn btn-secondary mr-1">Tahun Ini</button></a>
            <a href="index.php?p=daftar-produksi&filter=semua"><button type="button" class="btn btn-secondary mr-1">Semua Transaksi</button></a>
          </div>
          
          <div class="card">
            <div class="card-header">
              <h3>Data Produksi</h3>
            </div> 
            <div class="card-body">
              <a href="index.php?p=produksi"><button type="button" class="btn btn-primary mb-2">
              <i class="fas fa-plus"></i> Tambah Transaksi Baru</button></a>
              
              <table id="noorder" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>#</td>                    
                    <td>Tanggal Produksi</td>                    
                    <td>Petugas</td>
                    <td>Waktu Input</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
  if(empty($_GET['filter'])){
    $sql="SELECT beli.*,pemasok.nama as napem,user.nama as petugas from beli,pemasok,user where beli.id_pemasok=pemasok.id_pemasok and beli.id_user=user.id_user and tanggal_transaksi=DATE(NOW()) and jenis_transaksi='PRODUKSI' order by beli.id_beli desc";
  } else {
    if($_GET['filter']=='hari'){      
      $sql="SELECT beli.*,pemasok.nama as napem,user.nama as petugas from beli,pemasok,user where beli.id_pemasok=pemasok.id_pemasok and beli.id_user=user.id_user and tanggal_transaksi=DATE(NOW()) and jenis_transaksi='PRODUKSI' order by beli.id_beli desc";
    }
    if($_GET['filter']=='bulan'){      
      $sql="SELECT beli.*,pemasok.nama as napem,user.nama as petugas from beli,pemasok,user where beli.id_pemasok=pemasok.id_pemasok and beli.id_user=user.id_user and MONTH(tanggal_transaksi)=MONTH(NOW()) and jenis_transaksi='PRODUKSI' order by beli.id_beli desc";
    }
    if($_GET['filter']=='tahun'){      
      $sql="SELECT beli.*,pemasok.nama as napem,user.nama as petugas from beli,pemasok,user where beli.id_pemasok=pemasok.id_pemasok and beli.id_user=user.id_user and YEAR(tanggal_transaksi)=YEAR(NOW()) and jenis_transaksi='PRODUKSI' order by beli.id_beli desc";
    }
    if($_GET['filter']=='semua'){      
      $sql="SELECT beli.*,pemasok.nama as napem,user.nama as petugas from beli,pemasok,user where beli.id_pemasok=pemasok.id_pemasok and beli.id_user=user.id_user and jenis_transaksi='PRODUKSI' order by beli.id_beli desc";
    }
  }
  
  $query=mysqli_query($koneksi,$sql);
  while($kolom=mysqli_fetch_array($query)){  
?>                
                <tr>
                  <td><?= $kolom['id_beli']; ?></td>                  
                  <td><?= $kolom['tanggal_transaksi']; ?></td>
                  <td><?= $kolom['petugas']; ?></td>                  
                  <td><?= $kolom['dibuat_pada']; ?></td>
                  <td>
                  <!--<a target="blank" href="index.php?p=pembelian-info&token=<?= md5($kolom['id_beli']); ?>"><button type="button" class="btn btn-link"><i class="fas fa-info"></i></button></a>-->
                  <a target="blank" href="index.php?p=pembelian-edit&token=<?= $kolom['id_beli']; ?>"><button type="button" class="btn btn-link"><i class="fas fa-edit"></i></button></a>                    
                  <button type="button" class="btn btn-link infopembelian" data-toggle="modal" data-target="#infoPembelianModal" data-id="<?= $kolom['id_beli']; ?>"><i class="fas fa-info"></i></button> 
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

  <!-- Modal Untuk Informasi Pembelian -->
  <!-- Modal Edit -->
<div class="modal fade" id="infoPembelianModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Informasi Transaksi Pembelian</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
       
        
      </div>
    </div>
  </div>
</div>   
