// filter

// Custom lpad function
String.prototype.lpad = function(padString, length) {
    var str = this;
    while (str.length < length) {
        str = padString + str;
    }
    return str;
};

jQuery(document).ready(function($) {
	jQuery("#price-range").slider({
		range: true,
		min: 5000,
		max: 400000,
		values: [ 5000, 400000 ],
		slide: function( event, ui ) {
			jQuery(".min-price-label").html( "&#8377;" + ui.values[ 0 ]);
			jQuery(".max-price-label").html( "&#8377;" + ui.values[ 1 ]);
		}
	});
	jQuery(".price-ranges").slider({
		range: true,
		min: 5000,
		max: 400000,
		values: [ 5000, 400000 ],
		slide: function( event, ui ) {
			jQuery(".min-price-label").html( "&#8377;" + ui.values[ 0 ]);
			jQuery(".max-price-label").html( "&#8377;" + ui.values[ 1 ]);
			return  drop_function();
		}

	});
	// jQuery("#price-ranges_mobile").slider({
	// 	range: true,
	// 	min: 5000,
	// 	max: 400000,
	// 	values: [ 5000, 400000 ],
	// 	slide: function( event, ui ) {
	// 		jQuery(".min-price-label").html( "&#8377;" + ui.values[ 0 ]);
	// 		jQuery(".max-price-label").html( "&#8377;" + ui.values[ 1 ]);
	// 		return  drop_function();
	// 	}
	// });

	jQuery(".min-price-label").html( "&#8377;" + jQuery(".price-ranges").slider( "values", 0 ));
	jQuery(".max-price-label").html( "&#8377;" + jQuery(".price-ranges").slider( "values", 1 ));

	jQuery("#rating").slider({
		range: "min",
		value: 40,
		min: 0,
		max: 50,
		slide: function( event, ui ) {
		}
	});
	function convertTimeToHHMM(t) {
		var minutes = t % 60;
		var hour = (t - minutes) / 60;
		var timeStr = (hour + "").lpad("0", 2) + ":" + (minutes + "").lpad("0", 2);
		var date = new Date("2014/01/01 " + timeStr + ":00");
		var hhmm = date.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
		return hhmm;
	}
	jQuery("#flight-times").slider({
		range: true,
		min: 0,
		max: 1440,
		step: 5,
		values: [ 360, 1200 ],
		slide: function( event, ui ) {
			jQuery(".start-time-label").html( convertTimeToHHMM(ui.values[0]) );
			jQuery(".end-time-label").html( convertTimeToHHMM(ui.values[1]) );
		}
	});
	jQuery(".start-time-label").html( convertTimeToHHMM(jQuery("#flight-times").slider( "values", 0 )) );
	jQuery(".end-time-label").html( convertTimeToHHMM(jQuery("#flight-times").slider( "values", 1 )) );
});