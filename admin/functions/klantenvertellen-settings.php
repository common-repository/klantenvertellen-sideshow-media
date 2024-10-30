<?php
function kvssm_section_title(){
	echo '<h4>Easily generate a shortcode for usage on your website</h4>';
} // End kvssm_section_title

function kvssm_select_type_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<select id='shorttype' name='kvssm_settings[kvssm_select_type]' title='Select the shortcode type'>
		<option value='1' <?php selected( $options[ 'kvssm_select_type' ], 1 ); ?> title='This is a small square with your average rating'>Widget - Default</option>
		<option value='2' <?php selected( $options[ 'kvssm_select_type' ], 2 ); ?> title='This is a flat bar version of the widget'>Widget - Flat</option>
		<option value='3' <?php selected( $options[ 'kvssm_select_type' ], 3 ); ?> title='This allows you to show reviews'>Review</option>
	</select>
<?php
} // End kvssm_select_type_render

function kvssm_company_name_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<input type='text' name='kvssm_settings[kvssm_company_name]' title='Name of your company' value='<?php echo $options[ 'kvssm_company_name' ]; ?>'/>
<?php
} // End kvssm_company_name

function kvssm_short_description_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<textarea style='width:300px;resize:none;' name='kvssm_settings[kvssm_short_description]' title='Describe your company or services in a few words'><?php echo $options[ 'kvssm_short_description' ]; ?></textarea>
<?php
} // End kvssm_short_description_render

function kvssm_xml_feed_render(){
	$options = get_option( 'kvssm_settings' );
?>
	https://klantenvertellen.nl/xml/<input type='text' id='kvssm_xml' name='kvssm_settings[kvssm_xml_feed_default]' title='Complete the link based on your own Klantenvertellen link' value='<?php echo $options[ 'kvssm_xml_feed_default' ]; ?>'/>/all<br/>
	http://mobiliteit.klantenvertellen.nl/xml/<input type='text' id='kvssm_mobi' name='kvssm_settings[kvssm_xml_feed_mobility]' title='Complete the link based on your own Klantenvertellen link' value='<?php echo $options[ 'kvssm_xml_feed_mobility' ]; ?>'/><br/>
	https://www.klantenvertellen.nl/v1/review/feed.xml?locationId=<input type='text' id='kvssm_location' name='kvssm_settings[kvssm_xml_feed_location]' title='Complete the link based on your own Klantenvertellen link' value='<?php echo $options[ 'kvssm_xml_feed_location' ]; ?>'/>
	&tenantId=<input type='text' id='kvssm_tenant' name='kvssm_settings[kvssm_xml_feed_tenant]' title='Complete the link based on your own Klantenvertellen link' value='<?php echo $options[ 'kvssm_xml_feed_tenant' ]; ?>'/>

<?php
} // End kvssm_xml_feed_render

function kvssm_widget_link_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<textarea class='widget' style='width:300px;resize:none;' name='kvssm_settings[kvssm_widget_link]' title='Where should the widget link to?'><?php echo $options[ 'kvssm_widget_link' ]; ?></textarea>
<?php
} // End kvssm_widget_link_render

function kvssm_widget_color_grade_render(){
	$options = get_option( 'kvssm_settings' );
	$gradeColor = $options['kvssm_widget_color_grade'];
	if( $gradeColor == '' ){ $gradeColor = '#000000'; }
?>
	<input class='widget default widgetGradeColorPicker' type='color' style='height:30px;width:10%;' name='kvssm_settings[kvssm_widget_color_grade]' title='Color for the average grade inside the widget' value='<?php echo $gradeColor ?>'/> 
	<input class='widget default widgetGradeColor' type='text' name='kvssm_settings[kvssm_widget_color_grade]' title='Color for the average grade inside the widget' value='<?php echo $gradeColor; ?>'/>
<?php
} // End kvssm_widget_color_grade_render

