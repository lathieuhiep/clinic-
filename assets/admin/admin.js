( function( $ ) {
    "use strict";

    $( document ).ready( function () {
        // add title has icon
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

        // add button contact us
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

        // add button phone
        tinymce.create('tinymce.plugins.custom_button_phone', {
            init: function(editor, url) {
                editor.addButton('custom_button_contact', {
                    title: 'Nút điện thoại',
                    icon: 'icon dashicons-before dashicons-phone',
                    onclick: function() {
                        var shortcode = '[phone]Nội dung(nếu để trống sẽ hiện số điện thoại)[/phone]';
                        editor.insertContent(shortcode);
                    }
                });
            }
        })
        tinymce.PluginManager.add('custom_button_phone', tinymce.plugins.custom_button_phone)

    })
} )( jQuery );