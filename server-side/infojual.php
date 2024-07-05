<?php
include "../koneksi.php";
$id_jual = $_POST['idjual'];
$sql1 = "SELECT jual.*,anggota.nama as napel,akun.akun from jual,anggota,akun where jual.id_akun=akun.id_akun and jual.id_anggota=anggota.id_anggota and id_jual='$id_jual'";

$query1 = mysqli_query($koneksi, $sql1);
$kolom1 = mysqli_fetch_array($query1);
$terbayar = $kolom1['terbayar'];
$pajak = $kolom1['pajak'];
$diskon = $kolom1['diskon'];

echo '
<div class="row">
		<div class="col-md-3 col-sm-6">No Transaksi</div>
		<div class="col-md-3 col-sm-6">: #' . $kolom1['id_jual'] . ' </div>
		<div class="col-md-3 col-sm-6">Tanggal Transaksi</div>
		<div class="col-md-3 col-sm-6">: ' . date("d-M-Y", strtotime($kolom1['tanggal_transaksi'])) . '</div>
</div>
<div class="row">
		<div class="col-md-3">Pelanggan</div>
		<div class="col-md-3">: ' . $kolom1['napel'] . ' </div>
		<div class="col-md-3">Status Pembayaran</div>
		<div class="col-md-3">: ' . $kolom1['status_bayar'] . '</div>
</div><br>';
?>
<table class="table table-bordered table-striped table-sm" style="width:100%;">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>

			<th scope="col">Deskripsi Produk</th>
			<th scope="col">Harga</th>
			<th scope="col">Jumlah</th>
			<th scope="col">Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php

		$sql2 = "SELECT jual_detail.* from jual_detail where id_jual='$id_jual' ORDER BY produk";
		$query2 = mysqli_query($koneksi, $sql2);
		$no = 0;
		$grandtotal = 0;
		$jumlah_item = 0;
		while ($kolom2 = mysqli_fetch_array($query2)) {
			$no++;
			$harga = number_format($kolom2['harga_jual']);
			$jumlah = number_format($kolom2['jumlah'], 2);
			$jumlah_item = $jumlah_item + $jumlah;
			$subtotal = number_format($kolom2['jumlah'] * $kolom2['harga_jual']);
			$grandtotal = $grandtotal + ($kolom2['jumlah'] * $kolom2['harga_jual']);
			$token = md5($kolom2['id_jual']);
			echo "
		<tr>
			<td>$no</td>
			
			<td>$kolom2[produk]</td>
			<td align=right>$harga</td>
			<td align=right style='width:150px;'>$jumlah</td>
			<td align=right>$subtotal</td>
		</tr>
		";
		}
		?>

	</tbody>
	<tfoot class="text-bold">
		<tr>
			<td align='left' colspan="3">TOTAL</td>
			<td align="right"><?= number_format($jumlah_item, 2) ?></td>
			<td align='right'>
				<p><?= number_format($grandtotal); ?></p>
			</td>
		</tr>
		<tr>
			<td align='left' colspan="4">DISKON</td>
			<td align='right'>
				<p><?= number_format($diskon); ?></p>
			</td>
		</tr>
		<tr>
			<td align='left' colspan="4">GRANDTOTAL</td>
			<td align='right'>
				<p><?= number_format($grandtotal - $diskon); ?></p>
			</td>
		</tr>
		<tr>
			<td align='left' colspan="4">TERBAYAR</td>
			<td align='right'>
				<p><?= number_format($terbayar); ?></p>
			</td>
		</tr>
		<tr>
			<td align='left' colspan="4">SISA PEMBAYARAN</td>
			<td align='right'>
				<p><?= number_format(-$terbayar + $grandtotal - $diskon); ?></p>
			</td>
		</tr>
	</tfoot>
</table>

<?php
if (-$terbayar + $grandtotal - $diskon > 0) {
	echo "
		<label>PROSES SISA PEMBAYARAN</label>
	";
?>

<form action="aksi/jual_pembayaran.php" method="post">
	<input type="hidden" name="aksi" value="tambah">
	<div class="form-row">
		<div class="form-group col-sm-3">
			<label for="tanggal">Tanggal</label>
			<input class="form-control" type="date" placeholder="tanggal . . ." name="tanggal_transaksi" required value="<?= date('Y-m-d'); ?>">
		</div>
		<div class="form-group col-sm-5">
			<label for="deskripsi">Metode Bayar</label>
			<select name="id_akun" class="form-control" required>
                <option value="">-- Pilih Metode Bayar --</option>
                <?php
                $sql_non_tunai = "SELECT * from akun WHERE id_akun=3 OR keterangan='Pembayaran Non Tunai' ORDER BY id_akun";
                $query_non_tunai = mysqli_query($koneksi, $sql_non_tunai);
                while ($kolom_non_tunai = mysqli_fetch_array($query_non_tunai)) {
                  echo "<option value='$kolom_non_tunai[id_akun]'>$kolom_non_tunai[akun]</option>";
                }

                ?>
              </select>
		</div>
		<div class="form-group col-sm-2">
			<label for="jumlah">Nominal</label>
			<input class="form-control" type="number" value="0" min="1" max="<?= -$terbayar + $grandtotal - $diskon; ?>" autofocus placeholder="Nominal Bayar . . ." name="jumlah" required>
		</div>
		<div class="form-group col-sm-2 align-self-end">
				<input type="hidden" name="id_jual" value="<?= $id_jual; ?>">
			<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> Bayar</button>
		</div>

	</div>
</form>

<?php } ?>