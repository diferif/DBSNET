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
define('DB_NAME', 'wpdb_dbsnet');

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
define('AUTH_KEY',         'X%3Yt:k2Tx?)j8{ZpTz(Oa(_gGm%Y7@(@$|WQ09]C7LOwVM{Or!DttsxZEB4gt!C');
define('SECURE_AUTH_KEY',  'j_$&fOrTObC3&*,P1yl|#mOr5r$>JPu7Q#FO%e)ht%aOV5e-_g%jP]}%Rg=q~H{r');
define('LOGGED_IN_KEY',    'B3>Bl`[D1>>.e(ory1/N7u!.O!C]m0!FOi #35x8v]]N<O>|lQl8M.{6Js/lK5d3');
define('NONCE_KEY',        'D&( 5A=>8wG6(JMe<,{$JgmAs|7R[iJRLorpu|`-9eDmqZ-tWlDY3}_i%gg1B^[o');
define('AUTH_SALT',        'F7z,ECs)}yyZm~Ty+X|+F2T3}jqpXwDekVC&GT4Qtuo@*4;Pdo(L>~,z`62a1)k ');
define('SECURE_AUTH_SALT', 'UTS-YMc=e1zw9B2+FZ+/dLJ,@oP0Iu#4+W4^zVu~lF~K6IMDp7<Uk%ym|IPa]BRp');
define('LOGGED_IN_SALT',   '?=:z! v;)=KSS>-jPt:[aX80x33:5y- T$fKK<G~wVf|_NBVqx%62?b=zuxkB)YA');
define('NONCE_SALT',       '%y~~P?`2=SCJj^9dJ$X8migw>C<$AbgpP|Ep9-ZXBooa,7:]l+Wc$ji2l|Lk:a_I');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpdb_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
