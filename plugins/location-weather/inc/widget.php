<?php
// Weather Widget
function sp_location_weather_widget() {
	register_widget( 'sp_location_weather_widget_content' );
}

add_action( 'widgets_init', 'sp_location_weather_widget' );

/**
 * Class sp_location_weather_widget_content
 */
class sp_location_weather_widget_content extends WP_Widget {

	function __construct() {
		parent::__construct( 'sp_location_weather_widget_content', __( 'Location Weather', 'location-weather' ),
			array(
				'description' => __( 'This widget is to display weather.', 'location-weather' )
			)
		);
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget( $args, $instance ) {
		extract( $args );
		$title                    = apply_filters( 'widget_title', $instance['title'] );
		$location_weather_id      = $instance['location_weather_id'];
		$location_weather_city    = $instance['location_weather_city'];
		$location_weather_country = $instance['location_weather_country'];

		echo $before_widget;


		$output = '';
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$output .= '<div class="sp-location-weather-widget">';
		$output .= '<div id="location-weather-widget-' . $location_weather_id . '"></div>';
		$output .= '</div><!--/#widget-->';


		$output .= "<script>
		/*
		 * Location weather
		 */
		jQuery(document).ready(function() {
			loadWeatherWidget$location_weather_id('$location_weather_city','$location_weather_country'); //@params location, woeid
		});

		function loadWeatherWidget$location_weather_id(location, woeid) {
			jQuery.simpleWeather({
				location: location,
				woeid: woeid,
				unit: 'c',
				success: function(weather) {
					for(var i=4;i<weather.forecast.length;i++) {
						html =
						'<img class=\"weather-image\" src=\"'+weather.image+'\">'+'<span class=\"weather-type\">'+weather.currently+'</span><span class=\"weather-temp\"> '+weather.temp+'&deg;'+weather.units.temp+'</span><span class=\"weather-date\">'+weather.forecast[0].date+'</span><span class=\"weather-region\">'+weather.city+', '+weather.country+'</span>';
					}


					jQuery('#location-weather-widget-$location_weather_id').html(html);
				},
				error: function(error) {
					jQuery('#location-weather-widget-$location_weather_id').html('<p>'+error+'</p>');
				}
			});
		}</script>";


		echo $output;

		echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {
		$instance                             = $old_instance;
		$instance['title']                    = strip_tags( $new_instance['title'] );
		$instance['location_weather_id']      = strip_tags( $new_instance['location_weather_id'] );
		$instance['location_weather_city']    = strip_tags( $new_instance['location_weather_city'] );
		$instance['location_weather_country'] = strip_tags( $new_instance['location_weather_country'] );

		return $instance;
	}


	function form( $instance ) {
		$defaults = array(
			'title'                    => '',
			'location_weather_id'      => 1,
			'location_weather_city'    => 'london',
			'location_weather_country' => 'uk',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'location-weather' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   value="<?php echo $instance['title']; ?>" class="widefat"/>
        </p>
        <p>
            <label
                    for="<?php echo esc_attr( $this->get_field_id( 'location_weather_id' ) ); ?>"><?php _e( 'ID', 'location-weather' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'location_weather_id' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'location_weather_id' ) ); ?>"
                   value="<?php echo $instance['location_weather_id']; ?>" style="width:100%;"/>
        </p>
        <p>
            <label
                    for="<?php echo esc_attr( $this->get_field_id( 'location_weather_city' ) ); ?>"><?php _e( 'City', 'location-weather' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'location_weather_city' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'location_weather_city' ) ); ?>"
                   value="<?php echo esc_attr( $instance['location_weather_city'] ); ?>" style="width:100%;"/>
        </p>
        <p>
            <label
                    for="<?php echo esc_attr( $this->get_field_id( 'location_weather_country' ) ); ?>"><?php _e( 'Country', 'location-weather' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'location_weather_country' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'location_weather_country' ) ); ?>"
                   value="<?php echo esc_attr( $instance['location_weather_country'] ); ?>" style="width:100%;"/>
        </p>
        <p>The following fields are available in the <a href="https://shapedplugin.com/plugin/location-weather-pro/">Pro version</a></p>
        <p>
            <label disabled for=""><?php _e( 'Unit', 'location-weather' ); ?></label>
            <select disabled id="" name="">
                <option value="fahrenheit">Fahrenheit</option>
                <option value="celsius">Celsius</option>
            </select>
        </p>
        <p>
            <label disabled for=""><?php _e( 'Auto Location', 'location-weather' ); ?></label>
            <select disabled id="" name="">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </p>
        <p>
            <label disabled for=""><?php _e( 'Date', 'location-weather' ); ?></label>
            <select disabled id="" name="">
                <option value="show">Show</option>
                <option value="hide">Hide</option>
            </select>
        </p>
        <p>
            <label disabled for=""><?php _e( 'Humidity', 'location-weather' ); ?></label>
            <select disabled id="" name="">
                <option value="show">Show</option>
                <option value="hide">Hide</option>
            </select>
        </p>
        <p>
            <label disabled for=""><?php _e( 'Wind', 'location-weather' ); ?></label>
            <select disabled id="" name="">
                <option value="show">Show</option>
                <option value="hide">Hide</option>
            </select>
        </p>

		<?php
	}
}