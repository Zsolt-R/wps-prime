<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WPS_Prime_2
 */

if ( ! function_exists( 'wps_prime_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @param string $type stores the option that sets the display format of the paging navigation.
	 *
	 * @todo Create option to set either page links or page numbers from theme option panel
	 */
	function wps_prime_paging_nav( $type = 'link' ) {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		// Setup vars.
		$output = '';

		// Check type of pagination.
		if ( 'link' === $type ) {

			$output .= '<nav class="navigation paging-navigation" role="navigation">';
			$output .= '<h1 class="screen-reader-text">'. esc_html__( 'Posts navigation', 'wps-prime' ) .'</h1>';
			$output .= '<div class="nav-links">';
			$output .= get_next_posts_link() ? '<div class="nav-previous">'. get_next_posts_link( sprintf( esc_html__( '%1$s Older posts', 'wps-prime' ),'<span class="meta-nav">&larr;</span>' ) ).'</div>' : '';
			$output .= get_previous_posts_link() ? '<div class="nav-next">'. get_previous_posts_link( sprintf( esc_html__( 'Newer posts %1$s', 'wps-prime' ),'<span class="meta-nav">&rarr;</span>' ) ) .'</div>' : '';
			$output .= '</div><!-- .nav-links -->';
			$output .= '</nav><!-- .navigation -->';

		} else {

			$output = '<div class="navigation paging-numbered-navigation">'. paginate_links() .'</div>';

		}
			echo $output;
	}
endif;

if ( ! function_exists( 'wps_prime_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function wps_prime_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'wps-prime' ); ?></h1>
        <div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'wps-prime' ) );
				next_post_link( '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'wps-prime' ) );
			?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'wps_prime_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function wps_prime_posted_on() {

		$meta_setting = wps_get_theme_option( 'article_meta_visibility' );

		$meta_u_time_visibility = wps_get_theme_option( 'u_time_visibility' );
		if ( $meta_setting ) {
			return;
		}

		echo '<div class="entry-meta-content">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) && 'show' === $meta_u_time_visibility ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> | <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date','wps-prime' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author','wps-prime' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span> <span class="byline">' . $byline . '</span>'; // WPCS: XSS OK.

		echo '</div>';

	}
endif;

if ( ! function_exists( 'wps_prime_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function wps_prime_entry_footer() {

		$meta_setting = wps_get_theme_option( 'article_meta_visibility' );
		if ( $meta_setting ) {
			return;
		}

		echo '<div class="entry-meta-content">';

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'wps-prime' ) );
			if ( $categories_list && wps_prime_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wps-prime' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'wps-prime' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wps-prime' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'wps-prime' ), esc_html__( '1 Comment', 'wps-prime' ), esc_html__( '% Comments', 'wps-prime' ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'wps-prime' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);

		echo '</div>';
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'wps_prime_categorized_blog' ) ) :
	function wps_prime_categorized_blog() {
		if ( ( $all_the_cool_cats = get_transient( 'wps_prime_categories' ) ) === false ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );
	
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
	
			set_transient( 'wps_prime_categories', $all_the_cool_cats );
		}
	
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so wps_prime_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so wps_prime_categorized_blog should return false.
			return false;
		}
	}
endif;

/**
 * Flush out the transients used in wps_prime_categorized_blog.
 */
if ( ! function_exists( 'wps_prime_category_transient_flusher' ) ) :
	function wps_prime_category_transient_flusher() {
	
		// Like, beat it.
		delete_transient( 'wps_prime_categories' );
	}
endif;
add_action( 'edit_category', 'wps_prime_category_transient_flusher' );
add_action( 'save_post',     'wps_prime_category_transient_flusher' );
