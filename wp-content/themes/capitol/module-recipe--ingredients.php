<article class="ingredients sticky-section container__col-sm-12 container__col-md-4">

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

  <?php if( get_field('ingredient_notes') ): ?>

    <p>*<?php the_field('ingredient_notes'); ?></p>

  <?php endif; ?>

<?php endif; ?>

</article><!-- .ingredients -->