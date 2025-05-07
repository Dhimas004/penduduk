        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- DATA TABLE-->
            <section class="p-t-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <h3 class="title-5">Detail Warga</h3>
                                </div>
                            </div>
                            <div style="width: 100%;">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td class="align-top" style="width: 15%;">ID Warga</td>
                                            <td class="align-top" style="width: 20%;">: <?= $detailWarga['idWarga']; ?></td>
                                            <td class="align-top" style="width: 15%;">Status Perkawinan</td>
                                            <td class="align-top" style="width: 20%;">: <?= ucwords(str_replace('_', ' ', $detailWarga['status_perkawinan'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="align-top" style="width: 15%;">NIK</td>
                                            <td class="align-top" style="width: 20%;">: <?= $detailWarga['nik']; ?></td>
                                            <td class="align-top" style="width: 15%;">Pasangan</td>
                                            <td class="align-top" style="width: 20%;">: <?= $detailWarga['nama_pasangan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="align-top" style="width: 15%;">Nama Warga</td>
                                            <td class="align-top">: <?= ucwords(strtolower($detailWarga['nama'])); ?></td>
                                            <td class="align-top" style="width: 15%;">Anak 1</td>
                                            <td class="align-top" style="width: 20%;">: <?= $detailWarga['nama_anak_1']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="align-top" style="width: 15%;">Jenis Kelamin</td>
                                            <td class="align-top">: <?php
                                                                    if ($detailWarga['jekel'] == 'laki-laki') echo "Laki-Laki";
                                                                    else echo "Perempuan";
                                                                    ?></td>
                                            <td class="align-top" style="width: 15%;">Anak 2</td>
                                            <td class="align-top" style="width: 20%;">: <?= $detailWarga['nama_anak_2']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="align-top" style="width: 15%;">TTL</td>
                                            <td class="align-top">: <?= $detailWarga['tempat_lahir'] . ", " . tgl_indo($detailWarga['tanggal_lahir']); ?></td>
                                            <td class="align-top" style="width: 15%;">Anak 3</td>
                                            <td class="align-top" style="width: 20%;">: <?= $detailWarga['nama_anak_3']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="align-top" style="width: 15%;">Alamat</td>
                                            <td class="align-top">: <?= $detailWarga['alamat']; ?></td>
                                            <td class="align-top" style="width: 15%;">Anak 4</td>
                                            <td class="align-top" style="width: 20%;">: <?= $detailWarga['nama_anak_4']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="align-top" style="width: 15%;">RT/RW</td>
                                            <td class="align-top">: <?= $detailWarga['rt_rw']; ?></td>
                                            <td class="align-top" style="width: 15%;">Anak 5</td>
                                            <td class="align-top" style="width: 20%;">: <?= $detailWarga['nama_anak_5']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->