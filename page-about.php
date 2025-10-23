<?php
get_header();

global $post;
$founder_image = get_field('founder_image');
?>

<main class="about-page">
    <?php while (have_posts()):
        the_post() ?>
        <section class="intro">
            <h1>Welcome to Highness Publishing House</h1>
            <div class="paragraph-wrap">
                <?php the_field("intro_paragraph"); ?>
            </div>
        </section>

        <section class="owner">
            <h2>Meet the founder</h2>
            <div class="image-wrap">
                <img src="<?php echo esc_url($founder_image['url']) ?>" />
            </div>
            <div class="image-caption">
                <h3>Amana Manori</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="paragraph-wrap">
                <?php the_field("founder_text"); ?>
            </div>
        </section>

        <section class="vision">
            <h2>Art Infused Coffee Table Books: Thoughtfully Curated. Exquisitely Designed.</h2>
            <div class="paragraph-wrap">
                <?php the_field("about_paragraph"); ?>
            </div>
        </section>

        <section class="employees">
            <h2>Meet our Collaborators</h2>
        </section>
    <?php endwhile; ?>
</main>

<?php get_footer() ?>

