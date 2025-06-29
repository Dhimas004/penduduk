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
                            if (array_key_exists($user['idWarga'], $namaWarga)) {
                            ?>
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td style="width: 15%;">ID Warga</td>
                                            <td style="width: 20%;"><input type="text" name="idWarga" class="form-control" value="<?= $dataWarga[0]->idWarga; ?>" readonly /></td>
                                            <td style="width: 15%;">Status Perkawinan</td>
                                            <td style="width: 20%;">
                                                <select name="status_perkawinan" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="belum_menikah" <?= ($dataWarga[0]->status_perkawinan == 'belum_menikah' ? 'selected' : ''); ?>>Belum Menikah</option>
                                                    <option value="sudah_menikah" <?= ($dataWarga[0]->status_perkawinan == 'sudah_menikah' ? 'selected' : ''); ?>>Sudah Menikah</option>
                                                    <option value="janda" <?= ($dataWarga[0]->status_perkawinan == 'janda' ? 'selected' : ''); ?>>Janda</option>
                                                    <option value="duda" <?= ($dataWarga[0]->status_perkawinan == 'duda' ? 'selected' : ''); ?>>Duda</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td><input type="text" name="nik" value="<?= $dataWarga[0]->nik; ?>" class="form-control" /></td>
                                            <td>Pasangan</td>
                                            <td><input type="text" name="nama_pasangan" value="<?= $dataWarga[0]->nama_pasangan; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Warga</td>
                                            <td><input type="text" name="nama" class="form-control" value="<?= $dataWarga[0]->nama; ?>" /></td>
                                            <td>Anak 1</td>
                                            <td><input type="text" name="nama_anak_1" value="<?= $dataWarga[0]->nama_anak_1; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>
                                                <select name="jekel" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="laki-laki" <?= ($dataWarga[0]->jekel == 'laki-laki' ? 'selected' : ''); ?>>Laki-Laki</option>
                                                    <option value="perempuan" <?= ($dataWarga[0]->jekel == 'perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                                                </select>
                                            </td>
                                            <td>Anak 2</td>
                                            <td><input type="text" name="nama_anak_2" value="<?= $dataWarga[0]->nama_anak_2; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>
                                                <input type="text" name="tempat_lahir" value="<?= $dataWarga[0]->tempat_lahir; ?>" class="form-control mb-2" placeholder="Tempat Lahir" />
                                                <input type="date" name="tanggal_lahir" class="form-control" value="<?= $dataWarga[0]->tanggal_lahir; ?>" />
                                            </td>
                                            <td>Anak 3</td>
                                            <td><input type="text" name="nama_anak_3" value="<?= $dataWarga[0]->nama_anak_3; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><input type="text" name="alamat" value="<?= $dataWarga[0]->alamat; ?>" class="form-control" /></td>
                                            <td>Anak 4</td>
                                            <td><input type="text" name="nama_anak_4" value="<?= $dataWarga[0]->nama_anak_4; ?>" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>RT/RW</td>
                                            <td><input type="text" name="rt_rw" value="<?= $dataWarga[0]->rt_rw; ?>" class="form-control" placeholder="000/000" /></td>
                                            <td>Anak 5</td>
                                            <td><input type="text" name="nama_anak_5" value="<?= $dataWarga[0]->nama_anak_5; ?>" class="form-control" /></td>
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