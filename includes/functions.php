<?php
/**
 * All Functions
 *
 * @author Pluginbazar
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


if ( ! function_exists( 'wpp_is_page' ) ) {
	/**
	 * Return whether a page is $searched_page or not
	 *
	 * @param string $page_for
	 *
	 * @return bool
	 */
	function wpp_is_page( $page_for = 'archive' ) {

		if ( ! in_array( $page_for, array( 'archive' ) ) ) {
			return false;
		}

		$page_id = wpp()->get_option( 'wpp_page_' . $page_for );

		if ( $page_id == get_the_ID() ) {
			return true;
		}

		return false;
	}
}


if ( ! function_exists( 'wpp_get_poll' ) ) {
	/**
	 * Return Single Poll object
	 *
	 * @param bool $poll_id
	 *
	 * @return WPP_Poll
	 * @global WPP_Poll $poll
	 *
	 */
	function wpp_get_poll( $poll_id = false ) {

		return new WPP_Poll( $poll_id );
	}
}


if ( ! function_exists( 'wpp_add_poll_option' ) ) {
	/**
	 * Return poll option HTML
	 *
	 * @param bool $unique_id
	 * @param array $args
	 *
	 * @throws PB_Error
	 */
	function wpp_add_poll_option( $unique_id = false, $args = array() ) {

		global $post;

		if ( ! is_array( $args ) ) {
			$args = array( 'label' => $args );
		}

		$unique_id      = ! $unique_id ? hexdec( uniqid() ) : $unique_id;
		$option_label   = isset( $args['label'] ) ? $args['label'] : '';
		$option_thumb   = isset( $args['thumb'] ) ? $args['thumb'] : '';
		$is_frontend    = isset( $args['frontend'] ) ? $args['frontend'] : false;
		$options_fields = array(
			array(
				'options' => array(
					array(
						'id'          => "poll_meta_options[$unique_id][label]",
						'title'       => esc_html__( 'Option label', 'wp-poll' ),
						'placeholder' => esc_html__( 'Option 1', 'wp-poll' ),
						'type'        => 'text',
						'value'       => $option_label,
					),
					array(
						'id'          => "poll_meta_options[$unique_id][thumb]",
						'title'       => esc_html__( 'Image', 'wp-poll' ),
						'placeholder' => esc_html__( 'Day 1', 'wp-poll' ),
						'type'        => 'media',
						'value'       => $option_thumb,
					),
					array(
						'id'      => "poll_meta_options[$unique_id][shortcode]",
						'title'   => esc_html__( 'Shortcode', 'wp-poll' ),

						'details' => sprintf( '<span class="shortcode tt--hint tt--top" aria-label="Click to Copy">[poller_list poll_id="%s" option_id="%s"]</span>', $post->ID, $unique_id ),
					),
				),
			)
		);

		?>

        <li class="poll-option-single">

			<?php wpp()->PB_Settings()->generate_fields( $options_fields ); ?>

            <div class="poll-option-controls">
                <span class="option-remove" data-status=0><i class="icofont-close"></i></span>
                <span class="option-move"><i class="icofont-drag"></i></span>

				<?php if ( $is_frontend ) : ?>
                    <input type="hidden" name="poll_meta_options[<?php echo esc_attr( $unique_id ); ?>][frontend]"
                           value="<?php echo esc_attr( $is_frontend ); ?>">
                    <span class="option-external tt--hint tt--top"
                          aria-label="<?php esc_attr_e( 'Added on frontend', 'wp-poll' ); ?>"><i
                                class="icofont-tick-boxed"></i></span>
				<?php endif; ?>

                <!--                <span class="option-shortcode" aria-label=""><i class="icofont-code"></i></span>-->
            </div>
        </li>
		<?php
	}
}


if ( ! function_exists( 'wpp' ) ) {
	/**
	 * Return global $wpp
	 *
	 * @return WPP_Functions
	 */
	function wpp() {
		global $wpp;

		if ( empty( $wpp ) ) {
			$wpp = new WPP_Functions();
		}

		return $wpp;
	}
}


if ( ! function_exists( 'wpp_get_poller' ) ) {
	/**
	 * Return poller info
	 *
	 * @return int|mixed
	 */
	function wpp_get_poller() {

		if ( is_user_logged_in() ) {
			return get_current_user_id();
		}

		return wpp_get_ip_address();
	}
}


