<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" style="border-radius: 3px;" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $user['name']; ?></p>
                <span class='label label-success'>Verified</span>
            </div>
        </div>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" disabled class="form-control" placeholder="BPR BANGUNARTA">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-flat"><i class="fa fa-bank"></i>
                    </button>
                </span>
            </div>
        </form>

        <ul class="sidebar-menu" data-widget="tree">

            <?php
            $id = $user['role_id'];
            if ($id == "4") {
                $d = 'dashboard/analytic';
            } elseif ($id == "5" || $id == "6") {
                $d = 'dashboard/officer';
            } elseif ($id == "7" || $id == "8") {
                $d = 'dashboard/welcome';
            } else {
                $d = 'dashboard';
            }
            ?>
            <li class="header">HOME</li>
            <li class="<?php if ($this->uri->segment(1) == "dashboard") {
                            echo "active";
                        } ?>"><a href="<?= base_url($d) ?>"><i class="fa fa-tv"></i> <span>Dashboard</span></a></li>

            <li class="header">TOOLKIT</li>

            <!-- QUERY MENU -->
            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT user_menu.`id`, menu, icon_menu
                FROM user_menu JOIN user_access_menu
                ON user_menu.`id`=user_access_menu.`menu_id`
                WHERE user_access_menu.`role_id` = $role_id
                ORDER BY user_access_menu.`menu_id` ASC";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>

            <!-- LOOPING MENU -->
            <?php $uri = $this->uri->segment(1);
            foreach ($menu as $m) : ?>

                <?php if ($uri == $m['menu']) : ?>
                    <li class="treeview active">
                    <?php else : ?>
                    <li class="treeview">
                    <?php endif; ?>

                    <a href="#">
                        <i class="<?= $m['icon_menu']; ?>"></i> <span style="text-transform: capitalize;"><?= $m['menu']; ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <?php
                        $menuId = $m['id'];
                        $querySubMenu = "SELECT * FROM user_submenu
                                JOIN user_menu
                                ON user_submenu.`menu_id`=user_menu.`id`
                                WHERE user_submenu.`menu_id` = $menuId
                                AND user_submenu.`is_active` = '1'";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>

                        <?php foreach ($subMenu as $sm) : ?>
                            <?php if ($title == $sm['title']) : ?>
                                <li class="active">
                                <?php else : ?>
                                <li>
                                <?php endif; ?>

                                <a href="<?= base_url() ?><?= $sm['url'] ?>"><i class="<?= $sm['icon']; ?>"></i> <?= $sm['title']; ?></a>
                                </li>
                            <?php endforeach; ?>

                    </ul>
                    </li>
                <?php endforeach; ?>
                <li class="header">SESSION</li>
                <li><a href="<?= base_url('auth/logout'); ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
    </section>
</aside>