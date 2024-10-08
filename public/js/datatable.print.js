(function (factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery', 'datatables.net', 'datatables.net-buttons'], function ($) {
      return factory($, window, document);
    });
  } else if (typeof exports === 'object') {
    module.exports = function (root, $) {
      if (!root) {
        root = window;
      }
      if (!$ || !$.fn.dataTable) {
        $ = require('datatables.net')(root, $).$;
      }
      if (!$.fn.dataTable.Buttons) {
        require('datatables.net-buttons')(root, $);
      }
      return factory($, root, root.document);
    };
  } else {
    factory(jQuery, window, document);
  }
}(function ($, window, document, undefined) {
  'use strict';
  var DataTable = $.fn.dataTable;
  var _link = document.createElement('a');
  var _styleToAbs = function (el) {
    var url;
    var clone = $(el).clone()[0];
    var linkHost;
    if (clone.nodeName.toLowerCase() === 'link') {
      clone.href = _relToAbs(clone.href);
    }
    return clone.outerHTML;
  };
  var _relToAbs = function (href) {
    _link.href = href;
    var linkHost = _link.host;
    if (linkHost.indexOf('/') === -1 && _link.pathname.indexOf('/') !== 0) {
      linkHost += '/';
    }
    return _link.protocol + "//" + linkHost + _link.pathname + _link.search;
  };
  DataTable.ext.buttons.print = {
    className: 'buttons-print',
    text: function (dt) {
      return dt.i18n('buttons.print', 'Print');
    },
    action: function (e, dt, button, config) {
      var data = dt.buttons.exportData($.extend({
        decodeEntities: false
      }, config.exportOptions));
      var exportInfo = dt.buttons.exportInfo(config);
      var columnClasses = dt.columns(config.exportOptions.columns).flatten().map(function (idx) {
        return dt.settings()[0].aoColumns[dt.column(idx).index()].sClass;
      }).toArray();
      var addRow = function (d, tag) {
        var str = '<tr>';
        for (var i = 0, ien = d.length; i < ien; i++) {
          var dataOut = d[i] === null || d[i] === undefined ? '' : d[i];
          var classAttr = columnClasses[i] ? 'class="' + columnClasses[i] + '"' : '';
          str += '<' + tag + ' ' + classAttr + '>' + dataOut + '</' + tag + '>';
        }
        return str + '</tr>';
      };
      var html = '<table class="' + dt.table().node().className + '" border="0">';
      html += '<thead>';
      if (config.repeatingHead.logo) {
        var logoPosition = (['left', 'right', 'center'].indexOf(config.repeatingHead.logoPosition) > 0) ? config.repeatingHead.logoPosition : 'right';
        html += '<tr><th colspan="' + data.header.length + '" style="padding: 0;margin: 0;text-align: ' + logoPosition + ';"><img style="' + config.repeatingHead.logoStyle + '" src="' + config.repeatingHead.logo + '"/></th></tr>';
        html += '<tr><th colspan="' + data.header.length + '" style="padding: 0;margin: 0;text-align: ' + logoPosition + ';">' + config.repeatingHead.logotext + '</th></tr>';
      }
      if (config.repeatingHead.title) {
        html += '<tr><th colspan="' + data.header.length + '">' + config.repeatingHead.title + '</th></tr>';
      }
      if (config.header) {
        html += addRow(data.header, 'th');
      }
      html += '</thead>';
      html += '<tbody>';
      for (var i = 0, ien = data.body.length; i < ien; i++) {
        html += addRow(data.body[i], 'td');
      }
      html += '</tbody>';
      if (config.footer && data.footer) {
        html += '<tfoot>' + addRow(data.footer, 'th') + '</tfoot>';
      }
      html += '</table>';
      var win = window.open('', '');
      win.document.close();
      var head = '<title>' + exportInfo.title + '</title>';
      $('style, link').each(function () {
        head += _styleToAbs(this);
      });
      try {
        win.document.head.innerHTML = head;
      } catch (e) {
        $(win.document.head).html(head);
      }
      win.document.body.innerHTML = '<h1>' + exportInfo.title + '</h1>' + '<div>' + (exportInfo.messageTop || '') + '</div>' + html + '<div>' + (exportInfo.messageBottom || '') + '</div>';
      $(win.document.body).addClass('dt-print-view');
      $('img', win.document.body).each(function (i, img) {
        img.setAttribute('src', _relToAbs(img.getAttribute('src')));
      });
      if (config.customize) {
        config.customize(win, config, dt);
      }
      var autoPrint = function () {
        if (config.autoPrint) {
          win.print();
          win.close();
        }
      };
      if (navigator.userAgent.match(/Trident\/\d.\d/)) {
        autoPrint();
      } else {
        win.setTimeout(autoPrint, 1000);
      }
    },
    title: '*',
    messageTop: '*',
    messageBottom: '*',
    repeatingHead: {},
    exportOptions: {},
    header: true,
    footer: false,
    autoPrint: true,
    customize: null
  };
  return DataTable.Buttons;
}));
