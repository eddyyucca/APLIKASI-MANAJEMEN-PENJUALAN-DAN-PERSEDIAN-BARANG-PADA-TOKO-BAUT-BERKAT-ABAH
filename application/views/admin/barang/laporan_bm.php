<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold ">Laporan Semua Barang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container">
                    <a href="<?= base_url('admin/cetak_laporan_bm') ?>" class="btn btn-primary">Cetak PDF</a>
                    <hr>
                    <form action="<?= base_url('admin/laporan_bm2') ?>" method="post">
                        <div class="input-group mb-3 col-6">
                            <input type="date" class="form-control" id="tgl1" name="tgl1" placeholder="Batas Tanggal">

                            <input type="date" class="form-control" id="tgl2" name="tgl2" placeholder="Batas Tanggal">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-addon2">Cetak</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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