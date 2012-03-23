<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'buddypress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')_BM:3W#]J<E^NdrF0X6Em|w3?>+<G6+#s?jV{u8[|/ejg<Ht-vQX/L13t^XI4hm');
define('SECURE_AUTH_KEY',  '={58p t!t[J@(i8P!:>n9WDW.-V%Sl-6HgCp|=}XH2+Hj~XfB$q+]nl3H<=`Sl!m');
define('LOGGED_IN_KEY',    '8B`-qof#)YRQZ&,qjsY*}-usM}4(Qoy2GC*$-$%.ck4~];0!C+|xSZJs@~GOiH%F');
define('NONCE_KEY',        '4--um&:*jcGUdlwhr+!Ub8%-6>vV>&f3{4p|,B7EcM-i)T}KB+o3>^PKM1iikVM,');
define('AUTH_SALT',        'ma?gwP;Z#?3zZ|X@{EcT!f#[2Sx+6z$+hGrL/NV@qxW99a^d0<3t|{Bc>[DUMZ>a');
define('SECURE_AUTH_SALT', ',@umTi*P=.&TZ[R<Cy:q:`cLz}gp>6[a 92nJKK 3pizgIZ-c1{RhxT0RBSiSqHn');
define('LOGGED_IN_SALT',   ']P#6dAtDF yW2A9-~a%XI(eW3mQ{n;qFv6G2 Wc3uoYkc {19C]x>iMO/ab3y0o>');
define('NONCE_SALT',       '1i;kXLd}2NPgP32h+2jz-S-}SE:ve$aU)?qY-Qc)D|}B7ug]Wf07my?jF7?YJ%z,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
