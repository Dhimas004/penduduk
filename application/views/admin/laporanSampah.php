       <style>
           td,
           th {
               text-align: left !important;
           }
       </style>
       <!-- PAGE CONTENT-->
       <div class="page-content--bgf7">
           <!-- DATA TABLE-->
           <section class="p-t-60">
               <div class="container">
                   <div class="row">
                       <div class="col-md-12">
                           <div class="table-data__tool">
                               <h3 class="title-5">Laporan Sampah</h3>
                               <div class="table-data__tool-right">
                                   <a href="<?= base_url(); ?>penduduk/lapSampah" class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="top">
                                       <i class="zmdi zmdi-print"></i>print</a>
                               </div>
                           </div>
                           <!-- DATA TABLE-->
                           <?php if (count($kas) > 0) { ?>
                               <div class="table-responsive m-b-40">
                                   <table class="table table-borderless table-data3">
                                       <thead>
                                           <tr>
                                               <th>Nomor</th>
                                               <th>Status</th>
                                               <th>Jenis</th>
                                               <th>Nama Warga</th>
                                               <th>Tanggal</th>
                                               <th>Keterangan</th>
                                               <th>Jumlah</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <?php
                                            $saldo = 0;
                                            foreach ($kas as $kas) {
                                            ?>
                                               <tr>
                                                   <td><?= $kas->idKas; ?></td>
                                                   <td><?= ucfirst($kas->status); ?></td>
                                                   <td><?= ucfirst($kas->jenis); ?></td>
                                                   <td><?= (array_key_exists($kas->idWarga, $namaWarga)  ? ucwords(strtolower($namaWarga[$kas->idWarga])) : '')  ?></td>
                                                   <td><?= tgl_indo($kas->tanggal); ?></td>
                                                   <td><?= $kas->keterangan; ?></td>
                                                   <td><?php
                                                        if ($kas->jenis == 'keluar') {
                                                            echo "<span style='color:red'>" . rupiah($kas->jumlah * -1) . "</span>";
                                                            $saldo -= $kas->jumlah;
                                                        } else {
                                                            echo "<span style='color:green'>" . rupiah($kas->jumlah) . "</span>";
                                                            $saldo += $kas->jumlah;
                                                        }
                                                        ?>
                                                   </td>
                                               </tr>
                                           <?php }
                                            ?>
                                       </tbody>
                                       <thead>
                                           <tr>
                                               <th colspan="6" scope="col">Total</th>
                                               <th scope="col"><?= rupiah($saldo); ?></th>
                                           </tr>
                                       </thead>
                                   </table>
                               <?php } else { ?>
                                   TIDAK ADA LAPORAN SAMPAH
                               <?php } ?>
                               </div>
                               <!-- END DATA TABLE-->
                       </div>
                   </div>
               </div>
           </section>
           <!-- END DATA TABLE-->