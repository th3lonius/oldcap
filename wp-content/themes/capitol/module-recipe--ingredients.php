<section class="col-4-12 ingredients sticky-section">

  <?php if( have_rows('ingredients') ): ?>

    <h3 class="recipe-section-title sticky-title">Ingredients</h3>

    <ul>

    <?php while ( have_rows('ingredients') ) : the_row(); ?>

    <li>
      <span class="quantity"><?php the_sub_field('quantity'); ?></span>

      <span class="measurement"><?php the_sub_field('measurement'); ?></span>

      <span class="ingredient"><?php the_sub_field('ingredient'); ?></span>

    </li>

    <?php endwhile; ?>

    </ul>

  <p>*<?php the_field('ingredient_notes'); ?></p>

  <?php endif; ?>

</section><!-- .ingredients -->