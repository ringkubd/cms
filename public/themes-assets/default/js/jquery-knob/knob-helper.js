$('.knob').removeClass('d-none');

function currencyFormatToComma(num) {
  num = Math.ceil(num);
  return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

function currencyFormatToNumber(target) {
  comma = target.replace(/[^\d\.]/g, "");
  return parseInt(comma, 10);
}

function knob_init(selector, fgColor = "#05a0c8", inputColor = "#f55419") {
  $(selector).each(function () {
    let $this = $(this);
    let inputValue = currencyFormatToNumber($this.val());
    let device = $(window).width();
    let suffix = $this.attr('data-suffix');
    let dataValue = $this.attr('data-value');
    $this.knob({
      width: device > 576 ? 120 : 80,
      height: device > 576 ? 120 : 80,
      thickness: device > 576 ? 0.20 : 0.12,
      readOnly: true,
      fgColor: fgColor,
      inputColor: device > 576 ? inputColor : '#fff',
      displayPrevious: true,
      draw: function () {
        $(this.i).val(this.cv + suffix);
      }
    });
    $({
      value: 0
    }).animate({
      value: inputValue
    }, {
      duration: 2000,
      easing: 'swing',
      step: function () {
        $this.val(Math.ceil(this.value)).trigger('change');
      },
      done: function () {
        if(suffix) {
          $this.val(currencyFormatToComma(dataValue)).trigger('change');
        }else{
          $this.val(currencyFormatToComma(dataValue));
        }
      }
    });
  });
}
