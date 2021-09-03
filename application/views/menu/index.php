<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    $this->page->generateCss();
    ?>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png">

    <title><?php echo $this->page->generateTitle(); ?></title>
</head>

<body id="body-pd" class="noselect">
    <div class="l-navbar" id="navbar">
        <nav class="navigate">
            <div>
                <div class="nav__brand">
                    <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                    <h2><?php echo $this->session->userdata("nama"); ?></h2>
                </div>
                <div class="nav__list">
                    <a href="<?php echo site_url('Welcome') ?>" style="text-decoration: none; color: white;" class="nav__link collapse">
                        <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Dashboard</span>
                    </a>
                    <a href="<?php echo site_url('Kriteria') ?>" style="text-decoration: none; color: white;" class="nav__link collapse">
                        <ion-icon name="chatbubbles-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Data Kriteria & Bobot</span>
                    </a>

                    <div class="nav__link collapse">
                        <a href="<?php echo site_url('Sekolah') ?>" style="text-decoration: none; color: white;">
                            <ion-icon name="folder-outline" class="nav__icon"></ion-icon>
                        </a>
                        <span class="nav__name "> Data Sekolah </span>

                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                        <ul class="collapse__menu">
                            <a href="<?php echo site_url('SekolahDasar') ?>" style="text-decoration: none;" class="collapse__sublink">SD</a>
                            <a href="<?php echo site_url('SMP') ?>" style="text-decoration: none; " class="collapse__sublink">SMP</a>
                            <a href="<?php echo site_url('SMA') ?>" style="text-decoration: none; " class="collapse__sublink">SMA</a>
                        </ul>
                    </div>

                    <div class="nav__link collapse">
                        <a href="<?php echo site_url('Sekolah/rangking') ?>" style="text-decoration: none; color: white;">
                            <ion-icon name="people-outline" class="nav__icon"></ion-icon>
                        </a>
                        <span class="nav__name">Rangking</span>

                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                        <ul class="collapse__menu">
                            <a href="<?php echo site_url('Rangking') ?>" style="text-decoration: none;" class="collapse__sublink">SD</a>
                            <a href="<?php echo site_url('RangkingSMP') ?>" style="text-decoration: none;" class="collapse__sublink">SMP</a>
                            <a href="<?php echo site_url('RangkingSMA') ?>" style="text-decoration: none;" class="collapse__sublink">SMA</a>
                        </ul>
                    </div>
                    <!-- <a href="#" class="nav__link" style="text-decoration: none; color: white;">
                        <ion-icon name="settings-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Kuisioner</span>
                    </a> -->
                </div>
            </div>

            <a href="<?php echo base_url('Auth/logout'); ?>" style="text-decoration: none; color: white;" class="nav__link">
                <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

    <script>
        var base_url = "<?php echo site_url(); ?>";
    </script>
    <?php
    $this->page->generateJs();
    ?>

    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

    <!-- ===== MAIN JS ===== -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/sekolah.js"></script>
    <script>
        function killCopy(e) {
            return false;
        }

        function reEnable() {
            return true;
        }
        document.onselectstart = new Function("return false");
        if (window.sidebar) {
            document.onmousedown = killCopy;
            document.onclick = reEnable;
        }

        if (document.addEventListener !== undefined) {
            // Not IE
            document.addEventListener('click', checkSelection, false);
        } else {
            // IE
            document.attachEvent('onclick', checkSelection);
        }

        // function checkSelection() {
        //     var sel = {};
        //     if (window.getSelection) {
        //         // Mozilla
        //         sel = window.getSelection();
        //     } else if (document.selection) {
        //         // IE
        //         sel = document.selection.createRange();
        //     }

        //     // Mozilla
        //     if (sel.rangeCount) {
        //         sel.removeAllRanges();
        //         return;
        //     }

        //     // IE
        //     if (sel.text > '') {
        //         document.selection.empty();
        //         return;
        //     }
        // }
    </script>

</html>