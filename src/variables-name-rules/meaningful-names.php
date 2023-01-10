<?php

$moment = new DateTime();
// Example for variable names not meaningful
$ymdstr = $moment->format('y-m-d');
list($y, $m, $d) = explode('-', $ymdstr);
$timestamp = mktime(0, 0, 0, $m, $d, $y);

// Example for variable names meaningful
$today = $moment->format('y-m-d');
list($year, $month, $day) = explode('-', $today);
$timestamp = mktime(0, 0, 0, $month, $day, $year);

// Do not refer to a grouping of accounts as an accountList unless it’s actually a List.
$accountList = [];
// Example for meaningful
$accounts = [];
$acoountGroup = [];
