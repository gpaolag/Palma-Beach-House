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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'p21m2b32ch2' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '^1& 022lI+B4Qf1?W@mIE? REYL`*=Y{qFBng5yT=<L3V^8wka/&bh.aFFueR6[.' );
define( 'SECURE_AUTH_KEY',  'w)bHG}gJ~nbv426 BK.Q<|_1!dJ^dp}z,KWjX28Q4EY1/{x%xs-_Uu8&UJ,w|t,i' );
define( 'LOGGED_IN_KEY',    ';x`7%rpg[b,s,i0-wskaG:3J{vi-Co_ fHu5#_/pOwf SV>be=Q4OV{rL<l@|)/!' );
define( 'NONCE_KEY',        'b`V,dk8A7[?9{cZ|#~4V(kzHjVr1U[]6M+{k2G>g]Ncf-#PPHxOkZN:}3+Y&Qg0b' );
define( 'AUTH_SALT',        '~y_:aMrYR3@(Pg-.9jt]`S)rS7^(,]_E4!6xawE0nc[tzF8+0:|;LL6?l-i[QEC9' );
define( 'SECURE_AUTH_SALT', 'csIt08l p qt-duN!v8mK ;gs|($[f5IFyB8ng,]w?3sZF>cW4?!}>15Zh$)_ifs' );
define( 'LOGGED_IN_SALT',   'fzmYd<grK_6//N2)PU.B,08`j+M2^Bv1l%y6C(Q=S6HR`3P51KTX!Vr;hH?1*~xJ' );
define( 'NONCE_SALT',       '^y:A=h(:xfoJ8ti5[!L=R:2?~1C_8_pVl%*-B<P? ~w-^c?y~2JTH`dGI2DDRIk{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'p21m2b32ch2_1nd1g0';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
