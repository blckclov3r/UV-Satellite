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
define( 'DB_NAME', 'uvdb' );

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
define( 'AUTH_KEY',         '~dDx]~>{[b:XRY2A>]|@0Qah4-At5tRo+[lF(^Ne@`KX8;@g`}jSTp[mzv:qS(K8' );
define( 'SECURE_AUTH_KEY',  'D#_5Rm:Fd:bv6QHm}YFFy,0 z-1` +f;.J-Z`D8o}:WBNDEFhLg>gk>?C^=Zl_}I' );
define( 'LOGGED_IN_KEY',    '7^I)1JW&i:UQ=(r/|lJ~@dX{Dk>ulo#%pmq_!TG>Ol%I5U$Sjh5s/LjBPP9oPhen' );
define( 'NONCE_KEY',        '@Se`lG==T2GTDSoT_h|Yk>k?M(Y]c8vPacZ9gN-Vdh,lmRbEC}y<`?`wm=F|A *R' );
define( 'AUTH_SALT',        'X?6rN*JD@kN?Gn3xVIp^V,@#C/tD:.*%8v|yw:GkaUuv(pc}Qg/b$+!-=4DS/%jl' );
define( 'SECURE_AUTH_SALT', 'zhk`[Cj6Lh)e`!hwIl*Q EE[Rw<kQ?y_UGI2ED#nU%?`&fZwG4stVdn+a1lG3SP%' );
define( 'LOGGED_IN_SALT',   '/*r-5b662qBTEX8VEQ8iXZ6?pUR|q6FD@Jg8m->%y=e1l0& %2qn?R?L0.f u36U' );
define( 'NONCE_SALT',       'op>hy<)FrL*%M)QYy2q2V992aPHa|t-JD-2<U~|V9&gMeQ}yAI6TG.:W,Y^9W`mn' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