function kvssm_widget_color_other_render(){
	$options = get_option( 'kvssm_settings' );
	$otherColor = $options['kvssm_widget_color_other'];
	if( $otherColor == '' ){ $otherColor = '#000000'; }
?>
	<input class='widget default widgetOtherColorPicker' type='color' style='height:30px;width:10%;' name='kvssm_settings[kvssm_widget_color_other]' title='Color for the rest of the text' value='<?php echo $otherColor ?>'/> 
	<input class='widget default widgetOtherColor' type='text' name='kvssm_settings[kvssm_widget_color_other]' title='Color for the average grade inside the widget' value='<?php echo $otherColor; ?>'/>
<?php
} // End kvssm_widget_color_other_render

function kvssm_widget_letter_spacing_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<input class='widget default' type='number' name='kvssm_settings[kvssm_widget_letter_spacing]' title='The spacing between the letters of the grade' value='<?php echo $options[ 'kvssm_widget_letter_spacing' ]; ?>'/> 
	<select class='widget default' name='kvssm_settings[kvssm_widget_letter_spacing_method]' title='Select one of these, recommended is px'>
		<option value='px' <?php selected( $options[ 'kvssm_widget_letter_spacing_method' ], 'px' ); ?>>px</option>
		<option value='em' <?php selected( $options[ 'kvssm_widget_letter_spacing_method' ], 'em' ); ?>>em</option>
	</select>
<?php
} // End kvssm_widget_letter_spacing_render

function kvssm_widget_letter_position_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<input class='widget default' type='number' name='kvssm_settings[kvssm_letter_position_top]' title='Position from the top' value='<?php echo $options[ 'kvssm_letter_position_top' ]; ?>'/> 
	<select class='widget default' name='kvssm_settings[kvssm_widget_letter_position_top_method]' title='Select one of these, recommended is px'>
		<option value='px' <?php selected( $options[ 'kvssm_widget_letter_position_top_method' ], 'px' ); ?>>px</option>
		<option value='em' <?php selected( $options[ 'kvssm_widget_letter_position_top_method' ], 'em' ); ?>>em</option>
	</select> 
	<input class='widget default' type='number' name='kvssm_settings[kvssm_letter_position_left]' title='Position from the left' value='<?php echo $options[ 'kvssm_letter_position_left' ]; ?>'/> 
	<select class='widget default' name='kvssm_settings[kvssm_widget_letter_position_left_method]' title='Select one of these, recommended is px'>
		<option value='px' <?php selected( $options[ 'kvssm_widget_letter_position_left_method' ], 'px' ); ?>>px</option>
		<option value='em' <?php selected( $options[ 'kvssm_widget_letter_position_left_method' ], 'em' ); ?>>em</option>
	</select>
<?php
}// End kvssm_widget_letter_position_render

function kvssm_widget_flat_letter_size_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<input class='widget flat' type='number' name='kvssm_settings[kvssm_flat_letter_size]' title='Font size in pixels' value='<?php echo $options[ 'kvssm_flat_letter_size' ]; ?>'/> px
<?php
} // End kvssm_widget_flat_letter_size_render

function kvssm_widget_flat_font_color_render(){
	$options = get_option( 'kvssm_settings' );
	$fontColor = $options['kvssm_flat_font_color'];
	if( $fontColor == '' ){ $fontColor = '#000000'; }
?>
	<input class='widget flat widgetFlatOtherColorPicker' type='color' style='height:30px;width:10%;' name='kvssm_settings[kvssm_flat_font_color]' title='Text color' value='<?php echo $fontColor; ?>'/> 
	<input class='widget flat widgetFlatOtherColor' type='text' name='kvssm_settings[kvssm_flat_font_color]' title='Text color' value='<?php echo $fontColor; ?>'/>
<?php
} // End kvssm_widget_flat_font_color_render

function kvssm_widget_flat_left_padding_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<input class='widget flat' type='number' name='kvssm_settings[kvssm_flat_left_padding]' title='Left padding value' value='<?php echo $options[ 'kvssm_flat_left_padding' ]; ?>'/> 
	<select class='widget flat' name='kvssm_settings[kvssm_flat_left_padding_method]' title='Select one of these, recommended is %'>
		<option value='px' <?php selected( $options[ 'kvssm_flat_left_padding_method' ], 'px' ); ?>>px</option>
		<option value='%' <?php selected( $options[ 'kvssm_flat_left_padding_method' ], '%' ); ?>>%</option>
	</select>
