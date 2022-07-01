<body class="bg-gradient-primary">
    <div class="mbr-slider slide carousel" data-keyboard="false" data-ride="carousel" data-interval="2000" data-pause="true">
        <div class="container">
            <!-- Begin Page Content -->
            <div class="container col-8">
                <!-- Page Heading -->
                <div class="card">
                    <div class="card-header">
                        <a href="<?= base_url('auth') ?>"><i class="fas fa-arrow-circle-left"> Kembali</i></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="container-fluid">
                                <?= validation_errors() ?>
                                <form action="<?= base_url('auth/daftar_akun')  ?>" method="POST" enctype="multipart/form-data">
                                    <table class="table">
                                        <tr>
                                            <td width=20%>Nama</td>
                                            <td><input type="text" name="nama" class="form-control" required placeholder="Nama Lengkap"></td>
                                        </tr>
                                        <tr>
                                            <td width=20%>Username</td>
                                            <td><input type="text" name="username" class="form-control" required placeholder="Username"></td>
                                        </tr>

                                        <tr>
                                            <td width=20%>Telpon</td>
                                            <td><input type="number" name="telpon" class="form-control" required placeholder="Telpon"></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><input type="email" name="email" class="form-control" required placeholder="Email"></td>
                                        </tr>
                                        <tr>
                                            <td width=20%>Alamat</td>
                                            <td><input type="text" name="alamat" class="form-control" required placeholder="Alamat"></td>
                                        </tr>
                                        <tr>
                                            <td width=20%>Password</td>
                                            <td><input type="password" name="password" class="form-control" required placeholder="Password"></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <button class="btn btn-primary">Simpan</button>
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
</body>