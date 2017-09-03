<section class="col-4-12 ingredients">

  <?php if( have_rows('ingredients') ): ?>

    <h3 class="recipe-section-title">Ingredients</h3>

    <ul>

    <?php while ( have_rows('ingredients') ) : the_row(); ?>

    <li>
      <span class="quantity">
        <?php

        $output = get_sub_field('quantity');
        $fraction = decimalToFraction($output);

        if (is_float($output)) {

        echo $fraction[0];?>/<?php echo $fraction[1];

        } else {
          echo the_sub_field('quantity');
        }
        ?>
      </span>

      <span class="measurement"><?php the_sub_field('measurement'); ?></span>

      <span class="ingredient"><?php the_sub_field('ingredient'); ?></span>

    </li>

    <?php endwhile; ?>

    </ul>

  <p>*<?php the_field('ingredient_notes'); ?></p>

  <?php endif; ?>

</section><!-- .ingredients -->