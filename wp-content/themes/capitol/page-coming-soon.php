<?php
  get_header();
  $categ = get_category(4);
  $taxonomy = $categ->taxonomy;
  $term_id = $categ->term_id;
  $catcolor = get_field("series_color", $taxonomy . '_' . $term_id);
  $catheadimg = get_field("header_image", $taxonomy . '_' . $term_id);
?>

<article class="series-archive" data-type="background" data-speed="20" data-background="<?php echo($catheadimg["url"]); ?>">

  <div class="gradient-overlay"></div>

  <section class="col-6-12 series-intro">

    <h1 class="series-title" style="color:<?php echo($catcolor); ?>;"><?php echo($categ->name); ?></h1>

    <p><?php echo($categ->description); ?></p>

  </section>

</article>


<article class="series-screenings col-10-12 no-float">

  <section class="films-column">

      <?php
        $showargs = array(
          'post_type' =>      'showing',
          'orderby' =>        'meta_value_num',
          'meta_key' =>       'startdate',
          'order' => 'ASC',
          'numberposts'=>     -1,
          'posts_per_page'=>  -1,
          'category__in' =>   array($categ->term_id),
          'meta_query'  => array(
            array(
              'key'   => 'startdate',
              'value'     =>  strtotime('today midnight'),
              'compare'   => '>=',
            ),
          ),
          'post_status'=>     'publish'
        );
        $shows = new WP_Query( $showargs );
        $catshows = array();
        if ( $shows->have_posts() ) while ( $shows->have_posts() ) : $shows->the_post();
          $filmid = get_post_meta(get_the_ID(), 'filmid')[0];
          if( !in_array($filmid, $catshows) ) {
            array_push($catshows, get_post_meta(get_the_ID(), 'filmid')[0]);
          }
        endwhile;
        foreach( $catshows as $catshow ) {
           $filmargs = array(
              'post_type' =>      'film',
              'numberposts'=>     -1,
              'posts_per_page'=>  -1,
              'meta_key'   => 'agileid',
              'meta_value'     => $catshow,
              'post_status'=>     'publish'
           );
           $films = new WP_Query( $filmargs );

          if ( $films->have_posts() ) while ( $films->have_posts() ) : $films->the_post();
            $agileid = get_post_meta(get_the_ID(), 'agileid')[0];
            $prod_countries = explode(",", get_post_meta(get_the_ID(), 'production_country')[0]);
            $directors = explode(",", get_post_meta(get_the_ID(), 'director')[0]);

        ?>
         <section class="coming-soon col-6-12">
          <figure>
            <img src="<?php the_field('event_image'); ?>" />
            <figcaption style="background:<?php echo($catcolor); ?>;">
              <a href="<?php echo(the_field('infolink')); ?>"><h3 class="film-title"><?php the_title(); ?></h3></a>
              <h4 class="film-meta"><?php the_field('year_released'); echo(' / '); echo($prod_countries[0]); if( count($prod_countries) > 1 ) { echo(" +"); } echo(' / '); echo($directors[0]); if( count($directors) > 1 ) { echo(" +"); } ?></h4>
            </figcaption>
          </figure>
          <a href="#modal" class="trailer" data-video="<?php the_field('trailer'); ?>">
            <span class="video-link"></span>
          </a>
          <?php the_content(); ?>
        </section>
        <?php
          endwhile;
        }
        ?>
  </section>

</article>

<?php get_footer(); ?>