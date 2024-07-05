<?php
session_start();
include '../../koneksi.php';

//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {   

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number        
        
        $this->Cell(0, 10, 'Dicetak Oleh : '.$_SESSION['backend_user_nama'].' pada '.date("d-M-Y H:i:s"), 0, false, 'L', 0, '', 0, false, 'T','M');
        $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        // output the HTML content
        // $pdf->writeHTML($html_footer, true, false, true, false, '');
    }
}


// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('POS');
$pdf->SetTitle('Invoice Transaksi');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('Invoice');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT,15, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->SetPrintHeader(false);
// $pdf->setPrintFooter(false);
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$id_jual=$_GET['token'];
$sql1="SELECT jual.*,anggota.nama as napel,akun.akun from jual,anggota,akun where jual.id_akun=akun.id_akun and jual.id_anggota=anggota.id_anggota and md5(id_jual)='$id_jual'";

$query1=mysqli_query($koneksi,$sql1);
$kolom1=mysqli_fetch_array($query1);

// create some HTML content
$html = '<p style="text-align: center;"><strong>INVOICE</strong></p>
<table style="width:100%;">
    <tr>
        <th rowspan="4" width="15%"><img src="../../'.$APP_LOGO.'" width="80"></th>
        <th rowspan="4" width="45%">'.$APP_COMPANY_NAME.'<br>'.$APP_COMPANY_ADDRESS.'<br>'.$APP_COMPANY_PHONE.'</th>
        <td width="20%">No Invoice</td>
        <td width="20%">:#'.$kolom1['id_jual'].' </td>        
    </tr>
    <tr>
        <td>Tanggal Transaksi</td>
        <td>:'.date("d-M-Y", strtotime($kolom1['tanggal_transaksi'])).'</td>
    </tr>
    <tr>    
        <td>Pelanggan</td>
        <td>:'.$kolom1['napel'].' </td>        
    </tr>
    <tr>
        <td>Metode Bayar</td>
        <td>:'.$kolom1['akun'].'</td>
    </tr>
</table>
<br><br>
<table style="border-collapse: collapse;" border="1">
    <thead>
    <tr >      
      <td align="center" style="width:5%;">#</td>
      <td align="center" style="width:50%;">Deskripsi Produk</td>
      <td align="center" style="width:15%;">Harga</td>
      <td align="center" style="width:10%;">Jumlah</td>
      <td align="center" style="width:20%;">Subtotal</td>
    </tr>
    </thead>
<tbody>';

$sql2="SELECT jual_detail.*,jual.diskon from jual_detail,jual where jual_detail.id_jual=jual.id_jual and md5(jual_detail.id_jual)='$id_jual'";
$query2=mysqli_query($koneksi,$sql2);
$no=0;
$grandtotal=0;
$jumlah_item=0;
while($kolom2=mysqli_fetch_array($query2)){
$no++;
$diskon=$kolom2['diskon'];
$harga=number_format($kolom2['harga_jual']);
$jumlah=number_format($kolom2['jumlah'],2);
$jumlah_item=$jumlah_item+$jumlah;
$subtotal=number_format($kolom2['jumlah']*$kolom2['harga_jual']);
$grandtotal=$grandtotal+($kolom2['jumlah']*$kolom2['harga_jual']);
$html.='
        <tr>
            <td style="width:5%;"> '.$no.'</td>
            <td style="width:50%;"> '.$kolom2['produk'].' </td>
            <td align="right" style="width:15%;">'.$harga.' </td>
            <td align="right" style="width:10%;">'.$jumlah.' </td>
            <td align="right" style="width:20%;">'.$subtotal.' </td>
        </tr>
        ';
}        
$terbayar=$kolom1['terbayar'];
$sisa=($kolom1['total']-$kolom1['diskon']+$kolom1['pajak'])-$terbayar;
$html.='
</tbody>

<tr>
<td align="left" colspan="3"> TOTAL</td>
<td align="right" >'.number_format($jumlah_item,2).'</td>
<td align="right" >Rp. '.number_format($grandtotal).'</td>
</tr>
<tr>
<td align="left" colspan="4" > DISKON</td>
<td align="right" >Rp. '.number_format($diskon).'</td>
</tr>
<tr>
<td align="left" colspan="4" > GRANDTOTAL</td>
<td align="right" >Rp. '.number_format($grandtotal-$diskon).'</td>
</tr>
<tr>
<td align="left" colspan="4" > TERBAYAR</td>
<td align="right" >Rp. '.number_format($terbayar).'</td>
</tr>
<tr>
<td align="left" colspan="4" > SISA TAGIHAN</td>
<td align="right" >Rp. '.number_format($sisa).'</td>
</tr>
</table>';



$html.='

<p align="center">-- Terima Kasih Atas Kunjungan Anda --</p>

';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('invoice.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
