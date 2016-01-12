<?php
/**
 *	Custom Comment list
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
 * @package wps_prime
 */

/**
 * Function to generate comment list
 *
 * @param array $comment Array obtained by get_comments query.
 * @param array $args The options for the function.
 * @param int   $depth  The depth of the new comment. Must be greater than 0 and less than the value of the 'thread_comments_depth' option set in Settings > Discussion. Default 0.
 */
function wps_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' === $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' !== $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="media mb">
    <?php endif; ?>
    <div class="comment-author vcard media__img">
    <?php if ( 0 !== $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>    
    </div>
    <div class="media__body">
    <h4 class="mb0"><cite class="fn"><?php get_comment_author_link(); ?></cite></h4>
    <?php if ( $comment->comment_approved === '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php esc_attr_x( 'Your comment is awaiting moderation.' ,'wps-prime' ); ?></em>
        <br />
    <?php endif; ?>

    <small data-ui-component="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
			/* translators: 1: date, 2: time */
			printf( esc_html_x( '%1$s at %2$s','wps-prime' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ,'wps-prime' ), '  ', '' );
		?>
    </small>

    <?php comment_text(); ?>
    </div><!-- media__body -->

    <div class="reply">
    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' !== $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php
}
