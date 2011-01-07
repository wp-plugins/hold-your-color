var hyc = {
	init:function() {
		hyc.defaults();
		hyc.pickers();
	},
	
	defaults:function() {
		var inputs = j('input[id^="hyc_color_"]');
		var colorpicker = j('.colorpickerSelect');
		
		inputs.each(function(i) {
			colorpicker.eq(i).children('div').css('backgroundColor', '#' + j(this).val());
		});
		
		inputs.bind('keyup', function() {
			var slug = j(this).attr('id').split('_');

			j('#colorpicker_' + slug[2]).children('div').css('backgroundColor', '#' + j(this).val());
		});
	},
	
	pickers:function() {
		j('.colorpickerSelect').click(function() {
			var current = j(this);
			var id = j(this).attr('id').split('_');
			var input = j('#hyc_color_' + id[1]);
			var color = input.val();
						
			j(this).ColorPicker({
				color: '#' + color,
				onShow: function(colpkr) {
					j(colpkr).fadeIn(500);
					return false;
				},
				onHide: function(colpkr) {
					j(colpkr).fadeOut(500);
					return false;
				},
				onChange: function(hsb, hex, rgb) {
					input.val(hex);
					current.children('div').css('backgroundColor', '#' + hex);
				},
				onSubmit: function(hsb, hex, rgb, el) {
				}
			});
		});
	},
	
	widget: {
		init:function() {
			j('.hyc-widget select option').click(function(e) {
				var url = j(this).attr('id');
				
				window.location = url;
				
				e.preventDefault();
				return false;
			});
		}
	}
}