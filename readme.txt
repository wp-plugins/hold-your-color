=== Hold your color ===
Contributors: Under-Warz
Donate link: 
Tags: posts, tags, custom tags, color, colors
Requires at least: 2.8
Tested up to: 3.0.4
Stable tag: 1.0

Add custom color tag to your posts.

== Description ==

This plugin will add a custom "colors" tags to your posts. 

It will be very useful for e-commerce blog which selling clothes or for designs blogs writers who wants to set one or more colors for each posts.

It will add a new column in the admin posts listing page to show the colors tags used for each posts.

It will come with a customizable widget which allow you show colored bulls in your sidebar. You can also add a php code to display colors tags like classics tags. See `FAQ` section for more details.

== Installation ==

1. Upload `hold-your-color` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Like classic tag, add your color when you write a post
4. Manage the color with the colorpicker under the `Hold your color` settings page in `Settings` section

== Frequently Asked Questions ==

= How can I add/edit or remove colors =

The managing system is the same as `tags`. Go to `Colors` under the `Posts` section. Add a color with a color `Name` and a `Slug`. `Description` is not used. 

= How can I assigned a color to a post =

When you are writting a post, go to the right column under `tags` section and add or remove the colors you want.

= How can I change the color for the widget =

Go to the `Hold your color` settings page under `Settings` section. Then, for each color, paste the hexadecimal code in the input field or use the jQuery colorpicker.
Save your changes.

= Can I use a tag cloud for the colors =

Yes, set a new `Tag Cloud` widget and set `Colors` for the taxonomy.

= What are the colors widget options =

Title: (optional) set a title to the widget
Show as dropdown: change the presentation and use a dropdown list with the color name
Hide empty: if checked, colors which aren't assigned to a post will be hidden
Colors to show: check the colors you want to show. Prefer checking all

= How can I show colors tags in the loop =

The plugin comes with two useful functions.

`<?php the_colors($bull = true, $before = null, $separator = ' ', $after = null); ?>`
Parameters:
`$bull`: show colors as bullet and not as word
`$before`: text to show before listing
`$separator`: separator between each color
`$after`: text to show after listing

If you don't want to show directly the colors and keep its in a php variable, use this function :
`<?php get_the_colors($post_ID = null); ?>`
It will return an object array. Refer to this function to see who to use id : http://codex.wordpress.org/Function_Reference/wp_get_post_terms

= How can I print colors of a specific post outside the loop =

Use the second function see below and set the `$post_ID`.

= How can I change the style of the widget/inside post listing =

Just edit the `hyc-widget.css` in the `css` folder of the plugin.

== Screenshots ==

1. The manage colors tags
2. The Hold your color settings page
3. The Hold your color widget settings
4. Sidebar
5. In the Loop

== Changelog ==

== Upgrade Notice ==