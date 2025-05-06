<!DOCTYPE html>
<html>

<head>
	<base href="<?= base_url(); ?>">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="au theme template">
	<meta name="author" content="Hau Nguyen">
	<meta name="keywords" content="au theme template">
	<!-- Title Page-->
	<title>Kas & Sampah - <?= $judul; ?></title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/favicon.png">
	<!-- Fontfaces CSS-->
	<link href="<?= base_url(); ?>assets/css/font-face.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
	<!-- Bootstrap CSS-->
	<link href="<?= base_url(); ?>assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
	<!-- Vendor CSS-->
	<link href="<?= base_url(); ?>assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/wow/animate.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/slick/slick.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
	<link href="<?= base_url(); ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
	<!-- Main CSS-->
	<link href="<?= base_url(); ?>assets/css/theme.css" rel="stylesheet" media="all">
</head>

<body onload="print()">
	<center>
		<table>
			<tr>
				<td>
					<center>
						<h3>Laporan</h3>
						<h5>Jl. Duta Asri Ciakar</h5>
						<h5>Kabupaten Tangerang, Banten – Indonesia</h5>
					</center>
				</td>
			</tr>
		</table>
		<h4>Pemasukan dan Pengeluaran</h4>
	</center>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nomor</th>
				<th>Jenis</th>
				<th>Nama Warga</th>
				<th>Tanggal</th>
				<th>Keterangan</th>
				<th style="text-align: right;">Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$total = 0;
			foreach ($kas as $kas) {
			?>
				<tr>
					<td align="center"><?= $no++; ?></td>
					<td><?= $kas->idKas; ?></td>
					<td><?= ucfirst($kas->jenis); ?></td>
					<td><?= ($kas->idWarga != 0 ? ucwords(strtolower($namaWarga[$kas->idWarga])) : ''); ?></td>
					<td><?= tgl_indo($kas->tanggal); ?></td>
					<td><?= $kas->keterangan; ?></td>
					<td align="right"><?= ($kas->jenis == 'keluar' ? '-' : '') . rupiah($kas->jumlah); ?></td>
				</tr>
			<?php
				if ($kas->jenis == 'masuk') $total += $kas->jumlah;
				else if ($kas->jenis == 'keluar') $total += $kas->jumlah * -1;
			} ?>
		</tbody>
		<thead>
			<tr>
				<th colspan="6" scope="col">Total</th>
				<th scope="col" style="text-align: right;"><?= rupiah($total); ?></th>
			</tr>
		</thead>
	</table>

</body>

</html>