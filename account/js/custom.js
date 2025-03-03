/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Header Search
4. Init Menu
5. Init Home Slider
6. Init Courses Slider
7. Init Milestones
8. Init Accordions


******************************/

$(document).ready(function()
{
	"use strict";

	/* 

	1. Vars and Inits

	*/

	var menu = $('.menu');
	var menuActive = false;
	var header = $('.header');
	var burger = $('.hamburger');

	initMenu();
	initHomeSlider();
	initAccordions();

	/* 


	/* 

	4. Init Menu

	*/

	function initMenu()
	{
		if($('.menu').length)
		{
			var menu = $('.menu');
			if($('.hamburger').length)
			{
				burger.on('click', function()
				{
					if(menuActive)
					{
						closeMenu();
					}
					else
					{
						openMenu();

						$(document).one('click', function cls(e)
						{
							if($(e.target).hasClass('menu_mm'))
							{
								$(document).one('click', cls);
							}
							else
							{
								closeMenu();
							}
						});
					}
				});
			}
		}
	}

	function openMenu()
	{
		menu.addClass('active');
		menuActive = true;
	}

	function closeMenu()
	{
		menu.removeClass('active');
		menuActive = false;
	}

	/* 

	5. Init Home Slider

	*/

	function initHomeSlider()
	{
		if($('.home_slider').length)
		{
			var homeSlider = $('.home_slider');
			homeSlider.owlCarousel(
			{
				items:1,
				loop:true,
				autoplay:true,
				autoplayTimeout:8000,
				dots:false,
				nav:false,
				smartSpeed:1200
			});

			if($('.home_slider_prev').length)
			{
				var prev = $('.home_slider_prev');
				prev.on('click', function()
				{
					homeSlider.trigger('prev.owl.carousel');
				});
			}

			if($('.home_slider_next').length)
			{
				var next = $('.home_slider_next');
				next.on('click', function()
				{
					homeSlider.trigger('next.owl.carousel');
				});
			}
		}
	}

	/*

	6. Init Courses Slider

	*/

	function initCoursesSlider()
	{
		if($('.courses_slider').length)
		{
			var coursesSlider = $('.courses_slider');
			coursesSlider.owlCarousel(
			{
				items:3,
				loop:true,
				autoplay:true,
				autoplayTimeout:8000,
				nav:false,
				dots:false,
				smartSpeed:1200,
				margin:30,
				responsive:
				{
					0:
					{
						items:1
					},
					768:
					{
						items:2
					},
					992:
					{
						items:3
					}
				}
			});

			if($('.courses_slider_prev').length)
			{
				var prev = $('.courses_slider_prev');
				prev.on('click', function()
				{
					coursesSlider.trigger('prev.owl.carousel');
				});
			}

			if($('.courses_slider_next').length)
			{
				var next = $('.courses_slider_next');
				next.on('click', function()
				{
					coursesSlider.trigger('next.owl.carousel');
				});
			}
		}
	}

	/*

	8. Init Accordions

	*/

	function initAccordions()
	{
		if($('.accordion').length)
		{
			var accs = $('.accordion');

			accs.each(function()
			{
				var acc = $(this);

				if(acc.hasClass('active'))
				{
					var panel = $(acc.next());
					var panelH = panel.prop('scrollHeight') + "px";

					if(panel.css('max-height') == "0px")
					{
						panel.css('max-height', panel.prop('scrollHeight') + "px");
					}
					else
					{
						panel.css('max-height', "0px");
					}
				}

				acc.on('click', function()
				{
					if(acc.hasClass('active'))
					{
						acc.removeClass('active');
						var panel = $(acc.next());
						var panelH = panel.prop('scrollHeight') + "px";

						if(panel.css('max-height') == "0px")
						{
							panel.css('max-height', panel.prop('scrollHeight') + "px");
						}
						else
						{
							panel.css('max-height', "0px");
						}
					}
					else
					{
						acc.addClass('active');
						var panel = $(acc.next());
						var panelH = panel.prop('scrollHeight') + "px";

						if(panel.css('max-height') == "0px")
						{
							panel.css('max-height', panel.prop('scrollHeight') + "px");
						}
						else
						{
							panel.css('max-height', "0px");
						}
					}
				});
			});
		}
	}
	var cookieAll = getCookie('acceptedAllCookies');
	if(cookieAll == null) {
		$('.cookieinfo').show();
	}
	$('.acceptCookieButton').click(function() {
		document.cookie = "acceptedAllCookies=true;domain=he-me.com;path=/;expires=Fri, 01 Jan 2099 23:59:59 GMT;";
		$('.cookieinfo').remove();
	});

});
function getCookie(name) {
	var dc = document.cookie;
	var prefix = name + "=";
	var begin = dc.indexOf("; " + prefix);
	if (begin == -1) {
		begin = dc.indexOf(prefix);
		if (begin != 0) return null;
	}
	else
	{
		begin += 2;
		var end = document.cookie.indexOf(";", begin);
		if (end == -1) {
			end = dc.length;
		}
	}
	// because unescape has been deprecated, replaced with decodeURI
	//return unescape(dc.substring(begin + prefix.length, end));
	return decodeURI(dc.substring(begin + prefix.length, end));
}