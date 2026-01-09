<?php

return [

    // Standard barangay term length
    'term_years' => 4,

    // Term limits per position
    // null = unlimited
    'term_limits' => [
        'Barangay Captain'   => 4,
        'Barangay Councilor' => 4,
        'SK Chairman'        => 1,
        'Treasurer'          => null,
        'Secretary'          => null,
    ],

];