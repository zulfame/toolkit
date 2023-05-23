<div class="content-wrapper">

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

    <section class="content">

        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <div class="box-tools pull-left">
                    <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-tambah">ADD USER</a>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('admin/user') ?>" method="POST">
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
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-center">Region</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_user as $u) :
                                        if ($u['is_active'] == 1) {
                                            $status = "<span class='label label-success'>Active</span>";
                                        } else {
                                            $status = "<span class='label label-danger'>Not Active</span>";
                                        }

                                        if ($u['m_access'] == 1) {
                                            $mobile = "<span class='label label-success'>Allowed</span>";
                                        } else {
                                            $mobile = "<span class='label label-danger'>Not Allowed</span>";
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $u['name']; ?></td>
                                            <td><?= $u['email']; ?></td>
                                            <td><?= $u['role']; ?></td>
                                            <td><?= $u['region']; ?></td>
                                            <td class="text-center"><?= $status; ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-edit<?= $u['id']; ?>" class="btn-circle btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a class="btn-circle btn-sm btn-danger tombol-hapus" href="<?= base_url('admin/user_delete/') . $u['id']; ?>"><i class="fa fa-trash"></i></a>
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
        <?= form_error('email', '<div class="callout callout-danger"><p>', '</p></div>'); ?>

        <?php if (empty($all_user)) : ?>
            <div class="callout callout-danger">
                <p>Data <b>doesn't</b> exist!</p>
            </div>
        <?php endif; ?>
        <!-- End Alert Massage -->

    </section>
</div>

<?php
foreach ($edit as $data) :
    $id         = $data['id'];
    $email      = $data['email'];
    $role_id    = $data['role_id'];
    $region_id  = $data['region_id'];
    $is_active  = $data['is_active'];
?>
    <div class="modal fade" id="modal-edit<?= $id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-yellow">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <form action="<?= base_url('admin/user_edit'); ?>" method="POST">
                    <div class="modal-body">

                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $id; ?>">

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>">
                        </div>

                        <div class="form-group">
                            <label>Position</label>
                            <select class="form-control select2" style="width: 100%;" name="role_id" id="role_id" required>
                                <?php foreach ($position as $p) : ?>
                                    <option value="<?= $p['id']; ?>" <?php if ($p['id'] == $role_id) {
                                                                            echo "selected='selected'";
                                                                        } ?>><?= $p['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Region</label>
                            <select class="form-control" style="width: 100%;" name="region_id" id="select2" required>
                                <?php foreach ($wilayah as $w) : ?>
                                    <option value="<?= $w['id']; ?>" <?php if ($w['id'] == $region_id) {
                                                                            echo "selected='selected'";
                                                                        } ?>><?= $w['region']; ?></option>
                                <?php endforeach; ?>
                            </select>
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

<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import User</h4>
            </div>
            <form action="<?= base_url('admin/user_import'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload File <a href="#">| Format_Excel</a></label>
                        <input type="file" class="form-control" name="fileExcel" id="fileExcel" accept=".xlsx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <form action="<?= base_url('admin/user_add'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name=" role_id" id="role_id" required>
                            <?php foreach ($position as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= $p['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Region</label>
                        <select class="form-control select2" style="width: 100%;" name="region_id" required>
                            <?php foreach ($wilayah as $w) : ?>
                                <option value="<?= $w['id']; ?>"><?= $w['region']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Is Avtive?</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="1">Active</option>
                            <option value="2">Not Active</option>
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