<!-- PAGE CONTENT-->
<div class="page-content--bgf7">
    <!-- DATA TABLE-->
    <section class="p-t-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-data__tool">
                        <h3 class="title-5">Laporan Pembayaran Sampah Perbulan</h3>
                        <div class="table-data__tool-right">
                            <label for="tahun">Pilih Tahun:</label>
                            <select id="tahun" class="form-control" onchange="loadLaporan()">
                                <option value="">Pilih Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                    </div>
                    <!-- CONTENT -->
                    <div class="table-responsive">
                        <div id="laporan-container">
                            <!-- Data laporan akan dimuat di sini -->
                        </div>
                    </div>
                    <!-- END CONTENT -->
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->

    <script>
        function loadLaporan() {
            const tahun = document.getElementById("tahun").value;
            const laporanContainer = document.getElementById("laporan-container");

            if (tahun) {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "http://localhost/penduduk/api/laporan_pembayaran_sampah_perbulan?tahun=" + tahun, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        laporanContainer.innerHTML = xhr.responseText;
                    } else {
                        laporanContainer.innerHTML = "<p>Error memuat data.</p>";
                    }
                };
                xhr.send();
            } else {
                laporanContainer.innerHTML = "<p>Pilih tahun untuk melihat laporan.</p>";
            }
        }
    </script>
</div>