<?php
get_header();?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image:  url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            All Events
        </h1>
        <div class="page-banner__intro">
            <p>
                See what is going on
            </p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <?php
    while(have_posts()){
        the_post(); ?>
    <div class="event-summary">
        <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month">
                <?php 
                        $date = get_field('event_date', false, false);
                        $eventDate = new DateTime($date);
                        echo $eventDate->format('M');
                        ?>
            </span>
            <span class="event-summary__day">
                <?php echo $eventDate->format('j'); ?></span>
        </a>
        <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?></a></h5>
            <p>
                <?php echo wp_trim_words(get_the_content(), 18); ?> <a href="#" class="nu gray">Learn more</a></p>
        </div>
    </div>

    <?php   }
         echo paginate_links();
    ?>
    <hr class="section-break">
    <p>Looking for a recap of our past events?<a href="<?php echo site_url('/past-events')?>"> Check out our past events archive.</a> </p>
    
    
</div>
<?php
get_footer();
?>
