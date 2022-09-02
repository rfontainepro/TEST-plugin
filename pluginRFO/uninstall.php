<?php

/**
 *  Supression des fichiers liés au pluginRFO
 * 
 * @package pluginRFO
 */

 if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) { // https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/
    die;
 }

 // Nettoyer les données de la DB -----------------------------------------------------------------------------------------------------------------------------------

 // Première méthode
 //$books = get_posts( array('post_type' => 'book', 'numbberposts' => -1 ) );

 //foreach( $books as $book ) {
 //   wp_delete_post( $book->ID, true ); // https://developer.wordpress.org/reference/functions/wp_delete_post/
 //}

 // Seconde méthode
 // Emplacement données liés // http://localhost/phpmyadmin5.2.0/index.php?route=/sql&pos=0&db=wordpress&table=wp_posts (DB: wordpress => wp_posts)
 global $wpdb;
 $wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book'");
 $wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
 $wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );