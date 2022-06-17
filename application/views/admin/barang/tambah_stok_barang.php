<body class="bg-gradient-success">
    <div class="mbr-slider slide carousel" data-keyboard="false" data-ride="carousel" data-interval="2000" data-pause="true">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card o-hidden border-0 shadow-lg my-5 ">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <!-- Page Heading -->
                                        <div class="card">
                                            <div class="card-header">
                                                Barang Baru Masuk
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <?= validation_errors() ?>
                                                        <form action="<?= base_url('admin/proses_update_stok_barang/') . $data->id_barang  ?>" method="POST" enctype="multipart/form-data">
                                                            <table class="table">
                                                                <tr>
                                                                    <td width=20%>Nama Barang</td>
                                                                    <td><input type="text" name="nama_barang" class="form-control" required placeholder="<?= $data->nama_barang ?>" disabled></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>Stok Masuk</td>
                                                                    <td>
                                                                        <input type="number" name="stok_masuk" class="form-control" required placeholder="Stok Masuk">
                                                                        <input type="hidden" name="stok_gudang" value="<?= $data->jumlah_stok ?>">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>Tanggal Masuk</td>
                                                                    <td><input type="date" name="date" class="form-control" required placeholder="Date"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <button class="btn btn-success">Simpan</button>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>