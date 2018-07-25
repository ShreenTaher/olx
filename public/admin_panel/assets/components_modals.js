/* ------------------------------------------------------------------------------
 *
 *  # Modal dialogs and extensions
 *
 *  Specific JS code additions for components_modals.html page
 *
 *  Version: 1.0
 *  Latest update: Aug 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function() {

    // Alert combination
    $(document).on( "click", ".delete", function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var id = $(this).attr('object_id');
        var d_url = $(this).attr('delete_url');
        var elem = $(this).parent('div').parent('td').parent('tr');
        var small_elem = $(this).parent('li').parent('ul').parent('div').parent('div').parent('td').parent('tr');
        var token = $('meta[name="_token"]').attr('content');
        swal({
                title: "are you sure ?",
                text: "deletion will be complete and don't able to retreive again",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "yes, delete it !",
                cancelButtonText: "No, cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){

                if (isConfirm) {
                    $.ajax({
                        url : d_url,
                        type : "DELETE",
                        data : "",
                        success : function(result) {

                            elem.hide(1000);
                            small_elem.hide(1000);
                        }
                    });

                    swal({
                        title: "deletion complete ",
                        text: "deletion completed successfully",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    });



                }
                else {
                    swal({
                        title: "deletion cancelled",
                        text: "deletion cancelled successfully",
                        confirmButtonColor: "#2196F3",
                        type: "error"
                    });
                }
            });
    });

});