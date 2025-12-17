<?php
$site = site();
$headerImg = $page->header_image()->toFile();

$newsItems = $page->news_items()->toStructure()->map(function ($item) {
    $img = $item->image()->toFile();
    return [
        'title' => $item->title()->value(),
        'description' => $item->description()->value(),
        'src' => $img ? $img->url() : null,
        'projectId' => $item->projectId()->value()
    ];
})->values();

return [
    'header' => [
        'title' => $page->header_title()->value(),
        'intro' => $page->header_intro()->value(),
        'image' => $headerImg ? $headerImg->url() : null
    ],
    'banner' => [
        'text' => $page->banner_text()->value(),
        'linkText' => $page->banner_link_text()->value(),
    ],
    'newsItems' => $newsItems,
    'footerCta' => [
        'show' => $page->show_footer_cta()->toBool(),
        'title' => $site->global_cta_title()->value(),
        'text' => $site->global_cta_text()->value()
    ]
];