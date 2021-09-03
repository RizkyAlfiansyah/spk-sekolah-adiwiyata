<div class="page-header md-0">
    <h1>Halaman Olah Data Sekolah</h1>
</div>
<div class="container" id="main">
    <div class="row">
        <div class="col">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">
                            <div class="panel panel-default my_panel">
                                <div class="panel-body shadow">
                                    <h3>Jumlah Data</h3>
                                    <h1><?= $datasd; ?> Sekolah</h1>
                                </div>
                                <div class="panel-footer ">
                                    <h3>SD</h3>
                                    <a href="<?php echo site_url('SekolahDasar') ?>" class="btn btn-primary">Data Sekolah Dasar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">
                            <div class="panel panel-default my_panel">
                                <div class="panel-body">
                                    <h3>Jumlah Data</h3>
                                    <h1><?= $datasmp; ?> Sekolah</h1>
                                </div>
                                <div class="panel-footer ">
                                    <h3>SMP</h3>
                                    <a href="<?php echo site_url('SMP') ?>" class="btn btn-primary">Data Sekolah Menengah Pertama</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">
                            <div class="panel panel-default my_panel">
                                <div class="panel-body">
                                    <h3>Jumlah Data</h3>
                                    <h1><?= $datasma; ?> Sekolah</h1>
                                </div>
                                <div class="panel-footer ">
                                    <h3>SMA</h3>
                                    <a href="<?php echo site_url('SMA') ?>" class="btn btn-primary">Data Sekolah Menengah Atas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>