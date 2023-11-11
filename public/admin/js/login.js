$('#password').focusin(function(){
	$('form').addClass('up')
	});
	$('#password').focusout(function(){
	$('form').removeClass('up')
	});

	// Panda Eye move
	$(document).on( "mousemove", function( event ) {
	var dw = $(document).width() / 15;
	var dh = $(document).height() / 15;
	var x = event.pageX/ dw;
	var y = event.pageY/ dh;
	$('.eye-ball').css({
		width : x,
		height : y
	});
	});

// validation

// $('.btn').click(function(){
// $('form').addClass('wrong-entry');
// 	setTimeout(function(){ 
// 	$('form').removeClass('wrong-entry');
// 	},3000 );
// });


$.ajaxSetup({
headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$('.user-save').submit(function(e){
e.preventDefault();
//   message();
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
	success: function (data) {

	  if(data.status == 'success'){

		 $(".user-save")[0].reset();
			window.location.href = data.url;
	 	 }

	  if(data.status == 'error'){
			$('form').addClass('wrong-entry');
			$('.alert').text(data.message);
			setTimeout(function(){ 
				$('form').removeClass('wrong-entry');
			},3000 );
	   }

	},
	error: function(data) {

		if(data.responseJSON.errors.email){
			$('.error-email').text(data.responseJSON.errors.email[0]).fadeIn().delay(2000).fadeOut();
		}else{
			$('.error-email').text('');
		}

		if(data.responseJSON.errors.password){
			$('.error-password').text(data.responseJSON.errors.password[0]).fadeIn().delay(2000).fadeOut();
		}else{
			$('.error-password').text('');
		}

	}
  });
});