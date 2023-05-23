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
                    <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-tambah">ADD SUBMENU</a>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('menu/submenu') ?>" method="POST">
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">URL</th>
                                        <th class="text-center">Menu</th>
                                        <th class="text-center">Icon</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($submenu as $sm) :
                                        if ($sm['is_active'] == 1) {
                                            $status = "<span class='label label-success'>Active</span>";
                                        } else {
                                            $status = "<span class='label label-danger'>Not Active</span>";
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $sm['title']; ?></td>
                                            <td><?= $sm['url']; ?></td>
                                            <td style="text-transform: capitalize;"><?= $sm['menu']; ?></td>
                                            <td class="text-center">
                                                <i class="btn-circle btn-xs btn-default <?= $sm['icon']; ?>"></i>
                                            </td>
                                            <td class="text-center"><?= $status; ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-edit<?= $sm['id']; ?>" class="btn-circle btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a class="btn-circle btn-sm btn-danger tombol-hapus" href="<?= base_url('menu/submenu_delete/') . $sm['id']; ?>"><i class="fa fa-trash"></i></a>
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
        <?= form_error('menu_id', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <?= form_error('title', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <?= form_error('url', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <?= form_error('icon', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <?= form_error('is_active', '<div class="callout callout-danger"><p>', '</p></div>'); ?>

        <?php if (empty($submenu)) : ?>
            <div class="callout callout-danger">
                <p><?= $title; ?> <b>doesn't</b> exist!</p>
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
                <h4 class="modal-title">Add Submenu</h4>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Menu Name</label>
                        <select class="form-control select2" style="width: 100%;" name="menu_id" id="menu_id" required>
                            <option value="">--Select Menu--</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control" name="url" id="url" placeholder="Enter URL" required>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Enter Icon" required>
                    </div>
                    <div class="form-group">
                        <label>Is Avtive?</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <?php foreach ($active as $a) :
                                if ($a == 1) {
                                    $s_active = "Active";
                                } else {
                                    $s_active = "Not Active";
                                }
                            ?>
                                <option value="<?= $a; ?>"><?= $s_active; ?></option>

                            <?php endforeach; ?>
                        </select>
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

<?php
foreach ($edit as $data) :
    $id         = $data['id'];
    $title      = $data['title'];
    $url        = $data['url'];
    $icon       = $data['icon'];
    $is_active  = $data['is_active'];
    $menu_id    = $data['menu_id'];
?>
    <div class="modal fade" id="modal-edit<?= $id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-yellow">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Submenu</h4>
                </div>
                <form action="<?= base_url('menu/submenu_edit'); ?>" method="POST">
                    <div class="modal-body">

                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $id; ?>">

                        <div class="form-group">
                            <label>Menu Name</label>
                            <select class="form-control" style="width: 100%;" name="menu_id" id="select2" required>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>" <?php if ($m['id'] == $menu_id) {
                                                                            echo "selected='selected'";
                                                                        } ?>><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?= $title; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" class="form-control" name="url" id="url" value="<?= $url; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="icon" id="icon" value="<?= $icon; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Is Avtive?</label>
                            <select class="form-control" name="is_active" id="is_active">
                                <?php foreach ($active as $a) :
                                    if ($a == 1) {
                                        $s_active = "Active";
                                    } else {
                                        $s_active = "Not Active";
                                    }
                                ?>
                                    <?php if ($a == $is_active) : ?>
                                        <option value="<?= $a; ?>" selected><?= $s_active; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $a; ?>"><?= $s_active; ?></option>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>