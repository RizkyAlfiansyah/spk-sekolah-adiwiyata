$(".remove").click(function(){
    var id = $(this).parents("tr").attr("id");

   swal({
    title: "Are you sure?",
    text: "You will not be able to recover this imaginary file!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel plx!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
         url: '/SekolahDasar/delete/'+id,
         type: 'DELETE',
         error: function() {
            alert('Something is wrong');
         },
         success: function(data) {
              $("#"+id).remove();
              swal("Deleted!", "Your imaginary file has been deleted.", "success");
         }
      });
    } else {
      swal("Cancelled", "Your imaginary file is safe :)", "error");
    }
  });
 
});