<?php
/**
 * Labels and other text.
*/
function abcfggcl_inputbldr_lbls($id) {
    $out = '';
    switch ($id){
        case 1:
            $out = __('Images Container - Height.', 'abcfggcl-td');
            break;
        case 2:
            $out = __('Images Container - Width.', 'abcfggcl-td');
            break;
        case 3:
            $out = __('Leave it blank to have a container expand with content. Enter any number to set the fixed height.', 'abcfggcl-td');
            break;
        case 4:
            $out = __('Leave it blank to have a container expand with content. Enter any number to set the fixed width.', 'abcfggcl-td');
            break;
        case 5:
            $out = __('Images Container - Left Margin', 'abcfggcl-td');
            break;
        case 6:
            $out = __('Images Container - Top Margin', 'abcfggcl-td');
            break;
        case 7:
            $out = __('Leave it blank to keep default value of 0 (zero pixels). For custom margin enter any number.', 'abcfggcl-td');
             break;
        case 9:
            $out = __('Image - Left Margin', 'abcfggcl-td');
            break;
        case 10:
            $out = __('Image - Top Margin', 'abcfggcl-td');
            break;
        case 11:
            $out = __('Leave it blank to keep the default value of 20 pixels. For custom margin enter any number.', 'abcfggcl-td');
            break;
        case 12:
            $out = __('All margins and sizes are in pixels.', 'abcfggcl-td');
            break;
        case 13:
            $out = __('All margins and sizes are in pixels.  All values are optional.', 'abcfggcl-td');
            break;
        case 14:
            $out = __('Space between images.', 'abcfggcl-td');
            break;
        case 15:
            $out = __('Copy this code and paste it into your post, page or text widget content.', 'abcfggcl-td');
            break;
        case 17:
            $out = __('Image - Animation on Hover', 'abcfggcl-td');
            break;
       case 18:
            $out = __('Image- Borders', 'abcfggcl-td');
            break;
       case 21:
            $out = __('Text Layout', 'abcfggcl-td');
            break;
       case 22:
            $out = __('Gallery Skin', 'abcfggcl-td');
            break;
       case 23:
            $out = __('Position of the images container on a page.', 'abcfggcl-td');
            break;
       case 24:
            $out = __('Image Size', 'abcfggcl-td');
            break;
       case 25:
            $out = __('Select what images to use.', 'abcfggcl-td');
            break;
        default:
            break;
    }
    return $out;
}

//--CBOs----------------------------------------------------------------------------------------
function abcfggcl_inputbldr_cbo_img_sizes() {

    $sizes = array(
        'thumbnail' => __('Thumbnail', 'abcfggcl-td'),
        'medium' => __('Medium', 'abcfggcl-td'),
        'large' => __('Large', 'abcfggcl-td'),
        'full' => __('Full Size', 'abcfggcl-td')
    );

    $allSizes = array();
    $addedSizes = get_intermediate_image_sizes();

    // $added_sizes is an indexed array, therefore need to convert it to associative array
    foreach( $addedSizes as $key => $value) {
            $allSizes[$value] = $value;
    }

    return array_merge( $allSizes, $sizes );
}

function abcfggcl_inputbldr_display_mbox($post_type) {

    switch ($post_type){
        case 'abcfggcl_post_type':
            return true;
        default:
            return false;
    }
}

function abcfggcl_inputbldr_cbo_skin() {
    return array('W' => __('White - for light backgrounds.', 'abcfggcl-td'),
                'B'  => __('Black - for dark backgrounds.', 'abcfggcl-td'));
}

function abcfggcl_inputbldr_cbo_pg_layout() {
    return array('1' => __('1. Multiline. Left aligned.', 'abcfggcl-td'),
                '2'  => __('2. Multiline. Right aligned.', 'abcfggcl-td'),
                '3'  => __('3. Multiline. Centered.', 'abcfggcl-td')
                );
}

function abcfggcl_inputbldr_cbo_tl_frame() {
    return array('N' => __('None', 'abcfggcl-td'),
                'B'  => __('Border (1 pixel)', 'abcfggcl-td')
                );
}

function abcfggcl_inputbldr_cbo_tl_animate() {
    return array('N' => __('None', 'abcfggcl-td'),
                'F'  => __('Fade', 'abcfggcl-td'),
                'D'  => __('Darken', 'abcfggcl-td'),
                'S'  => __('Scale', 'abcfggcl-td'));
}

//===DIV Builders=======================================================================
function abcfggcl_inputbldr_hdivider() { return "<div class=\"abcfHDivider\">&nbsp;</div>"; }
function abcfggcl_inputbldr_hdivider2() { return "<div class=\"abcfHDivider2\">&nbsp;</div>"; }
function abcfggcl_inputbldr_hlp_wrap($in) { return '<div class="abcfMboxHlp">' . $in . '</div>'; }
function abcfggcl_inputbldr_hlp_wrap_b($in) { return '<div class="abcfMboxHlpB">' . $in . '</div>'; }
function abcfggcl_inputbldr_hlp_wrap_mt($in) { return '<div class="abcfMboxHlpMT">'  . $in . '</div>'; }
function abcfggcl_inputbldr_hlp_wrap_mtb($in) { return '<div class="abcfMboxHlpMTB">'  . $in . '</div>'; }
//==========================================================================
function abcfggcl_inputbldr_input_cbo($fldID, $fldName, $values, $selected, $lbl, $hlp='', $lblID=0, $hlpID=0, $isInt=true, $size='', $cls='', $style='',  $clsCntr='', $clsLbl='') {

    $optns = abcfggcl_inputbldr_input_options( $fldID, $fldName, $lbl, $hlp, $lblID, $hlpID, $size, $cls, $style, $clsCntr, $clsLbl, $values, $selected );
    extract( $optns );

    return  $divs . $lbl . '</div><select id="$fldID" type="text"' . $cls . $style . ' name="' . $fldName . '" >' . $options . '</select>' . $hlp . '</div>';
}

