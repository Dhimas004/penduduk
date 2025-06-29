<!-- PAGE CONTENT -->
<div class="page-content--bgf7">
    <!-- INPUT FORM -->
    <section class="p-t-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?= base_url('warga/pembaruanDataAction'); ?>" method="post" enctype="multipart/form-data">
                        <div class="table-data__tool" style="margin-bottom: 10px;">
                            <div class="table-data__tool-left">
                                <h3 class="title-5">Pembaruan Data</h3>
                            </div>
                        </div>
                        <div style="width: 100%;">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td style="width: 15%;">NIK</td>
                                        <td style="width: 20%;"><input type="text" name="nik" class="form-control" value="<?= $dataWarga->nik; ?>" required></td>
                                        <td style="width: 15%;">Status Perkawinan</td>
                                        <td style="width: 20%;">
                                            <select name="status_perkawinan" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                <option <?= ($dataWarga->status_perkawinan == 'belum_menikah' ? 'selected' : '') ?> value="belum_menikah">Belum Menikah</option>
                                                <option <?= ($dataWarga->status_perkawinan == 'sudah_menikah' ? 'selected' : '') ?> value="sudah_menikah">Sudah Menikah</option>
                                                <option <?= ($dataWarga->status_perkawinan == 'janda' ? 'selected' : '') ?> value="janda">Janda</option>
                                                <option <?= ($dataWarga->status_perkawinan == 'duda' ? 'selected' : '') ?> value="duda">Duda</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Warga</td>
                                        <td><input type="text" name="nama" value="<?= $dataWarga->nama; ?>" class="form-control" required></td>
                                        <td>Nama Pasangan</td>
                                        <td><input type="text" name="nama_pasangan" value="<?= $dataWarga->nama_pasangan; ?>" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>
                                            <select name="jekel" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                <option <?= ($dataWarga->jekel == 'laki-laki' ? 'selected' : ''); ?> value="laki-laki">Laki-Laki</option>
                                                <option <?= ($dataWarga->jekel == 'perempuan' ? 'selected' : ''); ?> value="perempuan">Perempuan</option>
                                            </select>
                                        </td>
                                        <td>Nama Anak 1</td>
                                        <td><input type="text" name="nama_anak_1" value="<?= $dataWarga->nama_anak_1; ?>" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>TTL</td>
                                        <td>
                                            <input type="text" name="tempat_lahir" value="<?= $dataWarga->tempat_lahir; ?>" class="form-control mb-2" placeholder="Tempat Lahir" required>
                                            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $dataWarga->tanggal_lahir; ?>" required>
                                        </td>
                                        <td>Nama Anak 2</td>
                                        <td><input type="text" name="nama_anak_2" value="<?= $dataWarga->nama_anak_2; ?>" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><input type="text" name="alamat" value="<?= $dataWarga->alamat; ?>" class="form-control" required></td>
                                        <td>Nama Anak 3</td>
                                        <td><input type="text" name="nama_anak_3" value="<?= $dataWarga->nama_anak_3; ?>" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>RT/RW</td>
                                        <td><input type="text" name="rt_rw" value="<?= $dataWarga->rt_rw; ?>" class="form-control" placeholder="000/000" required></td>
                                        <td>Nama Anak 4</td>
                                        <td><input type="text" name="nama_anak_4" value="<?= $dataWarga->nama_anak_4; ?>" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Upload Berkas (PDF)</td>
                                        <td><input type="file" name="berkas" id="berkas" accept="application/pdf"></td>
                                        <td>Nama Anak 5</td>
                                        <td><input type="text" name="nama_anak_5" value="<?= $dataWarga->nama_anak_5; ?>" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-warning">Perbarui</button>
                                <a href="<?= base_url('warga'); ?>" class="btn btn-secondary">Batal</a>
                            </div>
                            <br />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- END INPUT FORM -->
</div>