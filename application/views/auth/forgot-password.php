            <!-- wrap -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Reset Password</h4>
                                        <div class="nk-block-des">
                                            <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                        </div>
                                    </div>
                                </div>
                                <form class="user" method="post" action="<?= base_url('auth/forgotpassword'); ?>">

                                    <?= $this->session->flashdata('message'); ?>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                            <?= form_error('email', '<a class="link link-danger link-sm">', '</a>'); ?>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email address" value="<?= set_value('email'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-secondary btn-block" type="submit">Send Reset Link</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4">
                                    <a href="<?= base_url('auth'); ?>"><strong>Return to login</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>