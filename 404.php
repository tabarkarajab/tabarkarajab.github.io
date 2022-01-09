<?php get_header(); ?>

<div class="row">

	<div class="col-lg-8 col-12">
		<main id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<div class="row">
				<div class="col-md-12">
					<article class="entry">
						<h1 class="entry-title">
							<?php esc_html_e( 'Page not found' , 'olsen-light' ); ?>
						</h1>

						<div class="entry-content">
							<p><?php esc_html_e( 'The page you were looking for can not be found! Perhaps try searching?', 'olsen-light' ); ?></p>
							<?php get_search_form(); ?>
						</div>
					</article>
				</div>
			</div>
		</main>
	</div>

	<div class="col-lg-4 col-12">
		<?php get_sidebar(); ?>
	</div>

</div>

<?php get_footer(); ?>
