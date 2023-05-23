<div class="content-wrapper">
    <section class="content-header">
        <h1>
            User <?= $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tv"></i> Dashboard</a></li>
            <li><a href="#" style="text-transform:capitalize ;"><?= $this->uri->segment(1); ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <h3 class="box-title">Change <?= $title; ?></h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" action="<?= base_url('user/password'); ?>" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Current Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="current_password" id="current_password">
                                    <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="new_password1" id="new_password1">
                                    <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="new_password2" id="new_password2">
                                    <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Save and Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <font class="pull-right">
                    Page rendered in <strong>{elapsed_time}</strong> seconds.
                </font>
            </div>

        </div>

        <!-- Alert Massage -->
        <?= $this->session->flashdata('pass'); ?>
        <!-- End Alert Massage -->

    </section>
</div>