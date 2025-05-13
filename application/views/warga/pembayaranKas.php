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
                                    <h3 class="title-5">Pembayaran Kas</h3>
                                </div>
                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addKasMasukModal">
                                        <i class="zmdi zmdi-plus"></i>Bayar</button>
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
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        foreach ($kas as $k) { ?>
                                            <tr>
                                                <td><?= $k->idKas; ?></td>
                                                <td><?= ($k->idWarga != 0 ? $namaWarga[$k->idWarga] : ''); ?></td>
                                                <td><?= $k->keterangan; ?></td>
                                                <td><?= date('d-m-Y', strtotime($k->tanggal)); ?></td>
                                                <td><?= rupiah($k->jumlah); ?></td>
                                                <td>
                                                    <?php if ($k->status_persetujuan == 0) { ?>
                                                        <div class="table-data-feature">
                                                            <button class="item" data-toggle="modal" data-target="#editKasModal<?= $k->idKas; ?>" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <a href="#!" onclick="deleteConfirm('<?= base_url('penduduk/delkas/' . $k->idKas); ?>')">
                                                                    <i class="zmdi zmdi-delete" style="color:red"></i>
                                                            </button>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $total += $k->jumlah;
                                        } ?>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="4" scope="col">Total</th>
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
            foreach ($kas as $val): $no++; ?>
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
            <?php endforeach; ?>
            <!-- end modal editKasModal -->