var timer;
var timeOut_Val = 300;  
var timeOut = timeOut_Val; /* delay after last change to execute filter */
var tmpl_id = jQuery('.bdp-customizer').attr('data-template');
var preview_shortcode = jQuery('.bdp-customizer').attr('data-shortcode');

var checked_show_dep	= [];
var dep_wrap 			= '.bdp-shrt-fields-panel';
var dependency 			= jQuery(dep_wrap +' .bdp-cust-dependency').attr('data-dependency');
dependency 				= jQuery.parseJSON( dependency );

jQuery( document ).ready(function($) {

	$(document).on('click', '.bdp-shrt-dwp', function() {
		$('body').toggleClass('bdp-shrt-full-preview');
		$(this).toggleClass( 'bdp-shrt-dwp-active' );
	});

	/* Customizer Accordian */
	$( "#bdp-shrt-accordion" ).accordion({
		collapsible: true,
		heightStyle: "content",
		icons : {
				header: "dashicons dashicons-arrow-down-alt2",
				activeHeader: "dashicons dashicons-arrow-up-alt2"
	    }
	});

	/* Color Picker */
    if( $('.bdp-cust-color-box').length > 0 ) {
        $('.bdp-cust-color-box').wpColorPicker({
        	change: function(event, ui) {
        		bdp_generate_shortcode_preview();
        	},
        	clear: function() {
        		bdp_generate_shortcode_preview();
        	}
        });
    }

	/* Generate Shortcode */
    $(document).on('change', '.bdp-shrt-fields-panel select, .bdp-shrt-fields-panel input[type="number"]', function() {
    	field_timeout 	= $(this).attr('data-timeout');
    	timeOut 		= (typeof(field_timeout) !== 'undefined') ? field_timeout : timeOut_Val;

    	bdp_generate_shortcode_preview();
	});

	$(document).on('keyup', '.bdp-shrt-fields-panel input[type="text"], .bdp-shrt-fields-panel input[type="number"]', function() {
    	field_timeout 	= $(this).attr('data-timeout');
    	timeOut 		= (typeof(field_timeout) !== 'undefined') ? field_timeout : timeOut_Val;

    	bdp_generate_shortcode_preview();
	});

    /* On Change of Customizer Shortcode */
	$(document).on('change', '.bdp-shrt-switcher', function() {
		redirect = $(this).find(":selected").attr('data-url');

		if( typeof(redirect) !== 'undefined' && redirect != '' ) {
			window.location = redirect;
		}
	});

	/* Tweak - An extra care that form should not be refresh */
	jQuery('#bdp-customizer-shrt-form').submit(function( event ) {
    	var form_target = $(this).attr('target');

    	if( typeof(form_target) == 'undefined' || form_target == '' ) {
    		return false;
    	}
    });

	/* On Click of Preview Generate Button */
	$(document).on('click', '.bdp-cust-shrt-generate', function() {

		var main_ele	= '.bdp-shrt-fields-panel';
		var data		= bdp_check_valid_shortcode();

		/* If wrong shortcode then simply return */
		if( data && data.numeric[0] && data.numeric[0] !== preview_shortcode ) {
			alert( Bdp_Shrt_Generator.shortcode_err );
			return false;
		}

		if( data.named ) {
			$.each( data.named, function( shrt_param, shrt_param_val ) {
				if( shrt_param ) {
					$(main_ele+' .bdp-'+shrt_param).val( shrt_param_val ).trigger('change').trigger('keyup');
				}
			});
		}
	});

	/* Template id is set then run it's shortcode */
	if( tmpl_id != '' ) {
		$('.bdp-cust-shrt-generate').trigger('click');
	}

	/* Shortcode Customizer Dependency */
	if( dependency ) {
		$.each( dependency, function( key, dependency_val ) {

			if( key ) {

				/* Dependency on page load */
				setTimeout(function() {
					if( $.inArray( key, checked_show_dep ) == -1 ) {
			        	$(dep_wrap+' .bdp-'+key+'').trigger('change');
			    	}
			    }, 10);

				$(document).on('change keyup', dep_wrap+' .bdp-'+key+'', function() {
			    	
			    	var input_val = $(this).val();

			    	/* Show Dependency */
			    	if( dependency_val.show ) {
			    		$.each( dependency_val.show, function( sub_key, sub_dep_val ) {
			    			$(dep_wrap+' .bdp-'+sub_key+'').closest('.bdp-customizer-row').hide();
			    			$(dep_wrap+' .bdp-'+sub_key+'').addClass('bdp-cust-hidden-field');

			    			/* If value is present then show */
			    			if( ( $.inArray( input_val, sub_dep_val ) !== -1 ) ) {
			    				$(dep_wrap+' .bdp-'+sub_key+'').closest('.bdp-customizer-row').show();
			    				$(dep_wrap+' .bdp-'+sub_key+'').removeClass('bdp-cust-hidden-field');
			    			}

			    			/* Check if reference dependency is there then hide it's element also */
			    			bdp_check_ref_dependency( sub_key );
			    		});
			    	}

			    	/* Hide Dependency */
			    	if( dependency_val.hide ) {
			    		$.each( dependency_val.hide, function( sub_key, sub_dep_val ) {

			    			$(dep_wrap+' .bdp-'+sub_key+'').closest('.bdp-customizer-row').show();
			    			$(dep_wrap+' .bdp-'+sub_key+'').removeClass('bdp-cust-hidden-field');

			    			if( ( $.inArray( input_val, sub_dep_val ) !== -1 ) ) {
			    				$(dep_wrap+' .bdp-'+sub_key+'').closest('.bdp-customizer-row').hide();
			    				$(dep_wrap+' .bdp-'+sub_key+'').addClass('bdp-cust-hidden-field');
			    			}

			    			/* Check if reference dependency is there then hide it's element also */
			    			bdp_check_hide_ref_dependency( sub_key );
			    		});
			    	}
				});
			}
		});
	} else {
		bdp_generate_shortcode_preview();
	}
	/* Shortcode Customizer Dependency */
});

