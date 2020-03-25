<?php
$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    $config->application->DAODir,
    $config->application->controllersDir,
    $config->application->modelsDir,
    $config->application->formsDir,
    $config->application->libraryDir
])->register();