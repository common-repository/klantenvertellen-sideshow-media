<div class="wrap">
<a href='https://www.sideshowmedia.nl/' target='_blank'><img src='<?php echo plugin_dir_url( __DIR__ ); ?>images/logo-ssm.png' alt='SideShow Media logo' title='Bezoek SideShow Media'/></a>
<?php
function admin_tabs( $current = 'klantenvertellen' ) {
    $tabs = array( 'klantenvertellen' => 'Klantenvertellen', /*'pati&euml;ntenvertellen' => 'Pati&euml;ntenvertellen',*/ 'previews' => 'Previews' );
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=klantenvertellen-ssm&tab=$tab'>$name</a>";

    }
    echo '</h2>';
} // End admin_tabs

if( isset( $_GET['tab'] ) ){
	admin_tabs( $_GET['tab'] ); 
	form_display( $_GET['tab'] );
}else{
	admin_tabs();
	form_display();
} // End if isset

function form_display( $form = 'klantenvertellen' ){
	switch( $form ){
		case "klantenvertellen":
?>
		<form method="post" action="<?php echo esc_html( admin_url( 'options.php' ) ); ?>" autocomplete="off">
			<div style="position:relative;float:right;width:40%;">
				<h2>Generated Shortcode</h2>
				<textarea id="shortcode_holder" title="Copy this shortcode onto your website" style="width:100%;resize:none;" disabled></textarea>
			</div>
<?php
			include_once( plugin_dir_path( __DIR__ ) . 'functions/klantenvertellen-settings.php' );
			settings_fields( 'kvPlugin' );
			do_settings_sections( 'kvPlugin' );
			submit_button();
?>
		</form>
<?php
			break;
		case "patiëntenvertellen": // This is temporarily disabled until we have had the time to work on this page
?>
		<form method="post" action="<?php echo esc_html( admin_url( 'options.php' ) ); ?>" autocomplete="off">
			<div style="position:relative;float:right;width:40%;">
				<h2>Generated Shortcode</h2>
				<textarea id="shortcode_holder" title="Copy this shortcode onto your website" style="width:100%;resize:none;" disabled></textarea>
			</div>
		</form>
<?php
			break;
		case "previews":
			$options = get_option( 'kvssm_settings' );
?>
			<div id="widget-preview" style="width:10%;">
				<h2>Widget - Default:</h2>
<?php
			if( $options[ 'kvssm_xml_feed_default' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmld="' . $options[ 'kvssm_xml_feed_default' ] . '" type="widget"]' );
			}else if( $options[ 'kvssm_xml_feed_mobility' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmlm="' . $options[ 'kvssm_xml_feed_mobility' ] . '" type="widget"]' );
			}else if( $options[ 'kvssm_xml_feed_location' ] != '' && $options[ 'kvssm_xml_feed_tenant' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmll="' . $options[ 'kvssm_xml_feed_location' ] . ',' . $options[ 'kvssm_xml_feed_tenant' ] . '" type="widget"]' );
			}else{
				echo '<h4 style="color:#ff0000;">No XML file selected!</h4>';
			}
?>
			</div>

			<div id="widget-preview-flat">
			<h2>Widget - Flat:</h2>
<?php
			if( $options[ 'kvssm_xml_feed_default' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmld="' . $options[ 'kvssm_xml_feed_default' ] . '" type="flat"]' );
			}else if( $options[ 'kvssm_xml_feed_mobility' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmlm="' . $options[ 'kvssm_xml_feed_mobility' ] . '" type="flat"]' );
			}else if( $options[ 'kvssm_xml_feed_location' ] != '' && $options[ 'kvssm_xml_feed_tenant' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmll="' . $options[ 'kvssm_xml_feed_location' ] . ',' . $options[ 'kvssm_xml_feed_tenant' ] . '" type="flat"]' );
			}else{
				echo '<h4 style="color:#ff0000;">No XML file selected!</h4>';
			}
?>
			</div>

			<div id="review-preview">
			<h2>Review:</h2>
<?php
			if( $options[ 'kvssm_xml_feed_default' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmld="' . $options[ 'kvssm_xml_feed_default' ] . '" type="review" limit="1"]' );
			}else if( $options[ 'kvssm_xml_feed_mobility' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmlm="' . $options[ 'kvssm_xml_feed_mobility' ] . '" type="review" limit="1"]' );
			}else if( $options[ 'kvssm_xml_feed_location' ] != '' && $options[ 'kvssm_xml_feed_tenant' ] != '' ){
				echo do_shortcode( '[klantenvertellenSideShowMedia xmll="' . $options[ 'kvssm_xml_feed_location' ] . ',' . $options[ 'kvssm_xml_feed_tenant' ] . '" type="review" limit="1"]' );
			}else{
				echo '<h4 style="color:#ff0000;">No XML file selected!</h4>';
			}
?>
			</div>
<?php
			break;
	} // End switch
} // End form_display

?>
 
</div><!-- .wrap -->