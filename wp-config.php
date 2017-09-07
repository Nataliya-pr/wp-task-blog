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
define('DB_NAME', 'wp-task-blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'xo6,Gy>6dY+6SirPM|W$EOWU${#4-y%7;xBp+^SJb_#`iJ);_%K7<6Tc!~PZ_tcW');
define('SECURE_AUTH_KEY',  '.XIW;?O#:eYi/7sRqD]N4%gl7=K/l6*)c9MA9dRS#pH`&Eq;>1xMEpu $Q[V#b}?');
define('LOGGED_IN_KEY',    '*m_r:XXw(|M{]BQUy<VBvpK6-?>Ra(LL-,Rj] Sa5]FWn>WZ{}|FB**Uqf(f9d`E');
define('NONCE_KEY',        'J9Y@h*FiM>XU|l]|.YP.VX^7!Pi}2+~7!FQLB7ISDtmU;rl9kp=/d2C`LaZ:;0iv');
define('AUTH_SALT',        'qwi&;mD)1~DcG/ C]zEJ&CH3AFe2)M|w!B;l!gc=kUorP~~th}xn8b,1_}t^Hf b');
define('SECURE_AUTH_SALT', '|M2/;y&]79n>CT<-UvC!j#Jr8u(Rg&7MN.zXL01M|;-7Ilkbl<[Ma}[|lKlC[08t');
define('LOGGED_IN_SALT',   'HE24!aEsMuy3+t6Q;(P(JpQrWEcy&`wJk=ecm.]2#C/uW lO_=LzvVX&h&xGESc<');
define('NONCE_SALT',       'vJxa@,91#Bmk.12)CN^hRX<fb&@GIdFt<m9!~E~=L/!k&_pW3{%uY4oeJ_9;NYhQ');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
