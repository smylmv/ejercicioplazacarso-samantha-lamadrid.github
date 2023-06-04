<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'plazacarso_ejercicio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'mRE@5xca&Q^XF$`&L:n>^3s7eM~}M~{0uF.iDj|s5*(M3EQ~|3mZg#V#%,*rQ?+9' );
define( 'SECURE_AUTH_KEY',  '`#s~_-!HzYpj}r__Y<yn(-#Mc,,4ee?}5Kng6H4{WA>0w(E_|*|F7?X0!xF+mL[_' );
define( 'LOGGED_IN_KEY',    'xab7h,^MsAJez4|cb`Bjkg`giEfpX=kdhq&2]|ovsrX0Acdx`!*DA_WEbP0Q@S#8' );
define( 'NONCE_KEY',        'es)5cgAS;SfT1wyqF SempeF,RmSBJw4A52v9<^~lb*4PU kC9hh@uK9AKa]5J-r' );
define( 'AUTH_SALT',        '(B|U)D1Y1FfEmCpf}.o)n)N@6bR8OmNsBa?]+Xh=?cy,p_`r;`yZuF<;<>__^Kz]' );
define( 'SECURE_AUTH_SALT', '4T&=&.NSN,oe2PC7$z|`9jGOS3i07%r8]JMx{^{-}Y^99dDGD&5{3eRl!>&9~5GT' );
define( 'LOGGED_IN_SALT',   's8@e5~F[hS&:AcY`8<ehJ?T|?{ptPQ0FfKoT5W^n2R[hMbWlE*9btR?~h-m1Mmvg' );
define( 'NONCE_SALT',       '3-xQm=}z#g*NT,^(UC%{PFuF&<0G,w2vA2yfUh#d8M(Pg.pL[RpUBEWBZg<YOGE`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
