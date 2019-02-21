<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define( 'WPCACHEHOME', '/home/ph000505/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
//define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'ph000505_alexiamora');

/** Deshabilito WP_CRON */
define('DISABLE_WP_CRON', true);

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'ph000505_alexia');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'AlexiaMora2014');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ';RLu&`^$uP[0Gz9t2z>KBKY5=<=LH,g3dqP4*?!b/48xN oaPW[eQ3{[{;wt;8`1'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '  Bw>[{7h`_vV@E#?c``m?:zHPwcAX$Bg0vM[K=omXs#w-{<pr]|KrB1&h^WAmF+'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', 'S6m8VQg?!aq0?rgn3iZ2>M8B;u%G BOwQ-C?1<;hTNI<XzUOm!l9VorUY96-aG~^'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'x5yKlJd._4PI;TSZ}lF]=<obC[OmMIOCeCOZd$*FAU4S%p-Zt0AX9x[?<N+R|TWq'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'N=zPr.4e=^_;Q.@zfNv@V_xi`.G1^k Jn0^7?9}e7Ey_p8)twOA$ABGx[1Kg|m+1'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'gf,StRyX)=W;lTb+@]b73_F0u$-x(uLbqi-q-w`w+MR!zas*ep0Ku3 i*SDk#PJL'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', '%aEt+#`mV?F+rzu@O-,)>;ks;E@6o^**$fBPL1GJ9-4p(_[ZUQ+-`V7?cDi?E 3 '); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', '*@L:tY!Z{-$Am+E6 };9EII,*|10qxJ2aCPGE]#S-V|!?N<m.?k54vU@Hr55xpYg'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'am_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
// Modo depuración
define('WP_DEBUG', false);
@ini_set('log_errors', 'On');
@ini_set('display_errors', 'On');
@ini_set('error_log', '/php_error.log');


// Depurando scripts
// define( 'SCRIPT_DEBUG', false );
define( 'CONCATENATE_SCRIPTS', true );
define( 'CONCATENATE_CSS', true );
define( 'COMPRESS_SCRIPTS', true );


// Compresión y concatenación de estilos
define( 'COMPRESS_CSS', true );
define( 'COMPRESS_JS', true );
define( 'ENFORCE_GZIP', true );

// Forzar el ingreso seguro a la administración
define('FORCE_SSL_ADMIN', true);

// Generando las consultas a la base de datos.
// define( 'SAVEQUERIES', true );
/*
Guardando las consultas de la base de datos para análisis posterior
luego colocar en el hook wp_footer. O sea colocar este código en el footer.php de tu tema, justo antes del wp_footer();
<?php
	if ( current_user_can( 'administrator' ) )
	{
		global $wpdb;
		echo "<pre>";
		print_r( $wpdb->queries );
		echo "</pre>";
	}
?>
*/

// Deshabilitar el editor de temas y plugins para evitar metidas de pata de los clientes
define( 'DISALLOW_FILE_EDIT', true );

// Deshabilitando la opción de revisiones. Tu sabes que la base de datos irá creciendo y mucho, te lo recomiendo.
define('WP_POST_REVISIONS', false);

// Autoguardado de posts y páginas para evitar pérdidas si se corta las conexión a internet.
define('AUTOSAVE_INTERVAL', 60);

// Evitar imágenes duplicadas
define( 'IMAGE_EDIT_OVERWRITE', true );

// Incrementando el nivel de memoria asignada a WordPress para darle mayor velocidad
define( 'WP_MEMORY_LIMIT', '64M' );

// Desabilitando C-Form 7 scripts y css por defecto. Recomendable sí o sí.
// define( 'WPCF7_LOAD_JS', false );
// define( 'WPCF7_LOAD_CSS', false );

// Actualizaciones automáticas. Muy confiable
define( 'WP_AUTO_UPDATE_CORE', true );

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');