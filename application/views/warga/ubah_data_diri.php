<!-- PAGE CONTENT-->
<div class="page-content--bgf7">
    <!-- INPUT FORM-->
    <section class="p-t-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?= base_url('warga/editWarga'); ?>" method="post">
                        <input type="hidden" name="url" value="ubahDataDiri">
                        <div class="table-data__tool" style="margin-bottom: 10px;">
                            <div class="table-data__tool-left">
                                <h3 class="title-5">Ubah Data Diri</h3>
                            </div>
                        </div>
                        <div style="width: 100%;">
                            <?php
                            if ($user['idWarga'] != 0) {
                            ?>
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td style="width: 15%;">ID Warga</td>
                                            <td style="width: 20%;"><input type="text" name="idWarga" class="form-control" value="<?= $dataWarga['idWarga']; ?>" readonly /></td>
                                            <td style="width: 15%;">Status Perkawinan</td>
                                            <td style="width: 20%;">
                                                <select name="status_perkawinan" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="belum_menikah" <?= ($dataWarga['status_perkawinan'] == 'belum_menikah' ? 'selected' : ''); ?>>Belum Menikah</option>
                                                    <option value="sudah_menikah" <?= ($dataWarga['status_perkawinan'] == 'sudah_menikah' ? 'selected' : ''); ?>>Sudah Menikah</option>
                                                    <option value="janda" <?= ($dataWarga['status_perkawinan'] == 'janda' ? 'selected' : ''); ?>>Janda</option>
                                                    <option value="duda" <?= ($dataWarga['status_perkawinan'] == 'duda' ? 'selected' : ''); ?>>Duda</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td><input type="text" name="nik" value="<?= $dataWarga['nik']; ?>" class="form-control" /></td>
                                            <td>Pasangan</td>
                                            <td><input type="text" name="nama_pasangan" value="<?= $dataWarga['nama_pasangan']; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Warga</td>
                                            <td><input type="text" name="nama" class="form-control" value="<?= $dataWarga['nama']; ?>" /></td>
                                            <td>Anak 1</td>
                                            <td><input type="text" name="nama_anak_1" value="<?= $dataWarga['nama_anak_1']; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>
                                                <select name="jekel" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="laki-laki" <?= ($dataWarga['jekel'] == 'laki-laki' ? 'selected' : ''); ?>>Laki-Laki</option>
                                                    <option value="perempuan" <?= ($dataWarga['jekel'] == 'perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                                                </select>
                                            </td>
                                            <td>Anak 2</td>
                                            <td><input type="text" name="nama_anak_2" value="<?= $dataWarga['nama_anak_2']; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>
                                                <input type="text" name="tempat_lahir" value="<?= $dataWarga['tempat_lahir']; ?>" class="form-control mb-2" placeholder="Tempat Lahir" />
                                                <input type="date" name="tanggal_lahir" class="form-control" value="<?= $dataWarga['tanggal_lahir']; ?>" />
                                            </td>
                                            <td>Anak 3</td>
                                            <td><input type="text" name="nama_anak_3" value="<?= $dataWarga['nama_anak_3']; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><input type="text" name="alamat" value="<?= $dataWarga['alamat']; ?>" class="form-control" /></td>
                                            <td>Anak 4</td>
                                            <td><input type="text" name="nama_anak_4" value="<?= $dataWarga['nama_anak_4']; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>RT/RW</td>
                                            <td><input type="text" name="rt_rw" value="<?= $dataWarga['rt_rw']; ?>" class="form-control" placeholder="000/000" /></td>
                                            <td>Anak 5</td>
                                            <td><input type="text" name="nama_anak_5" value="<?= $dataWarga['nama_anak_5']; ?>" class="form-control" /></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="<?= base_url('warga'); ?>" class="btn btn-secondary">Batal</a>
                                </div>
                        </div>
                    </form>
                <?php
                            } else {
                                echo "<h1>User Tidak Memiliki Data Warga</h1><br/><br/><br/><br/><br/><br/>";
                            }
                ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END INPUT FORM-->
</div>