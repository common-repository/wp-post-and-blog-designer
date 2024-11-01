=== WP Post and Blog Designer ===
Contributors: pareshpachani007 
Tags: post, post designer, post list designer, blog designer post grid, post slider, blog, post ticker, masonry for post, blog template, post carousel, blog layout design, custom blog layout, modify blog design, blog,  posts in page, blog in page, grid blog template, list blog template, masonry blog template, slider blog template, carousel blog template, post ticker, blog widgets
Requires at least: 3.2
Tested up to: 5.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Show Posts and Blogs on your website usign Grid view, Slider view,  Filter view,  List view, Carousel Slider view and  Ticker view  with many designs and layouts.

== Description ==

Post and Blog Designer show WordPress posts with multiple layout with many designs. for post, blogs, and news via shortcodes or page builder elements and gutenberg blocks.

= WP Post and Blog Designer work with : =

* Grid  view.
* Slider view.
* Carousel slider view.
* Post filter views. 
* Post list(row) view.
* Masonry view.
* Cell-Box view.
* Ticker sliders view.
* Ticker widget for sidebar.
* Vertical slider for sidebar using Widget.
* Horizontal slider for sidebar using Widget.
* Grid for sidebar using Widget.

= WP Post and Blog Designer working with this all shortcode  =

* <code>[wpbd_grid]</code>     : Show post with grid view.
* <code>[wpbd_slider]</code>   : Show latest post with slider view.
* <code>[wpbd_filter]</code>   : Show Post with Filter view.
* <code>[wpbd_row]</code>      : Show post with list(row) view.
* <code>[wpbd_masonry]</code>  : Show post with masonry layouts.
* <code>[wpbd_carousel]</code> : Show recent post with carousel slider view.
* <code>[wpbd_cell_box]</code> : show post in grid box layout.
* <code>[wpbd_ticker]</code>   : show post in ticker slider.
* show your latest Posts & Blogs using widget in sidbar for all WordPress theme. 

= Features of This Plugin  =
* 5 Predefined Posts and Blogs design styles.
* No Need Coding Skills. 
* You can easily show/hide and customize every field using true and false value.
* Set your  Posts, Blogs within 2 minutes.
* Fully Responsive and Mobile friendly.
* Create with multiple category.
* Beautiful, minimalist & light-weight.
* Add unlimited posts.
* Unique settings for each layout.
* Touch, swipe or tap on iOS, Android or any other touch devices.
* Free Installation and Setup help.


= Common Shortcode Parameters for all layouts =

* **Set Post Limit:**
limit="5" ( ie show 5 posts then Post Pagination. To if show all posts use limit="-1", value: any numeric.).

* **Post by Category**
category="category_ID" ( ie show  posts by Group use with category id, Value: category ID only).

* **Design Template:**
template="template-1"(Select design template for post design. for all shortcode layout. value: template-1, template-2,template-3,template-4,template-5)

* **Post Author:**
post_author="false" (To display post author or not. Value: true or false)

* **Post Category name:**
post_category="false" (To  display post category name. value: true or false)

* **Post Date:**
post_date="false" ( To display post date Value: true or false)

* **Post Content:**
post_content="false" (To display post content Value: true or false)

* **Post Content Words Limit:**
post_words_limit="40" (Set post Content words limit for post. value: any numeric.)

* **Set Post Image Size:**
post_image_size="large" (Set post image size. Value: thumbnail, medium, large, full)

* **Read More:**
post_read_more="true" (To dispaly post read more button. Value: true or false)

* **Set Post Order:**
order="DESC" (for change post oerder ascending or descending Value: "DESC" and "ASC") 

