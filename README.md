# Paperplane photography theme
![Paperplane photography theme](https://www.paperplanefactory.com/ppuploads/repository-open-graph-template.jpg)

## A WordPress theme for photographers.
This theme needs [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/ "Advanced Custom Fields Pro") installed but can be adapted to manage options in others ways.<br/>
If you want to use Advanced Custom Fields Pro you can use "acf-export-fields.json" file to import all required fields.<br/>
### :v: The main objectives of this theme are:
* display images on all devices without being cropped;
* allow photographers maximum editorial control;
* web performance;
* indexing also on a site based mainly on images;

### :sunglasses: Features:
* dark or clear mode navigation;
* toggle all unnecessary navigation information when viewing a photo;
* sell single picture trough PayPal;
* homepage layout adjustable to show one single random picture or a list of works;
* gallery navigation is managed using the native system that WordPress uses to manage the attachments to a post;
* gallery navigation works with keyboard arrows and on mobile devices with swipe gestures;
* every image has its own URL and a set of microdata based on [schema.org ImageObject](https://schema.org/ImageObject "schema.org ImageObject")

### :exclamation: How to set it up:
* create a page and set "Home" as template;
* configure requested options;
* in WordPress "Settings > Reading" options set it as home page;
* go to "Theme settings" to set links you want to appear in footer. "Theme version" option can be useful for forcing cache clearing;
* go to "Site settings" and set both "Typographic" and "Image gallery" options;
* two menus are available: one for header and another for navigation reachable trough hamburger menu. Be sure not to add to many links in header menu because it's designed to be compact;

### :exclamation: How to set up a gallery:
Galleries use WordPress posts. To create a gallery:
* create a new post;
* upload to the post all images you want to add to the gallery;
* eventually re-order images using WordPress media panel;
* publish post;

Don't insert pictures in content, use "the_content" to describe your project instead: navigation trough images is generated automatically.

### :star: Useful plugin to install
Improve loading times with [WP Fastest Cache](https://it.wordpress.org/plugins/wp-fastest-cache/ "WP Fastest Cache").<br/>
CSS rules perfectly define appearence of forms created with [Contact Form 7](https://it.wordpress.org/plugins/contact-form-7/ "Contact Form 7")

### :sparkling_heart: Cool stuff used in this theme
* [Swup](https://swup.js.org/ "Swup");
* [LazyLoad](https://github.com/verlok/lazyload "LazyLoad");
* [Tocca.js](https://gianlucaguarini.com/Tocca.js/ "Tocca.js");
* [Infinite Scroll](https://infinite-scroll.com/ "Infinite Scroll");

### :smiling_imp: Why this plugin is not on [Theme Directory](https://wordpress.org/themes/ "Theme Directory")?
I'm lazy, so instead of creating a page to manage theme options in a traditional way, I preferred to use [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/resources/including-acf-within-a-plugin-or-theme/ "Advanced Custom Fields Pro").<br />
And I'm so lazy that I don't even want to sell this theme and then have to provide support.<br />
