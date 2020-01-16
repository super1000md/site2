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
define( 'DB_NAME', 'wp' );

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
define( 'AUTH_KEY',         'ZxkmB#FEWrlS5?{Qxt;}grjJxjy,S<M#AM6eFAzDg#KC7VaB{X=@^|J}kI:$85&2' );
define( 'SECURE_AUTH_KEY',  '3a)C6r*VI;V<GQ;wWGI^FZE,(T`u?isKW:,5luptam+a@3.90v_bvyvY6?|v]EIN' );
define( 'LOGGED_IN_KEY',    '@>Amu5I^q@I|V$HYvblO1<jHZJ+!AVq8mTZIj;(a^&o@SDUx+0`|~i7ZVD1Qm:_^' );
define( 'NONCE_KEY',        '(Fi9GxE~.~LVL$}C7C3IuaCUoSy%*A2ZUOu]#V]@+]%=%RSYB4c@?>K=(X?q<Z^e' );
define( 'AUTH_SALT',        '>DsQ~bYiDh|/gMgmuVZfR9Lac3t06IRTu(u6*bq+r:2pZCZ)*c-,+>.rv9/DPEa~' );
define( 'SECURE_AUTH_SALT', 'V<.5^[yBJ3gDCp4rKX1F/2H5i,fa<lbhdIiy0)Y~qvuzn`[zm)m+TSx9(RLAuZCv' );
define( 'LOGGED_IN_SALT',   'ufLIs% f`VAi@!n+rRs@yjLjY!2IL2{p/kAM6D2UH.0W->9Gs0b-*h`[1~&#{PWd' );
define( 'NONCE_SALT',       '#(XtJNo8+@U`*+UpCrjW$V!kCO [*Zlg4}Ldq38oMXXBG#+G*r EP38U|RvTl)&|' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