* **Set Post Order by :**
orderby="post_date" (set post order by value: 'none',ID','author','title','name',rand',date') 

* **Post Tags:**
post_tags="true" (To display post tags. Value: true or false)

* **Post Comments:**
post_comments="true" (To dispaly post comments. Value: true or false)

= Others Shortcode Parameters for Grid only =

<code>[wpbd_grid]</code>

* **Post Grid :**
[wpbd_grid grid="2"] (Set post columns  value: 1, 2, 3, 4, 5, 6. )

* **Post Pagination :**
[wpbd_grid pagination="true"] (To dispaly post pagination. Value: true or false).


= Others Shortcode Parameters for row only =

<code>[wpbd_row]</code>

* **Post Pagination :**
[wpbd_row pagination="true"] (to display post pagination. Value: true or false).


= Parameters for Post Slider Shortcode only =

<code>[wpbd_slider]</code>

* **Post slider Arrows:**
[wpbd_slider arrows="false"] (To display slider arrow. value: true or false)

* **Pagination dots:**
[wpbd_slider dots="false"] (To display post slider bullet. value: true or false)

* **Autoplay:**
[wpbd_slider autoplay="true"] (To set slide sliding automaticaly value: true, false).

* **Interval beetween 2 slide:**
[wpbd_slider autoplay_interval="2000"] (To set slider interval between two slide in Millisecond).

* **Slide moving Speed:**
[wpbd_slider speed="1000"] (To set slider slide moving speed in Millisecond)

* **slider Loop:**
[wpbd_slider loop="true"] ( Move slider continue in Loop OR not Value: "true" OR "false").


= Parameters for Post Carousel slider Shortcode only =

<code>[wpbd_carousel]</code>

* **Number of Posts dispaly at a slider:**
[wpbd_carousel slide_post="3"]

* **Number of Posts move at time in slider:**
[wpbd_carousel slide_scroll="1"] 

* **Pagination dots:**
[wpbd_carousel dots="false"] (To display post slider bullet. value: true or false).

* **Pagination arrows:**
[wpbd_carousel arrows="false"] (To display post slider arrow. value: true or false).

* **Autoplay slider:**
[wpbd_carousel autoplay="true"] (To set slide sliding automaticaly value: true, false).

* **Interval beetween 2 slide:**
[wpbd_carousel autoplay_interval="2000"] (To set slider interval between two slide in Millisecond).

* **Slide Moving Speed:**
[wpbd_carousel speed="1000"] (To set slider slide moving speed in Millisecond).

* **slider Loop:**
[wpbd_carousel loop="true"] ( Move slider continue in Loop OR not Value: "true" OR "false").


= Others Shortcode Parameters Masonry Shortcode only =

<code>[wpbd_masonry]</code>

* **Post Grid :**
[wpbd_masonry grid="2"] (Set post grid ie 1 or 2 or 3 or 4 or 5 )

* **Post Pagination :**
[wpbd_masonry pagination="true"] (dispaly pagination or not. Value: true or false )

* **Load More Post Effect :**
[wpbd_masonry effect="effect-2"] (Set effect on click on  masonry load more button. Value: effect-1, effect-2 )

* **Load More Text :**
[wpbd_masonry load_more_text="Load More Post"] (set text as per your requirement for load more Posts button.)


= others Shortcode Parameters for Cell Box Shortcode only =

<code>[wpbd_cell_box]</code>

* **Post Pagination :**
[wpbd_cell_box pagination="true"] (To display post pagination. Value: true or false )


= Others Shortcode Parameters moving Ticker Shortcode =

<code>[wpbd_ticker]</code>

* **Ticker Title :**
[wpbd_ticker ticker_title="Wp Latest Posts "] (Set Ticker title as per your requrement. )

* **Ticker template Color :**
[wpbd_ticker template_color="#2096cd"] (Set Ticker template as per your requrement.)

* **Ticker Title Color :**
[wpbd_ticker title_color="#fff"] (Change Ticker heading font color.)

* **Ticker Font Style :**
[wpbd_ticker font_style="normal"]

* **Ticker moving direction :**
[wpbd_ticker ticker_direction = "slide-v"] (  set ticker moving direction vertical, horizontal slide-v or slide-h).

* **Ticker Move Automaticaly:**
[wpbd_ticker autoplay="true"] ( To set ticker sliding automaticaly value: "true" OR "false")

* **Ticker scroll Speed :**
[wpbd_ticker speed="2500"] (To set ticker moving speed in Millisecond).

Others shortcode parameter for scroll  ticker same as common shortcodes  'category', 'order' and 'orderby' etc.

= Others Shortcode Parameters For Filter Shortcode =
<code>[wpbd_filter]</code>

* **filter Category :**
[wpbd_filter cat_id="Category ID"] (set filter using category ID value: category ID).

* **filter filter text:**
[wpbd_filter all_filter_text="All Animals"] (change text of all category value="any name").

* **include child category:**
[wpbd_filter include_cat_child="Category ID"] (set filter with child category using category ID value: category ID).


* **Post image height:**
[wpbd_filter image_height="500px"] (set post image size value: like. 100px, 200px, 300px, 400px, 500px).

* **set Post image fit:**
[wpbd_filter image_fit="false"] (set post image size fit in grid value: true, false).

* **Post Content tail:**
[wpbd_filter content_tail=">>"] (set post content tail sign like: ... or >>> any symbols).

* **Post category limit:**
[wpbd_filter cat_limit="4"] (set post category limit, value: 2,5,6).

* **Post category order:**
[wpbd_filter cat_order="DESC"] (set category order with Ascending and Descending value: ASC, DESC).

* **set Post category orderby:**
[wpbd_filter cat_orderby="date"] (set post category  with orderby, value: term_id, slug, date).

* **Remove Specific category:**
[wpbd_filter exclude_cat="category ID"] (remove specific category usign category id. value: category ID).

Post and Blog Designer plugin provide free design for post and blog design with mobile responsive post and blog design tempalte for Wordpress Website and this plugin provide so many different layout so setup blog page on any WordPress website. we always change post and blog layout as per theme with using this plugin.

== How to Installation ==
1. Upload the 'wp-post-and-blog-designer' folder to the '/wp-content/plugins/' directory.
2. Activate the WP Post and Blog Designer plugin through the 'Plugins' menu in WordPress.
3. Add and manage post items on your site by clicking on the  'Post' tab that appears in your admin menu.


== Frequently Asked Questions ==

= how can find complete shortcode with parameters for this plugin? =

all shortcode parameters are available on this plugin "Details" tabs.

= how can ask for help for setup & install or inform for plugin issues? =

If you need any help, you can ask it at WP Post and Blog Designer WordPress plugin Support Forum page.

= Can I create post slider design for website sidebar? =

Yes, this plugin also work any WordPress website sidebar using widget for slider and grid.

= Can I create post slider design also with  post slider carousel design with the help of WP Post and Blog Designer? =

Yes, this plugin also work with post Slider and slider Carousel layout using shortcode with five design templates.

= this WP Post and Blog Designer plugin also work with post pagination? =

Yes, WP Post and Blog Designer plugin works with post numeric pagination. 

= WP Post and Blog Designer work with my theme? =

Yes, WP Post and Blog Designer will work with any WordPress themes, but may be require some design styling changes to make it compatible with any theme color combination. If issue with WP Post and Blog Designer plugin please contact us at WordPress Support Forum page.


== Screenshots ==
1. How to add Posts & Blogs.
2. List of All Posts.
3. How to use this Plugin.


== Changelog ==

= 1.0 =
* Initial release.


== Upgrade Notice ==

= 1.0 =
* Initial release.