/* Check Valid Shortcode */
function bdp_check_valid_shortcode() {
	var shrt_val 	= jQuery.trim( jQuery('.bdp-shrt-box').val() );
	var first_char 	= shrt_val.substr(0, 1);
	var last_char 	= shrt_val.substr(-1);

	/* Simply return if blank value */
	if( shrt_val == '' ) {
		return false;
	}

	if( first_char == '[' && last_char == ']' ) {
		shrt_val = jQuery.trim( shrt_val.slice(1, -1) );

		first_char 	= shrt_val.substr(0, 1);
		last_char 	= shrt_val.substr(-1);
	}

	if( first_char != '[' ) {
		shrt_val = '[' + shrt_val;
	}
	if( last_char != ']' ) {
		shrt_val = shrt_val + ']';
	}

	jQuery('.bdp-shrt-box').val( shrt_val );

	temp_shrt_val = jQuery.trim( shrt_val.slice(1, -1) );
	var data = wp.shortcode.attrs( temp_shrt_val );

	return data;
}

/* Function to generate shortcode preview */
function bdp_generate_shortcode_preview() {

	/* Taking some variables */
    var shortcode_val   = '';
    var main_ele		= jQuery('.bdp-customizer');
    var cls_ele         = jQuery('.bdp-shrt-fields-panel');
    var shortcode_name  = preview_shortcode;

	clearTimeout(timer); /* if we pressed the key, it will clear the previous timer and wait again */
    timer = setTimeout(function() {

    	main_ele.find('.bdp-shrt-loader').fadeIn();

        shortcode_val += '['+shortcode_name;

        /* Loop of form element */
        cls_ele.find('input[type="text"], input[type="checkbox"]:checked, input[type="radio"], input[type="number"], textarea, select').each(function(i, field){

        	if( jQuery(this).hasClass('bdp-cust-hidden-field') ) {
        		return;
        	}

            var field_val	= jQuery(this).val();
            var field_name  = jQuery(this).attr('name');
            var default_val	= jQuery(this).attr('data-default');
            var allow_empty	= jQuery(this).attr('data-empty');            

            if( typeof(field_val) != 'undefined' && ( field_val != '' || allow_empty ) && field_val != default_val ) {
                shortcode_val += ' '+field_name+'='+'"'+field_val+'"';
            }
        });

        shortcode_val += ']';

        /* Append shortcode */
        main_ele.find('.bdp-shrt-box').val(shortcode_val);

        jQuery('#bdp-customizer-shrt-form').submit();        

		main_ele.find('.bdp-shrt-preview-frame').load(function () {
		    main_ele.find('.bdp-shrt-loader').fadeOut();
		});

    }, timeOut);
}

/* Function to check reference dependency */
function bdp_check_ref_dependency( sub_key ) {

	ref_dep = sub_key in dependency;

	if( ref_dep ) {

		var ref_input_val = jQuery(dep_wrap+' .bdp-'+sub_key+'').val();

		jQuery.each( dependency[sub_key]['show'], function( ref_key, ref_dep_val ) {

			jQuery(dep_wrap+' .bdp-'+ref_key+'').closest('.bdp-customizer-row').hide();
			jQuery(dep_wrap+' .bdp-'+ref_key+'').addClass('bdp-cust-hidden-field');

			if( jQuery.inArray( ref_input_val, ref_dep_val ) !== -1 && (!jQuery(dep_wrap+' .bdp-'+sub_key+'').hasClass('bdp-cust-hidden-field')) ) {
				jQuery(dep_wrap+' .bdp-'+ref_key+'').closest('.bdp-customizer-row').show();
				jQuery(dep_wrap+' .bdp-'+ref_key+'').removeClass('bdp-cust-hidden-field');
			}

			/* Check if reference dependency is there then hide it's element also */
			bdp_check_ref_dependency( ref_key );
		});

		checked_show_dep.push( sub_key ); /* Log checked show dependency */
	}
}

/* Function to check hide reference dependency */
function bdp_check_hide_ref_dependency( sub_key ) {

	ref_dep = sub_key in dependency;

	if( ref_dep ) {

		var ref_input_val = jQuery(dep_wrap+' .bdp-'+sub_key+'').val();

		jQuery.each( dependency[sub_key]['hide'], function( ref_key, ref_dep_val ) {

			jQuery(dep_wrap+' .bdp-'+ref_key+'').closest('.bdp-customizer-row').hide();
			jQuery(dep_wrap+' .bdp-'+ref_key+'').addClass('bdp-cust-hidden-field');

			if( jQuery.inArray( ref_input_val, ref_dep_val ) == -1 && (!jQuery(dep_wrap+' .bdp-'+sub_key+'').hasClass('bdp-cust-hidden-field')) ) {
				jQuery(dep_wrap+' .bdp-'+ref_key+'').closest('.bdp-customizer-row').show();
				jQuery(dep_wrap+' .bdp-'+ref_key+'').removeClass('bdp-cust-hidden-field');
			}

			/* Check if reference dependency is there then hide it's element also */
			bdp_check_hide_ref_dependency( ref_key );
		});
	}
}
