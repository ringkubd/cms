<?php

if (!function_exists("datatables")) {
  function datatables($selector)
  {
    return $script = <<<EOT
EOT;
  }
}

if (!function_exists("dataTableScript")) {

  function dataTableScript($selector, $options = null, $oriantation = 'portrait', $header = null, $footer = null, $button = null)
  {
    $printjs = asset('js/datatable.print.js');
    return <<<EOT
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
    <script type="text/javascript" src="$printjs"></script>
    <script type="text/javascript">
    $("$selector").DataTable({
        dom: 'Bfrtip',
        order: [[ 8, 'desc' ]],
        buttons:[
             {
                extend: 'print',
                footer: {
                    text: "IsDB-BISEW IT Scholarship Programme"
                },
                title: "",
                // messageTop:'Top message',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '8pt' )
                        .css('margin',0)
                        .css('padding',0)
                        .prepend(
                            '<img src="http://idb-bisew.org/templates/qc/images/logo.png" style="position:absolute; top:35%; left:35%; opacity: .2" />'
                        ).append(
                            {$footer}
                        );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
                //For repeating heading.
                repeatingHead: {
                    logo: 'https://www.isdb-bisew.org/img/isdb-bisew.png',
                    logoPosition: 'center',
                    logoStyle: 'width:60',
                    title: '<h3 style="text-align=center">{$header}</h3>',
                    logotext: 'IsDB-BISEW IT Scholarship Programme'
                },
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
             },
            'excel',
            {
                extend: 'pdfHtml5',
                title:'IsDB-BISEW IT Scholarship Programme',
                footer:true,
                orientation: '$oriantation',
                customize : function(doc){
                    // doc.styles['table'] = {
                    //     width: '100%!important'
                    // }
                    //doc.content[1].margin = [0, 0, 100, 0]
                    let colCount = [];
                    $("$selector").find('tbody tr:first-child td').each(function(){
                        if($(this).attr('colspan')){
                            for(let i=1;i<=$(this).attr('colspan');i++){
                                colCount.push('*');
                            }
                        }else{ colCount.push('*'); }
                    });
                    doc.content[1].table.widths = colCount;
                    doc.pageMargins = [10,10,10,10];
                    doc.defaultStyle.fontSize = 8;
                    doc.defaultStyle.align = 'center';
                    doc.styles.tableHeader.fontSize = 12;
                    doc.styles.title.fontSize = 16;
                    // Remove spaces around page title
                    doc.content[0].text = doc.content[0].text.trim();
                    //header
                    doc['header'] = (function() {
                      return[
                        {
                          columns: [
                              {
                                //image: '';
                                //width: 80
                              }
                            ],
                          margin: [10, 10],
                          alignment: 'center',
                          content: [{
                              text: 'IsDB-BISEW IT Scholarship Programme',
                              style: 'header'
                          }],
                        }
                      ]
                    })
                    // Create a footer
                    doc['footer']=(function(page, pages) {
                      return {
                        columns: [
                          {$footer},
                          {
                            // This is the right column
                            alignment: 'right',
                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                          }
                        ],
                        margin: [10, 0]
                      }
                    });

                  // Styling the table: create style object
                  var objLayout = {};
                  // Horizontal line thickness
                  objLayout['hLineWidth'] = function(i) { return .5; };
                  // Vertikal line thickness
                  objLayout['vLineWidth'] = function(i) { return .5; };
                  // Horizontal line color
                  objLayout['hLineColor'] = function(i) { return '#aaa'; };
                  // Vertical line color
                  objLayout['vLineColor'] = function(i) { return '#aaa'; };
                  // Left padding of the cell
                  objLayout['paddingLeft'] = function(i) { return 4; };
                  // Right padding of the cell
                  objLayout['paddingRight'] = function(i) { return 4; };
                  // Inject the object in the document
                  doc.content[1].layout = objLayout;

                }
            },
            {
              extend: 'copy',
              text: 'Copy to clipboard'
            }
        ],
        $options
    });
    </script>
EOT;
  }
}

if (!function_exists("dataTableStyle")) {

  function dataTableStyle()
  {
    return <<<EOT
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/fh-3.1.4/r-2.2.2/datatables.min.css"/>
    <style>
    div.dataTables_wrapper div.dataTables_filter {
      display: inline-block;
      float: right;
    }
    </style>
EOT;
  }
}
