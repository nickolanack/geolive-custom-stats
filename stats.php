<pre><?php
include_once dirname(__DIR__) . '/administrator/components/com_geolive/core.php';

/* @var $db MapsDatabase */
$db = Core::LoadPlugin('Maps')->getDatabase();

/* @var $db MapsDatabase */
$db = Core::LoadPlugin('Maps')->getDatabase();
$record = $db->query('SELECT min(date) as min, max(date) as max from z78ge_GeoL_Activity_Actions');
echo 'Monitoring Dates : ' . date('F jS, Y h:m:sa', strtotime($record[0]->min)) . ' to ' .
     date('F jS, Y h:m:sa', strtotime($record[0]->max)) . "\n";
echo '(these dates reflect the time the monitoring tool would have been enabled, to right now, or the date it was disabled)' .
     "\n\n";

$record = $db->query('SELECT count(*) as count FROM `z78ge_GeoL_Activity_Actions`');
echo 'Total Logged Events : ' . $record[0]->count . "\n";

$record = $db->query("SELECT count(*) as count FROM `z78ge_GeoL_Activity_Actions` WHERE action='onManipulateMap'");

echo 'Total Map Actions: ' . $record[0]->count . ' (move zoom etc)' . "\n";

$record = $db->query('SELECT count(*) as count FROM z78ge_GeoL_Map_MapItem');

echo 'Total Marker Count: ' . $record[0]->count . "\n";

$record = $db->query('SELECT sum(views) as views FROM z78ge_GeoL_Map_MapItem');
echo 'Total Marker Views: ' . $record[0]->views . "\n";

$record = $db->query('SELECT count(*) as count FROM `z78ge_GeoL_Activity_Actions` where action="onDisplayMap"');
echo 'Total Map Views: ' . $record[0]->count . "\n";

$record = $db->query('SELECT count(*) as count FROM (SELECT * FROM `z78ge_GeoL_Map_MapItem` group by uid) as a');

echo 'Total Unique Marker Authors: ' . $record[0]->count . "\n";

echo "\n";
$records = $db->query(
    'SELECT a.id, a.name, username, email, views, creationDate FROM `z78ge_GeoL_Map_MapItem` as a, `z78ge_users` as b WHERE a.uid=b.id order by views DESC');

echo 'Marker Detail List: ' . json_encode($records, JSON_PRETTY_PRINT);

?></pre>
