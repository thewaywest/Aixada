<?php

require_once 'testing/lib/dump_manager.php';

$shortopts = "f::t::";
$longopts  = array("from-time::",
		   "to-time::");
$options = getopt($shortopts, $longopts);

$from_str = isset($options['f']) 
    ? $options['f'] 
    : (isset($options['from-time']) 
       ? $options['from-time']
       : '-1 months');

$to_str = isset($options['t']) 
    ? $options['t'] 
    : (isset($options['to-time']) 
       ? $options['to-time']
       : '-1 days');
		       
$dump_from_time = date('Y-m-d@H:i', strtotime($from_str));
$dump_to_time   = date('Y-m-d@H:i', strtotime($to_str));

echo "dumping from $from_str($dump_from_time) to $to_str($dump_to_time) ...\n"; 

$ctime = time();
$dbdm = new DBDumpManager($dump_db_name, $dump_from_time, $dump_to_time, $table_key_pairs);
$dumpfile = $dbdm->create_initial_dump();
echo time()-$ctime . "s for creating dump\n";
?>