var FormFileUpload = function () {
    return {
        //main function to initiate the module
        init: function () {
             // Initialize the jQuery File Upload widget:
            $('#fileupload').fileupload({
                disableImageResize: false,
                autoUpload: false,
                disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                maxFileSize: 5000000,
                //previewMaxWidth: 300,
                //previewMaxHeight: 200,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                autoUpload: true
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},                
            });

            // Enable iframe cross-domain access via redirect option:
            $('#fileupload').fileupload(
                'option',
                'redirect',
                window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                )
            );

            // Upload server status check for browsers with CORS support:
            if ($.support.cors) {
                $.ajax({
                    type: 'HEAD'
                }).fail(function () {
                    $('<div class="alert alert-danger"/>')
                        .text('Upload server currently unavailable - ' +
                                new Date())
                        .appendTo('#fileupload');
                });
            }

            // Load & display existing files:
            $('#fileupload').addClass('fileupload-processing');
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: $('#fileupload').attr("action"),
                dataType: 'json',
                context: $('#fileupload')[0]
            }).always(function () {
                $(this).removeClass('fileupload-processing');
            }).done(function (result) {
                var sort = $.parseJSON($('#fileupload').attr("sort"));
                if (sort && sort.length){
                    var new_files_arr = [];
                    $(sort).each(function(key,value){
                        $(result.files).each(function(k,v){
                            //console.log(v);
                            if (v.name == value){
                                new_files_arr.push(v);
                            };
                        });
                    });
                    result.files = new_files_arr;
                };

                $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
            });
        }

    };

}();

jQuery(document).ready(function() {
    FormFileUpload.init();
});