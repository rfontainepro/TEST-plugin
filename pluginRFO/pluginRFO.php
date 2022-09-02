<?php

/**
 * @package pluginRFO
 */

/*
Plugin Name: pluginRFO
PLugin URI: https://oxbe.fr:8443
Description: Widget permettant diverses fonctions &#x1F608;
Version: 0.69
Author: Romain
Author URI: https://oxbe.fr:8443
License: GPLv2 or later
Text Domain: pluginRFO
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/

// Si ce fichier est appelé correctement, abandonnez !!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here?' );

//---------------------------------------------------------------------------------------------------

class pluginRFO {

    function __construct() {
        add_action( 'init', array( $this, 'custom_post_type' ) );
    }

    // Fonction pour déclencher l'action d'enregistrer
    function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    function activate() {
        $this->custom_post_type();
        flush_rewrite_rules();
    }

    function deactivate() {
        flush_rewrite_rules();
    }

    //function uninstall() {

    //}

    function custom_post_type() {
        register_post_type( 'book', ['public' => true, 'label' => 'books'] );
    }

    function enqueue() {
        wp_enqueue_style( 'mypluginstyle', plugins_url( '*/assets/mystyle.css', __FILE__ ) );
    }

}

if ( class_exists( 'pluginRFO' ) ) {
    $pluginRFO = new pluginRFO();
    $pluginRFO->register(); // Lancer la fonction REGISTER

}

// activation
register_activation_hook( __FILE__, array( $pluginRFO, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $pluginRFO, 'deactivate' ) );

// uninstall
//register_uninstall_hook( __FILE__, array( $pluginRFO, 'uninstall' ) );
// Cette méthode ne fonctionne pas... PHP ERROR