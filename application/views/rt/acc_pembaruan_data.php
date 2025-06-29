<?php if ($this->session->flashdata('message')) : ?>
    <?= $this->session->flashdata('message'); ?>
<?php endif; ?>
<div class="container mt-4">
    <h3 class="mb-4">Daftar Pengajuan Pembaruan Data Warga</h3>

    <?php if (empty($pembaruan)) : ?>
        <div class="alert alert-info">Tidak ada data pengajuan yang menunggu persetujuan.</div>
    <?php else : ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Status Kawin</th>
                    <th>Alamat</th>
                    <th>RT/RW</th>
                    <th>Berkas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pembaruan as $p) : ?>
                    <tr>
                        <td><?= $p['nik']; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td><?= ucwords(str_replace('_', ' ', $p['status_perkawinan'])); ?></td>
                        <td><?= $p['alamat']; ?></td>
                        <td><?= $p['rt_rw']; ?></td>
                        <td>
                            <?php if (!empty($p['berkas'])) : ?>
                                <a href="<?= base_url('uploads/berkas/' . $p['berkas']); ?>" target="_blank">Lihat</a>
                            <?php else : ?>
                                Tidak Ada
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <a href="<?= base_url('rt/setujui/' . $p['id']); ?>" class="btn btn-success btn-sm">Setujui</a>
                            <a href="<?= base_url('rt/tolak/' . $p['id']); ?>" class="btn btn-danger btn-sm">Tolak</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>