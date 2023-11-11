$(function(){
    
      $("#example1").DataTable();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.save').submit(function(e){
          e.preventDefault();
            message();
            var url = $(this).attr('action');
            var method = $(this).attr('method');  
            var data = new FormData($(this)[0]);
            $.ajax({
              url: url,
              type: method,
              data: data,
              async: false,
              cache: false,
              contentType: false,
              processData: false,
              dataType: 'json',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {       
                if(data.status == 'success'){

                  if(data.type == 'store'){
                      $(".save")[0].reset();
                  }

                  if(data.type == 'update'){
                    setTimeout(function(){ // wait for 1 secs(1000)
                        location.reload(); // then reload the page
                   }, 1000);
                }

                  toastr.success(data.message);
                  
              }else if(data.status == 'error'){
                  toastr.error(data.message);
              }else if(data.status == 'errors'){
                  printErrorMsg(data.message)
              }
              }
            });
      });


      $('.delete').on('click',(function(e) {
        e.preventDefault();
        message();
        var type = $(this).data('method');
        var action = $(this).data('action');
        if (confirm('Are you sure you want to delete this?')) { 
            $.ajax({
                type: type,
                url: action,
                success:function(data){
                    if(data.status == 'success'){
                        toastr.success(data.message);
                        setTimeout(function(){ // wait for 1 secs(1000)
                            location.reload(); // then reload the page
                       }, 1000);
                    }else if(data.status == 'error'){
                        toastr.error(data.message);
                    } 
                },
            });
         }
    }));


    function message(){
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-center",
          };
      }

    function printErrorMsg(msg) {
        $.each( msg, function( key, value ) {
            toastr.error(value);
        });
    }

});