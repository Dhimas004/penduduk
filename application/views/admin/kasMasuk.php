        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
        	<!-- DATA TABLE-->
        	<?php if ($this->session->flashdata('message')): ?>
        		<br>
        		<?= $this->session->flashdata('message'); ?>
        	<?php endif; ?>
        	<section class="p-t-60">
        		<div class="container">
        			<div class="row">
        				<div class="col-md-12">
        					<div class="table-data__tool">
        						<div class="table-data__tool-left">
        							<h3 class="title-5">data kas Masuk</h3>
        						</div>
        						<div class="table-data__tool-right">
        							<button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addKasMasukModal">
        								<i class="zmdi zmdi-plus"></i>pemasukan</button>
        						</div>
        					</div>
        					<!-- DATA TABLE-->
        					<div class="table-responsive m-b-40">
        						<table class="table table-borderless table-data3">
        							<thead>
        								<tr>
        									<th>Nomor</th>
        									<th>Nama Warga</th>
        									<th>Keterangan</th>
        									<th>Tanggal</th>
        									<th>Tanggal Pembayaran</th>
        									<th>Status Persetujuan</th>
        									<th>Tanggal Persetujuan</th>
        									<th>Jumlah</th>
        									<th>Aksi</th>
        								</tr>
        							</thead>
        							<tbody>
        								<?php
										$total = 0;
										foreach ($masuk as $msk) {
											if ($msk->status == 'kas') {
										?>
        										<tr>
        											<td><?= $msk->idKas; ?></td>
        											<td><?= ($msk->idWarga != 0 ? $namaWarga[$msk->idWarga] : ''); ?></td>
        											<td><?= $msk->keterangan; ?></td>
        											<td><?= tgl_indo($msk->tanggal) ?></td>
        											<td><?= tgl_indo($msk->created_at) ?></td>
        											<td><?php
														if ($msk->status_persetujuan == '0') echo "Belum Disetujui";
														else if ($msk->status_persetujuan == '1') echo "Sudah Disetujui";
														else if ($msk->status_persetujuan == '2') echo "Ditolak <br/><small>(" . $msk->alasan_penolakan . ")</small>";
														?></td>
        											<td><?= ($msk->tanggal_persetujuan != null ? tgl_indo($msk->tanggal_persetujuan) : ''); ?></td>
        											<td><?= rupiah($msk->jumlah); ?></td>
        											<td>
        												<div class="table-data-feature">
        													<?php if ($msk->status_persetujuan == 0) { ?>
        														<button class="item" data-toggle="modal" data-target="#setujuiPembayaranKas<?= $msk->idKas; ?>" data-placement="top" title="Edit">
        															<i class="zmdi zmdi-check" style="color: green;"></i>
        														</button>
        														<button class="item" data-toggle="modal" data-target="#tolakPembayaranKas<?= $msk->idKas; ?>" data-placement="top" title="Edit">
        															<i class="zmdi zmdi-close" style="color: red;"></i>
        														</button>
        													<?php } ?>
        													<button class="item" data-toggle="modal" data-target="#editKasModal<?= $msk->idKas; ?>" data-placement="top" title="Edit">
        														<i class="zmdi zmdi-edit"></i>
        													</button>
        													<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
        														<a href="#!" onclick="deleteConfirm('<?= base_url('penduduk/delkas/' . $msk->idKas); ?>')">
        															<i class="zmdi zmdi-delete" style="color:red"></i>
        													</button>
        												</div>
        											</td>
        										</tr>
        								<?php
												$total += $msk->jumlah;
											}
										} ?>
        							</tbody>
        							<thead>
        								<tr>
        									<th colspan="7" scope="col">Total</th>
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
        	<div class="modal fade" id="addKasMasukModal" tabindex="-1" role="dialog" aria-labelledby="addKasMasukModal" aria-hidden="true">
        		<div class="modal-dialog modal-dialog-centered" role="document">
        			<div class="modal-content">
        				<div class="modal-header">
        					<h4 class="modal-title" id="addKasMasukModal">Tambah Kas Masuk</h4>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				</div>
        				<div class="modal-body">
        					<div class="login-form">
        						<form action="<?= base_url('penduduk/addKas'); ?>" method="post">
        							<div class="form-group">
        								<label>Nomor</label>
        								<input class="form-control" type="text" name="id_kas" id="id_kas" value="3000<?= sprintf("%04s", $idKas); ?>" readonly>
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
        								<label>Keterangan</label>
        								<textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?= set_value('keterangan'); ?>" required></textarea>
        							</div>
        							<div class="form-group">
        								<label>Tanggal</label>
        								<input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= set_value('tanggal'); ?>" required>
        							</div>
        							<div class="form-group">
        								<label>Jumlah</label>
        								<input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="Jumlah Kas Masuk" value="<?= set_value('jumlah'); ?>" required>
        							</div>
        							<div class="form-group" hidden>
        								<label>Jenis</label>
        								<input class="form-control" type="text" name="jenis" id="jenis" value="masuk" required>
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
        	<!-- end modal addKasMasuk -->

        	<!-- modal editKasModal -->
        	<?php $no = 0;
			foreach ($masuk as $val): $no++; ?>
        		<div class="modal fade" id="editKasModal<?= $val->idKas; ?>" tabindex="-1" role="dialog" aria-labelledby="editKasModal" aria-hidden="true">
        			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h4 class="modal-title" id="editKasModal">Edit Kas Masuk</h4>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					</div>
        					<div class="modal-body">
        						<div class="login-form">
        							<?= form_open_multipart('penduduk/editkas'); ?>
        							<input type="hidden" name="idKas" id="idKas" value="<?= $val->idKas; ?>">
        							<div class="form-group">
        								<label>Nomor</label>
        								<input class="form-control" type="text" name="id_kas" id="id_kas" value="<?= $val->idKas; ?>" readonly>
        							</div>
        							<div class="form-group">
        								<label>Nama Warga</label>
        								<select class="form-control" name="idWarga" id="idWarga" value="<?= $val->idWarga; ?>">
        									<option value="">Pilih ...</option>
        									<?php
											foreach ($warga as $w) {
												echo "<option value='" . $w->idWarga . "' " . ($w->idWarga == $val->idWarga ? 'selected' : '') . ">" . ucwords(strtolower($w->nama)) . "</option>";
											}
											?>
        								</select>
        							</div>
        							<div class="form-group">
        								<label>Keterangan</label>
        								<textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required><?= $val->keterangan; ?></textarea>
        							</div>
        							<div class="form-group">
        								<label>Tanggal</label>
        								<input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= $val->tanggal; ?>">
        							</div>
        							<div class="form-group">
        								<label>Jumlah</label>
        								<input class="form-control" type="number" name="jumlah" id="jumlah" value="<?= $val->jumlah; ?>">
        							</div>
        							<div class="form-group" hidden>
        								<label>Jenis</label>
        								<input class="form-control" type="text" name="jenis" id="jenis" value="<?= $val->jenis; ?>" readonly>
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

        		<div class="modal fade" id="setujuiPembayaranKas<?= $val->idKas; ?>" tabindex="-1" role="dialog" aria-labelledby="editKasModal" aria-hidden="true">
        			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h4 class="modal-title" id="editKasModal">Setujui Pembayaran</h4>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					</div>
        					<?= form_open_multipart('penduduk/setujuiPembayaranKasAction'); ?>
        					<div class="modal-body">
        						<div class="login-form">
        							<input type="hidden" name="idKas" id="idKas" value="<?= $val->idKas; ?>">
        							<table class="table table-bordered">
        								<tbody>
        									<tr>
        										<td>Nomor</td>
        										<td><?= $val->idKas; ?></td>
        									</tr>
        									<tr>
        										<td>Nama Warga</td>
        										<td><?= ($val->idWarga != 0 ?  $namaWarga[$val->idWarga] : ''); ?></td>
        									</tr>
        									<tr>
        										<td style="width: 43%;">Tanggal Pembayaran</td>
        										<td><?= tgl_indo($val->tanggal); ?></td>
        									</tr>
        								</tbody>
        							</table>
        						</div>
        					</div>
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        						<button type="submit" class="btn btn-primary">Konfirmasi</button>
        					</div>
        					</form>
        				</div>
        			</div>
        		</div>

        		<div class="modal fade" id="tolakPembayaranKas<?= $val->idKas; ?>" tabindex="-1" role="dialog" aria-labelledby="editKasModal" aria-hidden="true">
        			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h4 class="modal-title" id="editKasModal">Tolak Pembayaran</h4>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					</div>
        					<?= form_open_multipart('penduduk/tolakPembayaranKasAction'); ?>
        					<div class="modal-body">
        						<div class="login-form">
        							<input type="hidden" name="idKas" id="idKas" value="<?= $val->idKas; ?>">
        							<table class="table table-bordered">
        								<tbody>
        									<tr>
        										<td>Nomor</td>
        										<td><?= $val->idKas; ?></td>
        									</tr>
        									<tr>
        										<td>Nama Warga</td>
        										<td><?= ($val->idWarga != 0 ?  $namaWarga[$val->idWarga] : ''); ?></td>
        									</tr>
        									<tr>
        										<td style="width: 43%;">Tanggal Pembayaran</td>
        										<td><?= tgl_indo($val->tanggal); ?></td>
        									</tr>
        								</tbody>
        							</table>
        							<br />
        							<div class="form-group">
        								<label for="alasan_penolakan">Alasan Penolakan</label>
        								<textarea class="form-control" name="alasan_penolakan" id="alasan_penolakan" style="height: 100px;"></textarea>
        							</div>
        						</div>
        					</div>
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        						<button type="submit" class="btn btn-primary">Konfirmasi</button>
        					</div>
        					</form>
        				</div>
        			</div>
        		</div>
        	<?php endforeach; ?>
        	<!-- end modal editKasModal -->