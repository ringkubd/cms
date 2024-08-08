function default_editor(selector) {
  tinymce.init({
    selector: selector,
    height: 450,
    formats: {
      h1: {
        block: "h1",
        classes: "heading1"
      },
      h2: {
        block: "h2",
        classes: "heading2"
      },
      h3: {
        block: "h3",
        classes: "heading3"
      },
      h4: {
        block: "h4",
        classes: "heading4"
      },
      h5: {
        block: "h5",
        classes: "heading5"
      }
    }
  });
}

function small_editor(selector, height = 250) {
  tinymce.init({
    menubar: false,
    branding: false,
    selector: selector,
    height: height,
    plugins: ["wordcount lists link code"],
    toolbar: "formatselect | bold italic underline | removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent  hr code ",
  });
}

function simple_editor(selector, height = 500) {
  const editor_config = {
    path_absolute: "/",
    menubar: false,
    branding: false,
    selector: selector,
    height: height,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality toc",
      "template emoticons spellchecker paste textcolor colorpicker textpattern imagetools"
    ],
    toolbar1: "undo redo | styleselect | forecolor backcolor  | cut copy removeformat | table toc | unlink link image media ",
    toolbar2: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent  hr | insertdatetime | code fullscreen ",

    formats: {
      h1: {
        block: "h1",
        classes: "heading1"
      },
      h2: {
        block: "h2",
        classes: "heading2"
      },
      h3: {
        block: "h3",
        classes: "heading3"
      },
      h4: {
        block: "h4",
        classes: "heading4"
      },
      h5: {
        block: "h5",
        classes: "heading5"
      }
    },
    relative_urls: false,
    file_browser_callback: function (field_name, url, type, win) {
      const x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      const y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

      let cmsURL = editor_config.path_absolute + 'file-manager?field_name=' + field_name;
      if (type === 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file: cmsURL,
        title: 'Filemanager',
        width: x * 0.8,
        height: y * 0.8,
        resizable: "yes",
        close_previous: "no"
      });
    }
  };
  tinymce.init(editor_config);
}

function medium_editor(selector) {
  tinymce.init({
    menubar: false,
    branding: false,
    selector: selector,
    height: 500,
    theme: "silver",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "template textpattern imagetools"
    ],
    toolbar1: "styleselect | blockquote forecolor backcolor | undo redo | cut copy removeformat | table | unlink link image media template codesample inserttable | print preview code fullscreen",
    toolbar2: "bold italic underline superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime",
    image_advtab: true,
    templates: [{
        title: "Test template 1",
        content: "Test 1"
      },
      {
        title: "Test template 2",
        content: "Test 2"
      }
    ]
  });
}

function full_editor(selector) {
  tinymce.init({
    selector: selector,
    height: 500,
    plugins: "print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help",
    toolbar1: "formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat",
    image_advtab: true,
    templates: [{
        title: "Test template 1",
        content: "Test 1"
      },
      {
        title: "Test template 2",
        content: "Test 2"
      }
    ],
    content_css: [
      "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
      "//www.tinymce.com/css/codepen.min.css"
    ]
  });
}
