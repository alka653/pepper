jQuery(document).ready(function ($) {
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.back-to-top').fadeIn('slow')
		} else {
			$('.back-to-top').fadeOut('slow')
		}
	})
	$('.select2').select2({
		width: '100%',
		placeholder: 'Seleccione una opción',
		allowClear: true,
		height: 'resolve'
	})
	$('.back-to-top').click(function () {
		$('html, body').animate({
			scrollTop: 0
		}, 1500, 'easeInOutExpo')
		return false
	})
	if ($('#nav-menu-container').length) {
		var $mobile_nav = $('#nav-menu-container').clone().prop({
			id: 'mobile-nav'
		})
		$mobile_nav.find('> ul').attr({
			'class': '',
			'id': ''
		})
		$('body').append($mobile_nav)
		$('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>')
		$('body').append('<div id="mobile-body-overly"></div>')
		$('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>')

		$(document).on('click', '.menu-has-children i', function (e) {
			$(this).next().toggleClass('menu-item-active')
			$(this).nextAll('ul').eq(0).slideToggle()
			$(this).toggleClass("fa-chevron-up fa-chevron-down")
		})

		$(document).on('click', '#mobile-nav-toggle', function (e) {
			$('body').toggleClass('mobile-nav-active')
			$('#mobile-nav-toggle i').toggleClass('fa-times fa-bars')
			$('#mobile-body-overly').toggle()
		})

		$(document).click(function (e) {
			var container = $("#mobile-nav, #mobile-nav-toggle")
			if (!container.is(e.target) && container.has(e.target).length === 0) {
				if ($('body').hasClass('mobile-nav-active')) {
					$('body').removeClass('mobile-nav-active')
					$('#mobile-nav-toggle i').toggleClass('fa-times fa-bars')
					$('#mobile-body-overly').fadeOut()
				}
			}
		})
	} else if ($("#mobile-nav, #mobile-nav-toggle").length) {
		$("#mobile-nav, #mobile-nav-toggle").hide()
	}
	$('.nav-menu a, #mobile-nav a, .scrollto').on('click', function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash)
			if (target.length) {
				var top_space = 0

				if ($('#header').length) {
					top_space = $('#header').outerHeight()

					if (!$('#header').hasClass('header-fixed')) {
						top_space = top_space - 20
					}
				}

				$('html, body').animate({
					scrollTop: target.offset().top - top_space
				}, 1500, 'easeInOutExpo')

				if ($(this).parents('.nav-menu').length) {
					$('.nav-menu .menu-active').removeClass('menu-active')
					$(this).closest('li').addClass('menu-active')
				}

				if ($('body').hasClass('mobile-nav-active')) {
					$('body').removeClass('mobile-nav-active')
					$('#mobile-nav-toggle i').toggleClass('fa-times fa-bars')
					$('#mobile-body-overly').fadeOut()
				}
				return false
			}
		}
	})
})
function url_param(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	return (results != null) ? results[1] || 0: false;
}
function loading(text = 'Cargando datos'){
	if($('.load').children().length == 0){
		$('.load').append(
			`<div class='load-animation'>
				<div class='text-center loading'>
					<img src='/img/load.gif' alt='${text}' style='width: 100px'>
					<h4>${text}</h4>
				</div>
			</div>`
		)
	}
}
function show_input(data, name_field){
	let options = {
		width: '100%',
		placeholder: 'Seleccione una opción',
		allowClear: true
	}
	let val_select = ''
	let toAppend = '<option value selected="selected"></option>'
	let select_input = $(`[name="${name_field}"]`)
	//select_input.select2('destroy')
	$.each(data, function(index, val){
		let selected = ''
		if(select_input.attr('data-id') != '' && index == select_input.attr('data-id')){
			selected = 'selected'
			val_select = index
		}
		if(index != ''){
			toAppend += `<option ${(index != '' ? `value="${index}"`: 'value=""')} ${selected}>${val}</option>`
		}
	})
	select_input.empty().append(toAppend)
	select_input.select2(options)
}
function get_by_url(url_request, name_field){
	loading()
	$.get(url_request, function(response){
		$('.load').empty()
		return show_input(response, name_field)
	})
}
$(document).on('keypress', '.only-number', function(e){
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false
	}
})
$(document).on('keypress', '.only-number-float', function(event){
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault()
	}
})
$(document).on('click', '.open-modal', function(e){
	e.preventDefault()
	$('.modal').empty().load($(this).attr('href'), function(){
		$('#Modal').modal()
	})
})
$(document).on('change', '.departamento_change', function(e){
	if($(this).val() != ''){
		var municipio = $(`[name="${$(this).attr('name').replace('departamento', 'municipio')}`)
		get_by_url(`/municipios/obtener-by-departamento/${$(this).val()}`, municipio.attr('name'))
	}
})
$(document).on('submit', '#form-modal', function(event){
	event.preventDefault()
	$.post($(this).attr('action'), $(this).serialize())
	.done(function(response){
		alert(response.message)
		$('.modal').modal('hide')
		location.reload(true)
	})
	.fail(function(xhr, status, error){
		$.each(xhr.responseJSON.errors, function(index, value){
			console.log(index, value)
			$(`#${index}`).parent().find('.invalid-feedback').remove()
			$(`#${index}`).parent().append(
				`<div class="invalid-feedback" style="display: block;">
					${value[0]}
				</div>`
			)
		})
	})
})
Number.prototype.format = function(n, x) {
	var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')'
	return '$ '+this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,')
}