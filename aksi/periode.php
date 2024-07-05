<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            
        }
        else if($_POST['aksi']=='ubah'){
            $id_periode=$_POST['id_periode'];
            $tanggal_mulai=$_POST['tanggal_mulai'];
            $tanggal_selesai=$_POST['tanggal_selesai'];
            

            $sql="update periode_pembukuan set tanggal_mulai='$tanggal_mulai',tanggal_selesai='$tanggal_selesai' where id_periode=$id_periode";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=keuangan-periode');
        }
        else if($_POST['aksi']=='proses-keuangan-bulanan'){
            $tanggal_mulai=$_POST['tanggal_mulai'];
            $tanggal_selesai=$_POST['tanggal_selesai'];
            $kode=$_POST['kode'];

            $sql="select id_anggota as ida,nama,alamat,is_individual,saldo,belanja_wajib,(select sum(total) from jual where id_anggota=ida and metode_bayar='POTONG SALDO ANGGOTA' and (tanggal_transaksi>='$tanggal_mulai' and tanggal_transaksi<='$tanggal_selesai')) as total_belanja,(select SUM(jual_cicil.jumlah_tagihan) from jual_cicil,jual where jual_cicil.id_jual=jual.id_jual and jual.id_anggota=ida and (tanggal_jatuh_tempo>='$tanggal_mulai' and tanggal_jatuh_tempo<='$tanggal_selesai')) as total_belanja_cicil from anggota where is_individual=1 and id_anggota!=1 order by nama";
            //echo $sql;
            $query=mysqli_query($koneksi,$sql);
            while($kolom=mysqli_fetch_array($query)){  
                $id_anggota=$kolom['ida'];
                //$belanja_wajib=50000;    
                //$total_belanja=$kolom['total_belanja']+$kolom['total_belanja_cicil'];
                //$saldo_awal=$kolom['saldo']+$total_belanja;
                //$sisa_saldo_belanja=$saldo_awal+$belanja_wajib-$total_belanja;               
                

                //if($sisa_saldo_belanja>=0){
                //    $potongan_toko=50000;
                //} else {
                //    $potongan_toko=(-1*$sisa_saldo_belanja)+50000;
                //}
                
                //$total_potongan=$potongan_toko;

                $belanja_wajib=$kolom['belanja_wajib'];    
                $total_belanja=$kolom['total_belanja']+$kolom['total_belanja_cicil'];
                //$saldo_awal=$kolom['saldo']+$total_belanja;
                $saldo_awal=$kolom['saldo']+$kolom['total_belanja'];                
                $sisa_saldo_belanja=$saldo_awal+$belanja_wajib-$total_belanja;    
                if($sisa_saldo_belanja>=0){
                $potongan_toko=$kolom['belanja_wajib'];
                } else {
                $potongan_toko=(-1*$sisa_saldo_belanja)+$kolom['belanja_wajib'];
                }
                
                $total_potongan=$potongan_toko;
                // Catat Mutasi Saldo
                $sql1="insert into anggota_mutasi_saldo(id_anggota,tanggal,jumlah,keterangan) values($id_anggota,'$tanggal_selesai',$total_potongan,'$kode')";
                mysqli_query($koneksi,$sql1);

                // Update Saldo Anggota
                if($sisa_saldo_belanja<0){
                    $sisa_saldo_belanja=0;
                }
                $sql2="update anggota set saldo=$sisa_saldo_belanja where id_anggota=$id_anggota";
                mysqli_query($koneksi,$sql2);

                // Kunci Periode Keuangan
                $sql3="update periode_pembukuan set is_locked=1 where kode='$kode'";
                mysqli_query($koneksi,$sql3);

                // Update Status Cicilan
                $sql5="update jual_cicil set is_terbayar=1,diubah_pada=DEFAULT where tanggal_jatuh_tempo>='$tanggal_mulai' and tanggal_jatuh_tempo<='$tanggal_selesai'";
                mysqli_query($koneksi,$sql5);

                // Simpan Log Perubahan
                $sql4="insert into periode_pembukuan_log (kode, id_anggota, saldo_awal, belanja_wajib, belanja_toko, sisa_saldo, total_potongan, dibuat_pada, diubah_pada) values('$kode', $id_anggota, $saldo_awal, $belanja_wajib, $total_belanja, $sisa_saldo_belanja, $total_potongan, DEFAULT, DEFAULT)";
                mysqli_query($koneksi,$sql4);
                
                //echo $sql1."<br>";
                
                }
                header('location:../index.php?p=keuangan-periode');

        }
    }

    if(!empty($_GET['aksi'])){        
        
    }
?>