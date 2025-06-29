        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- DATA TABLE-->
            <section class="p-t-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <h3 class="title-5">Cari Warga</h3>
                                </div>
                            </div>
                            <div style="width: 100%;">
                                <form method="GET" action="<?= base_url('warga'); ?>">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>NIK</label>
                                            <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Jenis Kelamin</label>
                                            <select name="jekel" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                <option value="laki-laki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Alamat</label>
                                            <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>RT/RW</label>
                                            <input type="text" name="rt_rw" class="form-control" placeholder="Contoh: 01/02">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status Perkawinan</label>
                                            <select name="status_perkawinan" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                <option value="belum_menikah">Belum Menikah</option>
                                                <option value="menikah">Menikah</option>
                                                <option value="cerai">Cerai</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                            <a href="" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->