<?php
} // End kvssm_widget_flat_left_padding_render

function kvssm_review_limit_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<input class='review' id='review_limit' type='number' min='0' name='kvssm_settings[kvssm_review_limit]' title='Amount of reviews to show, put 0 to show only your averages' value='<?php echo $options[ 'kvssm_review_limit' ]; ?>'/>
<?php
} // End kvssm_review_limit_render

function kvssm_review_key_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<select class='review' id='review_key' name='kvssm_settings[kvssm_review_key]' title='Column to display above each review'>
		<option value='noKeyField' <?php selected( $options[ 'kvssm_review_key' ], 'noKeyField' ); ?>>-- Select an option --</option>
<?php
		if( $options[ 'kvssm_xml_feed_default' ] !== '' ){
			$result = fill_dropdown( '1', 'kvssm_review_key' );
		}else if( $options[ 'kvssm_xml_feed_mobility' ] !== '' ){
			$result = fill_dropdown( '2', 'kvssm_review_key' );
		}else if( $options[ 'kvssm_xml_feed_location' ] !== '' && $options[ 'kvssm_xml_feed_tenant' ] !== '' ){
			$result = fill_dropdown( '3', 'kvssm_review_key' );
		}
		echo $result;
?>
	</select>
<?php
} // End kvssm_review_key_render

function kvssm_review_filter_render(){
	$options = get_option( 'kvssm_settings' );
?>
	<select class='review' id='review_filter_col' name='kvssm_settings[kvssm_review_filter_column]' title='Column to filter the reviews on'>
		<option value='noFilter' <?php selected( $options[ 'kvssm_review_filter_column' ], 'noFilter' ); ?>>-- Select an option--</option>
<?php
		if( $options[ 'kvssm_xml_feed_default' ] !== '' ){
			$result = fill_dropdown( '1', 'kvssm_review_filter_column' );
		}else if( $options[ 'kvssm_xml_feed_mobility' ] !== '' ){
			$result = fill_dropdown( '2', 'kvssm_review_filter_column' );
		}else if( $options[ 'kvssm_xml_feed_location' ] !== '' && $options[ 'kvssm_xml_feed_tenant' ] !== '' ){
			$result = fill_dropdown( '3', 'kvssm_review_filter_column' );
		}
		echo $result;
?>
	</select> 
	<input class='review' id='review_filter_val' type='text' name='kvssm_settings[kvssm_review_filter_value]' title='Value the column has to match' value='<?php echo $options[ 'kvssm_review_filter_value' ]; ?>'/>
<?php
} // End kvssm_review_filter_render

function kvssm_review_averages_background_color_render(){
	$options = get_option( 'kvssm_settings' );
	$backgroundColor = $options['kvssm_review_averages_color_bg'];
	if( $backgroundColor == '' ){ $backgroundColor = '#000000'; }
?>
	<input class='review averagesBackgroundColorPicker' type='color' style='height:30px;width:10%;' name='kvssm_settings[kvssm_review_averages_color_bg]' title='Background color for the averages' value='<?php echo $backgroundColor; ?>'/> 
	<input class='review averagesBackgroundColor' type='text' name='kvssm_settings[kvssm_review_averages_color_bg]' title='Background color for the averages' value='<?php echo $backgroundColor; ?>'/>
<?php
} // End kvssm_review_averages_background_color_render

function kvssm_review_averages_text_color_render(){
	$options = get_option( 'kvssm_settings' );
	$textColor = $options['kvssm_review_averages_color_text'];
	if( $textColor == '' ){ $textColor = '#000000'; }
?>
	<input class='review averagesTextColorPicker' type='color' style='height:30px;width:10%;' name='kvssm_settings[kvssm_review_averages_color_text]' title='Text color for the averages' value='<?php echo $textColor; ?>'/> 
	<input class='review averagesTextColor' type='text' name='kvssm_settings[kvssm_review_averages_color_text]' title='Text color for the averages' value='<?php echo $textColor; ?>'/>
<?php
} // End kvssm_review_averages_text_color_render

