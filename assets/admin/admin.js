( function( $ ) {
    "use strict";

    $( document ).ready( function () {
        tinymce.create('tinymce.plugins.custom_button_title', {
            init: function(editor, url) {
                editor.addButton('custom_button_title', {
                    title: 'Tiêu đề đặc biệt',
                    icon: 'icon dashicons-before dashicons-format-aside',
                    onclick: function() {
                        var shortcode = '[title_has_icon title="Nhập nội dung vào đây"]';
                        editor.insertContent(shortcode);
                    }
                });
            }
        })
        tinymce.PluginManager.add('custom_button_title', tinymce.plugins.custom_button_title)

        tinymce.create('tinymce.plugins.custom_button_contact', {
            init: function(editor, url) {
                editor.addButton('custom_button_contact', {
                    title: 'Nhóm nút liên hệ',
                    icon: 'icon dashicons-before dashicons-email-alt',
                    onclick: function() {
                        var shortcode = '[single_contact_us]';
                        editor.insertContent(shortcode);
                    }
                });
            }
        })
        tinymce.PluginManager.add('custom_button_contact', tinymce.plugins.custom_button_contact)

        // add short code blur image
        tinymce.create('tinymce.plugins.custom_button_blur_image', {
            init : function(ed, url) {
                ed.addButton('custom_button_blur_image', {
                    title : 'Chèn ảnh mờ',
                    icon : 'icon dashicons-before dashicons-format-image',
                    onclick : function() {
                        var frame = wp.media({
                            title: 'Chọn ảnh',
                            button: {
                                text: 'Chèn ảnh mờ'
                            },
                            multiple: false
                        });

                        frame.on('select', function() {
                            var attachment = frame.state().get('selection').first().toJSON();
                            var img_url = attachment.url;

                            ed.insertContent('[blur_image src="' + img_url + '"]');
                        });

                        frame.open();
                    }
                });
            },
            createControl : function(n, cm) {
                return null;
            },
        })
        tinymce.PluginManager.add('custom_button_blur_image', tinymce.plugins.custom_button_blur_image)

    })
} )( jQuery );