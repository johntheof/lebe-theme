<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lebe
 */
?>
<?php get_header(); ?>
<?php

$lebe_blog_used_sidebar = lebe_get_option( 'blog_sidebar', 'sidebar-1' );
$blog_frame_width = intval( lebe_get_option( 'blog_frame_width', '1400' ) );
/* Blog Layout */
$lebe_blog_layout = lebe_get_option( 'lebe_blog_layout', 'right' );
if ( ! is_active_sidebar( $lebe_blog_used_sidebar ) ) {
	$lebe_blog_layout = 'full';
}

/* Blog Style */
$lebe_blog_style = lebe_get_option( 'blog-style', 'standard' );

if (( $lebe_blog_layout == 'full' ) || ( $lebe_blog_style == 'modern' )) {
	$lebe_container_class[] = 'blog-page no-sidebar ' . $lebe_blog_style;
} else {
	$lebe_container_class[] = $lebe_blog_layout . '-sidebar has-sidebar blog-page';
}
$lebe_content_class   = array();
$lebe_content_class[] = 'main-content';
if (( $lebe_blog_layout == 'full' ) || ( $lebe_blog_style == 'modern' )) {
	$lebe_content_class[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
} else {
	$lebe_content_class[] = 'col-lg-9 col-md-9 col-sm-8 col-xs-12';
}

$lebe_slidebar_class   = array();
$lebe_slidebar_class[] = 'sidebar';
if (( $lebe_blog_layout != 'full' ) || ( $lebe_blog_style != 'modern' )) {
	$lebe_slidebar_class[] = 'col-lg-3 col-md-3 col-sm-4 col-xs-12';
}

?>
<div class="<?php echo esc_attr( implode( ' ', $lebe_container_class ) ); ?>" style="max-width: <?php echo esc_attr( $blog_frame_width ); ?>px;">
    <div class="container">
		<?php if ( is_search() ) : ?>
            <header class="page-header">
				<?php if ( have_posts() ) : ?>
                    <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'lebe' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php else : ?>
                    <h1 class="page-title"><?php echo esc_html__( 'Nothing Found', 'lebe' ); ?></h1>
				<?php endif; ?>
            </header><!-- .page-header -->
		<?php endif; ?>
        <div class="row">
            <div class="<?php echo esc_attr( implode( ' ', $lebe_content_class ) ); ?>">
				<?php get_template_part( 'templates/blog/blog', $lebe_blog_style ); ?>
            </div>
			<?php if (( $lebe_blog_layout != 'full' ) || ( $lebe_blog_style != 'modern' )): ?>
                <div class="<?php echo esc_attr( implode( ' ', $lebe_slidebar_class ) ); ?>">
					<?php get_sidebar(); ?>
                </div>
			<?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
