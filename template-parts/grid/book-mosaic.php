<div class="flex-hold-child grid-item-infinite">
	<div class="book-mosaic-item">
		<a href="<?php the_permalink(); ?>">
			<span class="screen-reader-text"><?php the_title(); ?></span>
			<?php
			$image_data = array(
				'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
				'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
				'size_fallback' => 'grid_image_nocrop'
			);
			$image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
				'desktop_retina' => 'grid_image_retina_crop',
				'desktop' => 'grid_image_retina_crop',
				'mobile' => 'grid_image_mobile_crop',
				'mobile_retina' => 'grid_image_mobile_crop',
				'micro' => 'micro'
			);
			print_theme_single_image( $image_data, $image_sizes );
			?>
		</a>
	</div>
</div>