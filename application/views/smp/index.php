<div class="page-header">
  <h1>Halaman Olah Sekolah Menengah Pertama / SMP</h1>
</div>
<div class="col-lg-12">
  
  <div id="main">
    <div class="row">
    <form action="<?= base_url('SMP') ?>" method="POST">
        <div class="form-inline">
          <div class="form-group" style="float: left;">
            <input name="keyword" type="text" class="form-control"  value="" placeholder="Search Keyword ..." autocomplete = "off"   autofocus>
            <input name="generate" type="submit" class="btn btn-primary" value="Cari">
          </div>
        </div>
      </form>
      <div class="form-group">
        <a href="<?php echo site_url('SMP/tambah') ?>" type="button" class="btn btn-primary">Tambah
          Sekolah</a>
      </div>
    </div>
    <div class="row">
    <h4>Total <?= $total_rows; ?> Data</h4>
    <?php
  $msg = $this->session->flashdata('message');
  if (isset($msg)) {
  ?>
    <div class="alert alert-success alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <?php echo $msg; ?>
    </div>
  <?php
  }
  ?>
      <div class="panel panel-primary">
        <div class="panel-heading">List Sekolah Menengah Pertama</div>
        <div class="panel-content">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th class="col-md-1">No</th>
                  <th class="col-md-4">Nama Sekolah</th>
                  <th class="col-md-3">Alamat</th>
                  <th class="col-md-4">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($sekolah)) {
                  if (count($sekolah) == 0) {
                    echo '<tr><td colspan="3" class="text-center"><h3>No Data Input</h3></td></tr>';
                  }
                  foreach ($sekolah as $item) {
                ?>
                    <tr>
                      <td><?php echo ++$start ?></td>
                      <td><?php echo $item->sekolah ?></td>
                      <td><?php echo $item->alamat ?></td>
                      <td>
                        <a class="btn btn-primary btn-xs" href="<?php echo site_url('SMP/tambah/' . $item->kdSekolah) ?>" role="button">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Ubah
                        </a>

                        <a class="btn btn-danger btn-xs" href="<?php echo site_url("SMP/delete/" . $item->kdSekolah); ?>" onclick="return confirm('Hapus data?');">
                          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus
                        </a>

                        <!-- Contextual button for informational alert messages -->
                        <button type="button" class="btn btn-info btn-xs" onclick="lihatnilai(<?php echo $item->kdSekolah; ?>)">
                          <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Lihat
                        </button>
                        <!-- Indicates a dangerous or potentially negative action -->
                        <!-- <button type="button" data-toggle="modal" class="btn btn-danger btn-xs" data-target="#modalDelete<?= $item->kdSekolah ?>">
                          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus
                        </button> -->
                      </td>
                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    <?= $this->pagination->create_links(); ?>

  </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="view_kriteria" role="dialog">
  <div class="modal-dialog view-detail-kriteria">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Detail Nilai Sekolah</h3>
          </div>
          <div class="panel-body">

            <div class=" col-md-3"><b>Nama Sekolah </b></div>
            <div class="col-md-9">
              <div id="viewKodeNama"></div>
            </div>

            <div class=" col-md-3"><b>Alamat </b></div>
            <div class="col-md-9">
              <div id="viewAlamat"></div>
            </div>
          </div>
        </div>


        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Detail Nilai</h3>
          </div>
          <div class="panel-body">
            <?php
            $no = 1;

            for ($no; $no <= 4; $no++) {
            ?>

              <div class="col-md-3"><b> Nilai C<?php echo $no ?> :</b></div>
              <!-- <div class="col-md-3">
                <div class="left" id="viewItemKriteria<?php echo $no ?>"></div>
              </div> -->
              <div class="col-md-9">
                <div id="viewNilai<?php echo $no ?>"></div>
              </div>
            <?php }
            ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 
<?php
if (isset($sekolah)) {
  foreach ($sekolah as $item) {
?>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalDelete<?= $item->kdSekolah ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi hapus data</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin menghapus data <?= $item->sekolah ?> ? </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" onclick="hapusSekolah(<?php echo $item->kdSekolah; ?>)">
              Hapus
            </button>
          </div>
        </div><!-- /.modal-content 
      </div><!-- /.modal-dialog 
    </div> /.modal -->
<?php }
} ?>

<script>
  function lihatnilai(id) {
    $('.view-detail-kriteria').css('width', '50%');
    $('.view-detail-kriteria').css('margin', '100px auto 100px auto');

    $('#viewKodeNama').text("");
    $('#viewAlamat').text("");

    for (var i = 1; i <= 2; i++) {
      var itemNama = 'viewNama' + i;
      var valueAlamat = 'viewAlamat' + i;

      $("#" + itemNama).text("");
      $("#" + valueAlamat).text("");
    }

    $.ajax({
      url: base_url + "SMP/" + "detail/" + id,
      type: "POST",
      dataType: "JSON",
      success: function(data) {

        $('#viewKodeNama').text(' : ' + data.sekolah.sekolah);
        $('#viewAlamat').text(' : ' + data.sekolah.alamat);

        for (var item in data.nilai) {
          var index = parseInt(item) + 1;
          var itemkriteria = 'viewItemKriteria' + index;
          var valueNilai = 'viewNilai' + index;

          $("#" + itemkriteria).text(data.nilai[item].kdKriteria);
          $("#" + valueNilai).text(data.nilai[item].nilai);


        }
        $('#view_kriteria').modal('show');
        $('#view_kriteria .modal-title').text('Detail Nilai');
      }
    });
  }
</script>