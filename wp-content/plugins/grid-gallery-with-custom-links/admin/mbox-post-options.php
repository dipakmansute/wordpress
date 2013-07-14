<?php
/**
 * Meta box: Post Options
 *
 */

add_action( 'add_meta_boxes', 'abcfggcl_add_mbox_post_optns', 10, 2 );
add_action( 'save_post', 'abcfggcl_mbox_save_post_optns', 10, 2 );

function abcfggcl_add_mbox_post_optns($post_type) {
    if ( abcfggcl_inputbldr_display_mbox($post_type) ) {
        add_meta_box(
            'abcfggcl-mbox-post-optns',
            __('Options', 'abcfggcl-td'),
            'abcfggcl_mbox_get_post_optns',
            $post_type,
            'normal',
            'high'
            );
    }
}

function abcfggcl_mbox_get_post_optns( $post ) {

    $optns = get_post_custom( $post->ID );
    $cntrH = isset( $optns['_abcfggcl_cntr_h'] ) ? esc_attr( $optns['_abcfggcl_cntr_h'][0] ) : '';
    $cntrW = isset( $optns['_abcfggcl_cntr_w'] ) ? esc_attr( $optns['_abcfggcl_cntr_w'][0] ) : '';
    $cntrLM = isset( $optns['_abcfggcl_cntr_lm'] ) ? esc_attr( $optns['_abcfggcl_cntr_lm'][0] ) : '';
    $cntrTM = isset( $optns['_abcfggcl_cntr_tm'] ) ? esc_attr( $optns['_abcfggcl_cntr_tm'][0] ) : '';
    $itemLM = isset( $optns['_abcfggcl_item_lm'] ) ? esc_attr( $optns['_abcfggcl_item_lm'][0] ) : '';
    $itemTM = isset( $optns['_abcfggcl_item_tm'] ) ? esc_attr( $optns['_abcfggcl_item_tm'][0] ) : '';
    $imgFr = isset( $optns['_abcfggcl_img_fr'] ) ? esc_attr( $optns['_abcfggcl_img_fr'][0] ) : 'N';
    $imgA = isset( $optns['_abcfggcl_img_annimate'] ) ? esc_attr( $optns['_abcfggcl_img_annimate'][0] ) : 'N';
    $layout = isset( $optns['_abcfggcl_layout'] ) ? esc_attr( $optns['_abcfggcl_layout'][0] ) : '';
    $imgSize = isset( $optns['_abcfggcl_img_size'] ) ? esc_attr( $optns['_abcfggcl_img_size'][0] ) : '';
    $skin = isset( $optns['_abcfggcl_skin'] ) ? esc_attr( $optns['_abcfggcl_skin'][0] ) : 'W';

    $cboFr = abcfggcl_inputbldr_cbo_tl_frame();
    $cboA = abcfggcl_inputbldr_cbo_tl_animate();
    $cboL = abcfggcl_inputbldr_cbo_pg_layout();
    $cboImgS = abcfggcl_inputbldr_cbo_img_sizes();
    $cboSkin = abcfggcl_inputbldr_cbo_skin();

    echo abcfggcl_inputbldr_hlp_wrap_b(abcfggcl_inputbldr_lbls(13));
    echo abcfggcl_inputbldr_input_cbo('ggclLayout', "",$cboL, $layout, '', '',  21,22, false);
    echo abcfggcl_inputbldr_input_cbo('ggclImgFrame', "",$cboFr, $imgFr, "", "",  18,0, false);
    echo abcfggcl_inputbldr_input_cbo('ggclImgA', "",$cboA, $imgA, "", "", 17,0, false);
    echo abcfggcl_inputbldr_input_cbo('ggclImgSize', "",$cboImgS, $imgSize, '', '',  24,25,0,0, false);
    echo abcfggcl_inputbldr_input_cbo('ggclSkin', "",$cboSkin, $skin, "", "", 22,0, false);
    echo abcfggcl_inputbldr_hdivider();
    echo abcfggcl_inputbldr_input_txt('ggclCntrW', '', $cntrW, '', '', 2,4);
    echo abcfggcl_inputbldr_input_txt('ggclCntrH', '', $cntrH, '', '', 1,3);
    echo abcfggcl_inputbldr_hdivider();
    echo abcfggcl_inputbldr_hlp_wrap_mt(abcfggcl_inputbldr_lbls(23));
    echo abcfggcl_inputbldr_input_txt('ggclCntrLM', "", $cntrLM, "", "", 5,7);
    echo abcfggcl_inputbldr_input_txt('ggclCntrTM', "", $cntrTM, "", "", 6,7);
    echo abcfggcl_inputbldr_hdivider();
    echo abcfggcl_inputbldr_hlp_wrap_mt(abcfggcl_inputbldr_lbls(14));
    echo abcfggcl_inputbldr_input_txt('ggclItemLM', "", $itemLM, "", "", 9,11);
    echo abcfggcl_inputbldr_input_txt('ggclItemTM', "", $itemTM, "", "", 10,11);

    wp_nonce_field( basename( __FILE__ ), 'abcfggcl_nonce_cntroptns' );
}

function abcfggcl_mbox_save_post_optns( $post_id, $post ) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( !isset( $_POST['abcfggcl_nonce_cntroptns'] ) || !wp_verify_nonce( $_POST['abcfggcl_nonce_cntroptns'], basename( __FILE__ ) ) )
            return $post_id;

    $oPpost = get_post_type_object( $post->post_type );
    if ( !current_user_can( $oPpost->cap->edit_post, $post_id ) ){return $post_id;}

    abcfggcl_mbsave_save_int( $post_id,  'ggclCntrH', '_abcfggcl_cntr_h');
    abcfggcl_mbsave_save_int( $post_id,  'ggclCntrW', '_abcfggcl_cntr_w');
    abcfggcl_mbsave_save_int( $post_id,  'ggclCntrLM', '_abcfggcl_cntr_lm');
    abcfggcl_mbsave_save_int( $post_id,  'ggclCntrTM', '_abcfggcl_cntr_tm');
    abcfggcl_mbsave_save_int( $post_id,  'ggclItemLM', '_abcfggcl_item_lm');
    abcfggcl_mbsave_save_int( $post_id,  'ggclItemTM', '_abcfggcl_item_tm');
    abcfggcl_mbsave_save_cbo( $post_id, 'ggclImgFrame', '_abcfggcl_img_fr', 'N');
    abcfggcl_mbsave_save_cbo( $post_id, 'ggclImgA', '_abcfggcl_img_annimate', 'N');
    abcfggcl_mbsave_save_cbo( $post_id, 'ggclLayout', '_abcfggcl_layout', '');
    abcfggcl_mbsave_save_cbo( $post_id, 'ggclImgSize', '_abcfggcl_img_size', '');
    abcfggcl_mbsave_save_cbo( $post_id, 'ggclSkin', '_abcfggcl_skin', '');

}