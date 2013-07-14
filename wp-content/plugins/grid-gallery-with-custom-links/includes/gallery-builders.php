<?php
/**
 * Gallery builders
 *
*/
function abcfggcl_gbldrs_get_pg($customPostID) {

    $divItems = '';
    $cls = 'ggclCtnr';
    $style = '';

    $optns = get_post_custom( $customPostID );
    $cntrH = isset( $optns['_abcfggcl_cntr_h'] ) ? esc_attr( $optns['_abcfggcl_cntr_h'][0] ) : '';
    $cntrW = isset( $optns['_abcfggcl_cntr_w'] ) ? esc_attr( $optns['_abcfggcl_cntr_w'][0] ) : '';
    $cntrLM = isset( $optns['_abcfggcl_cntr_lm'] ) ? esc_attr( $optns['_abcfggcl_cntr_lm'][0] ) : '';
    $cntrTM = isset( $optns['_abcfggcl_cntr_tm'] ) ? esc_attr( $optns['_abcfggcl_cntr_tm'][0] ) : '';
    $itemLM = isset( $optns['_abcfggcl_item_lm'] ) ? esc_attr( $optns['_abcfggcl_item_lm'][0] ) : '';
    $itemTM = isset( $optns['_abcfggcl_item_tm'] ) ? esc_attr( $optns['_abcfggcl_item_tm'][0] ) : '';
    $imgFr = isset( $optns['_abcfggcl_img_fr'] ) ? esc_attr( $optns['_abcfggcl_img_fr'][0] ) : '';
    $imgAn = isset( $optns['_abcfggcl_img_annimate'] ) ? esc_attr( $optns['_abcfggcl_img_annimate'][0] ) : '';
    $layout = isset( $optns['_abcfggcl_layout'] ) ? esc_attr( $optns['_abcfggcl_layout'][0] ) : '';
    $imgSize = isset( $optns['_abcfggcl_img_size'] ) ? esc_attr( $optns['_abcfggcl_img_size'][0] ) : '';
    $skin = isset( $optns['_abcfggcl_skin'] ) ? esc_attr( $optns['_abcfggcl_skin'][0] ) : 'W';

    $h4Style = '';
    $lnkClr = '';
    $h5Style = '';
    $descStyle = '';

    $h4Style = abcfggcl_lib_css_style_tag($h4Style);
    $h5Style = abcfggcl_lib_css_style_tag($h5Style);
    $descStyle = abcfggcl_lib_css_style_tag($descStyle);

    $items = abcfggcl_gbldrs_get_items($customPostID, $layout, $imgFr, $imgAn, $itemTM, $itemLM, $imgSize, $skin, $h4Style, $lnkClr, $h5Style, $descStyle);

    $style = abcfggcl_lib_css_wh($cntrW, $cntrH) . abcfggcl_lib_css_ptl($cntrTM, $cntrLM);
    $style = abcfggcl_lib_css_style_tag($style);

    if(!empty($items)) { $divItems = '<div id="equalH" class="' . $cls . '"' . $style . '>' . $items . '<div class="ggclClr"></div></div>'; }
    $js = '<script type="text/javascript">jQuery(function(){ jQuery("#equalH").equalHs(); });</script>';

    return $divItems . ' ' . $js;
}

function abcfggcl_gbldrs_get_items($postID, $layout, $imgFr, $imgAn, $itemTM, $itemLM, $imgSize, $skin, $h4Style, $lnkClr, $h5Style, $descStyle){

    $post = get_post( $postID );
    $pCnt = $post->post_content;

    if(empty($pCnt)) return '';
    $gImgs = abcfggcl_gbldrs_get_gallery_imgs( $postID, $pCnt, $imgSize );
    $out = '';

    foreach($gImgs as $gImg){
        $imgUrl = $gImg['imgUrl'];
        $imgW = $gImg['w'];
        $imgH = $gImg['h'];
        $alt = $gImg['alt'];
        $linkUrl = $gImg['linkUrl'];
        $linkTarget = $gImg['linkTarget'];
        $title = $gImg['title'];
        $cap1 = $gImg['cap1'];
        $cap2 = $gImg['cap2'];
        $cap3 = $gImg['cap3'];
        $cap4 = $gImg['cap4'];
        $desc = $gImg['desc'];
        $imgID = $gImg['imgID'];

        $imgTag = abcfggcl_lib_htmlbldr_img_tag( $imgID, $imgUrl, $alt, $title, $imgW, $imgH );
        $out .= abcfggcl_gbldrs_build_item( $imgID, $imgFr, $imgAn, $itemTM, $itemLM, $cap1, $cap2, $cap3, $cap4, $desc, $linkUrl, $linkTarget, $imgW, $imgTag,
                                            $layout, $skin, $h4Style, $lnkClr, $h5Style, $descStyle );
    }

    return $out;
 }

