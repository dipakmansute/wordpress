<?php
/**
 * Save meta box data.
 *
*/

function abcfggcl_mbsave_save_int( $post_id, $field_id, $meta_key) {

    $new_value = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : '' );
    $new_value = abcfggcl_mbsave_valid_int($new_value);
    abcfggcl_mbsave_save_field( $post_id, $meta_key, $new_value);
}

function abcfggcl_mbsave_save_cbo( $post_id,  $field_id, $meta_key, $default, $saveDefault = false) {

    $new_value = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : $default );
    if($new_value == $default && !$saveDefault) { $new_value = ""; }
    abcfggcl_mbsave_save_field( $post_id, $meta_key, $new_value);
}

function abcfggcl_mbsave_save_custom_css( $post_id, $field_id, $meta_key) {

    $new_value = ( isset( $_POST[$field_id] ) ? $_POST[$field_id] : '' );
    abcfggcl_mbsave_save_field( $post_id, $meta_key, $new_value);
}

//=============================================================================
function abcfggcl_mbsave_save_field( $post_id, $meta_key, $new_value)
{
        $new_value = trim($new_value);

	/* Get the meta value of the custom field key. */
	$old_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_value && '' == $old_value )
        {
		add_post_meta( $post_id, $meta_key, $new_value, true );
        }

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_value != '' && $new_value != $old_value )
        {
		update_post_meta( $post_id, $meta_key, $new_value );
        }

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_value && isset($old_value) )
        {
		delete_post_meta( $post_id, $meta_key, $old_value );
        }
}

//=============================================================================
function abcfggcl_mbsave_valid_int( $in, $default='') {

    if(abcfggcl_lib_isblank($in)){return $default;}
    if($in == '0'){return $in;}
    $in = intval($in);
    if($in == 0){return $default;}
    return intval($in);
}