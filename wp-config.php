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
define( 'DB_NAME', 'ikonic_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'Techverx@123!!' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'FS_METHOD', 'direct' );

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
define( 'AUTH_KEY',         '=+zGkd@kT$P^).,L0iisB|uv0rn9A|I#eU%AOwq?P`SttsQ;a`KwrD`p2[!<$N^A' );
define( 'SECURE_AUTH_KEY',  '6O5%uOO ~h=S*]o#h.P@W6wkR,fBHS*w dwJ>ck*0Z#C87w} ;rh(^&y2gNLaw6{' );
define( 'LOGGED_IN_KEY',    'E7k8en,%qnHrCZ:V=;4Po%)LN/^nN@C_4uH~b%4p-?l5]3pM0<@M)>Rh++YssU,r' );
define( 'NONCE_KEY',        '8pMBGOElGA`~c8QH^o3YcPfrCBd^Ymx8opwe/$9S-]S^0?n*Y+jP.g_PAI|`_H s' );
define( 'AUTH_SALT',        'e9(0[ZDfgb@qB;;;a0Z.As]8vNr:/S3Q-E1ysHD?3.=eNUvZEG!-,#,[!(I>lxx1' );
define( 'SECURE_AUTH_SALT', '=vj75jFF[j:O[u< 6Hv Q&YCOY[T%48<upg{t3dc=7_PX=N?)eA~5.!S/XT92hts' );
define( 'LOGGED_IN_SALT',   'OOWSp8O(FEy72j:_{~@so$_x&JH{<;&@(D@^G!y1i75ncu:v{0%JTV/JW-Z3=0R7' );
define( 'NONCE_SALT',       'Cs:4<j_kd%6[h^rw~MvBj:aUYsf|XIDg(yS!Hn>2/iJcF)k(Bn)s/k3IJaAtbQqX' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ikwp_';

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
