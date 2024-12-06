<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'database_testwork' );

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
define( 'AUTH_KEY',         '_;VFAf_=W|g@]ix7]z3p*;o{)AFQKj+Iu.N@69#(fo}DN{FkjcG}VLK/J[-Z+r&-' );
define( 'SECURE_AUTH_KEY',  '$fQ]^LN.Z}#giNN]w-Q#_;}hvI3)X[$M~@0bB%0@&<c~L?.RbM7C|b)Jz!/NOg1+' );
define( 'LOGGED_IN_KEY',    'B0kfE~V0FxXOPYKYUalzbFx2V]G6jT)F<L[sKzOFE:%uH~b;(m%jYxNg<?EC]bN&' );
define( 'NONCE_KEY',        'i$.[G1u!U4uI~-z4L8<9RurP>&>}(~Ug1[`9XM{x#}VE16-fJ0]MlmZ{ST5Y);3n' );
define( 'AUTH_SALT',        'rtu[A`_/(y+%l%L~v,C?60@:HCh4Fu7k%A2-b2TW.<Y)_XqjfU})bCGe*exB _{v' );
define( 'SECURE_AUTH_SALT', 'R)A,hf#5D-49Fz,&rX(H})M|5__>a%aZ$hX31W_HFEw`@P_U:{|TtJC]WW6ZnfH9' );
define( 'LOGGED_IN_SALT',   'n`)=#nJNK}#O@aHony$k*z%2HUw:Rt@-_bVp`i1RQ6Y/@mg%BSKUs}!k?HieclAT' );
define( 'NONCE_SALT',       '!3a)wQ?2gPi{,<X25dQDd9QF=x=2vcS`pEley,KR3Kdp`+}[pi,I4 !~q/&oSo?H' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
