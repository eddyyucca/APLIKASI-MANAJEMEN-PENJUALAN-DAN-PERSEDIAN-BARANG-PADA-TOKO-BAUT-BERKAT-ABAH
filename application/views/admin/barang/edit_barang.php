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
                                                        <form action="<?= base_url('admin/proses_edit_barang/' . $data->id_barang)  ?>" method="POST" enctype="multipart/form-data">
                                                            <table class="table">
                                                                <tr>
                                                                    <td width=20%>Nama Barang</td>
                                                                    <td><input type="text" name="nama_barang" class="form-control" value="<?= $data->nama_barang ?>" required placeholder="Nama Barang"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td width=20%>Lokasi</td>
                                                                    <td><input type="text" name="lokasi" value="<?= $data->lokasi ?>" class="form-control" required placeholder="Lokasi Barang"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=20%>Harga Satuan</td>
                                                                    <td><input type="text" name="harga" value="<?= $data->harga ?>" class="form-control" required placeholder="Harga Barang"></td>
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