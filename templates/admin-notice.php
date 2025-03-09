<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0.1
 */
?>
<div class="update-nag" id="studeon_admin_notice">
	<h3 class="studeon_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'studeon'), wp_get_theme()->name); ?></h3>
	<?php
	if (!studeon_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'studeon')); ?></p><?php
	}
	?><p><?php
		if (studeon_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'studeon'); ?></a>
			<?php
		}
		if (function_exists('studeon_exists_trx_addons') && studeon_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'studeon'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'studeon'); ?></a>
        <a href="#" class="button studeon_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'studeon'); ?></a>
	</p>
</div>