<?php
/**
 * Creates the menu page for the plugin.
 *
 * @package Klantenvertellen_SideShow_Media
 */
 
/**
 * Creates the menu page for the plugin.
 *
 * Provides the functionality necessary for rendering the page corresponding
 * to the menu with which this page is associated.
 *
 * @package Klantenvertellen_SideShow_Media
 */
class Menu_Page {
 
	private $deserializer;

	public function __construct( $deserializer ) {
		$this->deserializer = $deserializer;
	}
	
	/**
	 * This function renders the contents of the page associated with the menu
	 * that invokes the render method. In the context of this plugin, this is the
	 * menu class.
	 */
	public function render() {
		include_once( 'views/settings.php' );
	}

	public function code( $attr ){
		$options = get_option('kvssm_settings');
		
		/**
		 * Grab the browser
		 **/
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		
		$ua = array(
			'userAgent' => $u_agent,
			'name'	  => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'	=> $pattern
		);
		
		/**
		 * Grab the directory
		 **/
		$dir = plugin_dir_path( __FILE__ );
		if(strpos($dir, 'public_html') !== FALSE) { //HTTP
			$dirA = explode( 'public_html', $dir );
		}else if(strpos($dir, 'private_html') !== FALSE){ //HTTPS
			$dirA = explode( 'private_html', $dir );
		}else if(strpos($dir, 'httpdocs') !== FALSE) { //IIS
			$dirA = explode( 'httpdocs', $dir );
		}else if(strpos($dir, 'html') !== FALSE){ //Google Cloud
			$dirA = explode( 'html', $dir );
		}
		$dir = $dirA[ 1 ];
		if( $dir == '' ){
			$dir = plugin_dir_path( __FILE__ );
		}
		$url = ''; // Prepare an empty URL
		/**
		 * Define the URL variable based on the loaded XML attribute
		 **/
		if( isset( $attr[ 'xmld' ] ) && $attr[ 'xmld' ] != '' ){
			$url = 'https://klantenvertellen.nl/xml/' . $attr[ 'xmld' ] . '/all';
			$variant = '1';
		}else{
			if( isset( $attr[ 'xmlm' ] )  && $attr[ 'xmlm' ] != '' ){
				$url = 'http://mobiliteit.klantenvertellen.nl/xml/' . $attr[ 'xmlm' ];
				$variant = '2';
			}else{
				if( isset( $attr[ 'xmll' ] )  && $attr[ 'xmll' ] != '' ){
					$target = explode( ',', $attr[ 'xmll' ] );
					$url = 'https://www.klantenvertellen.nl/v1/review/feed.xml?locationId=' . $target[0] . '&tenantId=' . $target[1];
					$variant = '3';
				}
			}
		}
		// Check if the URL is empty
		if( $url === '' ){
			return 'No XML has been loaded';
			die();
		}else{
			// We have an XML loaded
			if( isset( $attr[ 'type' ] ) ){ $type = $attr[ 'type' ]; }else{ $type = 'widget'; } // Get the type attribute, if it is not defined default it to a widget block
			// If the above type is a review, prepare these variables
			if( $type == 'review' ){
				if( isset( $attr[ 'limit' ] ) ){ $baseLimit = $limit = $attr[ 'limit' ]; }else{ $baseLimit = $limit = 0; } // If the limit attribute is set use it, else default to showing only the averages
				if( isset( $attr[ 'filter' ] ) ){ $filter = $attr[ 'filter' ]; }else{ $filter = FALSE; } // If the filter attribute is set use it, else default to not using a filter
				if( isset( $attr[ 'key' ] ) ){ $keyCol = $attr[ 'key' ]; }else{ $keyCol = ''; } // If the key attribute is set use it, else default to not using a key
				$reviews  = array();
				$averages = array();
			}
			/**
			 * Start grabbing the XML feed data and prepare it for usage
			 **/
			$ch    = wp_remote_get( $url );
			$data  = wp_remote_retrieve_body( $ch );
			$xml   = simplexml_load_string( $data, null, LIBXML_NOCDATA );
			$average = $total = $aanbevelingP = '';
			switch( $variant ){
				case '1': // Default klantenvertellen
					while($average == ''){ $average      = $xml->statistieken->gemiddelde; }
					while($total == ''){ $total        = $xml->statistieken->aantalbeoordelingen; }
					while($aanbevelingP == ''){ $aanbevelingP = $xml->statistieken->percentageaanbeveling; }
					if( $type == 'review' ){
						foreach( $xml->statistieken->gemiddelden->cijfer as $cijfer ) {
							$col = $cijfer['name'];
							$averages[ "$col" ] = "$cijfer";
						}
						foreach( $xml->resultaten->resultaat as $review ) {
							array_push( $reviews, $review );
						}
					}
					break;
				case '2': // Mobility Klantenvertellen
					$jsonAverages  = json_encode($xml->totaal);
					$arrayAverages = json_decode($jsonAverages);
					while($average == ''){ $average      = $arrayAverages->gemiddelde; }
					while($total == ''){ $total        = $xml->statistieken->aantalingevuld; }
					while($aanbevelingP == ''){ $aanbevelingP = str_replace( '%', '', $xml->statistieken->aanbevolen); }
					if( $type == 'review' ){
						foreach( $arrayAverages as $key => $value ){
							$averages[ "$key" ] = "$value";
						}
						foreach( $xml->beoordelingen->beoordeling as $review ) {
							array_push( $reviews, $review );
						}
					}
					break;
				case '3': // Location Klantenvertellen
					while($average == ''){ $average      = str_replace( '.', ',', $xml->averageRating); }
					while($total == ''){ $total        = $xml->numberReviews; }
					while($aanbevelingP == ''){ $aanbevelingP = $xml->percentageRecommendation; }
					if( $type == 'review' ){
						foreach( $xml->questionRatingAverages->questionRatingAverages as $qAverages ){
							$averages[ "$qAverages->question" ] = "$qAverages->averageRating";
						}
						foreach( $xml->reviews->reviews as $review ) {
							array_push( $reviews, $review );
						}
					}
					break;
			}
			$result = ''; // Prepare our return variable
			switch( $type ){
				case 'widget':
					if($total == ''){ return 'Failed to grab critical data, please reload.'; }
					/**
					 * CSS for Widget Block
					 **/
					$stars = $average / 2;
					$result .= '<style>
					.kvssm-default-widget{
						text-align: center;
						color: ' . $options[ 'kvssm_widget_color_other' ] . '
					}
					.kvssm-default-widget-logo{
						display: inline-block;
						width: 100%;
						height: 85px;
						background: transparent url("' . $dir . 'images/logo-small.png") center center no-repeat;
					}
					.kvssm-default-widget-ratingValue{
						font-size: 32px;
						float: left;
						width: 100%;
						text-align: center;
						color: ' . $options[ 'kvssm_widget_color_grade' ] . ';
						letter-spacing: ' . $options[ 'kvssm_widget_letter_spacing'] . $options['kvssm_widget_letter_spacing_method'] . ';
						margin: ' . $options[ 'kvssm_letter_position_top'] . $options[ 'kvssm_widget_letter_position_top_method' ] . ' 0 0 ' . $options[ 'kvssm_letter_position_left'] . $options[ 'kvssm_widget_letter_position_left_method'] . ';
					}
					.kvssm-default-widget-starContainer{
						position: relative;';
					
					if( $ua['name'] == 'Mozilla Firefox' ){
						$result .= 'display: inline-flex;';
					}else if( $ua['name'] == 'Google Chrome' ){
						$result .= 'display: -webkit-flex;';
					}else{
						$result .= 'display: flex;';
					}
						
					$result .= 'width: 100%;
						height: 10px;
					}
					.kvssm-default-widget-starRating{
						width: 60px;
						margin: auto;
						background-image: url("' . $dir . '/images/stars-small-inactive.png");
					}
					.kvssm-default-widget-stars{
						display: block;
						height: 10px;
						width: ';
						if( $stars != 0 ) {
							$result .= ( 100 - ( 100 / ( $stars * 2 ) ) );
						}
						$result .= '%;
						background-image: url("' . $dir . '/images/stars-small.png");
					}
					.kvssm-default-widget-beoordelingContainer{
						display: -webkit-flex;
						width: 100%;
					}
					.kvssm-default-widget-beoordelingen{
						margin: auto;
					}';
					//CSS markup for non-widescreen screens
					$result .= '
					@media screen and (max-width: 1280px){
						
					}
					</style>';
					/**
					 * Widget block
					 **/
					$result .= '<a class="kvssm-default-widget" target="_blank" href="' . $options[ 'kvssm_widget_link' ] . '">
						<div itemscope itemtype="http://schema.org/Product">
							<meta itemprop="name" content="' . $options[ 'kvssm_company_name' ] . '">
							<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
								<meta itemprop="worstRating" content="0">
								<meta itemprop="bestRating" content="10">
								<span>
									<span class="kvssm-default-widget-logo"><span class="kvssm-default-widget-ratingValue" itemprop="ratingValue">' . $average . '</span></span>
									<span class="kvssm-default-widget-starContainer"><span class="kvssm-default-widget-starRating"><span class="kvssm-default-widget-stars"></span></span></span>
									<span class="kvssm-default-widget-beoordelingContainer">
										<small class="kvssm-default-widget-beoordelingen">
											<span itemprop="reviewCount">' . $total . '</span> beoordelingen
										</small>
									</span>
								</span>
							</div>
						</div>
					</a>';
					break;
				case 'flat':
					if($total == ''){ return 'Failed to grab critical data, please reload.'; }
					/**
					 * CSS for Flat Widget
					 **/
					 $result .= '<style>
					 .kvssm-flat-widget{
					 	background: transparent url("' . $dir . 'images/logo-small-flat.png") left center no-repeat;
					 	background-size: 32px;
					 	color: ' . $options[ 'kvssm_flat_font_color' ] . ';
					 	font-size: ' . $options[ 'kvssm_flat_letter_size' ] . 'px;
					 	padding-left: ' . $options[ 'kvssm_flat_left_padding' ] . $options[ 'kvssm_flat_left_padding_method' ] . ';
					 	line-height: 42px;
						display: inline-block;
					 }';
					//CSS markup for non-widescreen screens
					$result .= '
					@media screen and (max-width: 1280px){
						
					}
					 </style>';
					/**
					 * Widget bar
					 **/
					$result .= '<a class="kvssm-flat-widget" target="_blank" href="' . $options[ 'kvssm_widget_link' ] . '">
						<div itemscope itemtype="http://schema.org/Product">
							<meta itemprop="name" content="' . $options[ 'kvssm_company_name' ] . '">
							<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
								<meta itemprop="worstRating" content="0">
								<meta itemprop="bestRating" content="10">
								<span>
									<span class="kvssm-flat-widget-logo"></span>
									<span class="kvssm-flat-widget-ratingValue" itemprop="ratingValue">' . $average . '</span>
									op Klantenvertellen
									<span class="kvssm-flat-widget-beoordelingContainer">
										<small class="kvssm-flat-widget-beoordelingen">
											(<span itemprop="reviewCount">' . $total . '</span> beoordelingen)
										</small>
									</span>
								</span>
							</div>
						</div>
					</a>';
					break;
				case 'review':
					if($total == ''){ return 'Failed to grab critical data, please reload.'; }
					/**
					 * CSS for Reviews - Averages
					 **/
					$result .= '<style>
					.kvssm-review-averages-container {
						width: 100%;
						background-color: ' . $options[ 'kvssm_review_averages_color_bg' ] . ';
					}
					.kvssm-review-averages-title h1,
					.kvssm-review-averages-amount,
					.kvssm-review-averages-rating,
					.kvssm-review-averages-section,
					.kvssm-review-averages-recomendation-container {
						color: ' . $options[ 'kvssm_review_averages_color_text' ] . ';
					}
					.kvssm-review-averages-title {
						padding: 20px 30px 50px 40px;
					}
					.kvssm-review-averages-title h1 {
						font-size: 24px;
						font-weight: normal;
						margin: 0;
						padding: 0;
						line-height: 1.2em;
						width: 80%;
						display: block;
						float: left;
					}
					.kvssm-review-averages-stats {
						display: table;
						width: 100%;
					}
					.kvssm-review-averages-score-holder, .kvssm-averages-review-footer {
						display: table-row;
					}
					.kvssm-review-averages-score, .kvssm-review-averages-section, .kvssm-review-averages-recomendation-container, .kvssm-review-averages-share-options {
						display: table-cell;
						vertical-align: top;
						width: 100%;
					}
					.kvssm-review-averages-rating {
						font-size: 75px;
						text-align: center;
						display: block;
					}
					.kvssm-review-averages-amount {
						font-size: 18px;
						display: block;
						margin-top: 30px;
					}
					.kvssm-review-averages-section {
						width: 95%;
						float: right;
						padding: 20px 20px;
						font-size: 14px;
						background-color: rgba(255,255,255,0.10);
					}
					.kvssm-review-averages-section ul, .kvssm-review-averages-section ul li {
						margin: 0;
						padding: 0;
						list-style: none;
					}
					.kvssm-review-averages-section ul li {
						width: 100%;
						float: none;
					}
					.kvssm-review-averages-section ul li:nth-child( odd ) {
						margin-right: 5%;
					}
					.kvssm-review-averages-section ul li .kvssm-review-averages-section-label {
						width: 90%;
						float: left;
					}
					.kvssm-review-averages-section ul li .kvssm-review-averages-section-rating {
						width: 10%;
						float: right;
						text-align: right;
					}
					.kvssm-review-averages-recomendation-container, .kvssm-review-averages-share-options {
						vertical-align: middle;
						text-align: center;
					}
					.kvssm-review-averages-recomendation-container {
						width: 100%;
						height: 100%;
						float: left;
						position: relative;
						padding: 20px 0px 20px 0px;
						font-size: 19px;
						background-color: rgba(0,0,0,0.30);
					}';
					// Only add the rest of the CSS if a limit has been set
					if( $limit > 0 ){
						 /**
						 * CSS for Reviews - Review
						 **/
						$result .= '
						.kvssm-review-container-noscroll {
							height: 430px;
							overflow: hidden;
						}
						.kvssm-review-container {
							max-height: 100%;
							margin-right: -17px;
							overflow: auto;
						}
						.kvssm-review-amount,
						.kvssm-review-rating,
						.kvssm-review,
						.kvssm-review h2{
							color: ' . $options[ 'kvssm_review_reviews_color_text' ] . ';
						}
						.kvssm-review-score-cf:after {
							clear: both;
						}
						.kvssm-review-score-cf:before, .kvssm-review-score-cf:after {
							content: " ";
							display: table;
						}
						.kvssm-review {
							margin: 20px 0 60px 0;
							background-color: ' . $options[ 'kvssm_review_reviews_color_bg' ] . ';
						}
						.kvssm-review-body {
							position: relative;
						}
						.kvssm-review-title {
							padding: 30px 30px 30px 40px;
						}
						.kvssm-review-title h2 {
							font-size: 18px;
							font-weight: normal;
							margin: 0px;
							padding: 0px;
							line-height: 1.2em;
							width: 80%;
							display: block;
							float: left;
						}
						.kvssm-review-date {
							font-size: 14px;
							font-weight: normal;
							margin: 0px;
							padding: 0px;
							line-height: 1.2em;
							float: right;
							width: 20%;
							text-align: right;
							padding-top: 4px;
						}
						.kvssm-review-score{
							display: inline-block;
							width: 40%;
						}
						.kvssm-review-rating {
							font-size: 60px;
							width: 100%;
							text-align: center;
							float: left;
							display: block;
							margin: 30px auto 30px auto;
						}
						.kvssm-review-content {
							background-color: rgba(0,0,0,0.05);
							width: 50%;
							padding: 20px 20px;
							bottom: 0;
							right: 0;
							position: absolute;
							min-height: 100px;
							max-height: 150px;
							overflow: auto;
						}
						.kvssm-review-content p {
							margin: 0px;
							font-size: 14px;
						}
						.kvssm-review-recommend {
							width: 34%;
							padding: 20px 30px 20px 40px;
							font-size: 17px;
							text-align: center;
							background-color: rgba(0,0,0,0.30);
						}
						.kvssm-review-ratings {
							font-size: 14px;
							padding: 20px 40px;
							background-color: rgba(0,0,0,0.21);
						}
						.kvssm-review-ratings ul {
							list-style-type: disc;
							columns: 2;
							-webkit-columns: 2;
							-moz-columns: 2;
							list-style-position: inside;
							-webkit-column-gap: 20px;
							-moz-column-gap: 20px;
							column-gap: 20px;
						}
						.kvssm-review-ratings ul, .kvssm-review-ratings ul li {
							margin: 0px;
							padding: 0px;
							list-style: none;
						}
						.kvssm-review-ratings ul li .kvssm-review-score-label {
							width: 90%;
							float: left;
						}
						.kvssm-review-ratings ul li .kvssm-review-score-rating {
							width: 10%;
							float: right;
							text-align: right;
						}';
					 }
					//CSS markup for non-widescreen screens
					$result .= '
					@media screen and (max-width: 1280px){
						
					}
					</style>'; // Close the CSS styling
					/**
					 * Reviews
					 **/
					$result .= '<div class="kvssm-review-averages-container">
						<div class="kvssm-review-averages">
							<div class="kvssm-review-averages-title">
								<h1>Beoordelingen <span itemprop="itemreviewed">' . $options[ 'kvssm_company_name' ] . '</span></h1>
							</div>
							<div class="kvssm-review-averages-stats">
								<div class="kvssm-review-averages-score-holder">
									<div class="kvssm-review-averages-score">
										<span class="kvssm-review-averages-rating">' . $average . '<span class="kvssm-review-averages-amount"> met <span itemprop="votes">' . $total. '</span> beoordelingen</span></span>
										<div class="kvssm-review-averages-righthand" itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">
											<meta itemprop="average" content="' . $average . '">
											<meta itemprop="best" content="10">
											<meta itemprop="worst" content="1">
										</div>
									</div>
								</div>
								<div class="kvssm-review-averages-section">
									<ul>';
									foreach( $averages as $avrg => $value ){
										if($avrg != 'gemiddelde'){
										$result .= '<li class="kvssm-review-averages-section-cf">
											<span class="kvssm-review-averages-section-label">' . $avrg . '</span>
											<span class="kvssm-review-averages-section-rating">' . $value . '</span>
										</li>';
										}
										next( $averages );
									}
						$result .= '</ul>
								</div>
								<div class="kvssm-review-averages-footer">
									<div class="kvssm-review-averages-recomendation-container">' . $aanbevelingP . '% beveelt ' . $options[ 'kvssm_company_name' ] . ' aan</div>
									<div class="kvssm-review-averages-share-options"></div>
								</div>
							</div>
						</div>
					</div>';
					/**
					 * If a limit has been set, add the amount of reviews requested
					 **/
					if( $limit > 0 ){
						if( $limit > 1 ){ $result .= '<div class="kvssm-review-container-noscroll"><div class="kvssm-review-container">'; }
						$posted = 0; // Prepare posted with value 0 for the filter limitations
						for( $i = 0; $i < $limit; $i++ ){
							switch( $variant ){
								case '1': // Default Klantenvertellen
									$fields    = count($reviews[$i]);
									for( $j = 0; $j < $fields; $j++ ){
										if( $reviews[ $i ]->antwoord[ $j ][ 'name' ] == 'Voornaam:' ){
											$author = ucfirst( $reviews[ $i ]->antwoord[ $j ] );
										}
										if( $reviews[ $i ]->antwoord[ $j ][ 'name' ] == 'uit:' ){
											$city = ucfirst( $reviews[ $i ]->antwoord[ $j ] );
										}
										if( $reviews[ $i ]->antwoord[ $j ][ 'name' ] == 'datum' ){
											$date = $reviews[ $i ]->antwoord[ $j ];
										}
										if( $reviews[ $i ]->antwoord[ $j ][ 'name' ] == 'Ervaring:' ){
											$content = ucfirst( $reviews[ $i ]->antwoord[ $j ] );
										}
										if( $reviews[ $i ]->antwoord[ $j ][ 'name' ] == 'Aanbeveling:' ){
											$recommend = $reviews[ $i ]->antwoord[ $j ];
										}
										if( $reviews[ $i ]->antwoord[ $j ][ 'name' ] == 'Gemiddelde' ){
											$gemiddelde = $reviews[ $i ]->antwoord[ $j ];
										}
										/**
										 * Put all grades into a new array
										 **/
										foreach( $averages as $avrgs => $value ){
											if( $reviews[ $i ]->antwoord[ $j ][ 'name' ] == $avrgs ){
												$col = $reviews[ $i ]->antwoord[ $j ][ 'name' ];
												$grades[ "$col" ] = $reviews[ $i ]->antwoord[ $j ];
											}
										}
										if( $keyCol != '' ){
											if( $reviews[ $i ]->antwoord[ $j ][ 'name' ] == $keyCol ){
												$keyVal = $reviews[ $i ]->antwoord[ $j ];
											}
										}
									}
									/**
									 * Make a sentence out of our simple Yes / No answers
									 **/
									if( $recommend == 'ja' ){
										$recommend = 'Ik zou ' . $options[ 'kvssm_company_name' ] . ' aanbevelen!';
									}else if( $recommend == 'nee' ){
										$recommend = 'Ik zou ' . $options[ 'kvssm_company_name' ] . ' niet aanbevelen!';
									}
									break;
								case '2': // Mobility Klantenvertellen
									$author    = ucfirst( $reviews[ $i ]->voornaam ) . ' ' . ucfirst( $reviews[ $i ]->achternaam );
									$city      = ucfirst( $reviews[ $i ]->woonplaats );
									$dateRaw   = $reviews[ $i ]->datum;
									$date      = date('d-m-Y', "$dateRaw");
									$content   = ucfirst( $reviews[ $i ]->beschrijving );
									$reason    = ucfirst( $reviews[ $i ]->redenbezoek );
									$recommend = $reviews[ $i ]->aanbeveling;
									/**
									 * Make a sentence out of our simple Yes / No answers
									 **/
									if( $recommend == 'ja' ){
										$recommend = 'Ik zou ' . $options[ 'kvssm_company_name' ] . ' aanbevelen!';
									}else if( $recommend == 'nee' ){
										$recommend = 'Ik zou ' . $options[ 'kvssm_company_name' ] . ' niet aanbevelen!';
									}
									/**
									 * Put all grades into a new array
									 **/
									foreach( $reviews[ $i ] as $review => $value ){
										if( array_key_exists( $review, $averages ) ){
											$grades[ "$review" ] = "$value";
										}
									}
									$gemiddelde = end( $grades ); // The average is our last key
									reset ($grades ); // Reset the index pointer just to be safe
									if( $keyCol != '' ){
										$keyVal = $reviews[ $i ]->$keyCol;
									}
									break;
								case '3': // Location Klantenvertellen
									$author     = $reviews[ $i ]->reviewAuthor;
									$gemiddelde = $reviews[ $i ]->rating;
									foreach( $reviews[ $i ]->reviewContent->reviewContent as $revContent => $value ){
										/**
										 * Make a sentence out of our simple True / False answers
										 **/
										if( $value->questionType == 'BOOLEAN' ){
											switch( $value->rating ){
												case 'true': $recommend = 'Ik zou ' . $options[ 'kvssm_company_name' ] . ' aanbevelen!'; break;
												case 'false': $recommend = 'Ik zou ' . $options[ 'kvssm_company_name' ] . ' niet aanbevelen!'; break;
											}
										}
										/**
										 * Put all grades into a new array
										 **/
										if( $value->questionType == 'INT' ){
											$col = $value->questionTranslation;
											$val = $value->rating;
											$grades[ "$col" ] = "$val";
										}
										/**
										 * Get the review content
										 **/
										if( $value->questionType == 'TEXT' && $value->questionGroup == 'DEFAULT_OPINION' ){
											$content = $value->rating;
										}
										
										if( $keyCol != '' ){
											if( ucfirst( $value->questionTranslation ) == ucfirst( $keyCol ) ){
												$keyVal = $value->rating;
											}
										}
									}
									/**
									 * Adjust our date display
									 **/
									$date   = explode( 'T', $reviews[ $i ]->createDate ); // Remove the time
									$date   = explode( '-', $date[0] ); // Split up the date
									$date   = $date[2] . '-' . $date[1] . '-' . $date[0]; // Attach the dates again in order of Day Month Year
									break;
							}
							
							$keyCol = str_replace( ':', '', $keyCol ); // Remove semicolons from the key column, we add this on our own because not all fields have one
							
							if( $filter !== false ){
								$filterArray = explode( ',', $filter );
								if( $variant == '1' ){
									$fields = count($reviews[$i]);
									for( $j = 0; $j < $fields; $j++){
										$column = $reviews[$i]->antwoord[$j]['name'];
										if($column == $filterArray[0]){
											if( $reviews[$i]->antwoord[$j] == $filterArray[1] ){
												if( $posted != $baseLimit ){
													echo 'Column: '.$column.', Array: '.$filterArray[0].'<br/>';
													$result .= '<div class="kvssm-review">
														<div class="kvssm-review-body">
															<div class="kvssm-review-title">
																<h2>Beoordeeld door: ' . $author . '</h2>
																<meta itemprop="datePublished" content="' . $date . '">
																<span class="kvssm-review-date">' . $date . '</span>
															</div>
															<div class="kvssm-review-score">
																<span class="kvssm-review-rating">' . $gemiddelde . '</span>
															</div>
															<div class="kvssm-review-content"><p>';
															if( $keyCol != 'noKeyField'  && $keyCol != '' ){
																$result .= $keyCol . ':<br/>' . $keyVal . '<br/>';
															}
													$result .= 'Beschrijf uw ervaring:<br/>' . $content .
															'</p></div>
															<div class="kvssm-review-recommend">' . $recommend . '</div>
														</div>
														<div class="kvssm-review-footer">
															<div class="kvssm-review-ratings">
																<ul>';
																foreach( $grades as $grd => $value ){
																	if( $grd != 'gemiddelde' ){
																	$result .= '<li class="kvssm-review-score-cf">
																		<span class="kvssm-review-score-label">' . $grd . '</span>
																		<span class="kvssm-review-score-rating">' . $value . '</span>
																	</li>';
																	}
																	next( $grades );
																}
													$result .= '</ul>
															</div>
														</div>
													</div>';
													$posted++;
												}
											}
										}else{
											$limit++;
										}
									}
								} // End filter variant 1
								else if( $variant == '2' ){
									foreach( $reviews[$i] as $review => $value){
										if($review == $filterArray[0]){
											if($value == $filterArray[1]){
												if( $posted != $baseLimit ){
													$result .= '<div class="kvssm-review">
														<div class="kvssm-review-body">
															<div class="kvssm-review-title">
																<h2>Beoordeeld door: ' . $author . '</h2>
																<meta itemprop="datePublished" content="' . $date . '">
																<span class="kvssm-review-date">' . $date . '</span>
															</div>
															<div class="kvssm-review-score">
																<span class="kvssm-review-rating">' . $gemiddelde . '</span>
															</div>
															<div class="kvssm-review-content"><p>';
															if( $keyCol != 'noKeyField'  && $keyCol != '' ){
																$result .= $keyCol . ':<br/>' . $keyVal . '<br/>';
															}
													$result .= 'Beschrijf uw ervaring:<br/>' . $content .
															'</p></div>
															<div class="kvssm-review-recommend">' . $recommend . '</div>
														</div>
														<div class="kvssm-review-footer">
															<div class="kvssm-review-ratings">
																<ul>';
																foreach( $grades as $grd => $value ){
																	if( $grd != 'gemiddelde' ){
																	$result .= '<li class="kvssm-review-score-cf">
																		<span class="kvssm-review-score-label">' . $grd . '</span>
																		<span class="kvssm-review-score-rating">' . $value . '</span>
																	</li>';
																	}
																	next( $grades );
																}
													$result .= '</ul>
															</div>
														</div>
													</div>';
													$posted++;
												}
											}
										}else{
											$limit++;
										}
									}
								} // End filter variant 2
								else if( $variant == '3' ){
									foreach($reviews[$i] as $review => $value){
										if($review == $filterArray[0]){
											if($value == $filterArray[1]){
												if($posted != $baseLimit){
													$result .= '<div class="kvssm-review">
														<div class="kvssm-review-body">
															<div class="kvssm-review-title">
																<h2>Beoordeeld door: ' . $author . '</h2>
																<meta itemprop="datePublished" content="' . $date . '">
																<span class="kvssm-review-date">' . $date . '</span>
															</div>
															<div class="kvssm-review-score">
																<span class="kvssm-review-rating">' . $gemiddelde . '</span>
															</div>
															<div class="kvssm-review-content"><p>';
															if( $keyCol != 'noKeyField'  && $keyCol != '' ){
																$result .= $keyCol . ':<br/>' . $keyVal . '<br/>';
															}
													$result .= 'Beschrijf uw ervaring:<br/>' . $content .
															'</p></div>
															<div class="kvssm-review-recommend">' . $recommend . '</div>
														</div>
														<div class="kvssm-review-footer">
															<div class="kvssm-review-ratings">
																<ul>';
																foreach( $grades as $grd => $value ){
																	if( $grd != 'gemiddelde' ){
																	$result .= '<li class="kvssm-review-score-cf">
																		<span class="kvssm-review-score-label">' . $grd . '</span>
																		<span class="kvssm-review-score-rating">' . $value . '</span>
																	</li>';
																	}
																	next( $grades );
																}
													$result .= '</ul>
															</div>
														</div>
													</div>';
													$posted++;
												}
											}
										}else{
											$limit++;
										}
									}
									foreach( $reviews[$i]->reviewContent->reviewContent as $reviewC => $value ){
										if($value->questionTranslation == $filterArray[0]){
											if($value->rating == $filterArray[1]){
												if($posted != $baseLimit){
													$result .= '<div class="kvssm-review">
														<div class="kvssm-review-body">
															<div class="kvssm-review-title">
																<h2>Beoordeeld door: ' . $author . '</h2>
																<meta itemprop="datePublished" content="' . $date . '">
																<span class="kvssm-review-date">' . $date . '</span>
															</div>
															<div class="kvssm-review-score">
																<span class="kvssm-review-rating">' . $gemiddelde . '</span>
															</div>
															<div class="kvssm-review-content"><p>';
															if( $keyCol != 'noKeyField'  && $keyCol != '' ){
																$result .= $keyCol . ':<br/>' . $keyVal . '<br/>';
															}
													$result .= 'Beschrijf uw ervaring:<br/>' . $content .
															'</p></div>
															<div class="kvssm-review-recommend">' . $recommend . '</div>
														</div>
														<div class="kvssm-review-footer">
															<div class="kvssm-review-ratings">
																<ul>';
																foreach( $grades as $grd => $value ){
																	if( $grd != 'gemiddelde' ){
																	$result .= '<li class="kvssm-review-score-cf">
																		<span class="kvssm-review-score-label">' . $grd . '</span>
																		<span class="kvssm-review-score-rating">' . $value . '</span>
																	</li>';
																	}
																	next( $grades );
																}
													$result .= '</ul>
															</div>
														</div>
													</div>';
													$posted++;
												}
											}
										}else{
											$limit++;
										}
									}
								} // End filter variant 3
							}else{ // No filter has been set, just display everything
								$result .= '<div class="kvssm-review">
									<div class="kvssm-review-body">
										<div class="kvssm-review-title">
											<h2>Beoordeeld door: ' . $author . '</h2>
											<meta itemprop="datePublished" content="' . $date . '">
											<span class="kvssm-review-date">' . $date . '</span>
										</div>
										<div class="kvssm-review-score">
											<span class="kvssm-review-rating">' . $gemiddelde . '</span>
										</div>
										<div class="kvssm-review-content"><p>';
										if( $keyCol != 'noKeyField'  && $keyCol != '' ){
											$result .= $keyCol . ':<br/>' . $keyVal . '<br/>';
										}
								$result .= 'Beschrijf uw ervaring:<br/>' . $content .
										'</p></div>
										<div class="kvssm-review-recommend">' . $recommend . '</div>
									</div>
									<div class="kvssm-review-footer">
										<div class="kvssm-review-ratings">
											<ul>';
											foreach( $grades as $grd => $value ){
												if( $grd != 'gemiddelde' ){
												$result .= '<li class="kvssm-review-score-cf">
													<span class="kvssm-review-score-label">' . $grd . '</span>
													<span class="kvssm-review-score-rating">' . $value . '</span>
												</li>';
												}
												next( $grades );
											}
								$result .= '</ul>
										</div>
									</div>
								</div>';
							}
						}
						if( $limit > 1 ){ $result .= '</div></div>'; }
					}
				break;
			}
			return $result; // Return the result
		}
	}
}

add_shortcode( 'klantenvertellenSideShowMedia', array( 'Menu_Page', 'code' ) );