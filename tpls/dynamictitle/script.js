$(document).ready(
		function() {
			var openproject = null;

			// expand item
			$('h2 a').click(openclose);
			$('a.hider').click(openclose);
			
			function openclose(event) {

				var $target = $(event.target);

				if (event.target != openproject) {
					
					$arrow = $target.parents('div.permalink_class').children('a.hider');
					if($arrow.text() == unescape('%u2191') ){
						$arrow.text(unescape('%u2193'));
					}else{
						$arrow.text(unescape('%u2191'));
					}
					
					// div.content_class
					$target.parents('div.content')
							.children('div.content_class').slideToggle('300');

					// .fb_btns visible
					$target.parents('div.permalink_class').children(
							'div.fb-like').show('300');

					// div.content_class
					$(openproject).parents('div.content').children(
							'div.content_class').slideToggle('300');

					// .fb_btns no visible
					$(openproject).parents('div.permalink_class').children(
							'div.fb-like').hide('300');
					
					$arrow2 = $(openproject).parents('div.permalink_class').children('a.hider');
					if($arrow2.text() == unescape('%u2191') ){
						$arrow2.text(unescape('%u2193'));
					}else{
						$arrow2.text(unescape('%u2191'));
					}
					
					
					openproject = event.target;

				} else {

					// div.content_class
					$target.parents('div.content')
							.children('div.content_class').slideToggle('300');

					// .fb_btns visible
					$target.parents('div.permalink_class').children(
							'div.fb-like').hide('300');
					
					$arrow = $target.parents('div.permalink_class').children('a.hider');		
					if($arrow.text() == unescape('%u2191') ){
						$arrow.text(unescape('%u2193'));
					}else{
						$arrow.text(unescape('%u2191'));
					}

					openproject = null;

				}
				
				FB.Canvas.setSize();
				setTimeout(function(){ FB.Canvas.setSize() },500);
				
				return false;
			}
			
			
			 
		});