        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
        	<!-- DATA TABLE-->
        	<section class="p-t-60">
        		<div class="container">
        			<div class="row">
        				<div class="col-md-12">
        					<div class="table-data__tool">
        						<div class="table-data__tool-left">
        							<h3 class="title-5">Setujui Pembayaran Sampah</h3>
        						</div>
        						<div class="table-data__tool-right">
        						</div>
        					</div>
        					<!-- DATA TABLE-->
        					<div class="table-responsive m-b-40">
        						<?php if (count($pembayaranSampah) > 0) { ?>
        							<table class="table table-borderless table-data3">
        								<thead>
        									<tr>
        										<th>nomor</th>
        										<th>Nama Warga</th>
        										<th>tanggal</th>
        										<th>jumlah</th>
        										<th>aksi</th>
        									</tr>
        								</thead>
        								<tbody>
        									<?php
											$total = 0;
											foreach ($pembayaranSampah as $ps) { ?>
        										<tr>
        											<td><?= $ps->idKas; ?></td>
        											<td><?= ($ps->idWarga != 0 ? ucwords(strtolower($namaWarga[$ps->idWarga])) : ''); ?></td>
        											<td><?= tgl_indo($ps->tanggal); ?></td>
        											<td><?= rupiah($ps->jumlah); ?></td>
        											<td>
        												<div class="table-data-feature">
        													<button class="item" data-toggle="modal" data-target="#editKasModal<?= $ps->idKas; ?> " data-placement="top" title="Edit">
        														<i class="zmdi zmdi-check" style="color: green;"></i>
        													</button>
        													<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
        														<a href="#!" onclick="deleteConfirm('<?= $ps->idKas; ?>')">
        															<i class="zmdi zmdi-close" style="color:red"></i>
        													</button>
        												</div>
        											</td>
        										</tr>
        									<?php
												$total += $ps->jumlah;
											} ?>
        								</tbody>
        								<thead>
        									<tr>
        										<th colspan="3" scope="col">Total</th>
        										<th scope="col"><?= rupiah($total); ?></th>
        										<th scope="col">&nbsp;</th>
        									</tr>
        								</thead>
        							</table>
        						<?php } else { ?>
        							TIDAK ADA PEMBAYARAN SAMPAH YANG BELUM DISETUJUI
        						<?php } ?>
        					</div>
        					<!-- END DATA TABLE-->
        				</div>
        			</div>
        		</div>
        	</section>
        	<!-- END DATA TABLE-->

        	<!-- modal addKasKeluar -->
        	<div class="modal fade" id="addKasKeluarModal" tabindex="-1" role="dialog" aria-labelledby="addKasKeluarModal" aria-hidden="true">
        		<div class="modal-dialog modal-dialog-centered" role="document">
        			<div class="modal-content">
        				<div class="modal-header">
        					<h4 class="modal-title" id="addKasKeluarModal">Tambah Kas Keluar</h4>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				</div>
        				<div class="modal-body">
        					<div class="login-form">
        						<form action="<?= base_url('penduduk/setujuiPembayaranSampah'); ?>" method="post">
        							<table class="table table-bordered">
        								<tbody>
        									<tr>
        										<td>Nomor</td>
        										<td>Nama Warga</td>
        										<td>Tanggal Pembayaran</td>
        									</tr>
        								</tbody>
        							</table>
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
        	<!-- end modal addKasKeluar -->

        	<!-- modal editKasModal -->
        	<?php $no = 0;
			foreach ($pembayaranSampah as $val): $no++; ?>
        		<div class="modal fade" id="editKasModal<?= $val->idKas; ?>" tabindex="-1" role="dialog" aria-labelledby="editKasModal" aria-hidden="true">
        			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h4 class="modal-title" id="editKasModal">Setujui Pembayaran</h4>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					</div>
        					<?= form_open_multipart('penduduk/setujuiPembayaranSampahAction'); ?>
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
        	<?php endforeach; ?>
        	<!-- end modal editKasModal -->