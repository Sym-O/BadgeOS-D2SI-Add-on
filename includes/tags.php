<?php
/**
* Add tags feature to BadgeOS plugin
*
* @package BadgeOS D2SI
* @subpackage Achievements
* @author D2SI
* @license http://www.gnu.org/licenses/agpl.txt GNU AGPL v3.0
* @link https://D2SI.fr
 */

/**
* Modify each CPT created by badgeos for achievement by adding the taxonomy post_tag
*
* 
*/
function badgeos_d2si_add_tags_init() {
    
    // Grab all of our achievement type posts
	$achievement_types = get_posts( array(
		'post_type'      =>	'achievement-type',
		'posts_per_page' =>	-1,
    ) );
    
    // Loop through each achievement type post and register it as a CPT
	foreach ( $achievement_types as $achievement_type ) {
		$achievement_name_singular = get_post_meta( $achievement_type->ID, '_badgeos_singular_name', true );
        if(register_taxonomy_for_object_type( 'post_tag', sanitize_title( substr( strtolower( $achievement_name_singular ), 0, 20 ) ) ) == false) {
            return false;
        }
    }
    return true;
}
//add_action( 'init', 'badgeos_d2si_add_tags_init' ); TODO understand why add_action init here does not work
