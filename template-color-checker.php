<?php
/**
 * Template Name: Color Accessibility Checker
 * Template Post Type: page
 * 
 * This template is used to display the color accessibility checker interface
 */

get_header();

// Get the colors from ACF options
$font_colors = get_field('font-colors', 'option');
$background_colors = get_field('background_colors', 'option');
$object = get_queried_object();
?>

<main class="color-checker-template">
    <div class="container">
        <h1 class="page-title"><?=$object->post_title; ?></h1>
        
        <div class="color-checker-grid">
            <?php if ($background_colors && $font_colors) : ?>
                <?php foreach ($background_colors as $bg) : ?>
                    <div class="color-combination-group" style="background-color: <?php echo esc_attr($bg['background_color']); ?>">
                        <h2>Background: <?php echo esc_html($bg['background_color']); ?></h2>
                        
                        <?php foreach ($font_colors as $font) : ?>
                            <div class="color-test-text" style="color: <?php echo esc_attr($font['color']); ?>">
                                <p>Text Color: <?php echo esc_html($font['color']); ?></p>
                                <div class="contrast-ratio" data-background="<?php echo esc_attr($bg['background_color']); ?>" data-text="<?php echo esc_attr($font['color']); ?>">
                                    Calculating contrast...
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Please add colors in the Color Accessibility Settings page.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>