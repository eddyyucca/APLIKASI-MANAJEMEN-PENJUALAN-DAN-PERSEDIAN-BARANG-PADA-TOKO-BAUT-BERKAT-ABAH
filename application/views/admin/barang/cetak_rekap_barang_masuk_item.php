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
                <table style="float:right" border="0">
                    <?php
                    function tanggal_indo($tanggal, $cetak_hari = false)
                    {
                        $hari = array(
                            1 =>    'Senin',
                            'Selasa',
                            'Rabu',
                            'Kamis',
                            'Jumat',
                            'Sabtu',
                            'Minggu'
                        );

                        $bulan = array(
                            1 =>   'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember'
                        );
                        $split       = explode('-', $tanggal);
                        $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

                        if ($cetak_hari) {
                            $num = date('N', strtotime($tanggal));
                            return $hari[$num] . ', ' . $tgl_indo;
                        }
                        return $tgl_indo;
                    }
                    ?>
                    <tr align="right">
                        <br><br>
                        <td align="right" colspan="11">Banjarbaru, <?= tanggal_indo(date('Y-m-d')) ?> <br>
                            <img src=" <?= base_url('assets/ttd.png') ?>" width="60%"><br>
                            Putra .P, S.Kom
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.print()
</script>