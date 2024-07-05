<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='proses-beda-total'){
            $id_jual=$_POST['id_jual'];
            $selisih=$_POST['selisih'];
            $id_anggota=$_POST['id_anggota'];

            $sql1="UPDATE jual set total=total+$selisih WHERE id_jual=$id_jual";
            $sql2="UPDATE anggota set saldo=saldo-$selisih WHERE id_anggota=$id_anggota";

            mysqli_query($koneksi,$sql1);
            mysqli_query($koneksi,$sql2);

            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='SUKSES SIMPAN JUAL';                    
            }   
        }
        
        else if($_POST['aksi']=='ubah'){
            
        } 
    }

    if(!empty($_GET['aksi'])){        
        if($_GET['aksi']=='merge'){
            $id1=$_GET['id1'];
            $id2=$_GET['id2'];

            // Cek Data TRX1
            $sql1="select * from jual_detail where id_jual=$id1";
            $query1=mysqli_query($koneksi,$sql1);
            $ketemu1=mysqli_num_rows($query1);

            // Cek Data TRX2
            $sql2="select * from jual_detail where id_jual=$id2";
            $query2=mysqli_query($koneksi,$sql2);
            $ketemu2=mysqli_num_rows($query2);

            if($ketemu1>=1 && $ketemu2==0){
                
                $sql="select * from jual where id_jual=$id2";
                $query=mysqli_query($koneksi,$sql);
                $data=mysqli_fetch_array($query);
                $metode_bayar=$data['metode_bayar'];
                $id_anggota=$data['id_anggota'];
                $total=$data['total'];
                
                if($metode_bayar=='POTONG SALDO ANGGOTA'){
                    $sql_upd1="update anggota set saldo=saldo+$total where id_anggota=$id_anggota";
                    //echo $sql_upd1;
                    mysqli_query($koneksi,$sql_upd1);
                }
                
                $sql_upd2="delete from jual where id_jual=$id2"; 
                mysqli_query($koneksi,$sql_upd2);                               

            }
            
            header('location:../index.php?p=pemeliharaan');

        }
    }
?>