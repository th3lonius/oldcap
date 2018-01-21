<?php $image = get_field('photo');

  if( !empty($image) ){
    
    // vars
    $url = $image['url'];
    $title = $image['title'];
    $alt = $image['alt'];
    $caption = $image['caption'];

    // thumbnail
    $size = 'large';
    $customphoto = $image['sizes'][ $size ];
    $width = $image['sizes'][ $size . '-width' ];
    $height = $image['sizes'][ $size . '-height' ];
    
    ?>

<?php if( get_field('video') ): ?>

<section class="bg-image-intro" data-stellar-background-ratio="2" style="background-image: url(<?php echo $customphoto; ?>);">

<iframe class="video-recipe" width="100%" height="82vh" src="https://www.youtube.com/embed/<?php the_field('video'); ?>?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
  
  <button class="button-play-video"></button>
    
<?php else: ?>

      <section class="bg-image-intro" data-stellar-background-ratio="2" style="background-image: url(<?php echo $customphoto; ?>);">
        
<?php endif; ?>

  <?php } else {

  } ?>