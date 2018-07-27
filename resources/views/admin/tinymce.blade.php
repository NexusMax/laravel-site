<style>
    textarea {
        height: 500px !important;
    }
</style>
<script src="{{ asset('backend/vendor/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('backend/vendor/tinymce/tinymce.min.js') }}"></script>
<script>
    var editor_config = {
        path_absolute : "{{ URL::to('/') }}/",
        selector: "textarea.editor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern codesample responsivefilemanager"
        ],
        toolbar1: "insertfile undo redo | styleselect removeformat formatselecty | bold italic strikethrough | alignleft aligncenter alignright alignjustify | ltr rtl | bullist numlist outdent indent | emoticons charmap",
        toolbar2: "link unlink anchor | image responsivefilemanager media | forecolor backcolor | print preview code codesample",
        statusbar: true,
        image_advtab: true,
        relative_urls: false,
        language: "ru",
        external_filemanager_path:"/backend/vendor/filemanager/",
        filemanager_title:"Файловый менеджер",
        external_plugins: { "filemanager" : "{{ asset('backend/vendor/filemanager/plugin.min.js') }}"}
    };

    tinymce.init(editor_config);
</script>
