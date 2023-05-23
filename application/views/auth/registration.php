<!-- wrap -->
<div class="nk-wrap nk-wrap-nosidebar">
    <!-- content -->
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body wide-xs">
            <div class="card">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Registration</h4>
                            <div class="nk-block-des">
                                <p>Create new <b>Monitoring</b> account.</p>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="<?= base_url('auth/registration') ?>">

                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label">Name</label>
                                <?= form_error('name', '<a class="link link-danger link-sm">', '</a>'); ?>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg" id="name" name="name" type="email" placeholder="Enter your email" value="<?= set_value('name'); ?>" />
                            </div>
                        </div>

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
                                <?= form_error('password1', '<a class="link link-danger link-sm">', '</a>'); ?>
                            </div>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control form-control-lg" id="password1" name="password1" type="email" placeholder="Enter your password" value="<?= set_value('password1'); ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label">Confirm Password</label>
                                <?= form_error('password2', '<a class="link link-danger link-sm">', '</a>'); ?>
                            </div>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control form-control-lg" id="password2" name="password2" type="email" placeholder="Enter your password" value="<?= set_value('password2'); ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-lg btn-secondary btn-block" type="submit">Register</button>
                        </div>
                    </form>
                    <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="<?= base_url('auth') ?>"><strong>Sign in instead</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wrap @e -->
</div>
<!-- content @e -->