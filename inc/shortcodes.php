<?php 

function e4_build_slider($atts,$content=''){
	return '<div class="flexslider"><ul class="slides">'.do_shortcode($content).'</ul></div>';
}

function e4_build_slide($atts,$content=''){
	return '<li>'.do_shortcode($content).'</li>';
}

function e4_build_col25($atts,$content=''){
	return '<div class="col col25">'.do_shortcode($content).'</div>';
}

function e4_build_col50($atts,$content=''){
	return '<div class="col col50">'.do_shortcode($content).'</div>';
}

function e4_build_col75($atts,$content=''){
	return '<div class="col col75">'.do_shortcode($content).'</div>';
}

function e4_build_col33($atts,$content=''){
	return '<div class="col col33">'.do_shortcode($content).'</div>';
}

function e4_build_col66($atts,$content=''){
	return '<div class="col col66">'.do_shortcode($content).'</div>';
}

function e4_build_clear($atts,$content=''){
	return '<div class="clear"></div>';
}

function e4_build_hr($atts,$content=''){
	return '<hr>';
}


add_shortcode('e4-slider','e4_build_slider');
add_shortcode('e4-slide','e4_build_slide');

add_shortcode('col1','e4_build_col25');
add_shortcode('col25','e4_build_col25');

add_shortcode('col2','e4_build_col50');
add_shortcode('col50','e4_build_col50');

add_shortcode('col3','e4_build_col75');
add_shortcode('col75','e4_build_col75');

add_shortcode('col33','e4_build_col33');
add_shortcode('col66','e4_build_col66');

add_shortcode('clear','e4_build_clear');
add_shortcode('break','e4_build_hr');

?>