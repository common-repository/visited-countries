=== Plugin Name ===
Name: Visited Countries
Contributors: pcsforme
Donate link: http://www.p3ck.us/
Tags: world, countries, country, provinces, ammap, visited, visit
Requires at least: 4.0
Tested up to: 4.0
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Uses amMap's JavaScript maps to display a map of visited places via shortcode.

== Description ==

Visited Countries is a WordPress plugin that allows you to track how many countries you have visited and display your customized map via shortcode.

You can change the colors of the map from the settings page including: water color, visited color, not visited color, outline color, roll over color, roll over outline color, etc.

The map size is fully customizable by passing in a height and width value when you call the shortcode.

Use [visited_countries] to display your map. 

You can also add text and close the shortcode while using the following fields:
{num}, {total}, {percent}

i.e. [visited_countries width="500" height="500"]I have visited {num} of {total} countries! That is {percent} of the world![/visited_countries]


== Installation ==

1. Upload `np_visited_countries` folder to your current plugin directory (i.e. `/wp-content/plugins/` if you haven't changed them)
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= Can I change the size of the map? =

Yes, just pass in the width and height values when you call the shortcode. i.e. [visited_countries width="1000" height="600"]

= What colors can I use? =

You can use any valid HEX color code or even try entering a common color name. If I've added it to the plugin it will automatically change it to the correct HEX code and save it. Don't worry if you get one wrong, it will just go back to the default color.

I've added a preview of the map to the settings screen so you can immediately see your color changes!

Answer to foo bar dilemma.

== Screenshots ==

1. This is a preview of the map
1. Preview of the settings page
1. Preview of the countries page

== Changelog ==

= 1.0.1 =
* Added settings page

= 1.0.0 =
* First Draft

== Upgrade Notice ==

= 1.0.1 =
Provides more functionality. 