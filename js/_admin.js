/* global jQuery:false */
/* global STUDEON_STORAGE:false */

jQuery(document).ready(function() {
	"use strict";

	// Init Media manager variables
	STUDEON_STORAGE['media_id'] = '';
	STUDEON_STORAGE['media_frame'] = [];
	STUDEON_STORAGE['media_link'] = [];
	jQuery('.studeon_media_selector').on('click', function(e) {
		studeon_show_media_manager(this);
		e.preventDefault();
		return false;
	});
	
	// Hide empty override-options
	jQuery('.postbox > .inside').each(function() {
		if (jQuery(this).html().length < 5) jQuery(this).parent().hide();
	});

	// Hide admin notice
	jQuery('#studeon_admin_notice .studeon_hide_notice').on('click', function(e) {
		jQuery('#studeon_admin_notice').slideUp();
		jQuery.post( STUDEON_STORAGE['ajax_url'], {'action': 'studeon_hide_admin_notice'}, function(response){});
		e.preventDefault();
		return false;
	});
	
	// TGMPA Source selector is changed
	jQuery('.tgmpa_source_file').on('change', function(e) {
		var chk = jQuery(this).parents('tr').find('>th>input[type="checkbox"]');
		if (chk.length == 1) {
			if (jQuery(this).val() != '')
				chk.attr('checked', 'checked');
			else
				chk.removeAttr('checked');
		}
	});
		
	// Add icon selector after the menu item classes field
	jQuery('.edit-menu-item-classes').each(function() {
		var icon = studeon_get_icon_class(jQuery(this).val());
		jQuery(this).after('<span class="studeon_list_icons_selector'+(icon ? ' '+icon : '')+'" title="'+STUDEON_STORAGE['icon_selector_msg']+'"></span>');
	});
	jQuery('.studeon_list_icons_selector').on('click', function(e) {
		var selector = jQuery(this);
		var input_id = selector.prev().attr('id');
		if (input_id === undefined) {
			input_id = ('studeon_icon_field_'+Math.random()).replace(/\./g, '');
			selector.prev().attr('id', input_id)
		}
		var in_menu = selector.parents('.menu-item-settings').length > 0;
		var list = in_menu ? jQuery('.studeon_list_icons') : selector.next('.studeon_list_icons');
		if (list.length > 0) {
			list.find('span.studeon_list_active').removeClass('studeon_list_active');
			var icon = studeon_get_icon_class(selector.attr('class'));
			if (icon != '') list.find('span[class*="'+icon+'"]').addClass('studeon_list_active');
			var pos = in_menu ? selector.offset() : selector.position();
			list.data('input_id', input_id).css({'left': pos.left-(in_menu ? 0 : list.outerWidth()-selector.width()-1), 'top': pos.top+(in_menu ? 0 : selector.height()+4)}).fadeIn();
		}
		e.preventDefault();
		return false;
	});
	jQuery('.studeon_list_icons span').on('click', function(e) {
		var list = jQuery(this).parent().fadeOut();
		var icon = studeon_alltrim(jQuery(this).attr('class').replace(/studeon_list_active/, ''));
		var input = jQuery('#'+list.data('input_id'));
		input.val(studeon_chg_icon_class(input.val(), icon)).trigger('change');
		var selector = input.next();
		selector.attr('class', studeon_chg_icon_class(selector.attr('class'), icon));
		e.preventDefault();
		return false;
	});

	// Standard WP Color Picker
	if (jQuery('.studeon_color_selector').length > 0) {
		jQuery('.studeon_color_selector').wpColorPicker({
			// you can declare a default color here,
			// or in the data-default-color attribute on the input
	
			// a callback to fire whenever the color changes to a valid color
			change: function(e, ui){
				jQuery(e.target).val(ui.color).trigger('change');
			},
	
			// a callback to fire when the input is emptied or an invalid color
			clear: function(e) {
				jQuery(e.target).prev().trigger('change')
			}
		});
	}

	function studeon_chg_icon_class(classes, icon) {
		var chg = false;
		classes = studeon_alltrim(classes).split(' ');
		for (var i=0; i<classes.length; i++) {
			if (classes[i].indexOf('icon-') >= 0) {
				classes[i] = icon;
				chg = true;
				break;
			}
		}
		if (!chg) {
			if (classes.length == 1 && classes[0] == '')
				classes[0] = icon;
			else
				classes.push(icon);
		}
		return classes.join(' ');
	}

	function studeon_get_icon_class(classes) {
		var classes = studeon_alltrim(classes).split(' ');
		var icon = '';
		for (var i=0; i<classes.length; i++) {
			if (classes[i].indexOf('icon-') >= 0) {
				icon = classes[i];
				break;
			}
		}
		return icon;
	}

	function studeon_show_media_manager(el) {
		STUDEON_STORAGE['media_id'] = jQuery(el).attr('id');
		STUDEON_STORAGE['media_link'][STUDEON_STORAGE['media_id']] = jQuery(el);
		// If the media frame already exists, reopen it.
		if ( STUDEON_STORAGE['media_frame'][STUDEON_STORAGE['media_id']] ) {
			STUDEON_STORAGE['media_frame'][STUDEON_STORAGE['media_id']].open();
			return false;
		}
		// Create the media frame.
		STUDEON_STORAGE['media_frame'][STUDEON_STORAGE['media_id']] = wp.media({
			// Popup layout (if comment next row - hide filters and image sizes popups)
			frame: 'post',
			// Set the title of the modal.
			title: STUDEON_STORAGE['media_link'][STUDEON_STORAGE['media_id']].data('choose'),
			// Tell the modal to show only images.
			library: {
				type: STUDEON_STORAGE['media_link'][STUDEON_STORAGE['media_id']].data('type') ? STUDEON_STORAGE['media_link'][STUDEON_STORAGE['media_id']].data('type') : 'image'
			},
			// Multiple choise
			multiple: STUDEON_STORAGE['media_link'][STUDEON_STORAGE['media_id']].data('multiple')===true ? 'add' : false,
			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: STUDEON_STORAGE['media_link'][STUDEON_STORAGE['media_id']].data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: true
			}
		});
		// When an image is selected, run a callback.
		STUDEON_STORAGE['media_frame'][STUDEON_STORAGE['media_id']].on( 'insert select', function(selection) {
			// Grab the selected attachment.
			var field = jQuery("#"+STUDEON_STORAGE['media_link'][STUDEON_STORAGE['media_id']].data('linked-field')).eq(0);
			var attachment = null, attachment_url = '';
			if (STUDEON_STORAGE['media_link'][STUDEON_STORAGE['media_id']].data('multiple')===true) {
				STUDEON_STORAGE['media_frame'][STUDEON_STORAGE['media_id']].state().get('selection').map( function( att ) {
					attachment_url += (attachment_url ? "\n" : "") + att.toJSON().url;
				});
				var val = field.val();
				attachment_url = val + (val ? "\n" : '') + attachment_url;
			} else {
				attachment = STUDEON_STORAGE['media_frame'][STUDEON_STORAGE['media_id']].state().get('selection').first().toJSON();
				attachment_url = attachment.url;
				var sizes_selector = jQuery('.media-modal-content .attachment-display-settings select.size');
				if (sizes_selector.length > 0) {
					var size = studeon_get_listbox_selected_value(sizes_selector.get(0));
					if (size != '') attachment_url = attachment.sizes[size].url;
				}
			}
			field.val(attachment_url);
			if (attachment_url.indexOf('.jpg') > 0 || attachment_url.indexOf('.png') > 0 || attachment_url.indexOf('.gif') > 0) {
				var preview = field.siblings('.studeon_override_options_field_preview');
				if (preview.length != 0) {
					if (preview.find('img').length == 0)
						preview.append('<img src="'+attachment_url+'">');
					else 
						preview.find('img').attr('src', attachment_url);
				} else {
					preview = field.siblings('img');
					if (preview.length != 0)
						preview.attr('src', attachment_url);
				}
			}
			field.trigger('change');
		});
		// Finally, open the modal.
		STUDEON_STORAGE['media_frame'][STUDEON_STORAGE['media_id']].open();
		return false;
	}

});