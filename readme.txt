=== WpToFacebook ===
Contributors: plastikaweb
Donate link: http://www.plastikaweb.com/
Tags: facebook, page, social media, connect, publish, share, fb
Requires at least: 3.1
Tested up to: 3.9
Stable tag: 1.3.2

WpToFacebook lets you choose contents (manually or automatically) to be shown in one or more 'tabs' on a Facebook Page

== Description ==

WpToFb gives you a great number of parameters to be able to update a tab or menu on your Facebook's page.

= WpToFacebook =

* As many connections as you want
* Each connection needs a facebook app pointing to it, just create the connection on wp-to-fb first, and then use URL the system will create for you. Then use the fb App Id and the fb app secret to the wp-to-fb connection
* Each connection becomes a menu item on your facebook page menu (on the left column)
* You can choose a general title. 
* Choose also if the main contents are visible to no fans
* Choose an intro, an outro and content for no fans. All of them allow HTML tags.
* You can choose the contents to show. Posts, pages and other custom types are allowed
* You can make the contents visible automatically, selecting the type of content, the category and taxonomy tags. 
* The automatic contents can be ordered by title, date or randomily, in an ascendent or descendent order.
* When automatic contents is selected, you can choose the number of articles to show.
* You can make the contents visible manually, selecting the articles (and filtering also by the type of content), and dragging them. You can also order them by dragging with the mouse.
* Choose a template to show the contents on facebook. 
* You can create your own templates, just create a folder inside the tpls folder with an unique name with the files preview.png, style.css and tpl.php.
* Ready for multilanguage. English, Spanish and Catalan available. You can add your own language files.

== Installation ==

= Install =

1. Uncompress the download package
1. Upload the folder `wp-to-fb` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

= Requirements =

* PHP 5.2 or above
* WordPress 3.1 or above

== Frequently Asked Questions ==

= How can I create an app on facebook? =
Go to https://developers.facebook.com/apps
Check this tutorial http://developers.facebook.com/docs/appsonfacebook/tutorial/

= Where are the App Id and the secret Id of my facebook application? =
When you create your app on facebook (https://developers.facebook.com/apps) they are shown at the Summary

= How can I add my app to my Facebook page? =
Check this: https://developers.facebook.com/docs/appsonfacebook/pagetabs/

= Add option for pagination (yes/no add number of items per page) =
Soon.

== Screenshots ==

1. Menu and submenu
1. List View
1. Single edit view: General Settings
1. Single edit view: Automatic Wp Contents
1. Single edit view: Manual Wp Contents
1. Single edit view: Optional Contents
1. Single edit view: Templates
1. Single edit view: Featured Image
1. Single edit view: CSS rules
1. An example of a facebook page with the contents loaded from WP

== Changelog ==
= 1.3.2 =
* Added support for Serbian language. Translation done by Ogi Djuraskovic (http://firstsiteguide.com)

= 1.3.1 =
* Fixed problem with SSL servers.
* Updated compatibility with Wordpress 3.5

= 1.3.0 =
* Full code optimization.
* Design updated.
* Added help submenu about How To Create A Connection.
* Updated languages files (Catalan and Spanish).

= 1.2.3 =
* Fixed problem with TinyMce Editor in Edit View.

= 1.2.2 =
* Updated compatibility with new timeline view width on pages.

= 1.2.1 =
* Bug related with featured Images caused when post thumbnails are disabled on your theme.
* Bug related with rezise canvas on some templates fixed.
* Table version updated to 1.2.

= 1.2 =
* Added CSS header style option to overwrite Template CSS styles.
* Added option to include dynamically the featured image if available (none, small, medium or large).
* Added a new template, "dynamic title".
* Updated language files.
* Updated FAQ

= 1.1.1 =
* Fixed problem with TinyMce Editor in Wordpress 3.3.

= 1.1 =
* Critical bug about missing includes/tpl_redirect.php file fixed.

= 1.0 =
* Initial version.

