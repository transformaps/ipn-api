<?php
/**
 * /ala.occurences.php?include=ala.details&bname=Acacia&lat=-34.928726&lon=138.59994&radius=5&dump=1
 */

require_once ('./vendor/autoload.php');
require_once ('./ApiConfig.php');

/**
 * Request > Validation, required params
 */

if (!isset($_GET['taxon_name'])) {// taxonomy name
    \Api\Config::out(400, 'Invalid parameters: `taxon_name` required.');
}

$response = new StdClass;
$response->ala = new StdClass;
$response->ala->species = new \Api\Ala\Species($_GET);

/**
 * Debug: Dump
 */

if (isset($_GET['dump'])) {
     \Api\Config::serviceHeaders('html');
    dump(json_decode(json_encode($response)));
    //print json_encode($response, JSON_PRETTY_PRINT);
    exit(1);
}

/**
 * Default: Data
 */

\Api\Config::serviceHeaders();
print json_encode($response);
exit(1);
