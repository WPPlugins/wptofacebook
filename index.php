<?php
/*
 Plugin Name: WpToFacebook
 Version: 1.3.2
 Description: Choose contents to show in one or more tabs on a Facebook Page
 Author: Carlos Matheu Armengol
 Author URI: http://www.plastikaweb.com
 Plugin URI: http://www.plastikaweb.com/wordpress-to-facebook
 License: GPLv2
 */

/*
Copyright (C) 2011-2014 Carlos Matheu Armengol

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
 */

include_once 'includes/Wptofb.php';
include_once 'tests/PluginTest.php';

//Do some initial tests for system capabilities evaluation
$wptofb = new WpToFb();
$wptofb->wptofb_tests();
// If there were errors, show them on screen and do not allow to activate the plugin
if ( !empty(PluginTest::$errors ) ){
	PluginTest::print_notices();
}

register_activation_hook( __FILE__, 'WpToFb::wptofb_activate' );
