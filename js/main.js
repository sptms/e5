// FUNCTIONS

var minimum_width_for_iso = 600;

function resetgrid(){
	all_pre		= $grid.find('.pre');
	all_open	= $grid.find('.open');
	postloader  = $grid.find('.open .postloader');
	postloader.remove();
	all_pre.show();
	all_open.removeClass('open');
}

function lightbox(context){
	$l = context.find('a[href$=".gif"], a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".bmp"], .gallery-icon a');
	$l.swipebox();
}

function show_pageloader(event) {
	if (event) {event.preventDefault();}
	$('body').addClass('noscroll');
	$('#pageloader').fadeIn(300);
	$('body.side_open .menu-toggle').trigger('click');
}

function hide_pageloader(){
	$('#pageloader').delay(800).fadeOut(300);
}

function sliders(element){
  $(element).flexslider({
    animation: "slide"
  });
}

function close_grid(){
	context = $('body').attr('data-context');
	window.history.pushState({path:context},'',context);
	resetgrid();
	$grid.isotope('layout');
}

function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {
	var ratio = [maxWidth / srcWidth, maxHeight / srcHeight ];
	ratio = Math.min(ratio[0], ratio[1]);
	return { width:srcWidth*ratio, height:srcHeight*ratio };
}

function loadtriggers(z,g){
	loader.fadeIn(300);
	posturl		= z.attr('href');
	cpost		= z.closest('.post');
	pre 		= cpost.find('.pre');
	resetgrid();
	
	cpost.addClass('moving').fadeOut();
	pre.fadeOut(50, function(){
		cpost.addClass('open');
		pre.after('<div class="postloader"></div>');
		$.ajax({url:posturl,success: function(data){
			var datak = $(data).find('.post-content');
			$('.postloader').html(datak);
			sliders('.flexslider');
			
			
			
			
			// LOADING IMAGES
			var $images = datak.find('img'),
    		preloaded = 0,
    		total = $images.length;
			$images.load(function() {
   				if (++preloaded === total) {
        			$grid.isotope('layout');
    			}
			});		
			
			lightbox(datak);		
			// OK, LOADED, DRAW A BOX ON EACH IMAGE TO FIX IT
			cpost.fadeIn(300, function(){
				
				w_w = $(this).find('.entry-content').width();
				
				$('.e4-post-image-wrap img').each(function(){
					t = $(this);
					w = t.closest('.e4-post-image-wrap');
					
					t_w =	t.attr('width');
					t_h = 	t.attr('height');
					
					if (t_w < w_w){
						w_w = t_w;
					}
					if (t_w && w_w){
						w_h = calculateAspectRatioFit(t_w,t_h,w_w,10000);
						w_h = parseInt(w_h.height);
						w.css('height',w_h+'px');
					}
				});
				
				if ($(window).width() > minimum_width_for_iso){
					g.isotope('layout').isotope( 'once', 'layoutComplete', function(){
						if ($('.post.open')) $('html, body').animate({scrollTop: $('.post.open').offset().top -70}, 'slow');			
					});
				} else {
					if ($('.post.open')) $('html, body').animate({scrollTop: $('.post.open').offset().top -70}, 'slow');
				}
				
				
				
				cpost.removeClass('moving');	
				loader.fadeOut(300);
			});
			if(posturl!=window.location){
				window.history.pushState({path:posturl},'',posturl);	
			}
		}});
	});
}

function resize_boxes(){
	wv = $(window).width();
	$('.pre .entry-image').each(function(){
		t = 	$(this);
		i = 	t.find('img');
		i_w =	i.attr('width');
		i_h = 	i.attr('height');
		e_w = 	t.width();
		
		// i_w : e_w = i_h : x;
		
		e_h = calculateAspectRatioFit(i_w,i_h,e_w,10000);
		e_h = parseInt(e_h.height);
		if (e_h > 0){
			$(this).css('height',e_h+'px');
		}
	});
	
	// IS IT A GRID?
	if ($('#main').hasClass('grid')){
		go = $('.grid').offset().left;
		$('.grid').css('width',wv);
	}
}

$(document).ready(function(){
	resize_boxes();
	hide_pageloader();	
	lightbox($('body'));	
	
	
	// STATIC PAGE SLIDERS
	sliders('.flexslider');
	
	$(document).on('mouseenter', '.entry-image-overlay', function(){
		h = $(this).closest('.entry-image').innerHeight();
		$(this).css('height',h);
	});

	$("img.lazy").lazyload({ 
	    effect : "fadeIn",
	    threshold : 400
	});

	// SETUP MAIN VARS
	ww			= $(window).width();
	$grid		= $('.grid');
	$posts		= $('.grid > .post');
	$trigger	= $('.trigger');
	toggle		= $('.menu-toggle');
	side		= $('#side');
	main		= $('#main');
	page		= $('#page');
	loader		= $('.loader');
	
	
	// ISOTOPE
	if (ww > minimum_width_for_iso){
		$grid.isotope({
			itemSelector: '.post',
			layoutMode: 'packery',
		});
	}
	
	// MAIN AJAX TRIGGER FUNCTION
	$trigger.on('click', $(this), function(e){
		e.preventDefault();
		loadtriggers($(this),$grid);
	});
	
	$(document).on('click','.entry-footer a', function(e){
		show_pageloader();
	});
	
	// SIDE DYNAMICS
	side_w = side.outerWidth() -30;
	side_m = side.css('margin-right');
	toggle.on('click', $(this),function(e){
		e.preventDefault();
		if ($('body').hasClass('side_open')){
			$('body').removeClass('side_open');
			side.css('margin-right',side_m);
			page.css('right','0');
		} else {
			side.css('margin-right','-20px');
			page.css('right',side_w);
			$('body').addClass('side_open');
	
		}
	});
	
	// CLICKING ON SIDE LINKS 
	$('#side a, #header-widgets a').on('click', $(this), function(e){
		url = $(this).attr('href');
		trigger_item = $('.grid .trigger[href="'+url+'"]:first');
		can_we_ajax_it = trigger_item.size(); 
		
		// DO WE HAVE AJAXABLE LINKS?
		if (can_we_ajax_it) {
			e.preventDefault();
			trigger_item.trigger('click');
			toggle.trigger('click');
		} else {
			show_pageloader();
		}
	});
	
	// PREVENT SCROLL ON BODY WHILE SCROLLING SIDE
	$( '#side' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
    	var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
		this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
    	e.preventDefault();
    });
});

// CLOSE POST DYNAMICS
$('#main').on('click','.close',function(){
	url = $(this).attr('data-url');
	if ($('#main').hasClass('grid')){
		close_grid();
	} else {
		window.location.href = url;
	}
	
});

$(window).load(function(){
	resize_boxes();
	$grid.isotope('layout');
	
	hash = window.location.hash;
	
	if(hash) {
		hash = hash.replace('#','');
		$('#post-'+hash+' .trigger').trigger('click');
	} 
	
})

// HANDLING RESIZE 
$(window).bind('resize', function(e){
    window.resizeEvt;
    $(window).resize(function(){
        clearTimeout(window.resizeEvt);
        resize_boxes();
        window.resizeEvt = setTimeout(function(){
           
		   $grid.isotope('layout');
		   console.log('now');
        }, 350);
    });
});

window.onpopstate = function(event) {
	url = window.location.href;
	trigger_item = $('.grid .trigger[href="'+url+'"]:first');
		can_we_ajax_it = trigger_item.size(); 
		
		if (can_we_ajax_it) {
			trigger_item.trigger('click');
		} else {
			close_grid();
		}
};