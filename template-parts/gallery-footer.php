<div class="flex-hold gallery-footer allupper">
  <div class="left">
    <?php if(!empty($next_post)) : ?>
      <h6>
        <a href="<?php the_permalink($next_post->ID); ?>" title="<?php echo $next_post->post_title; ?>">
          <i class="icon-left-bold"></i>
          <span class="label"><?php echo $next_post->post_title; ?></span>
        </a>
      </h6>
    <?php endif; ?>
  </div>
  <div class="right">
    <?php if(!empty($prev_post)) : ?>
      <h6>
        <a href="<?php the_permalink($prev_post->ID); ?>" title="<?php echo $prev_post->post_title; ?>">
          <i class="icon-right-bold"></i>
          <span class="label"><?php echo $prev_post->post_title; ?></span>
        </a>
      </h6>
    <?php endif; ?>
  </div>
</div>