//-----------------------------------------------------------------------
function abcfggcl_gbldrs_build_item($imgID, $imgFr, $imgAn, $itemTM, $itemLM, $cap1, $cap2, $cap3, $cap4, $desc, $linkUrl, $linkTarget, $imgW, $imgTag,
        $layout, $skin, $h4Style, $lnkClr, $h5Style, $descStyle){

    $hasTxt = 1;
    $txtDiv = '';
    if(abcfggcl_lib_isblank($cap1) & abcfggcl_lib_isblank($cap2) & abcfggcl_lib_isblank($cap3) & abcfggcl_lib_isblank($cap4)){ $hasTxt = 0; }

    $cls = 'ggclItemCntr ggclItem_'. $imgID;
    $style = abcfggcl_lib_cssbldr_style_margin_tl($itemTM, $itemLM);
    $cntrS = '<div class="' . $cls . '"' . $style . '>';
    $cntrE = '</div>';

    $imgDiv = abcfggcl_gbldrs_build_img_div($skin, $imgFr, $imgAn, $imgTag, $linkUrl, $linkTarget);

    if($hasTxt === 1){
        $cap1 = esc_attr($cap1);
        $cap2 = esc_attr($cap2);
        $cap3 = esc_attr($cap3);
        $cap4 = esc_attr($cap4);
        $desc = wptexturize($desc);

        switch ($layout){
            case '1':
            case '2':
            case '3':
                $txtDiv = abcfggcl_gbldrs_build_txt_div_multiline($cap1, $cap2, $cap3, $cap4, $linkUrl, $linkTarget, $imgW, $imgFr, $layout, $skin, $h4Style, $lnkClr, $h5Style);
                break;
            default:
                break;
        }
    }

    return $cntrS . $imgDiv . $txtDiv . $cntrE;
 }

//-----------------------------------------------------------------------
function abcfggcl_gbldrs_build_img_div($skin, $imgFr, $imgAn, $imgTag, $linkUrl, $linkTarget){

    $frS = '';
    $frE = '';
    $clsA= '';
    switch ($imgAn){
    case 'S':
        $clsA = 'ggclImgSc ';
        break;
    case 'F':
        $clsA = 'ggclImgBkgW ggclImgFd ';
        break;
   case 'D':
        $clsA = 'ggclImgBkgB ggclImgFd ';
        break;
    default:
        break;
    }

    $clsFr = '';
    switch ($imgFr){
    case 'B':
        $clsFr = 'ggclImgB_' . $skin . ' ';
        break;
    case 'S':
        if($skin == 'W') { $clsFr = 'ggclImgS_W '; }
        break;
    case 'F':
        $clsFr = 'ggclImgFr_' . $skin . ' ';
        $frS = '<div class="ggclImgFrBr_' . $skin . '">';
        $frE = '</div>';
        break;
    case 'F5':
        $clsFr = 'ggclImgFr5_' . $skin . ' ';;
        $frS = '<div class="ggclImgFrBr_' . $skin . '">';
        $frE = '</div>';
        break;
    default:
        break;
    }

    $clsImg = 'ggclImg ' . $clsFr . $clsA;

    $aTag = abcfggcl_lib_htmlbldr_html_a_tag($linkUrl, $imgTag, $linkTarget, '','', '', false);
    $img = $frS . '<div class="' . $clsImg . '">' . $aTag . '</div>' . $frE;

    return $img;
 }

function abcfggcl_gbldrs_build_txt_div_multiline($cap1, $cap2, $cap3, $cap4, $linkUrl, $linkTarget, $imgW, $imgFr, $layout, $skin, $h4Style, $lnkClr, $h5Style){

    $txtCntrCls = 'ggclTxtMlCntr';
    $txtCntrW = $imgW;
    $txtCntrCls2 = abcfggcl_gbldrs_txt_align( $layout, 'ggclAlign' );

    $cls = abcfggcl_lib_css_class_tag($txtCntrCls . ' ' . $txtCntrCls2 );
    $style = abcfggcl_lib_css_style_tag(abcfggcl_lib_css_w($txtCntrW));
    $cntrS = abcfggcl_lib_htmlbldr_div_cls_style( $cls, $style );

     $l1 = '';
     $l2 = '';
     $l3 = '';
     $l4 = '';

     $l1 = abcfggcl_gbldrs_build_txt_h4($cap1, $linkUrl, $linkTarget, $h4Style, $lnkClr );

     if(!abcfggcl_lib_isblank($cap2)){ $l2 = '<p' . $h5Style . '>' . $cap2 . '</p>'; }
     if(!abcfggcl_lib_isblank($cap3)){ $l3 = '<p' . $h5Style . '>' . $cap3 . '</p>'; }
     if(!abcfggcl_lib_isblank($cap4)){ $l4 = '<p' . $h5Style . '>' . $cap4 . '</p>'; }

     return  $cntrS . $l1 . $l2 . $l3 . $l4 . '</div>';
}

//-----------------------------------------------------------------------
function abcfggcl_gbldrs_build_txt_h4($cap1, $linkUrl, $linkTarget, $h4Style, $lnkClr ){

    if(abcfggcl_lib_isblank($cap1)){ return '';}

    $aTag = abcfggcl_lib_htmlbldr_html_a_tag($linkUrl, $cap1, $linkTarget, '', '', $lnkClr, false);
    return '<h4' . $h4Style . '>' . $aTag . '</h4>';
}

function abcfggcl_gbldrs_txt_align( $layout, $txtCntrCls ){

    switch ($layout){
    case '1':
        $txtCntrCls .= 'L';
        break;
    case '2':
        $txtCntrCls .= 'R';
        break;
    case '3':
        $txtCntrCls .= 'C';
        break;
    default:
        break;
    }
    return $txtCntrCls;
}


function abcfggcl_gbldrs_get_gallery_imgs( $postID, $pCnt, $imgSize ) {

    $shortcodeArgs = shortcode_parse_atts(abcfggcl_gbldrs_get_regex_match('/\[gallery\s(.*)\]/isU', $pCnt));
    $ids = $shortcodeArgs['ids'];
    $attr = array(
        'include' => $ids,
        'order'       => 'DESC',
        'orderby'     => 'post__in',
        'id'          => $postID,
        'size'        => $imgSize
    );

    return abcfmlcf_get_images($attr);

}

// Return first regex match
function abcfggcl_gbldrs_get_regex_match( $regex, $content ) {
    $matches = array();
    preg_match($regex, $content, $matches);
    return $matches[1];
}