function kvssm_review_reviews_background_color_render(){
	$options = get_option( 'kvssm_settings' );
	$backgroundColor = $options['kvssm_review_reviews_color_bg'];
	if( $backgroundColor == '' ){ $backgroundColor = '#000000'; }
?>
	<input class='review reviewBackgroundColorPicker' type='color' style='height:30px;width:10%;' name='kvssm_settings[kvssm_review_reviews_color_bg]' title='Background color for the reviews' value='<?php echo $backgroundColor; ?>'/> 
	<input class='review reviewBackgroundColor' type='text' name='kvssm_settings[kvssm_review_reviews_color_bg]' title='Background color for the reviews' value='<?php echo $backgroundColor; ?>'/>
<?php
} // End kvssm_review_reviews_background_color_render

function kvssm_review_reviews_text_color_render(){
	$options = get_option( 'kvssm_settings' );
	$textColor = $options['kvssm_review_reviews_color_text'];
	if( $textColor == '' ){ $textColor = '#000000'; }
?>
	<input class='review reviewTextColorPicker' type='color' style='height:30px;width:10%;' name='kvssm_settings[kvssm_review_reviews_color_text]' title='Text color for the reviews' value='<?php echo $textColor; ?>'/> 
	<input class='review reviewTextColor' type='text' name='kvssm_settings[kvssm_review_reviews_color_text]' title='Text color for the reviews' value='<?php echo $textColor; ?>'/>
<?php
} // End kvssm_review_reviews_text_color_render

/**
 * Fetch external XML data
 **/
function kvssm_get_data( $url ){
	$ch = wp_remote_get( $url );
	$data = wp_remote_retrieve_body( $ch );

	return $data;
}

/**
 * Function to fill dropdowns
 * VAR version  -- Tells us what version to use for filling (Default, Mobility, Location)
 * VAR dropdown -- Tells us what dropdown to fill (Key or Filter)
 **/
