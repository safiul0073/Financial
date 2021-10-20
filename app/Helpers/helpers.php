<?php


function calculatTotalAmount($data) {
    $amount = 0;
    foreach ($data as $key => $item) {
        $amount += $item->invests->sum('amount');
    }
 return $amount;
}
