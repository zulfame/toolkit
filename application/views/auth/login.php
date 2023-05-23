            <!-- wrap -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">

                        <!-- <div class="brand-logo pb-4 text-center">
                            <a href="#" class="logo-link">
                                <img class="logo-dark logo-img logo-img-lg" src="<?= base_url('assets/login/') ?>img/logo-text.png" srcset="<?= base_url('assets/login/') ?>img/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div> -->

                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                        <div class="nk-block-des">
                                            <p>Please sign-in to your account and start the adventure.</p>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="<?= base_url('auth'); ?>">

                                    <?= $this->session->flashdata('message'); ?>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label">Email</label>
                                            <?= form_error('email', '<a class="link link-danger link-sm">', '</a>'); ?>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="email" class="form-control form-control-lg" id="email" name="email" type="email" placeholder="Enter your email" value="<?= set_value('email'); ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label">Password</label>
                                            <?= form_error('password', '<a class="link link-danger link-sm">', '</a>'); ?>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" inputmode="numeric" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-secondary btn-block" type="submit">Sign in</button>
                                    </div>
                                </form>

                                <!-- <div class="form-note-s2 text-center pt-4">
                                    <ul class="nav justify-center gx-4">
                                        <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/registration'); ?>">Create an account</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a></li>
                                    </ul>
                                </div> -->

                            </div>
                        </div>
                    </div>