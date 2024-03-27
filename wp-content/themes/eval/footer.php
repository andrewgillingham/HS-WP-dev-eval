			</main>
			<footer class="footer" id="footer" role="contentinfo">
				<div class="footer__content content-container">
					<div>
						<p class="h4"><strong><?php bloginfo( 'name' ); ?></strong></p>
						<p><?php bloginfo( 'description' ); ?></p>
					</div>
					<?php get_template_part( 'template-parts/nav', 'footer' ); ?>
				</div>
			</footer>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>