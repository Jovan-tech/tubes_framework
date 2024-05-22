<?php

// fungsi untuk mengembalikan format rupiah daru suatu nominal tertentu dengan pemisah ribuan
function rupiah($nominal) {
    return "Rp ".number_format($nominal);
}