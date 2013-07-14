<?php
/**
 * CSS builders
 *
*/
//====WxH============================================
function abcfggcl_lib_css_wh($w, $h){ return abcfggcl_lib_css_w($w) . abcfggcl_lib_css_h($h); }

function abcfggcl_lib_css_w($in){
    if(abcfggcl_lib_isblank($in)) { return''; }
    return 'width:'.$in.'px;';
}

function abcfggcl_lib_css_h($in){
    if(abcfggcl_lib_isblank($in)) { return ''; }
    return 'height:'.$in.'px;';
}
//=======MARGINS============================================
function abcfggcl_lib_css_mtl($t, $l){ return abcfggcl_lib_css_mt($t) . abcfggcl_lib_css_ml($l); }

function abcfggcl_lib_css_ml($in){
    if(abcfggcl_lib_isblank($in)) { return''; }
    return 'margin-left:'. $in . abcfggcl_lib_css_px($in) . ';';;
}

function abcfggcl_lib_css_mt($in){
    if(abcfggcl_lib_isblank($in)) { return''; }
    return 'margin-top:'. $in . abcfggcl_lib_css_px($in) . ';';
}

//=======PADDING============================================
function abcfggcl_lib_css_ptl($t, $l){ return abcfggcl_lib_css_pt($t) . abcfggcl_lib_css_pl($l); }

function abcfggcl_lib_css_pl($in){
    if(abcfggcl_lib_isblank($in)) { return''; }
    $s = 'padding-left:';
    if(substr($in,0,1) == '-'){ $s = 'margin-left:'; }

    return $s . $in . abcfggcl_lib_css_px($in) . ';';
}

function abcfggcl_lib_css_pt($in){
    if(abcfggcl_lib_isblank($in)) { return''; }
    $s = 'padding-top:';
    if(substr($in,0,1) == '-'){ $s = 'margin-top:'; }

    return $s . $in . abcfggcl_lib_css_px($in) . ';';
}
//===STYLE================================================
function abcfggcl_lib_cssbldr_style_margin_tl($t, $l) { return abcfggcl_lib_css_style_tag(abcfggcl_lib_css_mtl($t, $l));}

//===HELPERS================================================
function abcfggcl_lib_css_class_tag( $cls ){
    if(abcfggcl_lib_isblank($cls)) {return '';}
    return ' class="' . $cls . '"';
}

 function abcfggcl_lib_css_style_tag($style) {
    if(abcfggcl_lib_isblank($style)) {return '';}
    return ' style="' . $style . '" ';
}

function abcfggcl_lib_css_px($in){
    $px = 'px';
    if($in == '0'){ $px = '';}
    return $px;
}