function fill_dropdown( $version = '1', $dropdown ){
	$result = ''; // Prepare the result variable
	$options = get_option( 'kvssm_settings' );
	
	if( $version == '1' ){ // feed_default
		/**
		 * Get the XML feed and prepare the data
		 **/
		if( $options[ 'kvssm_xml_feed_default' ] != '' ){
			$data    = kvssm_get_data( 'https://www.klantenvertellen.nl/xml/' . $options[ 'kvssm_xml_feed_default' ] . '/all' );
			$xml     = simplexml_load_string( $data );
			$json    = json_encode( $xml );
			$array   = json_decode( $json, TRUE );
			
			/**
			 * Prepare empty arrays for filling
			 **/
			$reviews = array(  );
			$keyArray = array(  );
			
			/**
			 * Grab all available reviews
			 **/
			foreach( $xml->resultaten->resultaat as $resultaat ){
				array_push( $reviews, $resultaat );
			}
		
			$limit = count( $reviews ); // How many reviews do we have
			
			/**
			 * Put the name attribute of the reviews into the keyArray
			 **/
			for( $i = 0; $i < $limit; $i++ ){
				$fields = count( $reviews[ $i ] ) - 1;
				for( $j = 0; $j < $fields; $j++ ){
					array_push( $keyArray, $reviews[ $i ]->antwoord[ $j ][ 'name' ] );
				}
			}
			
			/**
			 * Clean up the keyArray leaving only unique values
			 **/
			$keyArray = array_unique( $keyArray );
			$keyArray = array_values( $keyArray );
			$blacklist = 'id'; // Keys that we have no use for due to the data they store
			
			/**
			 * Prepare the option fields based on our remaining keys
			 **/
			foreach( $keyArray as $key ){
				if( ! containsWord( $blacklist, $key ) ){ // If the key is not in our blacklist, add an option for it
					$result .= "<option value='" . $key . "'" . selected( $options[ $dropdown ], $key ) . ">" . ucfirst( str_replace( ':', '', $key ) ) . "</option>";
				}
				next( $keyArray ); // Go to the next keyArray element
			}
		}
	}else if( $version == '2' ){ // feed_mobility
		/**
		 * Get the XML feed and prepare the data
		 **/
		if( $options[ 'kvssm_xml_feed_mobility' ] != '' ){
			$data  = kvssm_get_data( 'http://mobiliteit.klantenvertellen.nl/xml/' . $options[ 'kvssm_xml_feed_mobility' ] );
			$xml   = simplexml_load_string( $data );
			$json  = json_encode( $xml );
			$array = json_decode( $json, TRUE );
			
			/**
			 * Prepare empty arrays for filling
			 **/
			$reviews  = array();
			$keyArray = array();
			
			/**
			 * Grab all available reviews
			 **/
			foreach( $array['beoordelingen']['beoordeling'] as $resultaat ){
				array_push( $reviews, $resultaat );
			}
			
			/**
			 * Put the key names into the keyArray
			 **/
			foreach( $reviews as $key => $value ) {
			    foreach( $value as $val ){
			    	if( key( $value ) != 'beschrijving' ){ // We do not add this field, it is always displayed.
			    		array_push( $keyArray, key( $value ) );
			    	}
			    	next( $value ); // Go to the next element
			    }
			}
			
			/**
			 * Clean up the keyArray leaving only unique values
			 **/
			$keyArray = array_unique( $keyArray );
			$keyArray = array_values( $keyArray );
			$blacklist = 'id'; // Keys that we have no use for due to the data they store
			
			/**
			 * Prepare the option fields based on our remaining keys
			 **/
			foreach( $keyArray as $key ){
				if( ! containsWord( $blacklist, $key ) ){ // If the key is not in our blacklist, add an option for it
					$result .= "<option value='" . $key . "'" . selected( $options[ $dropdown ], $key ) . ">" . ucfirst( str_replace( ':', '', $key ) ) . "</option>";
				}
				next( $keyArray ); // Go to the next keyArray element
			}
		}
	}else if( $version == '3' ){ // feed_location_tenant
		/**
		 * Get the XML feed and prepare the data
		 **/
		if( $options[ 'kvssm_xml_feed_location' ] != '' && $options[ 'kvssm_xml_feed_tenant' ] != '' ){
			$data  = kvssm_get_data( 'https://www.klantenvertellen.nl/v1/review/feed.xml?locationId=' . $options[ 'kvssm_xml_feed_location' ] . '&tenantId=' . $options[ 'kvssm_xml_feed_tenant' ] );
			$xml   = simplexml_load_string( $data );
			$json  = json_encode( $xml );
			$array = json_decode( $json, TRUE );
			
			/**
			 * Prepare empty arrays for filling
			 **/
			$reviews  = array();
			$reviewContent = array();
			$keyArray = array();
			
			/**
			 * Grab all available reviews
			 **/
			foreach( $array['reviews']['reviews'] as $resultaat ){
				/**
				 * Grab all available review content
				 **/
				foreach( $resultaat['reviewContent']['reviewContent'] as $content => $value ){
					array_push( $reviewContent, $value ); // Save the content of the review
				}
				array_push( $reviews, $resultaat ); // Save the review
			}
			
			/**
			 * Put the key names of the reviews into the keyArray
			 **/
			foreach( $reviews as $key => $value ) {
			    foreach( $value as $val ){
			    	array_push( $keyArray, key( $value ) );
			    	next( $value );
			    }
			}
			
			/**
			 * Put the key names of the reviewContent into the keyArray
			 **/
			foreach( $reviewContent as $key => $value ){
				foreach( $value as $val ){
					if( key( $value ) == 'questionTranslation'){ // The key is an array containing a question
						if( $val != 'Beschrijf uw ervaring' ){ // We do not add this field, it is always displayed.
							array_push( $keyArray, $val );
						}
					}else{
						array_push( $keyArray, key( $value ) ); // The key was not an array
					}
					next( $value ); // Go to the next element
				}
			}
			
			/**
			 * Clean up the keyArray leaving only unique values
			 **/
			$keyArray = array_unique( $keyArray );
			$keyArray = array_values( $keyArray );
			$blacklist = 'locationId reviewId QuestionType QuestionGroup order reviewContent reviewComments'; // Keys that we have no use for due to the data they store
			
			/**
			 * Prepare the option fields based on our remaining keys
			 **/
			foreach( $keyArray as $key ){
				if( ! containsWord( $blacklist, $key ) ){ // If the key is not in our blacklist, add an option for it
					$result .= "<option value='" . $key . "'" . selected( $options[ $dropdown ], $key ) . ">" . ucfirst( str_replace( ':', '', $key ) ) . "</option>";
				}
				next( $keyArray ); // Go to the next keyArray element
			}
		}
	}
	return $result; // Send the result back
} // End fill_dropdown


