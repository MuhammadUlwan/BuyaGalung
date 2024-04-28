

<?php

function generateStarRating($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= round($rating)) {
            $stars .= '★'; // Bintang terisi
        } else {
            $stars .= '☆'; // Bintang kosong
        }
    }
    return $stars;
}
