<!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header">
                Order Pending
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <div class="container">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <div class="container">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>User</th>
                                                <!-- <th>Alamat</th> -->
                                                <th>Tanggal</th>
                                                <th>Alamat Tujuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $nomor = 1;
                                            foreach ($data as $x) { ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $x->user; ?></td>
                                                    <!-- nanti tambah id -->
                                                    <td><?= $x->tanggal; ?></td>
                                                    <td><?= $x->alamat; ?></td>
                                                    <td align="center">
                                                        <a href="<?= base_url('order_barang/view/') . $x->id_usr ?>" class="btn btn-primary">View</a>
                                                        <a href="<?= base_url('order/hapusorder/') . $x->id_usr ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>