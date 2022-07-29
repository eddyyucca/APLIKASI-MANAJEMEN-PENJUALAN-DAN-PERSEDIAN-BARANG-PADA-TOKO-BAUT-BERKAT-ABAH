<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold ">Data Baut</h1>
        </div>
        <div class="card-body">
            <table>
                <tr align="left">
                    <th rowspan="2"><img src="<?= base_url('assets/cop.png') ?>" width="100%">
                    </th>
                </tr>
            </table>
            <hr>
            <h4>Waktu : <?= date('d-m-Y H:i:s') ?></h4>
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Lokasi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        function rupiah($angka)
                        {

                            $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
                            return $hasil_rupiah;
                        }
                        foreach ($data as $x) {

                        ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $x->nama_barang; ?></td>
                                <td><?= rupiah($x->harga) ?></td>
                                <td><?= $x->jumlah_stok; ?></td>
                                <td><?= $x->lokasi; ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.print()
</script>