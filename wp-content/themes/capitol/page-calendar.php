<?php
  get_header();
?>

<article class="calendar-full col-12-12 no-float">

<?php
  $baseline = date('Y-m-d', strtotime('today'));
  for($i = 0; $i < 42; ++$i) {
?>
  <section class="current-day">

    <header>
     <date><?php echo date('D, M j', strtotime($baseline . '+' . $i .' days')); ?></date>
    </header>
    <ol>
<?php
  $showargs = array(
    'post_type' =>      'showing',
    'orderby' =>        'meta_value_num',
    'meta_key' =>       'startdate',
    'order' => 'ASC',
    'numberposts'=>     -1,
    'posts_per_page'=>  -1,
    'meta_query'  => array(
      'relation' => 'AND',
      array(
        'key'   => 'startdate',
        'value'     =>  strtotime($baseline . '+' . $i .' days'),
        'compare'   => '>=',
      ),
      array(
        'key'   => 'startdate',
        'value'     =>  strtotime($baseline . '+' . ($i+1) .' days'),
        'compare'   => '<=',
      ),
    ),
    'post_status'=>     'publish'
  );
  $shows = new WP_Query( $showargs );
  $tmrwshows = array();
  if ( $shows->have_posts() ) while ( $shows->have_posts() ) : $shows->the_post();
    $filmid = get_post_meta(get_the_ID(), 'filmid')[0];
    if( !in_array($filmid, $tmrwshows) ) {
      array_push($tmrwshows, get_post_meta(get_the_ID(), 'filmid')[0]);
    }
  endwhile;

  foreach( $tmrwshows as $tmrwshow ) {
    $filmargs = array(
      'post_type' =>      'film',
      'numberposts'=>     -1,
      'posts_per_page'=>  -1,
      'meta_key'   => 'agileid',
      'meta_value'     => $tmrwshow,
      'post_status'=>     'publish'
    );
    $films = new WP_Query( $filmargs );
    if ( $films->have_posts() ) while ( $films->have_posts() ) : $films->the_post();
      $agileid = get_post_meta(get_the_ID(), 'agileid')[0];
?>
      <li>
        <h3 class="film-title"><a href="<?php the_field('infolink'); ?>"><?php the_title(); ?></a></h3>
        <a href="<?php the_field('infolink'); ?>"><figure style="background-image: url('<?php the_field('event_image'); ?>');"></figure></a>
        <time>
          <?php
            if ( $shows->have_posts() ) while ( $shows->have_posts() ) : $shows->the_post();
              if(get_post_meta(get_the_ID(), 'filmid')[0] == $agileid) {
          ?>
            <a href="<?php the_field('buylink'); ?>"><?php echo(date('g:ia', get_post_meta(get_the_ID(), 'startdate')[0])); ?></a>
          <?php
              }
            endwhile;
            wp_reset_postdata();
          ?>
        </time>
      </li>
<?php
    endwhile;
  }
?>

    </ol>

  </section>
<?php
  }
?>
</article>

<?php get_footer(); ?>