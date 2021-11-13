<?php
function filter_($str) {
    return str_replace("cxyu", "ccxyu", $str);
}
$data['userdata'] = $_POST['userdata'];
$serial_str = filter_(serialize($data));

file_put_contents(SYSTEM_ROOT.'db.txt', $serial_str);