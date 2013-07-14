<?php
/**
 * HTML builders
 *
*/
function abcfggcl_lib_htmlbldr_css_class($in){
    if(empty($in)){ return ''; }
    return ' class="' . $in . '" ';
}

function abcfggcl_lib_htmlbldr_div_cls( $cls ){ return '<div ' . $cls . ' >'; }

function abcfggcl_lib_htmlbldr_div_cls_style( $cls, $style ){ return '<div' . $cls . $style . ' >'; }

function abcfggcl_lib_htmlbldr_css_w($w, $units='px'){

    if(abcfggcl_lib_isblank($w)) { return ''; }
    return 'width:'. $w . $units . ';';
}

function abcfggcl_lib_htmlbldr_css_style( $style ) {

    if(abcfggcl_lib_isblank($style)) { return ''; }
    return ' style="' . $style . '" ';
}

//---------------------------------------------------------------------
function abcfggcl_lib_htmlbldr_img_tag($imgID, $src, $alt, $imgTitle, $imgW=0, $imgH=0, $cls='', $style='') {

    if (empty($src)) return '';
    $imgWH = '';
    if ($imgW > 0 && $imgH > 0) { $imgWH = ' width="' . $imgW . '" height="' . $imgH . '"'; }
    if (!empty($imgID)){ $imgID = ' id="' . $imgID . '"'; }
    if (!empty($cls)) { $cls = ' class="' . $cls . '"'; }
    if (!empty($style))  { $style = ' style="' . $style . '"'; }

    $alt = esc_attr( strip_tags( $alt ) );
    $alt = ' alt="' . $alt . '" ';
    if (!empty($imgTitle))  {
        $imgTitle = esc_attr( strip_tags( $imgTitle ) );
        $imgTitle = ' title="' . $imgTitle . '"';
        }
    $src =  ' src="' . $src . '"';

    return '<img ' . $imgID . $src . $cls . $style . $imgWH . $imgTitle . $alt . '/>';
 }

function abcfggcl_lib_htmlbldr_html_a_tag($href, $lnkTxt, $target='', $cls='', $style='', $spanStyle= '', $blankTag=true) {

    if(abcfggcl_lib_isblank($href)){
       if( !$blankTag ){ return $lnkTxt; }
       $href = "#";
    }

    if(!empty($spanStyle)){ $lnkTxt = '<span style="' . $spanStyle . '">' . $lnkTxt . '</span>'; }

    $href = esc_url($href);

    if($target === '1' || $target == '_blank' ){ $target = ' target="_blank"'; }
    if(empty($target)){ $target = ""; }

    if (!abcfggcl_lib_isblank($cls)) { $cls = ' class="' . $cls . '"'; }
    if(!abcfggcl_lib_isblank($style)){ $style = ' style="' . $style . '"'; }
    return "<a" . $cls . $style . ' href="' . $href . '"' . $target .  '>' . $lnkTxt . '</a>';
}
//---------------------------------------------------------------------
function abcfggcl_lib_isblank($in){ return (!isset($in) || trim($in)==='');}
