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
define('DB_NAME', 'wp_liveform');

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
define('AUTH_KEY',         'PFs?2{md=,:@L}1wKvdDSSiDhR%j:;p,kQhs>cig eR<eG?*oflQTY] !Mip>135');
define('SECURE_AUTH_KEY',  'cmZlu=5^W~e2BQ,u L`GX.bZ]Q3*9.snZ7$AgVKII:7S+h_xzIe;lAIAUe2)vF]-');
define('LOGGED_IN_KEY',    '91v=qO-5O%JPNJ.%Wx0;mIf0[A-NypR^RJBd$7l-^_Jy&oX_78>FOfR_Bd7Rnk`&');
define('NONCE_KEY',        ')^gG$DcDI.eV~%lq8b8Hro2453m>8Ed{J)Y1ec;(I=yYWURw]&vRZC,G=:GUg_cO');
define('AUTH_SALT',        'X^<Gm~BG^K~t|cY8!PqYff5cDrHtu6vFb>tp)W0>pRi+_ RYdp.Di/m~uEP*1_U|');
define('SECURE_AUTH_SALT', '6c/jBovdVF/=lE!uD%2G0TcJ[C?2Vut%#b,GaQN4@2Hl@-q}`OHYge.bG3rw2`ol');
define('LOGGED_IN_SALT',   'by|F~#tg2(=TZcF[f|Yu`,uY_?zV+wUOSx,_I0fW>V>5dw8rO(KOq{p9jf<i-Q7`');
define('NONCE_SALT',       'p7]HGU!l;:xw1k<*zw,fFLC!,6[1iN7Sa<UP,?.&xZY~Gg:eWy[H ]z|xdL1pWL:');

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
