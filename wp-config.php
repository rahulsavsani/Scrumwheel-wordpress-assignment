<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/%XsS?5Zf?+.U|3/vu6X92^et91N4-1/:/=[mQhQ2R!uJB8$,$ wXv[~D>d9M39q' );
define( 'SECURE_AUTH_KEY',  'qhS%hPH^~mM@>am}Bb3!ieSqNts&;cfdXjTk$Csb[%*-^f,?OvfEWY4L+j07w~$s' );
define( 'LOGGED_IN_KEY',    'ir4o+o7%(fwM$ON_S0@H>Tl0&eM(p!{:#7MoY9sD]Mr@yHl/xF|vf4p7_ryC]u),' );
define( 'NONCE_KEY',        'w:zQ&:Vchsiy_w,{X8*h%#{e7O;%9+$Avrvz3Z=tIEy8x++aJzV=kzXN ,RW8n5u' );
define( 'AUTH_SALT',        '59^7l{.5;0q}hXJw,VB7I@yB%|b>Y_i7S/0vcx{h%vh4*(q+kHe>S,=6ixn#m~{y' );
define( 'SECURE_AUTH_SALT', ',&:_!FU+ wx0Msxc2C&RT33)z5bDEp.Z6[MLwcgv;ihvMytxG55*!w,A9ea?:~HE' );
define( 'LOGGED_IN_SALT',   'TjDK57>lI=3`^jz[AW>O/tfZ:8>]njmfr}EoXm98^BbA#UvS_98t<YqcL9}&UaVA' );
define( 'NONCE_SALT',       'L!jf2(3AxTzm?)!3!uzG*-lJQ6h,58dz^[)zR)%!|XzX.;a{m<r_mSse!l-~_vtm' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

set_time_limit(40000);

define('WP_MEMORY_LIMIT', '512M');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
