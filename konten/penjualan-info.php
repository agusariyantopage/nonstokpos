
<?php
    $id_jual=$_GET['token'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Point Of Sales</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Toko</a></li>
              <li class="breadcrumb-item"><a href="index.php?p=daftar-penjualan">Penjualan</a></li>
              <li class="breadcrumb-item active">Informasi Penjualan</li>
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
              <h3>Informasi Transaksi Penjualan</h3>
            </div> 
            <div class="card-body">              
                <?php
                $sql1="select jual.*,anggota.nama as napel from jual,anggota where jual.id_anggota=anggota.id_anggota and md5(id_jual)='$id_jual'";

                $query1=mysqli_query($koneksi,$sql1);
                $kolom1=mysqli_fetch_array($query1);

                echo '
                <div class="row">
                        <div class="col-md-3">No Transaksi</div>
                        <div class="col-md-3">: #'.$kolom1['id_jual'].' </div>
                        <div class="col-md-3">Tanggal Transaksi</div>
                        <div class="col-md-3">: '.$kolom1['tanggal_transaksi'].'</div>
                </div>
                <div class="row">
                        <div class="col-md-3">Anggota</div>
                        <div class="col-md-3">: '.$kolom1['napel'].' </div>
                        <div class="col-md-3">Metode Pembayaran</div>
                        <div class="col-md-3">: '.$kolom1['metode_bayar'].'</div>
                </div>                            
                <br>
                ';
                ?>
              
              <table class="table table-bordered table-striped" style="width:100%;">
                  <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                      </tr>
                  </thead>
                  <tbody>
<?php
                  
                  $sql2="select jual_detail.*,produk.nama from jual_detail,produk where jual_detail.id_produk=produk.id_produk and md5(id_jual)='$id_jual'";
                  $query2=mysqli_query($koneksi,$sql2);                  
                  $no=0;
                  $grandtotal=0;
                  while($kolom2=mysqli_fetch_array($query2)){
                    $no++;
                    $harga=number_format($kolom2['harga_jual']);
                    $jumlah=number_format($kolom2['jumlah']);
                    $subtotal=number_format($kolom2['jumlah']*$kolom2['harga_jual']);
                    $grandtotal=$grandtotal+($kolom2['jumlah']*$kolom2['harga_jual']);
                    $token=md5($kolom2['id_jual']);
                    echo "
                    <tr>
                      <td>$no</td>
                      <td>$kolom2[id_produk]</td>
                      <td>$kolom2[nama]</td>
                      <td align=right>$harga</td>
                      <td align=right style='width:150px;'>$jumlah</td>
                      <td align=right>$subtotal</td>
                    </tr>
                    ";
                  }
?>

                  </tbody>
                  <tfoot>
                    <td align='center' colspan="5">GRANDTOTAL</td>
                    <td align='right'><p><?= number_format($grandtotal); ?></p></td>
                  </tfoot>
                  </table>                

            </div> 
          </div>         
        </div>
        <br><br>
        <?php
          if($kolom1['metode_bayar']=='CICIL BAYAR'){
        ?>
        <table class="table table-bordered table-striped" style="width:100%;">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Tanggal Jatuh Tempo</th>
              <th scope="col">Nominal Bayar</th>
              <th scope="col">Lunas</th>              
            </tr>
          </thead>
          <tbody>

          </tbody>
          </table>            
        <?php
          }
        ?>
      </row>
      
        
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