if ( ! function_exists( 'wpp_get_ip_address' ) ) {
	/**
	 * Return IP Address
	 *
	 * @return mixed
	 */
	function wpp_get_ip_address() {

		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}
}


if ( ! function_exists( 'wpp_poll_archive_class' ) ) {
	/**
	 * Return poll archive class container
	 *
	 * @param string $classes
	 */
	function wpp_poll_archive_class( $classes = '' ) {

		if ( ! is_array( $classes ) ) {
			$classes = explode( "~", str_replace( array( ' ', ',', ', ' ), '~', $classes ) );
		}

		$classes[] = 'archive-poll';

		printf( 'class="%s"', esc_attr( implode( " ", apply_filters( 'wpp_filters_poll_archive_class', $classes ) ) ) );
	}
}


if ( ! function_exists( 'wpp_generate_classes' ) ) {
	/**
	 * Generate and return classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function wpp_generate_classes( $classes = '' ) {

		if ( ! is_array( $classes ) ) {
			$classes = explode( "~", str_replace( array( ' ', ',', ', ' ), '~', $classes ) );
		}

		return implode( " ", apply_filters( 'wpp_generate_classes', array_filter( $classes ) ) );
	}
}


if ( ! function_exists( 'wpp_single_post_class' ) ) {
	/**
	 * Return single post classes
	 *
	 * @param string $classes
	 */
	function wpp_single_post_class( $classes = '' ) {

		if ( ! is_array( $classes ) ) {
			$classes = explode( "~", str_replace( array( ' ', ',', ', ' ), '~', $classes ) );
		}

		$classes[] = sprintf( '%s-single', get_post_type() );

		printf( 'class="%s"', wpp_generate_classes( $classes ) );
	}
}


if ( ! function_exists( 'wpp_options_single_class' ) ) {
	/**
	 * Return options single classes
	 *
	 * @param string $classes
	 * @param WPP_Poll|null $poll
	 */
	function wpp_options_single_class( $classes = '', \WPP_Poll $poll = null ) {

		if ( ! is_array( $classes ) ) {
			$classes = explode( "~", str_replace( array( ' ', ',', ', ' ), '~', $classes ) );
		}

		if ( ! $poll ) {
			global $poll;
		}

		$options_theme = $poll->get_style( 'options_theme' );


		// Check multiple or single vote
		$classes[] = $poll->can_vote_multiple() ? 'wpp-checkbox' : 'wpp-radio';


		// Add Theme class
		$classes[] = sprintf( 'wpp-option-list-%s', $options_theme );


		// Add common class excluding for Theme - 1
		if ( $options_theme != 1 && $options_theme != 2 ) {
			$classes[] = 'wpp-custom';
		}


		// Add checkbox animation class excluding for Theme - 1
		if ( $options_theme != 1 && $options_theme != 2 && $poll->can_vote_multiple() ) {
			$classes[] = sprintf( 'wpp-%s', $poll->get_style( 'animation_checkbox' ) );
		}


		// Add radio animation class excluding for Theme - 1
		if ( $options_theme != 1 && $options_theme != 2 && ! $poll->can_vote_multiple() ) {
			$classes[] = sprintf( 'wpp-%s', $poll->get_style( 'animation_radio' ) );
		}

		printf( 'class="%s"', esc_attr( implode( " ", apply_filters( 'wpp_options_single_class', $classes ) ) ) );
	}
}


if ( ! function_exists( 'wpp_get_template_part' ) ) {
	/**
	 * Get Template Part
	 *
	 * @param $slug
	 * @param string $name
	 * @param array $args
	 */
	function wpp_get_template_part( $slug, $name = '', $args = array() ) {

		$template   = '';
		$plugin_dir = WPP_PLUGIN_DIR;

		/**
		 * Locate template
		 */
		if ( $name ) {
			$template = locate_template( array(
				"{$slug}-{$name}.php",
				"wpp/{$slug}-{$name}.php"
			) );
		}

		/**
		 * Check directory for templates from Addons
		 */
		$backtrace      = debug_backtrace( 2, true );
		$backtrace      = empty( $backtrace ) ? array() : $backtrace;
		$backtrace      = reset( $backtrace );
		$backtrace_file = isset( $backtrace['file'] ) ? $backtrace['file'] : '';

		if ( strpos( $backtrace_file, 'wp-poll-survey' ) !== false && defined( 'WPPS_PLUGIN_DIR' ) ) {
			$plugin_dir = WPPS_PLUGIN_DIR;
		}


		/**
		 * Search for Template in Plugin
		 *
		 * @in Plugin
		 */
		if ( ! $template && $name && file_exists( untrailingslashit( $plugin_dir ) . "/templates/{$slug}-{$name}.php" ) ) {
			$template = untrailingslashit( $plugin_dir ) . "/templates/{$slug}-{$name}.php";
		}


		/**
		 * Search for Template in Theme
		 *
		 * @in Theme
		 */
		if ( ! $template ) {
			$template = locate_template( array( "{$slug}.php", "wpp/{$slug}.php" ) );
		}


		/**
		 * Allow 3rd party plugins to filter template file from their plugin.
		 *
		 * @filter wpp_filters_get_template_part
		 */
		$template = apply_filters( 'wpp_filters_get_template_part', $template, $slug, $name );


		if ( $template ) {
			load_template( $template, false );
		}
	}
}


