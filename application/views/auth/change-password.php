            <!-- wrap -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Change password</h4>
                                        <div class="nk-block-des">
                                            <p>Create a new password for <b><?= $this->session->userdata('reset_email'); ?></b>.</p>
                                        </div>
                                    </div>
                                </div>
                                <form class="user" method="post" action="<?= base_url('auth/changepassword'); ?>">

                                    <?= $this->session->flashdata('message'); ?>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">New Password</label>
                                            <?= form_error('password1', '<a class="link link-danger link-sm">', '</a>'); ?>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control form-control-lg" id="password1" name="password1" placeholder="New password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Repeat Password</label>
                                            <?= form_error('password2', '<a class="link link-danger link-sm">', '</a>'); ?>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control form-control-lg" id="password2" name="password2" placeholder="Repeat password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-secondary btn-block" type="submit">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>