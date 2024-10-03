<?php
add_action( 'admin_footer', 'rs_author_info_box_admin_footer_ads' );
function rs_author_info_box_admin_footer_ads(){
	?>
	<div class="rs-author-info-box-admin-footer-ad-wrapper" id="rswpbs-banner-ad">
		<div class="rs-author-info-box-admin-footer-ad-inner">
			<div class="close-popup">
				<div class="rswpbs-banner-close"><span class="dashicons dashicons-no-alt"></span></div>
			</div>
			<div class="rs-author-info-box-ad-image image-left">
				 <img src="<?php echo esc_url( RS_AUTHOR_INFO_BOX_PLUGIN_URL . 'includes/install-rswpbs/author-portfolio-pro-thumb.png' );?>" alt="<?php esc_attr_e('RS WP BOOK SHOWCASE', 'rs-author-info-box');?>">
			</div>
			<div class="rs-author-info-box-ad-content">
			    <h2><?php esc_html_e('Take Your Book Display to the Next Level!', 'rs-author-info-box'); ?></h2>
			    <p><?php esc_html_e('Do you feature books on your website? Make them stand out with the RS WP Book Showcase Plugin – a must-have plugin for authors, bloggers, and publishers.', 'rs-author-info-box'); ?></p>
			    <ul>
			        <li>✅ <?php esc_html_e('Showcase your books in a stunning, organized layout.', 'rs-author-info-box'); ?></li>
			        <li>✅ <?php esc_html_e('Customize it to fit your website\'s unique style.', 'rs-author-info-box'); ?></li>
			        <li>✅ <?php esc_html_e('Boost engagement with a user-friendly, mobile-responsive design.', 'rs-author-info-box'); ?></li>
			    </ul>
			    <p><?php esc_html_e('And the best part? It\'s FREE to install!', 'rs-author-info-box'); ?></p>
			    <p><strong><?php esc_html_e('Unlock a beautiful book showcase with just one click.', 'rs-author-info-box'); ?></strong><br>
			    <?php esc_html_e('Click', 'rs-author-info-box'); ?> <strong><?php esc_html_e('Install Now', 'rs-author-info-box'); ?></strong> <?php esc_html_e('and start transforming your book display today!', 'rs-author-info-box'); ?></p>
			    <a class="rswpbs-install" href="#"><?php esc_html_e('Install Now', 'rs-author-info-box'); ?></a>
			    <a class="rswpbs-learn-more" target="_blank" href="<?php echo esc_url('https://rswpthemes.com/rs-wp-book-showcase-wordpress-plugin/');?>"><?php esc_html_e('View Details', 'rs-author-info-box'); ?></a>
			</div>
		</div>
	</div>
	<?php
}

/**************************
 *   RSWPBS Installer
 **************************/

 //Admin Enqueue for Admin
function rs_author_info_box_install_rswpbs(){
	wp_enqueue_style( 'rs-author-info-box-rswpbs-install', RS_AUTHOR_INFO_BOX_PLUGIN_URL . '/includes/install-rswpbs/install-rswpbs.css' );
	wp_enqueue_script( 'rs-author-info-box-rswpbs-installer', RS_AUTHOR_INFO_BOX_PLUGIN_URL . '/includes/install-rswpbs/install-rswpbs.js', array( 'jquery' ), '', true );
    wp_localize_script( 'rs-author-info-box-rswpbs-installer', 'rs_author_info_box_rswpbs_ajax_object',
        array(
        	'ajax_url' => admin_url( 'admin-ajax.php' ),
        	'nonce'    => wp_create_nonce('rswpbs_install_nonce')
        ),
    );
}
add_action( 'admin_enqueue_scripts', 'rs_author_info_box_install_rswpbs' );

add_action( 'wp_ajax_install_rswpbs_plugin', 'rs_author_info_box_rswpbs_install_plugin' );

function rs_author_info_box_rswpbs_install_plugin() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    if ( ! file_exists( WP_PLUGIN_DIR . '/rs-wp-books-showcase' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'rs-wp-books-showcase' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );
        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'rs-wp-books-showcase/rs-wp-books-showcase.php' );
    }
}
