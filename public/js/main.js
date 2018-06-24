$(document).ready(function(){

/* ==========================================================================
   Preloader
   ========================================================================== */		
	$(window).load(function() { // makes sure the whole site is loaded
		$('#status').fadeOut(); // will first fade out the loading animation
		$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
		$('body').removeClass("preloader_active");
	})

/* ==========================================================================
   Countdown
   ========================================================================== */
	$('.countdown').downCount({
        date: '09/15/2016 12:00:00' // m/d/y
    });

/* ==========================================================================
	Ajax contact
	========================================================================== */	
	var form = $('.contact-form');
	form.submit(function () {
		$this = $(this);
		$.post($(this).attr('action'), function(data) {
			$this.prev().text(data.message).fadeIn().delay(3000).fadeOut();
		},'json');
		return false;
	});
	

/* ==========================================================================
	Validate newsletter form
	========================================================================== */
	// Invoke the Placeholder plugin
		$('input, textarea').placeholder();

		// Validate newsletter form
		$('<div class="loading"><span class="bounce1"></span><span class="bounce2"></span><span class="bounce3"></span></div>').hide().appendTo('.form-wrap');
		$('<div class="success"></div>').hide().appendTo('.form-wrap');
		$('#newsletter-form').validate({
			rules: {
				newsletter_email: { required: true, email: true }
			},
			messages: {
				newsletter_email: {
					required: 'Email address is required',
					email: 'Email address is not valid'
				}
			},
			errorElement: 'span',
			errorPlacement: function(error, element){
				error.appendTo(element.parent());
			},
			submitHandler: function(form){
				$(form).hide();
				$('#newsletter .loading').css({ opacity: 0 }).show().animate({ opacity: 1 });
				$.post($(form).attr('action'), $(form).serialize(), function(data){
					$('#newsletter .loading').animate({opacity: 0}, function(){
						$(this).hide();
						$('#newsletter .success').show().html('<p>Thank you for subscribing!</p>').animate({opacity: 1});
					});
				});
				return false;
			}
		});


	
/* ==========================================================================
   Modal
   ============================================================= */
		
		// Open modal window on click
		$('.about-us').on('click', function(e) {
			var mainInner = $('.main_section'),
				modal = $('#modal-1');

			mainInner.animate({ opacity: 0 }, 400, function(){
				$('html,body').scrollTop(0);
				modal.addClass('modal-active').fadeIn(400);
			});
			e.preventDefault();

			$('.cross').on('click', function(e) {
				modal.removeClass('modal-active').fadeOut(400, function(){
					mainInner.animate({ opacity: 1 }, 400);
				});
				e.preventDefault();
			});
		});	


		$('.service').on('click', function(e) {
			var mainInner = $('.main_section'),
				modal = $('#modal-2');

			mainInner.animate({ opacity: 0 }, 400, function(){
				$('html,body').scrollTop(0);
				modal.addClass('modal-active').fadeIn(400);
			});
			e.preventDefault();

			$('.cross').on('click', function(e) {
				modal.removeClass('modal-active').fadeOut(400, function(){
					mainInner.animate({ opacity: 1 }, 400);
				});
				e.preventDefault();
			});
		});

		$('.location').on('click', function(e) {
			var mainInner = $('.main_section'),
				modal = $('#modal-3');

			mainInner.animate({ opacity: 0 }, 400, function(){
				$('html,body').scrollTop(0);
				modal.addClass('modal-active').fadeIn(400);
			});
			e.preventDefault();

			$('.cross').on('click', function(e) {
				modal.removeClass('modal-active').fadeOut(400, function(){
					mainInner.animate({ opacity: 1 }, 400);
				});
				e.preventDefault();
			});
		});			

		
/* ==========================================================================
   Nice Scroller
   ========================================================================== */
	$("html").niceScroll();
	$(".modal").niceScroll({cursorcolor:"#00F"});

/* ==========================================================================
   Tool Tip
   ========================================================================== */

	$('.more-links a, .social a').tooltip();
		$('.more-links a, .social a').on('click', function () {
			$(this).tooltip('hide')
		});

		
/* ==========================================================================
   WOW Animation
   ========================================================================== */
	wow = new WOW(
		{
	boxClass:     'wow',
	animateClass: 'animated',
	offset:       100
	}
	);
	wow.init();
	
	

	



});

