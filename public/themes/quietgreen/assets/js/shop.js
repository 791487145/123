	($(function() {
		$('.chart1').easyPieChart({
			easing: 'easeOutBounce',
			animate: 1000,
			lineWidth: 12,
			barColor:'#feb529',
			trackColor:'#ffdfbf',
			scaleColor:false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent)/20);
			}
		});
		$('.chart2').easyPieChart({
			easing: 'easeOutBounce',
			animate: 1000,
  			lineWidth: 12,
  			barColor:'#feb529',
  			trackColor:'#ffdfbf',
  			scaleColor:false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent)/20);
			}
		});

		$('.chart3').easyPieChart({
			easing: 'easeOutBounce',
			animate: 1000,
  			lineWidth: 12,
  			barColor:'#feb529',
  			trackColor:'#ffdfbf',
  			scaleColor:false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent)/20);
			}
		});
	}));