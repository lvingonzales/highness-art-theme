<?php
get_header();

global $post;

$founder_image = get_field('founder_image');
$vishana_group = get_field("vishana_group");
$magda_group = get_field("magda_group");
$joseph_group = get_field("joseph_group");
$ann_group = get_field("ann_group");

$groups = array($vishana_group, $magda_group, $joseph_group, $ann_group);
?>

<main class="about-page">
    <?php while (have_posts()):
        the_post() ?>
        <section class="intro-about">
            <div class="intro-wrap">
                <h1>Welcome to Highness Publishing House</h1>
                <div class="paragraph-wrap">
                    <?php the_field("intro_paragraph"); ?>
                </div>
            </div>
        </section>

        <section class="founder">
            <div class="founder-wrap">
                <div class="image-wrap">
                    <img class="founder-img" src="<?php echo esc_url($founder_image['url']) ?>" />
                    <div class="image-caption">
                        <h3>Amana Manori</h3>
                        <p>Founder & CEO</p>
                    </div>
                </div>
                <div class="founder-info-wrap">
                    <h2>Meet the founder</h2>
                    <div class="paragraph-wrap">
                        <?php the_field("founder_text"); ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="vision">
            <div class="vision-wrap">
                <h2>Art Infused Coffee Table Books: Thoughtfully Curated. Exquisitely Designed.</h2>
                <div class="paragraph-wrap">
                    <?php the_field("about_paragraph"); ?>
                </div>
            </div>
        </section>

        <section class="employees">
            <div class="employee-wrap">
                <h2>Meet our Collaborators</h2>
                <div class="list-wrap">
                    <ul class="employee-list">
                        <?php
                        if ($groups):
                            foreach ($groups as $group):
                                $image = $group['image'] ?? null;
                                $link = $group['link'] ?? null;
                                $label = $group['label'] ?? null;
                                if ($image && $link):
                                    ?>
                                    <li class="collab-card">
                                        <div class="deco-bg"></div>
                                        <a href="<?php echo esc_url($link['url']);?>">
                                            <img src="<?php echo esc_url($image['url']) ?>" alt="" class="collab-img">
                                            <div class="text-wrap">
                                                <h3 class="light"><?php echo esc_html($label) ?></h3>
                                                <h3><?php echo esc_html($link['title']) ?></h3>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>

<?php get_footer() ?>

