<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold ">Data Baut</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container">
                    <a href="<?= base_url('admin/tambah_item') ?>" class="btn btn-primary">Tambah Item</a>
                    <a href="<?= base_url('admin/cetak_data_baut') ?>" class="btn btn-primary">Cetak PDF</a>
                    <hr>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Lokasi</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        function rupiah($angka)
                        {

                            $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
                            return $hasil_rupiah;
                        }
                        $nomor = 1;
                        foreach ($data as $x) { ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $x->nama_barang; ?></td>
                                <td><?= rupiah($x->harga); ?></td>
                                <td><?= $x->jumlah_stok; ?></td>
                                <td><?= $x->lokasi; ?></td>
                                <td align="center">
                                    <a href="<?= base_url('admin/hapus_barang/') . $x->id_barang; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger">Hapus</a>
                                    <a href="<?= base_url('admin/edit_barang/') . $x->id_barang; ?>" class="btn btn-primary">Edit</a>
                                    <a href="<?= base_url('admin/rekap_barang_masuk_item/') . $x->id_barang; ?>" class="btn btn-primary">Rekap Barang Masuk</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>