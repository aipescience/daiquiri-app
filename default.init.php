#!/usr/bin/env php
<?php
// Path to the application and to the daiquiri library:
// You only need to change this, if the application and daiquiri are not
// sitting in the same directory.

$application_path = realpath(__DIR__);
$daiquiri_path = realpath(__DIR__ . '/../daiquiri');

// Application configuration:
// Please change all option you want to change for you application.
// Warning: This could drasically affect the overall security of the application.

$options = array(
    'database' => array(
        /* configure the 'web' and 'user' database adapters */
        'web' => array(
            'dbname' => 'daiquiri_web',
            'host' => 'localhost',
            'username' => 'daiquiri_web',
            'password' => 'daiquiri_web',
        ),
        'user' => array(
            'dbname' => 'daiquiri_user_%',
            'additional' => array(), // add your science databases here
            'host' => 'localhost',
            'username' => 'daiquiri_user',
            'password' => 'daiquiri_user',
            'file' => true,
            'func' => true,
            'qqueue' => true
        )
    ),
    'mail' => array(
        /* add the smtp connection to your mailserver here */
        'type' => 'smtp',
        'host' => 'example.com',
        'email' => 'daiquiri@example.com',
        'name' => 'Daiquiri Admin'
    ),
    'modules' => array(
        /* active modules for this instance of daiquiri */
        'core',
        'auth',
        'contact',
        'data',
        'meetings' ,
        'query',
        'uws'
    ),
    'config' => array(
        'core' => array(
            'minify' => array(
                /* enable minification via yui-compressor */
                'enabled' => true
            ),
            'cms' => array(
                /* enable wordpress cms */
                'enabled' => false
            ),
        ),
        'auth' => array(
            'registration' => true,
            'confirmation' => true,
            'details' => array(
                'firstname', 'lastname', 'website'
            )
        ),
        'query' => array(
            /* allow queries without a user account */
            'guest' => false,
            /* configure query 'direct' or 'qqueue' */
            'query' => array(
                'type' => 'direct'
            ),
            /* configure download */
            'download' => array(
                /* configure type 'direct' or 'gearman' */
                'type' => 'gearman',
                'adapter' => array(
                    /* configure download formats */
                    'enabled' => array('mysql', 'csv', 'votable', 'votableB1', 'votableB2')
                )
            ),
            /* configure forms for query interface */
            'forms' => array(

                'sql' => array(
                    'default' => true,
                    'title' => 'SQL query',
                    'help' => 'Place your SQL statement directly in the text area below and submit your request using the button.',
                    'class' => 'Query_Form_SqlQuery',
                    'view' => $daiquiri_path . '/modules/query/views/scripts/_partials/sql-query.phtml'
                ),
                'cone' => array(
                    'title' => 'Cone Search',
                    'help' => 'Please specify a coordinate in right ascension (RA) and declination (DEC) and a radius in arcsec.',
                    'class' => 'Query_Form_ConeQuery',
                    'table' => 'RAVEPUB_DR3.RAVE_DR1',
                    'raField' => 'RAdeg',
                    'decField' => 'DEdeg',
                    'raDefault' => 0.1,
                    'decDefault' => 0.2,
                    'radiusDefault' => 2.1
                )
            )
        ),
        'data' => array(
            /* write metadata into the comment fields of the science tables */
            'writeToDB' => true
        ),
    ),
    'init' => array(
        'auth' => array(
            /* add initial users here */
            'user' => array(
                array(
                    'username' => 'admin',
                    'password' => 'admin',
                    'email' => 'admin@example.com',
                    'status' => 'active',
                    'role' => 'admin',
                    'firstname' => 'Albert',
                    'lastname' => 'Admin',
                    'website' => 'example.com',
                ),
                array(
                    'username' => 'user',
                    'password' => 'user',
                    'email' => 'user@example.com',
                    'status' => 'active',
                    'role' => 'user',
                    'firstname' => 'Ulf',
                    'lastname' => 'User',
                    'website' => 'example.com',
                ),
            ),
        ),
        'data' => array(
            /* add science databases */
            'databases' => array(
/*                array(
                    'name' => 'RAVEPUB_DR3',      // add the name the database
                    'description' => '',          // some description
                    'publication_role' => 'user', // minimal role which has access
                    'publication_select' => true, // allow select statements
                    'publication_show' => true,   // allow show table statements
                    'autofill' => true            // automagically add tables and columns
                )*/
            ),
            /* add additional user defined functions */
            'functions' => array(
                array(
                    'name' => 'angdist',
                    'description' => '',
                    'publication_role' => 'user'
                )
            )
        ),
        'query' => array(
            'examples' => array(
                /* add you example queries here */
                array(
                    'name' => 'Select first 20 rows from the foo.bar table',
                    'query' => 'SELECT * FROM `foo`.`bar` LIMIT 20;',
                    'description' => '',         // some description
                    'publication_role' => 'user' // minimal role which can see this example
                )
            )
        )
    )
);

// create init object
require_once($daiquiri_path . '/library/Daiquiri/Init.php');
$init = new Daiquiri_Init($application_path, $daiquiri_path, $options);
$init->run();


