/**
 * Created by sankester on 14/05/2017.
 */

// function hapusSekolah(id){
//     $.ajax({
//         url :  base_url + "SekolahDasar" + "hapus/"+id,
//         type : "POST",
//         dataType : "JSON",
//         success : function(data){
//             location.reload();
//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error adding / update data');
//         }
//     });
// }

function lihat_nilai(id){
    $('.view-detail-kriteria').css('width', '50%');
    $('.view-detail-kriteria').css('margin', '100px auto 100px auto');

    $('#viewKodeNama').text("");
    $('#viewAlamat').text("");
    
    for(var i=1; i<=2; i++){
        var itemNama = 'viewNama' + i;
        var valueAlamat = 'viewAlamat' + i;

        $("#" + itemNama ).text("");
        $("#" + valueAlamat ).text("");
    }

    $.ajax({
        url: base_url + "SekolahDasar/" + "detail/"+id,
        type : "POST",
        dataType : "JSON",
        success:  function(data){

            $('#viewKodeNama').text(' : '+ data.sekolah.sekolah);
            $('#viewAlamat').text(' : '+data.sekolah.alamat);

            for(var item in data.nilai){
                var index = parseInt(item) + 1;
                var itemkriteria = 'viewItemKriteria' + index;
                var valueNilai = 'viewNilai' + index;

                $("#" + itemkriteria ).text(data.nilai[item].kdKriteria);
                $("#" + valueNilai ).text(data.nilai[item].nilai);


            }
            $('#view_kriteria').modal('show');
            $('#view_kriteria .modal-title').text('Detail Nilai');
        }
    });
}
