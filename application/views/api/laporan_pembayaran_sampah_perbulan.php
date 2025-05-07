<style>
    td[align='center'] {
        font-weight: bolder;
    }
</style>
<!-- Table Laporan -->
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nama Warga</th>
                <th class="text-center">Jan</th>
                <th class="text-center">Feb</th>
                <th class="text-center">Mar</th>
                <th class="text-center">Apr</th>
                <th class="text-center">Mei</th>
                <th class="text-center">Jun</th>
                <th class="text-center">Jul</th>
                <th class="text-center">Agt</th>
                <th class="text-center">Sep</th>
                <th class="text-center">Okt</th>
                <th class="text-center">Nov</th>
                <th class="text-center">Des</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($warga as $w) {
            ?>
                <tr>
                    <td align="left"><?= ucwords(strtolower($w->nama)); ?></td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-01", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-02", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-03", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-04", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-05", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-06", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-07", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-08", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-09", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-10", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-11", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                    <td align="center">
                        <?= (in_array($w->idWarga . $tahun . "-12", $pembayaran) ? '&#10003;' : ''); ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>