$(document).on({
	ready: function(){
		return $('body').on('click', '.create-unit', function(e){
			e.preventDefault();
			$('#unit').modal('show')
						.find('#modalContent')
						.load($(this).attr('href'));
		})
	}
})


/*
*Create user/login/email in modal
*/
$(document).on({
	ready: function(){
		return $('body').on('click', '.user-create', function(e){
			e.preventDefault();
			$('#root').modal('show')
						.find('#modalContent')
						.load($(this).attr('href'));
		})
	}
})


$(document).on({
	ready: function(){
		return $('body').is(':visible', '.kv-alert-container', setTimeout(function(){
			$('.kv-alert-container').fadeOut('slow')
		},3000))
	}
})

/*$(document).on({
	ready: function(){
		if($('.kv-alert-container').is(':visible')){
			setTimeout(function(){
				$('.kv-alert-container').fadeOut('slow')
			},3000);
		}
	}
})*/

$(document).on({
	ready: function(){
		return $('body').on('click', '.service-view', function(e){
			e.preventDefault();
			$('#root').modal('show')
						.find('#modalContent')
						.load($(this).attr('href'))
		})
	}
})
/*
*Detail view service-contract/id in modal
*/
$(document).on({
	ready: function(){
		return $('body').on('click', '')
	}
})



/*$(document).on({
	ready: function(){
		if($('.kv-alert-container').css('display', 'block')){
		setTimeout(function(){
			$('.kv-alert-container').fadeOut('slow')
		},3000);
	}
		
	}
	
})*/


/*
Аякс удаление пользователей у клиента
*/

$(document).on({
	ready: function(){
		return $('body').on('click', '.ajax-delete', function(e){
			e.preventDefault();
			var deleteurl = $(this).attr('delete-url');
			BootstrapDialog.confirm({
				type : BootstrapDialog.TYPE_WARNING,
				title : 'Подтверждение',
				message : 'Вы уверены, что хотите удалить этот элемент?',
				callback : function(result){
					if(result){
						$.ajax({
							url: deleteurl,
							type: 'post',
							error: function (xhr, status, error) {
								alert('There was an error with your request. '
										+xhr.responseText);
							}
						}).done(function(data){
							$.pjax.reload({container:'#user-pjax-container'})
						})
					}else{
						return;
					}
				}
			})

		})
	}
})



$(document).on({
	ready:function(){
		return $('body').on('click', '.btn-create', function(){
			$('#alert-message').css('display', 'none').removeClass();
			$('#root').modal('show')
					.find('#modalContent')
					.load($(this).attr('data-attribute-url'));
		})
			
	}
})

$(document).on({
	ready: function(){
		return $('body').on('click', '.modalLink', function(e){
			e.preventDefault();
			$('#alert-message').css('display', 'none').removeClass();
			$('#root').modal('show')
					.find('#modalContent')
					.load($(this).attr('data-attribute-url'));
		})
	}
})