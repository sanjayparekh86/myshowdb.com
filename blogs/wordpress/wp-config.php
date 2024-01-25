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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '3%r}LOoO7BgL$J/D!KQo*~H-$VZNRucsL+)#A3xsaZ+La9ybI(QFcw!CeUf,}WW&' );
define( 'SECURE_AUTH_KEY',  '^]R^e!6PUzP/uFf/[AWx!z(J^b!eID}TWr-WeIZHZMpxZh+dm.1s.(yz_]etX8eF' );
define( 'LOGGED_IN_KEY',    '@beFeI/L_NgE.uArkj)cB2{EyNBPpsJ1w<FoU/!F-(ma%%P}cw*a4(%<RJF9tB47' );
define( 'NONCE_KEY',        'a*FdXE@^(C4Wx|wB@Td]!l1=(@,SG#Q{U#W|GNU(7;>5O8ohl~[m!lAv>m)@CUr4' );
define( 'AUTH_SALT',        'KBWCls)**3U~p5jV/QRrNr`O=,xzT?$y^M6F$>P&0q?K6`ffkhmn,qei 5za[Y^i' );
define( 'SECURE_AUTH_SALT', 'wX*E,nYsHKd~m}mL2_{U=y/g?;mN{~<1}.&<~Y60jj/xfq>/okfJUEAZ!+Y2.ni.' );
define( 'LOGGED_IN_SALT',   '8n]`~TyxaLVQg68CT5Ecs{&(MwQ)AXN=La}BkcWoCn(BN:a~V^HYz&4ssDXD{UrP' );
define( 'NONCE_SALT',       '^4$X7qu!30-hq,WIuQG>w:Nx184RS_EMm!J`~wZtrgOLF&qrjh`1[dA^0Gnc|[zm' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
