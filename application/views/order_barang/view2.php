<!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header">
                <a href="<?= base_url('order_barang') ?>"><i class="fas fa-arrow-circle-left"> Kembali</i></a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <div class="container">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <div class="container">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>BARANG</th>
                                                <th>QTY</th>
                                                <th>TANGGAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($data4->status == "2") {

                                                $no = 1;
                                                if ($data2 == false) { ?>
                                                    <td colspan='5' align='center'>Data Kosong</td>
                                                    <?php
                                                } else {
                                                    foreach ($data2 as $x) { ?>

                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $x->nama_barang ?></td>
                                                            <td><?= $x->qty_order ?></td>
                                                            <td><?= $x->tanggal ?></td>

                                                        </tr>
                                        </tbody>
                                    <?php } ?>

                                    <?php $no = 1;


                                                    foreach ($data2 as $k) :
                                                        if ($no++ > 1) break;
                                    ?>



                                    <?php endforeach; ?>

                                <?php }
                                            } elseif ($data4->status == "3") { ?>
                                <td colspan='5' align='center'>Data Kosong</td>
                            <?php } elseif ($data4->status == "1") { ?>
                                <td colspan='5' align='center'>Data Kosong</td>
                            <?php } elseif ($data4->status == "4") { ?>
                                <td colspan='5' align='center'>Data Kosong</td>
                            <?php   } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>