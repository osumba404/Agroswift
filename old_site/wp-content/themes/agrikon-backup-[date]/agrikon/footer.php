<?php
        /**
        * The template for displaying the footer.
        *
        * Contains the closing of the #content div and all content after
        *
        * @package agrikon
        */

        do_action( 'agrikon_before_main_footer' );

        // Elementor `footer` location
        if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
            /**
            * Hook: agrikon_footer_action.
            *
            * @hooked agrikon_copyright - 20
            */
            do_action( 'agrikon_footer_action' );
        }

        echo '</div>';// .page-wrapper

        do_action( 'agrikon_after_main_footer' );

        do_action( 'agrikon_before_wp_footer' );

        wp_footer();

        ?>
    </body>
</html>
