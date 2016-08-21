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
define('DB_NAME', 'i2809005_wp1');

/** MySQL database username */
define('DB_USER', 'i2809005_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'K[UF(9](VerdfPIBeo[77][3');

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
define('AUTH_KEY',         '7U3qjWg89PDMCISrQ04ZAcMFyvnM3wwFw1P0IgXrQCvmeFdUB55fsk0vlefl51jd');
define('SECURE_AUTH_KEY',  'DefToWOVeHE3YjRmV5ZF1LwEGLZX4q3bI4F6MnSfRL9GZyePsmgITzE8wcJnYPwr');
define('LOGGED_IN_KEY',    'kAUmpGdvM0m36oO6fDd5vSu3oMXbpOVInw01nX5BR4QUVRTteJ0M9cqqiMc9C1so');
define('NONCE_KEY',        'iHsa3n1xLLkKPU8SDCqSVM0kYxrgdVQCdjyyJiqCSBr6Z4BjBF3ZtQzJqtvnh6Re');
define('AUTH_SALT',        '8BDpos9rAvYIY1bxHrFlOChgkYTqVEZLNTh238N3tfH5qRVCtHhFw0zdAvqgQtlz');
define('SECURE_AUTH_SALT', '2pTkS2SaE1Qi5iILpECgWCRH8uRSsT6hvvVjtXPVfgy27wTO39UzgsTd0LzHf3cR');
define('LOGGED_IN_SALT',   'CCrlfy5QqhsxCW49mLGm8JbNztPIaKd7oafbpY7dRJZJs38UC68HzuxPCPzrvdQM');
define('NONCE_SALT',       'yhxHh5C0leMuXvDUd68NBEjL5O3qWasuIVbEsWgYapvK0WHTaPCHS9r7qeqzaOEc');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
