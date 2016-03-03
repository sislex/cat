var ComponentsEditors = function () {

    var handleWysihtml5 = function () {
        if (!jQuery().wysihtml5) {
            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["/admin/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    var handleSummernote = function () {
        // initialise editor
        $('#summernote_1').summernote({
            height: 300,
            onImageUpload: function(files) {
                var id = $('#id').val();
                sendFile(files[0], id);
            }
            // old version
            //onImageUpload: function(files, editor, welEditable) {
            //    sendFile(files[0], editor, welEditable);
            //}
        });

        // send the file
        function sendFile(file, id) {
        // old version
        //function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            data.append("id", id);
            $.ajax({
                data: data,
                type: 'POST',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
                    return myXhr;
                },
                //url: root + '/admin/assets/global/plugins/bootstrap-summernote/php/uploadEditorImages.php',
                url: '/admin/assets/global/plugins/bootstrap-summernote/php/uploadEditorImages.php',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    $('#summernote_1').summernote('editor.insertImage', url);
                    // old version
                    //editor.insertImage(welEditable, url);
                },
                error: function(e, data){
                    console.log('error: ', e);
                    console.log('data: ', data);
                }
            });
        }

         //update progress bar
        function progressHandlingFunction(e){
            if(e.lengthComputable){
                $('progress').attr({value:e.loaded, max:e.total});
                // reset progress on complete
                if (e.loaded == e.total) {
                    $('progress').attr('value','0.0');
                }
            }
        }

        //API:
        //var sHTML = $('#summernote_1').code(); // get code
        //$('#summernote_1').destroy(); // destroy
    };

    return {
        //main function to initiate the module
        init: function () {
            handleWysihtml5();
            handleSummernote();
        }
    };

}();

jQuery(document).ready(function() {    
   ComponentsEditors.init(); 
});