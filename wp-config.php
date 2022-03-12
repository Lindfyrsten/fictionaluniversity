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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Kc4MRb9ICDH+ttzJ/POxUsxcSPDryYddO8EbMgFkbwpgJiDuIpRrchCGg3AqOpjafJJ8OP48dGtzQKlDzZsuig==');
define('SECURE_AUTH_KEY',  'v92RkorOwEBnwZcpuTAe/2i10lQVIlZt6lk61/xv/B5GmL9gmtjrO60hqDKpcVInY0wqxvs3GzEwAlB4AJGjQg==');
define('LOGGED_IN_KEY',    'KGlWKtFboGJvga912N4aQhbDI2ciNUYcTUdncX9GA3gmjSgVSTSC+J1qWolCpatQsXkMg74CLXUCLX2rYYpSIQ==');
define('NONCE_KEY',        'xN4DBtw6PE3Y64MUMIJzY7622TXcUSsIp/B169MbtWQR3nUdg2bbo5yPPSa9uodIvMub2U95DIMMNrL31NrODQ==');
define('AUTH_SALT',        'mv3mDtVIsUSabdKD2g9XwgGljeSyrnCtrWQ8VyZEZnhXjPUlvNbjRs8fi61lZGl8gMaWRuPsPiQjs5hyah4Bog==');
define('SECURE_AUTH_SALT', 'or7Mn3uyn0Kas5671uxtehJGQHp6L8qgBkLxkbB8VNx7JC4vM6QYI63Z9P8zRYZEe77781ugzcC1AAkaeSRI5g==');
define('LOGGED_IN_SALT',   'isbQN63awcnJPlf9YQOahCEBPqndaVRr333LQniiLEcbVSFkp+uNoRhoPOl4Z2KLSmepNuev/QHjoqDAkZEETw==');
define('NONCE_SALT',       '5NHr6Q7QXwzVv4kdQqWhlJ5/ayY/iR9gwyzx5xXQGNJmbxqemFvHwfYYMpGQxc5PkzfYWC4DgXYv9JA/JUGArw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
