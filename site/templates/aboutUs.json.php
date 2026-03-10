<?php
$site = site();

$headerImg = $page->header_image()->toFile();
$conceptImg = $page->concept_image()->toFile();

$splitSections = $page->split_sections()->toStructure()->map(function ($section) {
    $img = $section->image()->toFile();
    return [
        'title' => $section->title()->value(),
        'text' => $section->text()->value(),
        'img' => [
            'src' => $img ? $img->url() : null,
            'alt' => $section->title()->value()
        ]
    ];
})->values();

$cooperations = $page->cooperations_list()->toStructure()->map(function ($item) {
    $logoFile = $item->logo()->toFile();
    return [
        'name' => $item->name()->value(),
        'link' => $item->link()->value(),
        'logo' => $logoFile ? $logoFile->url() : null,
        'logo_alt' => $logoFile ? $logoFile->alt()->value() : $item->name()->value()
    ];
})->values();

$rooms = $page->rooms_gallery()->toFiles()->map(function ($file) {
    return ['src' => $file->url()];
})->values();

return [
    'header' => [
        'title' => $page->header_title()->value(),
        'text' => $page->header_text()->value(),
        'image' => $headerImg ? $headerImg->url() : null
    ],
    'description' => [
        'left' => $page->description_left()->value(),
        'right' => $page->description_right()->value()
    ],
    'banner1' => $page->banner_text_1()->value(),
    'splitSections' => $splitSections,
    'cooperations' => [
        'title' => $page->cooperations_title()->value(),
        'items' => $cooperations
    ],
    'banner2' => $page->banner_text_2()->value(),
    'concept' => [
        'title' => $page->concept_title()->value(),
        'textLeft' => $page->concept_text_left()->value(),
        'textRight' => $page->concept_text_right()->value(),
        'name' => $page->concept_name()->value(),
        'role' => $page->concept_role()->value(),
        'image' => $conceptImg ? $conceptImg->url() : null
    ],
    'rooms' => [
        'title' => $page->rooms_title()->value(),
        'images' => $rooms
    ],
    'footerCta' => [
        'show' => $page->show_footer_cta()->toBool(),
        'title' => $site->global_cta_title()->value(),
        'text' => $site->global_cta_text()->value()
    ]
];