/**
 * Custom function to check strings for specific words
 **/
function containsWord($str, $word){
	return !!preg_match('#\b' . preg_quote($word, '#') . '\b#i', $str);
}

/**
 * JavaScript
 **/
function kvssm_form_display( $display = 'Widget - Default' ){
	if( $display == 'Widget - Default' || $display == '1' ){
?>
		<script type='text/javascript'>
			jQuery(document).on('ready', function(){
				jQuery( '.default' ).parent().parent().show();
				jQuery( '.flat' ).parent().parent().hide();
				jQuery( '.review' ).parent().parent().hide();
			});
		</script>
<?php
	}else if($display == 'Widget - Flat' || $display == '2' ){
?>
		<script type='text/javascript'>
			jQuery(document).on('ready', function(){
				jQuery( '.default' ).parent().parent().hide();
				jQuery( '.flat' ).parent().parent().show();
				jQuery( '.review' ).parent().parent().hide();
			});
		</script>
<?php
	}else if( $display == 'Review' || $display == '3' ){
?>
		<script type='text/javascript'>
			jQuery(document).on('ready', function(){
				jQuery( '.widget' ).parent().parent().hide();
				jQuery( '.review' ).parent().parent().show();
			});
		</script>
<?php
	}
}
?>

<!--
	JavaScript to prepare the default shape of the form
