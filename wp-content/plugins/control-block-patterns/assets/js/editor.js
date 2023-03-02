;
(function($) {
    $(document).on('ready', function(){
        $('.ctrlbp-editor-type').each(function() {
          
            var editor = ace.edit($(this).attr('id'));
            var editorType = $(this).data('editor_type');
            var editorTheme = $(this).data('editor_theme');

            var this_textarea = $('textarea#' + $(this).data('id'));
            editor.setTheme("ace/theme/"+editorTheme);
            editor.getSession().setMode("ace/mode/"+editorType);
            editor.setShowPrintMargin(false);
            editor.setOptions({
                fontSize: "14px",
                autoScrollEditorIntoView: true,
                maxLines: 40,
                minLines: 20
                });

            editor.getSession().setValue(this_textarea.val());
            editor.getSession().on('change', function() {
                this_textarea.val(editor.getSession().getValue());
            });
            this_textarea.on('change', function() {
                editor.getSession().setValue(this_textarea.val());
            });
        });

    });
})(jQuery, window, document);