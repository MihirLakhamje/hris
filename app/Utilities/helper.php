<?php

if (!function_exists('numberToReadable')) {
  function numberToReadable($number) {
    if ($number >= 1000 && $number < 1000000) {
      return round($number / 1000, 1) . 'k';
    } elseif ($number >= 1000000 && $number < 1000000000) {
      return round($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000000000) {
      return round($number / 1000000000, 1) . 'B';
    }

    return $number;
  }
}