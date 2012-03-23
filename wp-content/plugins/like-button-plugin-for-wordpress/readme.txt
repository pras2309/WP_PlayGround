=== Like-Button-Plugin-For-Wordpress ===
Contributors:  GBWorld, natterstefan
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SB94MEM9ATTBG
Tags: facebook, like button, open graph protocol, social plugins, fb, plugins, for wordpress, button, widget, sidebar widget, shortcode, like, generator, gb world, share, socialwidget, likebutton, fb, gbworld, natterstefan, natter stefan, meta tags, shortcode like, gbwiki, gb-world, dynamic, exclude, live support, recommend, wordpress, Facebook, featured image, featured post, dynamic, twitter, twitter button, page, plugin, post, wordpress like, recommendation, widgets, activity feed, fb, fblike, fb like, opengraph, analyse, iframe, xfbml, javasdk, send button, send, sendbutton, new, update, url linter, lint, tools, facebook url linter, template, template function, php, php function
Requires at least: 3.0
Tested up to: 3.2.x
Stable tag: trunk

This plugin adds a Like-Button wherever you want on your blog. Before or after the content as well as a sidebar-widget. And many more!

== Description ==

**Features**

*   Plugin is available in English and in German
*   the Button can be individualy created for every site or one button for the entire blog
*   you can exclude sites which won't get a like button
*   individual button position (before/after the content)
*   add all available OpenGraph Meta-Tags including video and audio tags
*   choose any language for your Like Button you want (any one that Facebook supports)
*   you can individually design your Like-Button with css (css-Class)
*   our Like-Button-Generator makes it even more easier for you to create a Like Button
*   Analyse your Blog: Analyse the activity of your visitors and their likes (Dashboard Widget and additional stuff)
*   Use iFrame or XFBML-Button including the Send-Button (with share and comment functionality)
*   Use the Send-Button (new feature) of Facebook right now! It is availble now!
*   use a shortcode to insert the like-Button wherever you want it to show up on your page
*   create a Like-Button Sidebar-Widget (also individual Like-Button for every Site/Post or one Like-Button for the entire site)
*   Facebook Recommendation and Activity Feed: it is also possible to add this Widgets beside the Like-Button Widget
*   Recommendations-Sidebar-Widget: you can also add a Recommendations-Widget to your Sidebar
*   [BugTracker](http://bugs.gb-world.net/) and live support on our [FanPage](http://www.facebook.com/GBWorldnet)
*   easily connect your Facebook-Account, Fanpage or Application with the Like-Button on your blog
*   Individual Description-Tag for every post/page of your blog
*   you can choose a individual (fb-)image for each post/page
*   you can set up to three images for every post/page including the featured image of each post/page
*   Exclude Pages with their ID or with a single click on the checkbox on every Post-/Page-Edit Site with the Editor-Widget
*   design your Like-Button individually from the Design Page with the CSS-Box
*   You can now add anything you want (Twitter Button, Images, Text) beside the generated Like Button
*   Admin-Bar Menu with many options you can set right from the frontend of your blog (WP 3.1+)
*   new and fully integrated Template-Function now available (WP 3.1+)
*   and many more (read more on our [GB-World Facebook-Page](http://www.facebook.com/GBWorldnet)or on our [Blog](http://www.gb-world.net/blog))


**Facebook-Like-Button**

This plugin adds a Like-Button after every post/page you choose (you can exclude Posts/Pages/..., These excluded sites will have no Like-Button). The Like-Button-Widget includes a little Like-Button-Generator to make it easier for you to get a Like-Button to your sidebar. It also adds a Shortcode for your like-Button. It is also possible to choose the XFBML or the iframe-Button. You could also choose the position of your like-button within the post/page.


**Shortcode**

It also adds a Shortcode `[like]` or `[like url=http://www.gb-world.net]` which inserts the code for your Facebook-Like-Button. You can create a like-Button with the FB-LB-Generator on the settings-page. After that it is possible to create some Open-Graph-Protocol-Meta-Tags which will be written in the <head>-section. Also the JavaSDK will be used for your Buttons. But only if you enter a valid Facebook-AppID into the AppID-Box.

Now you can put the shortcode `[like]` or with the url-attribute (`[like url=http://www.gb-world.net]`) where ever you want to insert the Facebook-Like-Button.


**Widget**

There is also a new Widget available. Go to the Widget-Page and add the Facebook-Like-Button-Generator to your sidebar. Enter all your information into the FB-LB-Generator - that's it.


**Bugs and Live Support**

If you find any bugs **please report** them at our BugTracker: | [BugTracker](http://bugs.gb-world.net) |


**Translation**

We need your help to translate our plugin into more different languages (currently only English and German is supported). Write a new topic in our forum if you would like to help us. Thx!
Internationalization Support: English, Deutsch


**[Become a Fan of GB-World](http://www.facebook.com/GBWorldnet)**
Become a Fan of GB-World and get all the latest development and social media news daily!


**Other Important Links**

| [GB-World-Post](http://www.gb-world.net/projects/like-button-plugin-for-wordpress) |
| [Become a Fan of GB-World.net](http://www.facebook.com/GBWorldnet) |
| [GB-Wiki](http://wiki.gb-world.net/wiki/GB-Wiki:Like-Button-Plugin-For-Wordpress) |
| [Tutorial](http://www.facebook.com/GBWorldnet?v=app_2392950137) |
| [Support](http://www.facebook.com/GBWorldnet) |

== Installation ==

Extract the zip file and just drop the contents in the `/wp-content/plugins/` directory of your WordPress installation and then activate the Plugin from Plugins page.

Make sure that your template has the `wp_footer();` in its footer.php-file and `wp_header();` in its header.php-file!

After that visit the General-Setting Page on the bottom of the Menu and activate the Like-Button via the first Checkbox. After that you have to generate the Button with the Generator below and define the Position-Settings on the Position-Setting-Tab. Then hit the save button and you're done! All the other pages include different and additional options! Additionally you have to visit the OpenGraph-page and set all the Administrative and Blog-Tags.

**Recommendation: it is better to use the XFBML-Version or even provide a valid App-ID if you still use the iFrame Version! Please enter a valid App-ID if you do not already have one! [Get an App-ID](http://developers.facebook.com/setup/)**

**Notice: Please BACKUP your database everytime BEFORE you update to a new version!**


**Step-by-Step Tutorial** 
[youtube http://www.youtube.com/watch?v=p8tyI57sUvI]

== Frequently Asked Questions ==

**Notice: Please BACKUP your database everytime BEFORE you update to a new version!**


**FAQ** 


**How-To install and setup the Plugin**

**1.** Download and Install the Plugin

**2.** Go to the General-Page and set all the required information and activate the Plugin with the first checkbox on this site. Now hit save and you're done!

**3.** You should now generate the Like Button with the Generator on the General-Page (take a look at the Facebook-Generator-FAQ below)

**4. Facebook-Generator-FAQ:**

*   The URL must look like this and containt `http://` -> http://www.gb-world.net - Otherwise the Button will not work properly.
*   Now choose your layout style, width, height, font, verb to display, color scheme and if faces should be shown.
*   Language: It is possible to choose a language for your button.
*   Dynamic Like-Button: Every page will have its own unique like-button if you activate this checkbox. Otherwise every page will use the same facebook-like-button.

**5.** After that visit the OpenGraph-Site and fill in all the Administrative and Blog-Tags correct


**Information about XFBML (Java-SDK) and iFrame**

*   The basic Like button is available via a simple iframe you can drop into your page easily. A fuller-featured Like button is available via the &lt;fb:like&gt; XFBML tag and requires you use the new JavaScript SDK. The XFBML version allows users to add a comment to their like as it is posted back to Facebook. The XFBML version also dynamically sizes its height; for example, if there are no profile pictures to display, the plugin will only be tall enough for the button itself. (definition by Facebook)


**[like]-Shortcode**

*   You only have to insert `[like]` into a post/article and your like-Button (generated with all your defined settings) will appear at this position
*   available Options: `url`, `action`, `width`, `height`, `style`
*   Example: `[like]` or `[like url=http://www.gb-world.net action=recommend width=100 height=150 style=border:solid;float:right;padding-left:15px;]`


**Template Function `GBLikeButtonTemplate`**

*   You only have to insert `<?php GBLikeButtonTemplate(); ?>` somewhere in your template-files and your like-Button (generated with all your defined settings) will appear at this position
*   available Options: `url`, `action`, `width`, `height`, `style`
*   You have to set the values with an array like this: `array('url' => "http://www.gb-world.net")`. It does not work if you send the parameter like this to the function `GBLikeButtonTemplate("http://www.gb-world.net")`
*   Example: `GBLikeButtonTemplate();` or `GBLikeButtonTemplate(array( 'url' => "http://www.gb-world.net", 'action' => 'recommend', 'width' => 250, 'height' => 200, 'style' => array('border' => 'solid', 'overflow' => 'hidden')));` 


**Facebook-Like-Button-Widget, Facebook Recommendations and Facebook Activity Feed**

*   Go to the Widgets-Page on the left. Add the needed Widget and add the required information.
*   The URL must look like this and containt `http://` -> http://www.gb-world.net - Otherwise the Button will not work properly.


**W3c-Validation**

*   If you want to validate your site and the Validator says that the `og-` and `fb-tags` are not valid you can activate the W3c-Validated Output Checkbox on the Expert Side to generated an W3c-Valided Output of the Meta-Tags


**How to use the og:image-Tag properly**
[youtube http://www.youtube.com/watch?v=gsxA0Hai6kU]


= Important Notes =  


You have to enter a valid App-ID and additionally the Admin-ID and Page-ID to provide valid tags and fulfill the requirements of the Like-Button!

**App-ID:** You have to enter a valid Facebook-App-ID. [Get an App-ID](http://developers.facebook.com/setup/)
**Admin-ID:** Facebook-Profile-IDs of all Administrators of this Like-Button.

We recommend to enter a App-ID instead of the Admin-ID to keep your personal profile secure and secret.


**Open-Graph-Protocol:**

It is recommended to add the following

`xmlns:og="http://ogp.me/ns#"
xmlns:fb="http://www.facebook.com/2008/fbml"`


to the html-tag of your template-header.php-file. If you do not do this the Open-Graph-Protocol will not work with all its functions.


= Problems with DISQUS and Like-Button-Plugin-For-Wordpress (Bugfix) =


If you can't access your tabs on the Settings Page and you use the Disqus-Plugin beside this Plugin than you have to do the following to solve the bug:

*   1) Open the discus.php-file on your server in the Disqus-Plugin Directory

*   2) find this function `function sdq_menu_admin_head()` and add the following line after `<?php }` --> `if ( ( isset($_GET['page']) && strstr($_GET['page'],"disqus") )) { add_action('admin_head', 'sdq_menu_admin_head'); }`

*   3) now you should be able to access the tabs again!


= Extended FAQ =

| [Video-Tutorials](http://www.facebook.com/GBWorldnet?v=app_2392950137) |
| [Support](http://www.facebook.com/GBWorldnet) |
| [GB-Wiki](http://wiki.gb-world.net/wiki/GB-Wiki:Like-Button-Plugin-For-Wordpress) |

== Screenshots ==

1. FB-Like Button Option-Page with a lot of options
2. You have to enter this two attributes to the -tag in your "Template-header.php"-file.
3. The Facebook-Like-Button-Generator with a live iFrame Preview
4. You can easily define all the Open-Graph-Meta-Tags. It is as easy as it could be.
5. The new Admin-Bar menu enables a lot of Quick Links on the Frontpage while you are logged in (WP 3.1+)
6. There are a lots of helpful tools to fix bugs but also reset all the Settings
7. It is now also possible to use a Template-Function for the LikeButton - easily choose where you want to have the Like Button
8. There are many Options you can individually choose for each post/page while you are creating/editing them
9. Via the TinyMCE-Button you can insert an individual Like-Button wherever you want it on this page/post
10. Plugin-Information (with jQuery - also some other tips are displayed like that)


== Changelog ==

= Version 4.5.2 =

+ Major Bugfix: Google-Crawling Bug was totally fixed!


= Version 4.5.1 =

+ **I am verry sorry for any inconvenience you got from the latest update(s). I am working on a fix and this bugfix patches the Google Problem. I am sorry though for any problems. ./Stefan**


= Version 4.5 =

+ **IMPORTANT: PLEASE BACKUP YOUR DATABASE FIRST BEFORE YOU UPDATE -> there is no way to downgrade this Plugin after the Update so please backup your data!**
+ How-To-Downgrade: if something went wrong you can restore your Database (if you made a backup before the update) and restore the plugin (4.4.4.3.2 is still available in the Repo)
+ Important: min. Wordpress-Installation is now [v3.x]
+ Important: it is now required to provide a valid [App-ID](http://developers.facebook.com/setup/)
+ New: Quick Installation Page to make it even easier and faster to use/install the Like-Button
+ New: Feed-Links open now in a Fancybox so you can stay on the Plugin-Site while reading some help files
+ New-Design: new Backend-Design for all Like-Pages
+ New-Design: optimized for Smartphones and smaller Screens
+ New: You can now also add other Buttons more easily (visit the Expert-Mode Site) like +1, Tweet Button, Digg, StumbleUpon and more
+ New: Incompatible Plugin and Bug-List Sidebar-Box @the Backend (live Update)
+ New: Social Button Analysis now available for all your posts/pages (visit the All Post/Page Pages for more information) [Wp 3.0+]
+ New-Security: Role and Capability implemented to choose the required level to access the backend pages - default: administrator [WP 3.0+]
+ New: it is now possible to deactivate the Message-Output after an installation/update/... of the Plugin (Settings-Page)
+ New-Widget: it is now also possible to choose the language for the Like-Button Widget
+ New-Priority-Setting: you can now set the Priority of the Like-Button-Plugin-For-Wordpress Output relative to other plugins you use (Settings-Page)
+ New-GBCleaner: totally rewritten GBCleaner and GBWidgetCleaner to prevent bugs and update all Plugin-Options
+ New-Message: Infomessage after you update the Plugin right on the 'Installed Plugins'-Site
+ New-Preview: it is now also possible to see a XFBML-Preview (General-Page)
+ New: Google Analytics Social Tracking is now implemented too (currently it is always enabled)
+ New-Development: Important Functions now log errors and success messages in the debug.log-file (if WP_DEBUG = true)
+ New Shortcode&Template: layout, div, xfbml, besidebutton, class Options
+ New-FAQ&Tutorial: you can now access a Guider if you enter the GET-Variable: '?fbguide=true' or hit on the black ?-Button
+ Language: Updated Translation
+ Request: it is now possible to choose if the 'Featured Image' is activated all the time (works only for newer posts after this update)
+ Request: it is now possible to add a Side-Specific Button beside the Post-Specific (visit the Expert-Mode-Site)
+ Request: you can now add a 'Custom Channel URL' - [More Information](https://developers.facebook.com/docs/reference/javascript/FB.init/)
+ Request (Meta): Image-Order is now fixed and fully established: featured, specific, default image --> according to your settings
+ Design: Complete new Backend-Design
+ Design: small menu-changes (title, order,...), better tabs-menu and other some smaller changes
+ Design: new GB-World Page Design and new Plugin-Info-Box Design
+ Design: new 'Jump to the top' Button
+ Design/Performance: 'Loading'-Images added
+ FAQ: complete FAQ overhauled
+ FAQ: YouTube-Videos instead of the Facebook Videos implemented
+ Dashboard: StumbleUpon Widget added, Recommendation Feed removed and some other changes
+ Performance: optimized for Wordpress 3.2
+ Performance: Backend loads faster and used the WP jQuery-files instead of the files provided by Google [WP 3.2+ recommended]
+ Performance: Twitter-like Notification on several BackEnd-Pages for several actions
+ Performance: better and faster loading of the several Like-Buttons because of an optimized JDK-Library Output on the Frontend
+ Security-Update: check if current user can save something (QuickEdit, Post/Page Widget and Admin-Menu)
+ Bugfix: Default-Value for the position of the Button added to prevent the 'Hidden Content'-Bug (default value: after-content)
+ Bugfix: the Footer-File (Backend) was loaded twice
+ Bugfix: the meta-tags now strip all html-tags of the meta-tag content
+ Bugfix: BugTracker Feed was not visible and working anymore
+ Bugfix: OpenGraph-Image preview is now implemented complete and without any jQuery errors
+ Bugfix: new Image-Tag Outputorder (Default - Specific - Featured)
+ Bugfix: it is now also possible to add/use pictures with https://
+ Bugfix: hidden content when position of the Like Button was not set
+ Bugfix: some new jQuery code implemented to provide a stable backend
+ Bugfix: Excerpt, Title and Site-Name now do not longer show tags (strip_tags)
+ Bugfix: additional Code beside the Like Button was not inside the div-tags
+ Bugfix: Template-Function now supports the Style-Attribute correct
+ Bugfix: no bugs anymore if a option is not set and you hit the Save-Button (foreach error fixed)
+ Bugfix: br-Output before and after the LikeButton was missing sometimes
+ Bugfix: Many PHP-Bugfixes in the Backend
+ Coding: updating class-snoopy.php to http.php
+ Coding: <br /> changed to <br>
+ Obsolete: jQuery script inside the plugin directory out of use
+ Obsolete: currently the Supporter-Section (Sidebar) is not available anymore
+ Obsolete: Shortcode-Only Mode is now available via the Settings-Page and not via the General-Page
+ Important: No support anymore for Plugins below [v4.5] though to the amount of changes since this version


= Version 4.4.4.3.2 =

+ Patchversion: patched Generate-File and new Output of the (XFBML) Like Button (based on [IDEEcon](http://www.ideecon.com/social-media/facebook-like-button-ohne-plugin-in-validem-html-in-wordpress-integrieren/))
+ **Notice: Please add an App-ID (OpenGraph-Page) to prevent Bugs with the Like Button: [Get an App-ID](http://developers.facebook.com/setup/)**


= Version 4.4.4.3.1 =

+ Short Update to fix the Problem that causes no Like-Counts when you hit the Button
+ Important: it is now a must have to enter a valid App-ID! Please enter a valid App-ID if you do not already have one!
+ Problems with the Wordpress-Repo: This was causing the Updates from [v4.4.4.1] to [v4.4.4.3]
+ Patchversion [v4.4.4.3.1]: it patches the Generate-File which includes a performance increase and other smaller patches


= Version 4.4.4 =

+ New: Admin-Bar Menu with many options you can set right from the frontend of your blog (WP 3.1+)
+ New: new and fully integrated Template-Function now available (WP 3.1+)
+ New: The Widget on the Edit-Pages can disable/enable the Template-Button if you like/need it (Pages, Posts)
+ New: TinyMCE Button now fully supports all the required Shortcode Options and live Preview
+ New: W3C-Validaded Code - it is now possible to choose if you want to optimize the Output to valided your page correctly (Expert-Mode Site)
+ New: Optimized and even more settings for the type and default image tag
+ Warning-System: New Warning if you enter a non-supported image-URL
+ OpenGraph: The image-tags are only visible in the source code if you enter a supported image-file (png, jpg, jpeg, gif)
+ Help: Due to many problems with the image tag I expand the Info-Text to answer FAQs right above the Inputbox
+ Update: new Screenshots added with a new description
+ Update: totally rewritten FAQ-Section for the Plugin-Page on Wordpress.org
+ Coding (Beta): to prevent and test a new way of adding the Like Button to the Content I changed AddAction to ApplyFilter ([More Information](http://tinyurl.com/FilterInsteadOfAction))
+ BugFix: Title-Meta-Tag was not visible on other pages like archive and category
+ BugFix: The Image-Tag was sometimes not working on other pages than post/page.
+ BugFix: if the Default image was not set no image appeared at all
+ BugFix: Option send now fully integrated and should be added automatically (Check Expert-Mode)
+ BugFix: sometimes the Post-Specific Options disapeared after you edit something and save the post/page again
+ BugReports-Fix: 0000065, 0000054, 0000062, 0000068, 0000067, 0000053
+ Disabled: Send-Function now deactivated for the iFrame Version because Facebook does not support send for the iFrame Button
+ Information: Currently it seems that Facebook has several problems with the XFBML-Button. Sometimes it does not appear even if it works in the past! Please be patient until Facebook fixes this! Thanks.


= Version 4.4.3.6 =

+ New: Implement the new Send Button if you using the XFBML Like Button (iFrame also but Facebook recommends the XFBML-Button)
+ New: Facebook URL Linter Link on every Edit-Page (post and page)
+ Bugfix: the iFrame Version does now also support the language you choose
+ OpenGraph: displays now the WP-Title of the current Category/Archive for the title-tag (more dynamic soon)
+ JavaScript: Generator-File Update
+ Coding: the new default value of height/width is 100/250px


= Version 4.4.3.5 =

+ New: Due to a request I added the function to deactivate the default image if you like (Edit-Pages)
+ Bugfix: Featured Image Support now only with WP 2.9+ and if your template supports thumbnails
+ Bugfix: new Query to check if the current theme supports thumbnails


= Version 4.4.3.4 =

+ Bugfix: the new OpenGraph Option was accidently shown in the sourcecode
+ Bugfix: Post-Title-Value was taken on Category and Archive Pages -> currently you can not set which value this two sites have but it will be available soon
+ Bugfix: Meta-Tags were sometimes disabled
+ Bugfix: The featured image option is not set true by default anymore
+ Bugfix: Some Post-Specific Options (on the Edit-Pages) were not changeable


= Version 4.4.3.2 =

+ Bugfix: OpenGraph was not activated by default after the update


= Version 4.4.3.1 =

+ New: Featured Image Option - Notice: all posts/pages before this update have the featured image option deactivated to prevent bugs or incompability
+ New: You can now deactivate the Meta-Tags for posts/pages if you want to on the Edit-Pages.
+ Notice: featured image is set by default if you add a new post/page
+ New: You can choose up to 3 images including the default one of the blog and the featured and specific image of each post/page.
+ New: It is now possible to deactivate the Meta-Output of the Plugin
+ New: You can now add something (code, other button, links, images and more) beside the Button (left or right) (WP3.+ required)
+ New: You can now also add the Activity-Feed-Box to your Sidebar (new Widget)
+ Bugfix: some people below WP3.0 had problems with some new functions
+ Bugfix: Tooltips did not work on several pages ( including the edit pages of pages/posts)
+ Coding: page=fb-like-beta page is now available at page=fb-like-expert
+ Widget-Fix: it was not possible to choose 'Recommend' it is now fixed
+ Widget-Design: more space for the ref-attribute
+ Widget-Menu-Design: new Widget-Backend CSS based Design to show the identity of the Plugin
+ Dasboard-Design: Fixed the unwanted overflow depending on the Screensize of your monitor/smartphone
+ GB-World-Page: Feed-URL Update (because we switched to FeedBurner: http://feeds.feedburner.com/GBWorldnet)
+ Message-Update: Updated Message Output after you update to this version


= Version 4.4.3 =

+ Design: We optimized the OpenGraph Page to keep it more simple
+ Bugfix: We optimized the Save-Process
+ New: We added a from  new option which lets you deactivate the description tag
+ FAQ: new video added from our Facebook Fanpage to the FAQ Page


= Version 4.4.2 =

+ jQuery: The conflict with Disqus is now fixed
+ GBCleaner: we updated and improve its functionality
+ Bugfix: The output of the Like Button was not correct (before or after the content)
+ Bugfix: We updated the Warning-System because the messages won't hide when everything is ok. But you still have to refresh to update the Messages
+ New: on the 'Expert-Mode' page you can now take a look at all your settings. They are listed in a textarea to help finding bugs
+ New: 'Reset Options' Tool on the 'Settings' Page


= Version 4.4 =

+ New: We implemented the GB-Warning-System again after it was disabled since [v4.2]. It is now better, cleaner and even more detailed/helpful
+ New: Completly new Message-System to keep you up-to-date and help you to install/update the Plugin without any problems
+ Design: new 'Settings-Saved' Message Design
+ Design: new Admin-Menu Icon (Facebook Logo)
+ Design: Some Info-Text was changed and deleted or added
+ Design: PayPal-Box was modified and updated
+ Language: fully updated German-Language-File
+ Help: After we noticed that a lof of people did not set the height of the Button and were suprised because of the blank space we added a Infomessage to remember everybody to set a height value
+ BugFix: Error-Fix while activating the Plugin (was only visible if you Debug the Blog)
+ Coding: new standards were established to improve the loading speed of the Admin-Pages
+ Coding: changed some variables and backend access coding
+ Coding: many functions/files were completly rewritten to improve the performance and the new plugin-structure
+ jQuery: update to the latest jQuery 1.5 version
+ GB-World: GB-World Page Update (Design and Coding)
+ GB-world-Newsbox: Updated the Links and the Feedreader


= Version 4.3.2 =

+ New: Adding an Update-Message to help you after an Update
+ Feed-Update: new URL for the Wordpress-News-Feed
+ Bugfix: Problem when Updating the Plugin was now solved
+ Coding: some problems and mistakes were fixed
+ Coding: If you deactive the Like-Button the Meta-Tags will not be generated anymore for your blog
+ GB-World-Page: Update of the Links and some other settings/code parts
+ FAQ-Page: We added the Tutorial-Videos and also the GB-Wiki and BugTracker-Page
+ Security: required lvl to change any settings is now set as administrator (User-Request)
+ Design: New order of the General Options. Because some user did not find the 'Dynamic Button' Setting
+ Design: Different Position for the Submit-Button
+ OpenGraph-Feature: you are now able to set a type-tag for each type of site (frontpage, post, page) by yourself
+ OpenGraph-update: You have to update your header.php-file according to the description on the AdminPage: xmlns:og="http://ogp.me/ns#"
+ Future-Feature: you'll be able to set many new Pluginsettings soon - But you can already see some of them.
+ others: We updated the text of the readme-file


= Version 4.3.1 =

+ Coding: There was an Error when you tried to save an option - fixed!
+ Coding: Some other Changes with the Plugin-Options -> Tip: Run the GB-Cleaner after the update!


= Version 4.3 =

+ Design: Complete Redesign of the Plugin
+ Coding: Performance-Update
+ Coding: jQuery-Problem is now solved (nonConflict)
+ and some other smaller BugFixes/Updates/Changes


= Version 4.2.5.1 =

+ BugFix: one function was not up-to-date and it causes some error with the output if you activate (before/after the footer)


= Version 4.2.5 =

+ Feature: you can now hide the Like-Button on every page/post you want more easily. Just check the new Checkbox when you create a new post or page.
+ Feature: you can now easily add some css-style within the new css-box (only available with the jquery-based-Design)
+ Coding: change the default height-value to 250px if it is not set
+ BugFix: the og-type-tag is now working again
+ Fix: fixed some spelling and text mistakes
+ Widget: a new Widget is available: Recommendations. You can now add a Recommendation-Box to your Sidebar with the new Widget
+ Design: little bugfix on the Settings-Page
+ Future: we will change the design and structure of the Settings-Page with the next update (no tabs, no jQuery)
+ FAQ: new explanation for the URL-Setting at the Like-Button-Generator-Section
+ BugFix: the excerpt was not shown correctly (thx to Nicole Simon)
+ Coding: add a link to the header.php-File


= Version 4.2.4 =

+ Feature: it is now possible to add a different fb-image for every post/page of your site
+ BugFix: the problem with the 'undefined ajaxurl' is now resolved (finally)
+ BugFix (Meta-Tags): the 'url'-Tag was not listed on every page - now fixed
+ Added: now also a category-page has its own description-tag. This tag will use the description of the shown category you defined in the admin-menu.
+ Shortcode: The Shortcode can now also have attributes (url) which lets you easily choose which url will be "liked" with a Shortcode-Button
+ Post/Page-Editor: you can now easily add the Shortcode with a new TinyMCE-Button


= Version 4.2.3 =

+ Coding: the Like-Button won't appear on 404-Pages any more
+ FAQ: Adding the Information that you can also like Facebook Pages and Applications
+ Dashboard: Updating the Dashboard-Widget
+ Facebook Like Button Update: box_count is now also available
+ Bugfix Open-Graph: og:type should be article on posts. everything except posts will have your choosen type. posts will allways have 'article' as og:type-tag value
+ Bugfix Open-Graph: og:image -> problem should no be solved!
+ Coding: Performance-Update at the Meta-Output
+ Widget: Adding a Facebook-Recommendation-Widget
+ Widget-Coding: Updating the code and the Description at the Widget-Page


= Version 4.2.2 =

+ GB: some small fixes


= Version 4.2.1 =

+ Plugin: We used the plugin 'Changelogger' as a plugin in our plugin.
+ Info: Adding some more information for the AppID-Tag
+ Bugfix: page_id-MetaTag
+ new Feature: now there is also a new dashboard-widget with your blog-recommendations available (Dahsboard)
+ Codefix: adding the 'height'-Option at the end of the src-attribute of the iFrame-Version (all Like-Buttons)
+ Codefix: adding the 'height'-Option at the end of the src-attribute of the iFrame-Version (Sidebar-Widget)
+ Code: some code-update on the Meta-Section (jQuery-based Design)
+ FAQ: Update the FAQ with the "Meta-Tag App-ID"-Description
+ Feature: now the Description-Meta-Tag is more individual for every post/page
+ Bug-Fix: undefined ajaxurl (on the Option-Page as well as on the GB-World-Page
+ Bug-Fix: XFBML-Modification was not showing up correctly
+ Feature: now you can use the Shortcode-Only if you just need the Like-Button sometimes
+ Bug-Fix: the old design had some problems if you deactivate the jQuery-Design - is now fixed. But please reload the page if you de/activate jQuery
+ GB: Introducing Google-Analytics
+ Design: some small css-fixes and changes


= Version 4.2 =

+ you can now deactivate or activate the FavIcon on the Option-Page
+ active textboxes have no a different background
+ now you can press Enter to save the Settings
+ coding-Updates
+ js-files Update
+ js and css-files are now compressed to reduce space
+ you can now activate or deacitvate the jQuery-based Option-Page (will be activated as default at v4.5)
+ introducing the jQuery-Fancybox, Image-Preview and Image-Thumbnails Plugin
+ Official Function-Request: currently you have to exclude all private-pages by your own but we will solve it as soon as possible
+ GB-Warning-System: you can now deactivate the warnings of our Warning-System if you do not like/need them
+ some functions are now disabled if you are offline (not connected to the internet)
+ now we can also launch some votings within the option-page
+ launching the share-button for the plugin
+ little GB-NewsboxUpdate (v3.2)
+ Update GB-Warning-System [v1.2]
+ Bugfixes: GB-Warning-System
+ some new Screenshots
+ language-files update to the latest version


= Version 4.1.3 =

+ default height if the option is unset
+ GB-Warning-System Update v1.0.6
+ little Performence-Update


= Version 4.1.2 =

+ some options were not correctly displayed (only wrong display but they saved the option correctly).
+ css-class infotext is now more detailed


= Version 4.1.1 =

+ some small bugfixes. sorry for any issues caused by that bugs.


= Version 4.1 =

+ new design
+ introducing the css-function - Sidebar-Widget and Like-Button
+ some text changes and some options are now in the FB-Button-Settings-Box
+ BugTracker-Link was broken -> fixed
+ now you can choose how many <br>s you wanna have before or after the Like Button
+ adding the 'page_id' meta tag
+ GB-Warning-System-Update [v1.0.5]


= Version 4.0 =

+ WP3.0 Compatibility
+ Infopage-Update
 * GB-World-Plugin-List Update: new algorithm to find the installed gb-world-plugins
 * Performance Update
 * CSS-Update
 * GB-Newsbox-Update 3.1
+ Security Update
+ Traffic-Reduction
+ Settingspage
 * Update some text and information
 * Metatags-update
  ** Infotext about the image-meta
 * the Like-Button-Position can now be before, after or before and after the content
 * the Like-Button can now also be displayed at the archive-page of your theme (sometimes it depends on the theme if it works - please report any errors and the name of the theme were the error occurs)
+ More Stability
+ Introducing our new BugTracker-System
 * Introduction of the BugTracker-Link
 * Show the latest Bug-Reports of the Plugin on the Option-Page
+ Introducing the REF-Option
 * Introducing the FB-Analytics-Box
+ introducing a Warning-System [v1.0]
 * currently only for the Option-Page and not for the Widget
+ introducing the new GB-World-Ad-System [v1.0]
 * now you can advertise on our plugin-option-page (see more on the Option-Page in your Wordpress-Backend-Menu
+ introducing a new GB-Cleaner
 * this new tool cleanes senseless options of older versions of this plugin
+ Updating the Sidebar-Widget
 * Add the Ref-Option
 * Meta-Tags are now also available if you only use the Sidebar-Widget
+ Introducing a Facebook-Like-Box of GB-World.net
+ fixing more than 100-200 coding lines
+ Update the FAQ
+ language file updated
+ better information about the <html>-Attributes you have to add if you use XFBML


= Version 3.1 =

*   We have added some new information to the FAQ on the Option-Page and much easier explanations for all of our plugin-users
*   Now 'Categories' can also display the Like-Button - and you can also exclude categories
*   We changed some text on the Option-Page
*   Update the Info-Page to v1.1: Bugfixes and it now dispalys all of the installed GB-World-Plugins
*   some Bugfixes and new functions for the Meta-Tags:
*   the Description-Meta-Tag is now dynamic (you can choose more options for this tag)
*   Meta-Tag-Image: Now a little preview is available for the Image you choose (until width=400px)
*   We also changed the Blog-Type-Meta-Tag into a combobox and added tooltips

= Version 3.0.1 =

*   Bugfix: GB-World-Info-Page [v1.0] had a bug -> now it is fixed

= Version 3.0 =

*   Updating the SideBar-Widget with new functions and bugfixes
*   New functions for the Like-Button were added
*   Bugfixes and a performance-update of the executing code
*   Tooltips for some difficult options which need some explanations
*   introducing the GB-World-Info-Page [v1.0]

= Version 2.5 =

*   Bugfix and update speed of the plugin
*   changed all the settings to our new domain: gb-world.net

= Version 2.0 =

*   Updating the GB-Newsbox to v2.5
*   fixed the bug for all IE-Users. They were not able to save any options

= Version 1.4.5 =

*   We introduced the php-function 'urlencode' to ensure that the url for the facebook-button is correct	
*   it is now possible to change the language of the fb-button by yourself (only if you use the Java-SDK)
*   We have expendet your Generator with new functions
*   It is now also possible to choose the position of the facebook-button within the content of your page/post (top/bottom)

= Version 1.4 =

*   We finally finished all the work for our 1.3.x-versions. We have tested this new code on a website of us and it works!


= Version 1.3.7.5 =

*   every Post/Page or even Frontpage will now have a individual Facebook-Like-Button. This is the principal function of a Like-Button. The Like-Buttons are generated automatically after you make one with our Generator.

= Version 1.3.7.3 =

*   we implemented the fb:like-tag into this plugin. We do not know if all works properly with this new code segment. we need some reports from you if there is a new bug or something else.
*   we know that some domains have a problem with the Java-SDK-Output of our plugin. We do not really know why. We are working on that problem.

= Version 1.3.6.2 =

*   important bugfix: enabling all functions of the open-graph-protocol and fixing a mistake in the code
*   extending the FAQ

= Version  1.3.6 =

*   some new translations
*   some bugfixes in the background-code

= Version  1.3.5 =

*   fix some bugs.

= Version  1.3 =

*   relase this version to the official WP-Plugin-Repo.


== Help US ==

Help us translating the Plugin into other languages. Translate it into your language and send us your language-files. Thanks a lot. You'll also get a link on our plugin-page.

== Please support me and my work ==

I would appreciate it if you would support my work with a little Donation. Thanks a lot to all my Supporters. | [Donation/Spende](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SB94MEM9ATTBG) |

== Rate my Plugin please ==

If you like my plugin the rate it please --> (on the right side). Thanks a lot! :)

== BUGS ==

If you find any bugs **please report** them at our BUGTRACKER-SYSTEM: | [BugTracker](http://bugs.gb-world.net) |

== Wiki ==

check our new wiki for further information: | [GB-Wiki](http:/wiki.gb-world.net/wiki/GB-Wiki:Like-Button-Plugin-For-Wordpress) |

== FANPAGE ==

Become a fan of us now on our | [GB-World.net Facebook Page](http://www.facebook.com/GBWorldnet) |

== We use ==

[Changelogger-Plugin](http://wordpress.org/extend/plugins/changelogger/) for our plugin because it is a very impressive plugin which reads and displays the changelog of various plugins (in this case only of our plugin). Note: This is NOT our work. This Plugin is only included to display our changelogs. Official Author: Oliver Schl&ouml;be