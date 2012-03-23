// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins
// http://stackoverflow.com/questions/3822435/tinymce-pop-up-window-resizing
(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('gxtb_fb_lB_TinyMCE');
	
	tinymce.create('tinymce.plugins.gxtb_fb_lB_TinyMCE', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('mcegxtb_fb_lB_TinyMCE', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					width : 550 + ed.getLang('gxtb_fb_lB_TinyMCE.delta_width', 0),
					height : 400 + ed.getLang('gxtb_fb_lB_TinyMCE.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('gxtb_fb_lB_TinyMCE', {
				title : 'gxtb_fb_lB_TinyMCE.desc',
				cmd : 'mcegxtb_fb_lB_TinyMCE',
				image : url + '/gxtb_jump_page.gif'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('gxtb_fb_lB_TinyMCE', n.nodeName == 'IMG');
			});
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
					longname  : 'Like-Button-Plugin-For-Wordpress',
					author 	  : 'Stefan Natter',
					authorurl : 'http://www.gb-world.net',
					infourl   : 'http://www.gb-world.net',
					version   : "0.5"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('gxtb_fb_lB_TinyMCE', tinymce.plugins.gxtb_fb_lB_TinyMCE);
})();