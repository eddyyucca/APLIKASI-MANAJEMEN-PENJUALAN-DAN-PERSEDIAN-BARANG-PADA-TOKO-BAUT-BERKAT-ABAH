<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold ">Data Baut</h6>
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
                            <th>Stok Masuk</th>
                            <th>Date</th>
                            <th>Waktu</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($data as $x) { ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $x->nama_barang; ?></td>
                                <td><?= $x->stok_masuk; ?></td>
                                <td><?= $x->date; ?></td>
                                <td><?= $x->waktu; ?></td>

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