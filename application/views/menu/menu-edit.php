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
        <div class="box box-warning">
            <div class="box-header with-border bg-yellow">
                <h3 class="box-title">Update <?= $title; ?></h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="">
                            <!--ID MENU-->
                            <input type="hidden" class="form-control" name="id" id="id" value="<?= $menu['id']; ?>">

                            <div class="form-group">
                                <label>Menu</label>
                                <input type="text" class="form-control" name="menu" id="menu" value="<?= $menu['menu']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <input type="text" class="form-control" name="icon" id="icon" value="<?= $menu['icon_menu']; ?>">
                            </div>

                            <a href="<?= base_url('menu'); ?>" class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <font class="pull-right">
                    Page rendered in <strong>{elapsed_time}</strong>
                </font>
            </div>

        </div>

        <!-- Alert Massage -->
        <?= $this->session->flashdata('message'); ?>
        <?= form_error('menu', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <!-- End Alert Massage -->

    </section>
</div>