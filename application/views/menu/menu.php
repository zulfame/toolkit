<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title; ?> Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tv"></i> Dashboard</a></li>
            <li><a href="#" style="text-transform:capitalize ;"> <?= $this->uri->segment(1); ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <div class="box-tools pull-left">
                    <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-tambah">ADD MENU</a>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('menu') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 180px;">
                            <input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <input type="submit" class="btn btn-default" name="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-body" style="margin-top:-5px ;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">Menu</th>
                                        <th class="text-center" width="5%">Icon</th>
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($menu as $m) : ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $m['menu']; ?></td>
                                            <td class="text-center">
                                                <i class="btn-circle btn-xs btn-default <?= $m['icon_menu']; ?>"></i>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('menu/edit/') . $m['id']; ?>" class="btn-circle btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a class="btn-circle btn-sm btn-danger tombol-hapus" href="<?= base_url('menu/delete/') . $m['id']; ?>"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php $page; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <p></p>

                        <!-- Pagination -->
                        <?php echo $pagination; ?>
                        <!-- / End Pagination -->

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <font class="pull-left">Total Rows <strong><?= $total_rows; ?></strong></font>
                <font class="pull-right">Rendered in <strong>{elapsed_time}</strong></font>
            </div>

        </div>

        <!-- Alert Massage -->
        <?= form_error('menu', '<div class="callout callout-danger"><p>', '</p></div>'); ?>

        <?php if (empty($menu)) : ?>
            <div class="callout callout-danger">
                <p>Data <b>doesn't</b> exist!</p>
            </div>
        <?php endif; ?>
        <!-- End Alert Massage -->

    </section>
</div>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Menu</h4>
            </div>
            <form action="<?= base_url('menu'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Menu</label>
                        <input type="text" class="form-control" name="menu" id="menu" placeholder="Enter Menu" required>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Enter Icon" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>