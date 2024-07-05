<?php
    session_start();
    include "../koneksi.php";

    

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='reset-data'){
            
            $sql1="truncate beli";
            mysqli_query($koneksi,$sql1);
            $sql2="truncate beli_detail";
            mysqli_query($koneksi,$sql2);
            $sql3="truncate jual";
            mysqli_query($koneksi,$sql3);
            $sql4="truncate jual_detail";
            mysqli_query($koneksi,$sql4);
            $sql5="update produk set qty=0,qty_awal=0,hpp=0,hpp_awal=0";
            mysqli_query($koneksi,$sql5);
            header('location:../index.php');
        }       
        
    }
?>