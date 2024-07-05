<?php
    session_start();
    include "../koneksi.php";
    function pesan_transaksi($koneksi)
    {
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'SUKSES';
        } else {
            $_SESSION['status_proses'] = 'GAGAL';
        }
    }

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $kode=$_POST['kode'];            
            $akun=$_POST['akun'];            
            $tipe=$_POST['tipe'];            
            $keterangan=$_POST['keterangan'];            
            $saldo=0;            
                      
            
            $sql="INSERT INTO akun(id_akun, kode, akun, tipe, keterangan, saldo) VALUES (DEFAULT, '$kode', '$akun', '$tipe', '$keterangan', $saldo)";
            mysqli_query($koneksi,$sql);
            pesan_transaksi($koneksi);
            // echo $sql;
            header('location:../index.php?p=coa');
        }
        else if($_POST['aksi']=='ubah'){
            $id_akun=$_POST['id_akun'];            
            $kode=$_POST['kode'];            
            $akun=$_POST['akun'];            
            $tipe=$_POST['tipe'];            
            $keterangan=$_POST['keterangan'];            
            $saldo=0;            
                      
            
            $sql="UPDATE akun SET kode='$kode',akun='$akun',tipe='$tipe',keterangan='$keterangan' WHERE id_akun=$id_akun";
            mysqli_query($koneksi,$sql);
            pesan_transaksi($koneksi);
            // echo $sql;
            header('location:../index.php?p=coa');
        }
        
    }
    

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $x0=$_GET['token'];
            // Jalankan Prosedur Cek Data
            $cek1="select * from akun_mutasi where md5(id_produk)='$x0'";
            $query1=mysqli_query($koneksi,$cek1);
            $ketemu1=mysqli_num_rows($query1);
            if($ketemu1==0){
                $cek2="select * from jual_detail where md5(id_produk)='$x0'";
                $query2=mysqli_query($koneksi,$cek2);
                $ketemu2=mysqli_num_rows($query2);
                if($ketemu2==0){
                    $sql="delete from produk where md5(id_produk)='$x0'";
                    mysqli_query($koneksi,$sql);
                    //echo $sql;
                }
            }
            
            //echo $sql;
            header('location:../index.php?p=produk');
        }
        if($_GET['aksi']=='buang-spasi'){
            $sql="update produk set nama=trim(nama)";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=produk');
        }
        if($_GET['aksi']=='set-kapital'){
            $sql="update produk set nama=upper(nama)";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=produk');
        }
        if($_GET['aksi']=='set-proper'){
            $sql="UPDATE produk SET nama = CONCAT(UPPER(SUBSTRING(nama, 1, 1)), LOWER(SUBSTRING(nama FROM 2)))";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=produk');
        }
        
    }
?>