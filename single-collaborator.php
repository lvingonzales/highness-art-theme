<?php get_header(); ?>

<main class="collaborator-single"> 
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endif ?>
        <div class="title"> 
            <h1><?php echo esc_html(get_the_title()); ?></h1>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
