// Creates links to the TinyMCE
require.context(
    'file-loader?name=[path][name].[ext]&context=node_modules/tinymce!tinymce/skins/ui/oxide',
    true,
    /.*/
);
// Import TinyMCE
var tinymce = require('tinymce/tinymce');

// A theme is also required
require('tinymce/themes/silver');

// Any plugins you want to use has to be imported
require('tinymce/plugins/paste');
require('tinymce/plugins/link');

// Initialize the app
tinymce.init({
    selector: 'textarea',
    plugins: ['paste', 'link'],
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});