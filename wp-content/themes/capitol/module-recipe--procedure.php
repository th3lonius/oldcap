<article class="procedure container__col-sm-12 container__col-md-8">
  
  <?php if( get_field('serving_tips') ): ?>

    <section>

      <h3 class="recipe-section-title sticky-title">Serving Tips</h3>

      <?php the_field('serving_tips'); ?>

    </section>

  <?php endif; ?>

  <section>

    <h3 class="recipe-section-title sticky-title">Directions</h3>

    <?php the_field('directions'); ?>

  </section>

  <?php if( get_field('cooking_tips') ): ?>

    <section id="cooking-tips">

      <h3 class="recipe-section-title sticky-title">Cooking Tips</h3>

      <?php the_field('cooking_tips'); ?>

    </section>

  <?php endif; ?>

  <?php if( get_field('variations') ): ?>

    <section id="variations">

      <h3 class="recipe-section-title sticky-title">Variations</h3>

      <?php the_field('variations'); ?>

    </section>

  <?php endif; ?>

</article><!-- .procedure -->