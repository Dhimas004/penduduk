        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- DATA TABLE-->
            <section class="p-t-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-data__tool">
                                <h3 class="title-5">laporan data kas</h3>
                                <!-- <div class="table-data__tool-left">
									<a class="au-btn-filter">
											<i class="zmdi zmdi-filter"> from </i><input type="date"></a>
									<a class="au-btn-filter">
											<i class="zmdi zmdi-filter"> to </i><input type="date"></a>
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="top">
                                            <i class="zmdi zmdi-search"></i>cari</button>
                                </div> -->
                                <div class="table-data__tool-right">
                                    <a href="<?= base_url(); ?>penduduk/lapkas" class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="top">
                                        <i class="zmdi zmdi-print"></i>print</a>
                                </div>
                            </div>
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>nomor</th>
                                            <th>keterangan</th>
                                            <th>tanggal</th>
                                            <th>jenis</th>
                                            <th>jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($kas as $kas) { ?>
                                            <tr>
                                                <td><?= $kas->idKas; ?></td>
                                                <td><?= $kas->keterangan; ?></td>
                                                <td><?= date('d-m-Y', strtotime($kas->tanggal)); ?></td>
                                                <td><?= $kas->jenis; ?></td>
                                                <td class="process">Rp <?= rupiah($kas->jumlah); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <thead>
                                        <?php
                                        $sum_masuk = 0;
                                        foreach ($masuk as $total_masuk) {
                                            $sum_masuk += $total_masuk->total;
                                        }
                                        $sum_keluar = 0;
                                        foreach ($keluar as $total_keluar) {
                                            $sum_keluar += $total_keluar->total;
                                        }
                                        $saldo = $sum_masuk - $sum_keluar;
                                        ?>
                                        <tr>
                                            <th colspan="4" scope="col">TOTAL <small>(Saldo)</small></th>
                                            <th scope="col">Rp <?= rupiah($saldo); ?></th>
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