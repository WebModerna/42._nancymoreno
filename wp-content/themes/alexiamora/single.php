<?php
	$post = $wp_query->post;
	if ('post_type' == 'post_type_obra')
	{
		include ( TEMPLATEPATH.'/single-post_type_obra.php' );
	}
	elseif ('post_type' == 'eventos')
	{
		include ( TEMPLATEPATH.'/single-eventos.php' );
	}
	else
	{
		include ( TEMPLATEPATH.'/single-default.php' );
	}
;?>