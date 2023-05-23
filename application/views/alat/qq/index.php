<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tv"></i> Dashboard</a></li>
            <li><a href="#" style="text-transform:capitalize ;"> <?= $this->uri->segment(1); ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cari Data</h3>
                    </div>

                    <form role="form" method="POST" action="<?= base_url("alat/filter_qq/") ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label>No. Tabungan</label>
                                <input type="number" class="form-control" name="noacc" minlength="16" required placeholder="0010101201XXXXXX">
                            </div>

                            <div class="form-group">
                                <label>Nama Debitur</label>
                                <input type="text" class="form-control" readonly>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success" style="width:100%;"><i class="fa fa-filter"></i>&nbsp;FILTER</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Riwayat</h3>
                    </div>

                    <div class="box-body">
                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">No</th>
                                        <th class="text-center">TANGGAL</th>
                                        <th class="text-center">NOACC</th>
                                        <th class="text-center">NAMA DEBITUR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data_qq as $dq) : ?>
                                        <tr class="warning">
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $dq['waktu']; ?></td>
                                            <td><?= $dq['noacc']; ?></td>
                                            <td><?= $dq['debitur']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->