
// Define function to open filemanager window
  var lfm = function(options, cb) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/file-manager';
      window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = cb;
  };

  // Define LFM summernote button
  var LFMButton = function(context) {
      var ui = $.summernote.ui;
      var button = ui.button({
          contents: '<i class="note-icon-picture"></i> ',
          tooltip: 'Insert image with filemanager',
          click: function() {
              lfm({type: 'image', prefix: '/file-manager'}, function(url, path) {
                  context.invoke('insertImage', url);
              });
          }
      });
      return button.render();
  };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like


function summernote_lfm(target, height = 400){
    $(target).summernote({
        height: height,
        placeholder: 'write here...',
        tabsize: 2,
        toolbar: [   
            ['font', ['undo', 'redo', 'bold', 'underline', 'italic', 'clear']],
            // ['fontname', ['fontname']],
            // ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['style', ['style']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
            ['table', ['table']],
            ['insert', ['hr', 'link','lfm','video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        buttons: {
            lfm: LFMButton
        }
    });
}