if ( ! function_exists( 'wpp_get_template' ) ) {
	/**
	 * Get Template
	 *
	 * @param $template_name
	 * @param array $args
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return WP_Error
	 */
	function wpp_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args ); // @codingStandardsIgnoreLine
		}

		/**
		 * Check directory for templates from Addons
		 */
		$backtrace      = debug_backtrace( 2, true );
		$backtrace      = empty( $backtrace ) ? array() : $backtrace;
		$backtrace      = reset( $backtrace );
		$backtrace_file = isset( $backtrace['file'] ) ? $backtrace['file'] : '';

		$located = wpp_locate_template( $template_name, $template_path, $default_path, $backtrace_file );


		if ( ! file_exists( $located ) ) {
			return new WP_Error( 'invalid_data', __( '%s does not exist.', 'woc-open-close' ), '<code>' . $located . '</code>' );
		}

		$located = apply_filters( 'wpp_filters_get_template', $located, $template_name, $args, $template_path, $default_path );

		do_action( 'wpp_before_template_part', $template_name, $template_path, $located, $args );

		include $located;

		do_action( 'wpp_after_template_part', $template_name, $template_path, $located, $args );
	}
}


if ( ! function_exists( 'wpp_locate_template' ) ) {
	/**
	 *  Locate template
	 *
	 * @param $template_name
	 * @param string $template_path
	 * @param string $default_path
	 * @param string $backtrace_file
	 *
	 * @return mixed|void
	 */
	function wpp_locate_template( $template_name, $template_path = '', $default_path = '', $backtrace_file = '' ) {

		$plugin_dir = WPP_PLUGIN_DIR;

		/**
		 * Template path in Theme
		 */
		if ( ! $template_path ) {
			$template_path = 'wpp/';
		}

		if ( ! empty( $backtrace_file ) && strpos( $backtrace_file, 'wp-poll-survey' ) !== false && defined( 'WPPS_PLUGIN_DIR' ) ) {
			$plugin_dir = WPPS_PLUGIN_DIR;
		}

		/**
		 * Template default path from Plugin
		 */
		if ( ! $default_path ) {
			$default_path = untrailingslashit( $plugin_dir ) . '/templates/';
		}

		/**
		 * Look within passed path within the theme - this is priority.
		 */
		$template = locate_template(
			array(
				trailingslashit( $template_path ) . $template_name,
				$template_name,
			)
		);

		/**
		 * Get default template
		 */
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		/**
		 * Return what we found with allowing 3rd party to override
		 *
		 * @filter wpp_filters_locate_template
		 */
		return apply_filters( 'wpp_filters_locate_template', $template, $template_name, $template_path );
	}
}


if ( ! function_exists( 'wpp_pagination' ) ) {
	/**
	 * Return Pagination HTML Content
	 *
	 * @param bool $query_object
	 * @param array $args
	 *
	 * @return array|string|void
	 */
	function wpp_pagination( $query_object = false, $args = array() ) {

		global $wp_query;

		$previous_query = $wp_query;

		if ( $query_object ) {
			$wp_query = $query_object;
		}

		$paged = max( 1, ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1 );

		$defaults = array(
			'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'    => '?paged=%#%',
			'current'   => $paged,
			'total'     => $wp_query->max_num_pages,
			'prev_text' => esc_html__( 'Previous', 'wp-poll' ),
			'next_text' => esc_html__( 'Next', 'wp-poll' ),
		);

		$args           = apply_filters( 'wpp_filters_pagination', array_merge( $defaults, $args ) );
		$paginate_links = paginate_links( $args );

		$wp_query = $previous_query;

		return $paginate_links;
	}
}
