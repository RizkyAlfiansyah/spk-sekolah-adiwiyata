<div class="col-lg-12">
    <div class="container">
        <div class="row">
            <div class="page-header mx-1">
                <h1><?php echo $this->page->generateTitle(); ?> </h1>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Table Perhitungan</div>
                <div class="panel-body">
                    <h2>Table 1 - Nilai Awal</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr class="active">
                                <th class="col-md-1 text-center">No</th>
                                <?php
                                $no = 1;
                                $table = $this->page->getData('table1');
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
                                    <td class="text-center"><?php echo $no ?></td>
                                    <?php
                                    foreach ($value as $itemValue) {
                                    ?>
                                        <td><?php echo $itemValue ?></td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>

                        </table>
                    </div>
                    <!-- <?= $this->pagination->create_links(); ?> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>