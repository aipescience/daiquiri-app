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
        )
    ),
    'mail' => array(
        /* add the smtp connection to your mailserver here */
        'type' => 'smtp',
        'host' => 'example.com',
        'email' => 'daiquiri@example.com',
        'name' => 'Daiquiri Admin'
    ),
    'config' => array(
        'auth' => array(
            'registration' => true,
            'confirmation' => true,
            'details' => array(
                'firstname', 'lastname', 'website', 'affiliation', 'country'
            )
        ),
        'query' => array(
            'guest' => false,
            'queue' => array(
                'type' => 'simple'
            ),
            'download' => array(
                'queue' => array(
                    'type' => 'simple'
                ),
                'adapter' => array(
                    'enabled' => array('csv')
                )
            ),
            'examples' => array(
                /* add you example queries here */
                array(
                    'name' => 'Select first 20 rows from the foo.bar table',
                    'query' => 'SELECT * FROM `foo`.`bar` LIMIT 20;'
                ),
            )
        ),
        'contact' => true
    ),
    'auth' => array(
        'user' => array(
            array(
                'username' => 'admin',
                'password' => 'admin',
                'email' => 'admin@example.com',
                'status_id' => 1,
                'role_id' => 5,
                'firstname' => 'n/a',
                'lastname' => 'n/a',
                'website' => 'n/a',
                'affiliation' => 'n/a',
                'country' => 'n/a',
            ),
        ),
    ),
    /*
    'data' => array(
        'databases' => array(
            'name' => '', // add the name of your science database here
            'description' => '',
            'adapter' => 'user',
            'publication_role_id' => '1',
            'publication_select' => '1',
            'publication_update' => '0',
            'publication_insert' => '0',
            'publication_show' => '0',
            'autofill' => '1',
        )
    )
    */
);

// create init object
require_once($daiquiri_path . '/library/Daiquiri/Init.php');
$init = new Daiquiri_Init($application_path, $daiquiri_path, $options);
$init->run();


