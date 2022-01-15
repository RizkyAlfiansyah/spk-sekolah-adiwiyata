<div class="page-header md-0">
    <h1>Halaman Rangking</h1>
</div>
<div class="container" id="main">
    <div class="row">
        <div class="col">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">
                            <div class="panel panel-default my_panel">
                                <div class="panel-body">
                                    <img src="<?php echo base_url(); ?>assets/images/sda.png" alt="" class="img-responsive center-block" />
                                </div>
                                <div class="panel-footer ">
                                    <h3>SD</h3>
                                    <?php if($this->session->userdata('level')== "admin") { ?>
                                        <a href="<?php echo site_url('Rangking') ?>" class="btn btn-primary">Rangking Sekolah Dasar</a>
                                        <?php } else { ?> 
                                            <a href="<?php echo site_url('Rangking/nilairangking') ?>" class="btn btn-primary">Rangking Sekolah Dasar</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">
                            <div class="panel panel-default my_panel">
                                <div class="panel-body">
                                    <img src="<?php echo base_url(); ?>assets/images/smp.png" alt="" class="img-responsive center-block" />
                                </div>
                                <div class="panel-footer ">
                                    <h3>SMP</h3>
                                    <?php if($this->session->userdata('level')== "admin") { ?>
                                        <a href="<?php echo site_url('RangkingSMP') ?>" class="btn btn-primary">Rangking Sekolah Menengah Pertama</a>
                                        <?php } else { ?> 
                                            <a href="<?php echo site_url('RangkingSMP/nilairangking') ?>" class="btn btn-primary">Rangking Sekolah Menengah Pertama</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">
                            <div class="panel panel-default my_panel">
                                <div class="panel-body">
                                    <img src="<?php echo base_url(); ?>assets/images/sma.png" alt="" class="img-responsive center-block" />
                                </div>
                                <div class="panel-footer ">
                                    <h3>SMA</h3>
                                    <?php if($this->session->userdata('level')== "admin") { ?>
                                        <a href="<?php echo site_url('RangkingSMA') ?>" class="btn btn-primary">Rangking Sekolah MenengahAtas</a>
                                        <?php } else { ?> 
                                            <a href="<?php echo site_url('RangkingSMA/nilairangking') ?>" class="btn btn-primary">Rangking Sekolah Menengah Atas</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>