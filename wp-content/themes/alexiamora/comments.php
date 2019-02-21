<?php
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die (__('Por favor, no cargues esta página directamente. Gracias :-D', 'alexiamora'));
    if ( post_password_required() ) { ?>
        <?php _e('Esta publicación está protegida con contraseña. Ingresá tu usuario y tu password para ver los comentarios.', 'alexiamora');?>
    <?php
        return;
    }
?>
<?php if ( have_comments() ) : ?>
    <h2 id="comments"><?php comments_number(__('No hay respuestas', 'alexiamora'), __('Una Respuesta', 'alexiamora'), __('% Respuestas', 'alexiamora'));?></h2>
    <div class="navigation">
        <div class="next-posts"><?php previous_comments_link() ?></div>
        <div class="prev-posts"><?php next_comments_link() ?></div>
    </div>
    <ol class="commentlist">
        <?php wp_list_comments(); ?>
    </ol>
    <div class="navigation">
        <div class="next-posts"><?php previous_comments_link() ?></div>
        <div class="prev-posts"><?php next_comments_link() ?></div>
    </div>
<?php else : // this is displayed if there are no comments so far ?>
    <?php if ( comments_open() ) : // Si los comentarios están abiertos...bien...pero no hay comentariosa ahora. ?>
    <?php else : // comments are closed ?>
        <p><?php __('Los comentarios están cerrados', 'alexiamora');?></p>
    <?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<div class="los_comentarios">
    <h2><?php comment_form_title( __('Dejar un Comentario', 'alexiamora'), __('Dejar un Comentario a %s', 'alexiamora')); ?></h2>
    <div class="cancel-comment-reply">
        <?php cancel_comment_reply_link(); ?>
    </div>
    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
        <p><?php _e('Debes estar', 'alexiamora');?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logueado', 'alexiamora');?></a> <?php _e('para publicar un comentario', 'alexiamora');?>.</p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    <?php if ( is_user_logged_in() ) : ?>
            <p><?php _e('Logueado como', 'alexiamora');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a class="" href="<?php echo wp_logout_url(get_permalink());?>"><?php _e('Desloguearse »', 'alexiamora');?></a></p>
        <?php else : ?>
            <input type="text" placeholder="<?php _e('Apellido y Nombre', 'alexiamora');?>" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'";?> />
            <input type="text" placeholder="<?php _e('E-Mail. No será publicado', 'alexiamora');?>" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
        <?php endif; ?>
        <!--<p>You can use these tags: <code><?php// echo allowed_tags(); ?></code></p>-->
        <textarea placeholder="<?php _e('Comentario', 'alexiamora');?>" name="comment" id="comment" row="22" cols="30" ></textarea>
        <input class="ver_mas" name="submit" type="submit" id="submit" value="<?php _e('Enviar Comentario', 'alexiamora');?>" />
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
    </form>
    <?php endif; // If registration required and not logged in ?>
</div>
<?php endif;?>