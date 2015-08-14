<?php
get_header();

if($post->post_parent) {
  $parent_id = $post->post_parent;
  $parent = get_post($parent_id);
  $parent_title = $parent->post_title;
} else {
  $parent_id = $post->ID;
  $parent_title = $post->post_title;
}

$args = array(
  'post_parent' => $parent_id,
  'post_type'   => 'page',
  'numberposts' => -1,
  'post_status' => 'publish'
);
$subpages = get_children( $args );

?>

<div class="interior">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>



    <article class="primary-content">

     <h1 class="series-title"><?php echo($parent_title); ?></h1>

      <aside class="col-12-12">
        <ul>
          <?php
            foreach( $subpages as $subpage ){
          ?>
          <li>
            <a href="<?php echo get_template_directory_uri().'/'.$subpage->post_name; ?>">
              <?php echo($subpage->post_title); ?>
            </a>
          </li>
          <?php
            }
          ?>
        </ul>
      </aside>

      <section class="col-8-12">

        <?php the_content(); ?>

      </section>

    </article>

    <article data-type="background" data-speed="12" data-background="<?php echo $src['0']; ?>">

    </article>

    <?php endwhile; ?>


    <?php else : ?>


  <?php endif; ?>

</div><!-- .interior -->

<?php get_footer(); ?>