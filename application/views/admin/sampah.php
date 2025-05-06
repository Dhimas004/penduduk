        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
        	<!-- DATA TABLE-->
        	<section class="p-t-60">
        		<div class="container">
        			<div class="row">
        				<div class="col-md-12">
        					<div class="table-data__tool">
        						<div class="table-data__tool-left">
        							<h3 class="title-5">Data Sampah</h3>
        						</div>
        						<div class="table-data__tool-right">
        							<button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addPembayaranSampahModal">
        								<i class="zmdi zmdi-plus"></i>Pembayaran</button>
        						</div>
        					</div>
        					<!-- DATA TABLE-->
        					<div class="table-responsive m-b-40">
        						<table class="table table-borderless table-data3">
        							<thead>
        								<tr>
        									<th>Nomor</th>
        									<th>Nama Warga</th>
        									<th>Tanggal Pembayaran</th>
        									<th>Jumlah</th>
        									<th>Aksi</th>
        								</tr>
        							</thead>
        							<tbody>
        								<?php $total = 0;
										foreach ($sampah as $s): ?>
        									<tr>
        										<td><?= $s->idKas; ?></td>
        										<td><?= $namaWarga[$s->idWarga]; ?></td>
        										<td><?= tgl_indo($s->tanggal); ?></td>
        										<td><?= rupiah($s->jumlah); ?></td>
        										<td>
        											<div class="table-data-feature">
        												<button class="item" data-toggle="modal" data-target="#editPembayaranSampahModal<?= $s->idKas; ?>" data-placement="top" title="Edit">
        													<i class="zmdi zmdi-edit"></i>
        												</button>
        												<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
        													<a href="#!" onclick="deleteConfirm('<?= base_url('penduduk/delkas/' . $s->idKas); ?>')">
        														<i class="zmdi zmdi-delete" style="color:red"></i>
        												</button>
        											</div>
        										</td>
        									</tr>
        								<?php $total += $s->jumlah;
										endforeach; ?>
        							</tbody>
        							<thead>
        								<tr>
        									<th colspan="3" scope="col">Total</th>
        									<th scope="col"><?= rupiah($total); ?></th>
        									<th scope="col">&nbsp;</th>
        								</tr>
        							</thead>
        						</table>
        					</div>
        					<!-- END DATA TABLE-->
        				</div>
        			</div>
        		</div>
        	</section>
        	<!-- END DATA TABLE-->

        	<!-- modal addKasMasuk -->
        	<div class="modal fade" id="addPembayaranSampahModal" tabindex="-1" role="dialog" aria-labelledby="addPembayaranSampahModal" aria-hidden="true">
        		<div class="modal-dialog modal-dialog-centered" role="document">
        			<div class="modal-content">
        				<div class="modal-header">
        					<h4 class="modal-title" id="addPembayaranSampahModal">Tambah Pembayaran Sampah</h4>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				</div>
        				<div class="modal-body">
        					<div class="login-form">
        						<form action="<?= base_url('penduduk/addPembayaranSampah'); ?>" method="post">
        							<div class="form-group">
        								<label>Nomor</label>
        								<input class="form-control" type="text" name="id_kas" id="id_kas" value="4000<?= sprintf("%04s", $idSampah); ?>" readonly>
        							</div>
        							<div class="form-group">
        								<label>Nama Warga</label>
        								<select class="form-control" name="idWarga" id="idWarga" value="<?= set_value('idWarga'); ?>">
        									<option>Pilih ...</option>
        									<?php
											foreach ($warga as $w) {
												echo "<option value='" . $w->idWarga . "'>" . ucwords(strtolower($w->nama)) . "</option>";
											}
											?>
        								</select>
        							</div>
        							<div class="form-group">
        								<label>Tanggal Pembayaran</label>
        								<input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= set_value('tanggal'); ?>" required>
        							</div>
        							<div class="form-group">
        								<label>Jumlah</label>
        								<input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="Jumlah Pembayaran Sampah" value="<?= set_value('jumlah'); ?>" required>
        							</div>
        							<input class="form-control" type="hidden" name="jenis" id="jenis" value="masuk" required>
        							<input class="form-control" type="hidden" name="status" id="status" value="sampah" required>
        							<div class="modal-footer">
        								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        								<button type="submit" class="btn btn-primary">Confirm</button>
        							</div>
        						</form>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	<!-- end modal addKasMasuk -->

        	<!-- modal editPembayaranSampahModal -->
        	<?php $no = 0;
			foreach ($sampah as $s): $no++; ?>
        		<div class="modal fade" id="editPembayaranSampahModal<?= $s->idKas; ?>" tabindex="-1" role="dialog" aria-labelledby="editPembayaranSampahModal" aria-hidden="true">
        			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h4 class="modal-title" id="editPembayaranSampahModal">Edit Pembayaran Sampah</h4>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					</div>
        					<div class="modal-body">
        						<div class="login-form">
        							<?= form_open_multipart('penduduk/editPembayaranSampah'); ?>
        							<input type="hidden" name="idKas" id="idKas" value="<?= $s->idKas; ?>">
        							<div class="form-group">
        								<label>Nomor</label>
        								<input class="form-control" type="text" name="id_kas" id="id_kas" value="<?= $s->idKas; ?>" readonly>
        							</div>
        							<div class="form-group">
        								<label>Nama Warga</label>
        								<select class="form-control" name="idWarga" id="idWarga" value="<?= $s->idWarga; ?>">
        									<option value="">Pilih ...</option>
        									<?php
											foreach ($warga as $w) {
												echo "<option value='" . $w->idWarga . "' " . ($w->idWarga == $s->idWarga ? 'selected' : '') . ">" . ucwords(strtolower($w->nama)) . "</option>";
											}
											?>
        								</select>
        							</div>
        							<div class="form-group">
        								<label>Tanggal Pembayaran</label>
        								<input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= $s->tanggal; ?>">
        							</div>
        							<div class="form-group">
        								<label>Jumlah</label>
        								<input class="form-control" type="number" name="jumlah" id="jumlah" value="<?= $s->jumlah; ?>">
        							</div>

        							<div class="modal-footer">
        								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        								<button type="submit" class="btn btn-primary">Confirm</button>
        							</div>
        							</form>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	<?php endforeach; ?>
        	<!-- end modal editPembayaranSampahModal -->