function abcfggcl_inputbldr_input_txt($fldID, $fldName, $fldValue, $lbl, $hlp='', $lblID=0, $hlpID=0, $size='', $cls='', $style='',  $clsCntr='', $clsLbl=''){

    $optns = abcfggcl_inputbldr_input_options( $fldID, $fldName, $lbl, $hlp, $lblID, $hlpID, $size, $cls, $style, $clsCntr, $clsLbl );
    extract( $optns );

    return  $divs . $lbl . '</div><input id="' . $fldID . '" type="text"' . $cls . $style . 'name="' . $fldName . '" value="' . $fldValue . '" />' . $hlp . '</div>';
}

function abcfggcl_inputbldr_input_txt_readonly($fldID, $fldName, $fldValue, $lbl, $hlp='', $lblID=0, $hlpID=0, $size='', $cls='', $style='', $clsCntr='', $clsLbl=''){

    $optns = abcfggcl_inputbldr_input_options( $fldID, $fldName, $lbl, $hlp, $lblID, $hlpID, $size, $cls, $style, $clsCntr, $clsLbl );
    extract( $optns );

    return $divs . $lbl . '</div><input id="' .$fldID . '" type="text" ' . $cls . $style . 'name="' . $fldName . '" value="' . $fldValue . '" readonly />' . $hlp . '</div>';
}


function abcfggcl_inputbldr_input_options( $fldID, $fldName, $lbl, $hlp, $lblID, $hlpID, $size, $cls, $style, $clsCntr, $clsLbl, $values='', $selected='' ) {

    list($w, $units) = abcfggcl_inputbldr_input_size($size);
    $w = abcfggcl_lib_htmlbldr_css_w($w, $units);
    $style = abcfggcl_lib_htmlbldr_css_style( $w . $style );

    if(empty($fldName)) $fldName = $fldID;
    $cls = abcfggcl_lib_htmlbldr_css_class($cls);
    $divs = abcfggcl_inputbldr_get_fld_cntr_divs($clsCntr, $clsLbl);
    $lbl = abcfggcl_inputbldr_html_lbl($fldID, $lbl, $lblID, '0');
    $hlp = abcfggcl_inputbldr_get_input_hlp_under($hlp, $hlpID, '0');
    $options = abcfggcl_inputbldr_cbo_get_options($values, $selected);

    $out = array(
        'cls'       => $cls,
        'style'     => $style,
        'divs'      => $divs,
        'lbl'       => $lbl,
        'hlp'       => $hlp,
        'fldName'   => $fldName,
        'options'   => $options
    );
    return $out;
}

//============================================================================
function abcfggcl_inputbldr_get_lbl_txt($lblID, $sec) { return abcfggcl_inputbldr_lbls($lblID); }

function abcfggcl_inputbldr_html_lbl($fldID, $lbl, $lblID, $sec) {
    if((int)$lblID > 0){ $lbl = abcfggcl_inputbldr_get_lbl_txt($lblID, $sec); }
    return "<label for=\"$fldID\">$lbl</label>";
}

function abcfggcl_inputbldr_get_input_hlp_under($hlp, $hlpID, $sec) {

    if((int)$hlpID > 0){ $hlp = abcfggcl_inputbldr_get_lbl_txt($hlpID, $sec); }
    if(!empty($hlp)){return '<span class="abcfFldHlpUnder">' . $hlp . '</span>';}
    return '';
}

//============================================================================
function abcfggcl_inputbldr_input_size( $size ) {

    $defaultW='30';
    $defaultUnits='%';
    if(empty($size)) { return array($defaultW, $defaultUnits); }

    $w = '';
    $units = substr($size, -1, 1);
    if( $units == '%' ) { $w = rtrim($size, '%'); };
    if( $units == 'x' ) {
        $w = rtrim($size, 'px');
        $units = 'px';
     };

    if(empty($w)) {return array($defaultW, $defaultUnits);}
    return array($w, $units);
}

function abcfggcl_inputbldr_get_fld_cntr_divs($clsCntr, $clsLbl) {

    $clsCntr = !empty($clsCntr) ? $clsCntr : 'abcfFldCntr';
    $clsLbl = !empty($clsLbl) ? $clsLbl : 'abcfFldLbl';

    return '<div class="' . $clsCntr . '"><div class="' . $clsLbl .'">';
}

function abcfggcl_inputbldr_cbo_get_options($values, $selected_value) {
    $out = "";
    if(empty($values)){return $out;}
    $selected = "";
    foreach($values as $key => $value){
        $selected = abcfggcl_inputbldr_cbo_set_selected($key, $selected_value);
        $out .= "<option $selected value=\"$key\">$value</option>\n";
    }
    return $out;
}

function abcfggcl_inputbldr_cbo_set_selected($key, $selected_value) {
    $out = "";
    if(!abcfggcl_lib_isblank($selected_value)) { if($key == $selected_value) {$out = " selected=\"selected\" "; } }
    return $out;
}

