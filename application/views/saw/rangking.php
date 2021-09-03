<div class="col-lg-12">
    <div class="container">
        <div class="row">
            <div class="page-header mx-1">
                <h1><?php echo $this->page->generateTitle(); ?> </h1>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Table Perhitungan</div>
                <div class="panel-body">
                    <h2>Table 4 - Dijumlah sesuai dengan sekolah dan di dapat hasil rangking</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr class="active">
                                <th class="col-md-1 text-center">No</th>
                                <?php

                                $no = 1;
                                $start = $this->uri->segment(3) + $no;
                                $table = $this->page->getData('tableFinal');
                                foreach ($table as $item => $value) {
                                    foreach ($value as $heading => $itemValue) {
                                ?>
                                        <th class="text-center"><?php echo $heading ?></th>
                                <?php
                                    }
                                    break;
                                }
                                ?>
                            </tr>
                            <?php
                            foreach ($table as $item => $value) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $start ?></td>
                                    <?php
                                    foreach ($value as $itemValue) {
                                    ?>
                                        <td><?php echo $itemValue ?></td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            <?php
                                ++$start;
                            }
                            ?>
                        </table>
                    </div>

                    <?= $this->pagination->create_links(); ?>

                    <?php
                    $table = $this->page->getData('tableFinal');
                    foreach ($table as $item => $value) {
                        if ($value->Rangking == 1) {
                    ?>
                            <div class="alert alert-success" role="alert">
                                <h4><b>Kesimpulan : </b> Dari hasil perhitungan yang dilakukan menggunakan metode SAW
                                    Sekolah terbaik untuk di pilih adalah
                                    <?php echo $value->Sekolah ?> dengan nilai <?php echo $value->Total ?>
                                </h4>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ket :</h3>
                        </div>
                        <!-- <div class="panel-body">
                        <div class="col-md-9"><b> C1 : Aspek Kebijakan Sekolah yang Berwawasan Lingkungan</b></div>
                        <div class="col-md-9"><b> C2 : Aspek Kegiatan Sekolah Berbasis Partisipatif</b></div>
                        <div class="col-md-9"><b> C3 : Aspek Kebijakan Sekolah yang Berwawasan Lingkungan</b></div>
                        <div class="col-md-9"><b> C3 : Aspek Kebijakan Sekolah yang Berwawasan Lingkungan</b></div>
                    </div>
 -->

                        <div class="panel-body">

                            <?php

                            foreach ($kriteria as $item) {
                            ?>
                                <div class="col-md-9"><b> <?php echo $item->kriteria ?> : <?php echo $item->kode ?> </b></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>