-->
<script type='text/javascript'>
	jQuery(document).on( 'ready', function(){
		jQuery( '.flat' ).parent().parent().hide();
		jQuery( '.review' ).parent().parent().hide();
		
		/**
		 * Change the form display depending on what we select in the first dropdown
		 **/
		jQuery( '#shorttype' ).on( 'change', function(){
			var selected = jQuery( this ).val();
			if( selected === '1' ){
				jQuery( '.widget' ).parent().parent().show();
				jQuery( '.flat' ).parent().parent().hide();
				jQuery( '.review' ).parent().parent().hide();
			}else if( selected === '2' ){
				jQuery( '.widget' ).parent().parent().show();
				jQuery( '.default' ).parent().parent().hide();
				jQuery( '.review' ).parent().parent().hide();
			}else if( selected === '3' ){
				jQuery( '.widget' ).parent().parent().hide();
				jQuery( '.review' ).parent().parent().show();
			}
		});
		
		function generate_shortcode(){
			/**
			 * Prepare our variables
			 * @var xml       This is the xml to read our data from
			 * @var xml_mobi  This is the mobility xml to read our data from
			 * @var xml_loc   This is the location field of our xml to read our data from
			 * @var xml_ten   This is the tenant field of our xml to read our data from
			 * @var type      This is the type of shortcode to make
			 * @var limit     This is the amount of reviews to show
			 * @var filter    This is the filter we wish to apply
			 * @var key       This is the key field we wish to display
			 * @var shortcode This is the completed shortcode
			 **/
			var xml       = jQuery( '#kvssm_xml' ).val();
			var xml_mobi  = jQuery( '#kvssm_mobi' ).val();
			var xml_loc   = jQuery( '#kvssm_location' ).val();
			var xml_ten   = jQuery( '#kvssm_tenant' ).val();
			var type      = jQuery( '#shorttype' ).val();
			var limit     = jQuery( '#review_limit' ).val();
			var filter    = jQuery( '#review_filter_col').val() + ',' + jQuery( '#review_filter_val' ).val();
			var key       = jQuery( '#review_key' ).val();
			var shortcode = '[klantenvertellenSideShowMedia ';
			/**
			 * If the XML is not empty add the value, else clear the field
			 **/
			if( xml !== '' ){
				shortcode += 'xmld="' + xml + '"';
			}else if( xml_mobi !== '' ){
				shortcode += 'xmlm="' + xml_mobi + '"';
			}else if( xml_loc !== '' || xml_ten !== '' ){
				shortcode += 'xmll="' + xml_loc + ',' + xml_ten + '"';
			}
			/**
			 * If the type is not empty, add a space then check what our type is an attach the value related to it
			 **/
			if( type !== '' ){
				shortcode += ' ';
				if( type == 1 ){
					shortcode += 'type="widget"';
				}else if( type == 2 ){
					shortcode += 'type="flat"';
				}else if( type == 3 ){
					shortcode += 'type="review"';
					/**
					 * If the limit is not empty add a limit
					 **/
					if( limit !== '' ){
						shortcode += ' limit="' + limit + '"';
					}
					/**
					 * If the filter is not set to the default values append a filter
					 **/
					if( filter != 'noFilter,' ){
						shortcode += ' filter="' + filter + '"';
					}
					/**
					 * If the key is not empty append a key
					 **/
					if( key != 'noKeyField' ){
						shortcode += ' key="' + key + '"';
					}
				}
			}
			shortcode += ']'; // Close the shortcode
			jQuery( '#shortcode_holder' ).text( shortcode ); // Put the shortcode into the textarea for copying
		}
		
		/**
		 * Run the generate_shortcode function on the following actions
		 **/
		jQuery( '#kvssm_xml' ).on( 'keyup paste', function(){
			generate_shortcode();
		});
		
		jQuery( '#kvssm_mobi' ).on( 'keyup paste', function(){
			generate_shortcode();
		});
		
		jQuery( '#kvssm_location' ).on( 'keyup paste', function(){
			generate_shortcode();
		});
		
		jQuery( '#kvssm_tenant' ).on( 'keyup paste', function(){
			generate_shortcode();
		});
		
		jQuery( '#shorttype' ).on( 'change', function(){
			generate_shortcode();
		});
		
		jQuery( '#review_key' ).on( 'change', function(){
			generate_shortcode();
		});
		
		jQuery( '#review_filter_col' ).on( 'change', function(){
			generate_shortcode();
		})
		
		jQuery( '#review_filter_val' ).on( 'keyup paste', function(){
			generate_shortcode();
		});
		
		jQuery( '#review_limit' ).on( 'change keyup paste', function(){
			generate_shortcode();
		});
		
		/**
		 * Keep the color fields at the same values
		 **/
		jQuery( '.widgetGradeColorPicker' ).on( 'change', function(){
			jQuery( '.widgetGradeColor' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.widgetOtherColorPicker' ).on( 'change', function(){
			jQuery( '.widgetOtherColor' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.widgetFlatOtherColorPicker' ).on( 'change', function(){
			jQuery( '.widgetFlatOtherColor' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.averagesBackgroundColorPicker' ).on( 'change', function(){
			jQuery( '.averagesBackgroundColor' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.averagesTextColorPicker' ).on( 'change', function(){
			jQuery( '.averagesTextColor' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.reviewBackgroundColorPicker' ).on( 'change', function(){
			jQuery( '.reviewBackgroundColor' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.reviewTextColorPicker' ).on( 'change', function(){
			jQuery( '.reviewTextColor' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.widgetGradeColor' ).on( 'keyup paste', function(){
			jQuery( '.widgetGradeColorPicker' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.widgetOtherColor' ).on( 'keyup paste', function(){
			jQuery( '.widgetOtherColorPicker' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.widgetFlatOtherColor' ).on( 'keyup paste', function(){
			jQuery( '.widgetFlatOtherColorPicker' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.averagesBackgroundColor' ).on( 'keyup paste', function(){
			jQuery( '.averagesBackgroundColorPicker' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.averagesTextColor' ).on( 'keyup paste', function(){
			jQuery( '.averagesTextColorPicker' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.reviewBackgroundColor' ).on( 'keyup paste', function(){
			jQuery( '.reviewBackgroundColorPicker' ).val( jQuery( this ).val() );
		});
		
		jQuery( '.reviewTextColor' ).on( 'keyup paste', function(){
			jQuery( '.reviewTextColorPicker' ).val( jQuery( this ).val() );
		});
		
		generate_shortcode(); // Generate a shortcode when the document has loaded
	});
</script>

<?php

// Initiate form
$options = get_option( 'kvssm_settings' );
kvssm_form_display( $options[ 'kvssm_select_type' ] );