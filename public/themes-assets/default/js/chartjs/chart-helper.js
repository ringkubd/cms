var chartArea = $('.chartArea');
width = chartArea.width();
height = chartArea.height();
chartArea.find('.chart-canvas').attr('width', width).attr('height', height);
chartArea.find('.chartValue').css({
  'font-size': Math.round(width) * 0.18,
  width: Math.round(width) + 'px',
  height: Math.round(height) + 'px'
});

function currencyFormatToComma(num) {
  num = Math.ceil(num);
  return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

function currencyFormatToNumber(target) {
  var comma = target.text();
  comma = comma.replace(/[^\d\.]/g, "");
  return parseInt(comma, 10);
}

function animate_chartValue(target, gain, percent = null) {
  let chartClass = target.closest('.chartArea').find('.chartValue > span');
  $({
    Counter: 0
  }).animate({
    Counter: chartClass.attr('data-value')
  }, {
    duration: 1000,
    easing: 'swing',
    step: function () {
      chartClass.attr('data-value', Math.ceil(this.Counter));
      if (percent) {
        chartClass.text(currencyFormatToComma(this.Counter) + percent);
      } else {
        chartClass.text(currencyFormatToComma(this.Counter));
      }

    },
    complete: function () {
      chartClass.attr('data-value', gain);
      if (percent) {
        chartClass.text(currencyFormatToComma(gain) + percent);
      } else {
        chartClass.text(currencyFormatToComma(gain));
      }
    }
  });
}

function chart_config(gain, total) {
  var gain = parseInt(gain);
  var total = parseInt(total);
  return {
    type: 'doughnut',
    data: {
      labels: [
        "Beneficiaries",
        "Non Beneficiaries",
      ],
      datasets: [{
        data: [total, total - gain],
        backgroundColor: [
          '#05A0C8',
          'rgb(235, 235, 235)',
        ],
        borderWidth: 0,
      }]
    },
    options: {
      animation: {
        duration: 2000 // general animation time
      },
      legend: {
        display: false
      },
      tooltips: {
        enabled: true
      },
      cutoutPercentage: 78,
      responsive: false
    }
  }
} // end function chart_config

function chart_generate() {
  $('.chart-canvas').each(function () {
    let gain = $(this).attr('data-value');
    let total = $(this).attr('data-total');
    let suffix = $(this).attr('data-suffix');
    var myChart = new Chart($(this), chart_config(gain, total));
    setInterval(function () {
      myChart.reset();
    }, 2000);

    //animate section
    animate_chartValue($(this), gain, suffix);
  });
}
