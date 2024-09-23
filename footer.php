<?php
// Paperplane _blankTheme - template per footer.
//wp_reset_query();
?>
</div><!-- body-shaper closing tag -->
<footer id="footer" class="delight-area bg-5 txt-1 menu">
	<div class="wrapper">
		<div class="wrapper-padded">
			<?php if ( get_field( 'footer_additional_texts', 'options' ) ) : ?>
				<div class="flex-hold flex-hold-2 margins-wide">
					<div class="flex-hold-child">
						<?php the_field( 'credits_and_more', 'options' ); ?>
					</div>
					<div class="flex-hold-child right">
						<?php the_field( 'footer_additional_texts', 'options' ); ?>
					</div>
				</div>
			<?php else : ?>
				<?php the_field( 'credits_and_more', 'options' ); ?>
			<?php endif; ?>
		</div>
	</div>
</footer>
<div class="loading-transition-effect bg-5">
	<div class="spinner-in flex-hold verticalize">
		<div class="spinner">
			<div class="bounce1 bg-2"></div>
			<div class="bounce2 bg-2"></div>
			<div class="bounce3 bg-2"></div>
		</div>
	</div>
</div>
</div>
</div><!-- swup closing tag -->
<script type="text/javascript">
	var SWIPE_THRESHOLD = 60, // default value
		DBL_TAP_THRESHOLD = 200, // range of time in which a dbltap event could be detected,
		LONG_TAP_THRESHOLD = 1000, // range of time after which a longtap event could be detected
		TAP_THRESHOLD = 150, // range of time in which a tap event could be detected
		TAP_PRECISION = 60 / 2, // default value (touch events boundaries)
		JUST_ON_TOUCH_DEVICES = false, // default value ( decide whether you want to use the Tocca.js events only on the touch devices )
		IGNORE_JQUERY = false; // default value ( will not use jQuery events, even if jQuery is detected )
</script>
<?php wp_footer(); ?>

</body>

</html>