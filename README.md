# Paperplane photography theme
![Paperplane photography theme](https://www.paperplanefactory.com/ppuploads/static/github/repository-open-graph-template.jpg)

## A WordPress theme for photographers
This theme is designed to enhance pictures. UX and UI elements are designed to have the least possible impact on the observation of images. You can see it in action on [Allegra Martin website](https://www.allegramartin.it/ "Allegra Martin website").


Paperplane photography theme requires [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/ "Advanced Custom Fields Pro") to be installed.<br/>
Required set of fields is already included through functions.php.<br/>
### :v: The main objectives of this theme are:
* display images on all devices without cropping;
* give photographers maximum editorial control;
* web performance;
* SEO friendly also if site is based mainly on images;

### :sunglasses: Features:
* dark or clear mode navigation;
* toggle all unnecessary navigation information when viewing a photo;
* sell single picture trough PayPal;
* homepage layout adjustable to show one single random picture or a list of works;
* gallery navigation is managed using the native system that WordPress uses to manage the attachments to a post;
* gallery navigation works with keyboard arrows and on mobile devices with swipe gestures;
* every image has its own URL and a set of microdata based on [schema.org ImageObject](https://schema.org/ImageObject "schema.org ImageObject");
* set custom logo for home button or just leave site title as text link;
* optional custom post types for news and books;
* don't ask me why but I made this theme compatible with Microsoft Internet Exporer :hankey:

### :exclamation: How to set up theme:
* :hankey: before activating this theme check if Advanced Custom Fields Pro is installed and active!
* best option: install theme using [GitHub Updater](https://github.com/afragen/github-updater "GitHub Updater") in order to see available updates in the future;
* create a page and set "Home" as template;
* configure requested options;
* in WordPress "Settings > Reading" options set it as home page;
* go to "Theme settings" to set links you want to appear in footer. "Theme version" option can be useful for forcing cache clearing;
* go to "Site settings" and set both "Color & Typo options" and "Image gallery" options;
* two menus are available: one for header and another for navigation reachable trough hamburger menu. Be sure not to add to many links in header menu because it's designed to be compact;
* to activate clear/dark mode toggle just add a link to your menu with these settings:
  * URL: #
  * Navigation label: `<i class="icon-fas-fa-adjust"></i>`
  * Title attribute: Switch clear/dark mode
  * CSS Classes: `bright-switch`
  * Description: Turn website from light background color/dark texts to dark background color/light texts and vice versa.
* if you need a news section there's a "News" custom post type for it. To add a news listing page create a new page and assign "News" as template. News published within 90 days are automatically listed in homepage;
* if you need a books section there's a "Books" custom post type for it. To add a books listing page create a new page and assign "Books" as template;
* if you want to sell an image you must first configure the basic information for PayPal and then, from the editor of the single image in the media library, enable the sale and set the price;
* if you want to use custom favicons please refer to [Favicon & App Icon Generator](https://www.favicon-generator.org/ "Favicon & App Icon Generator"). Generate your set of favicons and replace them into "assets/images/favicons" folder;
* if you want to enable visitors to use galleries as slideshow with autoplay you can do so by setting to yes "Show play/pause button?" in Site settings > Image gallery options;

### :exclamation: How to set up a gallery:
Galleries use WordPress posts and post attachments. To create a gallery:
* create a new post;
* upload to the post all images you want to add to the gallery;
* eventually re-order images using WordPress media panel;
* publish post;
* you can also use posts to display videos. To do so, use the custom field "Video embed". Using a post to display a video will disable the gallery's navigation for that post (only one video per post);

Don't insert pictures in content, use "the_content" to describe your project instead: navigation trough images is generated automatically.

### :electric_plug: Useful plugins to install:
These plugins are suggested based on my experience and are therefore a simple tip.
* [WP Fastest Cache](https://it.wordpress.org/plugins/wp-fastest-cache/ "WP Fastest Cache") to improve loading time - avoid scripts combining option if you want to keep Microsoft Internet Explorer :hankey: compatibility;
* [Contact Form 7](https://it.wordpress.org/plugins/contact-form-7/ "Contact Form 7"): CSS rules perfectly define appearence of forms created with CF7. In CF7 editor just wrap your form into a DIV with class "form-hold";
* [WebP Express](https://wordpress.org/plugins/webp-express/ "WebP Express") is a must have plugin if your hosting provider supports WebP image conversion tools;
* [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/ "Yoast SEO") to boost SEO;

### :sparkling_heart: Cool stuff used in this theme:
* [Swup](https://swup.js.org/ "Swup");
* [LazyLoad](https://github.com/verlok/lazyload "LazyLoad");
* [Tocca.js](https://gianlucaguarini.com/Tocca.js/ "Tocca.js");
* [Infinite Scroll](https://infinite-scroll.com/ "Infinite Scroll");
* Icons from [Font Awesome](https://fontawesome.com/ "Font Awesome") free pack;

### :zap: Lighthouse report
Here's a [Lighthouse](https://developers.google.com/web/tools/lighthouse "Lighthouse") report. To do even better convert images into WebP format.
![Lighthouse report](https://www.paperplanefactory.com/ppuploads/static/github/lighthouse.png)

### :smiling_imp: Why this plugin is not on WordPress [Theme Directory](https://wordpress.org/themes/ "Theme Directory")?
I'm lazy, so instead of creating a page to manage theme's options in a traditional way, I preferred to use [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/resources/including-acf-within-a-plugin-or-theme/ "Advanced Custom Fields Pro").<br />
And yes, I'm so lazy that I don't even want to sell this theme and then have to provide support.<br />
