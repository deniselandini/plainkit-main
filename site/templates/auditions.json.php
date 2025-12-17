<?php
$headerImg = $page->header_image()->toFile();

$auditionDates = $page->auditions_list()->toStructure()->map(function ($item) {
    $fullLabel = $item->audition_date()->toDate('d.m.y') . ', ' . $item->audition_place()->value();
    return [
        'value' => $fullLabel,
        'label' => $fullLabel,
    ];
})->values();

return [
    'header' => [
        'title' => $page->header_title()->value(),
        'intro' => $page->header_intro()->value(),
        'image' => $headerImg ? $headerImg->url() : null
    ],
    'auditions_list' => $auditionDates,
    'settings' => [
        'auditions_active' => $page->auditions_active()->toBool(),
        'download_link_text' => $page->download_link_text()->value(),
        'download_file' => $page->download_file()->toFile() ? $page->download_file()->toFile()->url() : null,
    ]

];