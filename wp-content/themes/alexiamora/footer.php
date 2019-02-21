
	<footer>
		<ul>
			<li><?php _e('Síguenos en: ', 'alexiamora');?></li>

			<?php
			$facebook_contact = of_get_option('facebook_contact','');
			$twitter_contact = of_get_option('twitter_contact','');
			$linkedin_contact = of_get_option('linkedin_contact', '');
			$google_plus_contact = of_get_option('google_plus_contact','');
			$email_contact = of_get_option('email_contact','');
			$direccion_contact = of_get_option('direccion_contact','');

			if( $facebook_contact ) { ?>
			<li class="autor_fb">
				<a target="_blank" class="icon-facebook" title="Facebook" href="http://<?php echo $facebook_contact;?>"></a>
			</li>
			<?php };?>

			<li class="autor_feed">
				<a target="_blank" class="icon-rss" title="RSS" href="<?php bloginfo('rss2_url');?>"></a>
			</li>

			<?php if( $google_plus_contact ) { ?>
			<li class="autor_google">
				<a target="_blank" class="icon-google-plus" title="Google+" href="http://<?php echo $google_plus_contact;?>"></a>
			</li>
			<?php };

			if( $twitter_contact ) { ?>
			<li class="autor_tw">
				<a target="_blank" class="icon-twitter" title="Twitter" href="http://<?php echo $twitter_contact;?>"></a>
			</li>
			<?php };

			if( $email_contact ) { ?>
			<li class="autor_mail">
				<a target="_blank" class="icon-mail" title="E-Mail" href="mailto:<?php echo $email_contact;?>"></a>
			</li>
			<?php };?>
		</ul>

		<?php if( $direccion_contact ) { ?>
		<address>
			<?php echo $direccion_contact;?>
		</address>
		<?php };?>
		<div class="copyright">
			&copy; <?php echo date('Y '); bloginfo('name'); _e('. Todos los derechos reservados.', 'alexiamora');?>
		</div>

		<a class="ir_arriba" id="ir_arriba" href="#">^</a>
	</footer>
</div><!-- #wrapper -->
<?php if (wp_is_mobile()==false) { ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/scripts.js"></script>
<?php } else { // Para desactivar el script del parallax  ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/scripts.movil.js"></script>
<?php };?>
<?php wp_footer();?>
</body>
</html>
