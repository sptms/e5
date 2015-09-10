E4:


1.0 SHORTCODES:

	1.1 SLIDERS:
	
	-------------------------------------------
	
	How to build a responsive slider with E4's shortcodes:
	
	[e4-slider]: the slider wrapper
	[e4-slide]: the slide
	
	example:
	
		[e4-slider]
			[e4-slide]url_to_img[/e4-slide]
			[e4-slide]url_to_img[/e4-slide]
			[e4-slide]url_to_img[/e4-slide]
		[/e4-slider]
	
	
	1.2 GRID ALIGNED CONTENTS IN POST:
	
	-------------------------------------------
	
	[col1],[col25]: 1/4 grid size
	[col2],[col50]: 1/2 grid size
	[col3],[col75]: 3/4 grid size		
	[col33]: 1/3 grid size
	[col66]: 2/3 grid size
	
	example:
	
		[col25]This content is 1/4 post size[/col25]
		[col75]This content is 3/4 post size[/col75]
	
	
	1.3 CLEAR
	
	-------------------------------------------
	
	[clear]: clears row, to be used to line-break after [colXX] usage:
	
	example:
		
		[col25]this content is in col25[/col25]
		[col25]this content is in col25[/col25]
		[clear]
		<p>New line content</p>
		
		
	1.4 SUGGESTED PLUGINS
	
	-------------------------------------------
	
	SIMPLE CUSTOM POST ORDER: https://wordpress.org/plugins/simple-custom-post-order/
	CSSHERO: http://csshero.org