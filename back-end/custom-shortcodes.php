<?php 


function web_link($atts = array(), $content = null) {
    $content = do_shortcode($content);
    $href = $atts['href'];
    return '<div class="center"><a target="_blank" href="'.$href.'" class="btn-outline">'.$content.'</a></div>';
}
add_shortcode('web', 'web_link');


?>