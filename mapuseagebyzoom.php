<?php
include_once dirname(__DIR__) . '/administrator/components/com_geolive/core.php';

/* @var $db MapsDatabase */
$db = Core::LoadPlugin('Maps')->getDatabase();
$prefix = '';

$records = $db->query(
    "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(data, '[', -1), ',', 1) as lat, SUBSTRING_INDEX(SUBSTRING_INDEX(data, ']', 1), ',', -1) as lng,
SUBSTRING_INDEX(SUBSTRING_INDEX(data, ':', -1), '}', 1) as zoom
FROM `z78ge_GeoL_Activity_Actions` WHERE action='onManipulateMap' AND date > '2015-06-15'");

echo json_encode(array(
    'success' => true,
    'records' => $records
));