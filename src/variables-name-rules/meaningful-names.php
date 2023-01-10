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

// Avoid mental mapping. For example, the names i, j, and k are okay as loop counters,
// but be careful when they are used as variable names.
// Example for mental mapping
for ($i = 0; $i < 10; $i++) {
    // ...
}
// Example for meaningful
for ($index = 0; $index < 10; $index++) {
    // ...
}

