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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pizzeria');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 's3gurid@d');

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
define('AUTH_KEY',         '|f9<_}r#d(r.pSk?td.Op+_2B3*AuX]dLOz+Qxj6q]+V+AZ.S6*.$sDPk2XCbwz3');
define('SECURE_AUTH_KEY',  '-M?J/zSnWq`vj#s:-]cW*A1yKJua-=R(-?h*3s>+#Qv-$+9yyQ dp+n05;1@h/#Z');
define('LOGGED_IN_KEY',    'j&dF*aL:oiHoKGWi)5U8imSGbMu`{MaYSqG+kmZe56%@p/b<0{^Pe[SF&JlyiPvv');
define('NONCE_KEY',        'g0u~wafDa8KKGo^Pjq@Fxr~7^mx+NXO50EXn--9phJ Z,0SHOF{LX|N0kj+|?|b7');
define('AUTH_SALT',        '9w36b/Whb-E1ky3:$B|qd0m+wZ ^!},[vyKcSS{C>US-h `/2EH_Ab$+HISe^x^J');
define('SECURE_AUTH_SALT', '{vTirLX*@_;|/kp=62lg(t%nk=Zi2j~o)G|:)hW+6^uqhFO0U=+QdsSh<N=ScG!Z');
define('LOGGED_IN_SALT',   '5@^i{+7%Oem3DHCaR=#8i@*F0c{$bU@%97D{Z)b29:~^dD&tQB&B%?*;7#)u8k(9');
define('NONCE_SALT',       'h(sLb4X;y5D[mFQU0[G+su!6ow!^+o)EiK.>SLL{*A*=&};US9W#-{v+oaQYL7u|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
