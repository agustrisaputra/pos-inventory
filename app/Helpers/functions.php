<?php

function rupiah($value) {
    $result = 'Rp ' . number_format($value, 0, ',', '.');

    return $result;
}
