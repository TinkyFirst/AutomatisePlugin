</main>
<footer style="background: <?php echo esc_attr( get_option( 'ap_footer_color', '#ffffff' ) ); ?>; color: <?php echo esc_attr( get_option( 'ap_footer_text_color', '#000000' ) ); ?>;">
    <nav class="footer-menu">
        <ul>
            <?php
            $pages = get_option( 'ap_footer_pages', array() );
            foreach ( (array) $pages as $page_id ) {
                $page = get_post( $page_id );
                if ( $page ) {
                    echo '<li><a href="' . esc_url( get_permalink( $page ) ) . '">' . esc_html( $page->post_title ) . '</a></li>';
                }
            }
            ?>
        </ul>
    </nav>
    <div class="copyright">
        <?php echo esc_html( get_option( 'ap_footer_copy' ) ); ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
