<?php
// site/templates/home.json.php
$site = site();

$getFileUrl = function ($field) {
    $file = $field->toFile();
    return $file ? $file->url() : null;
};

$newsPage = page('news');
$newsItems = [];

if ($newsPage) {
    $newsItems = $newsPage->news_items()->toStructure()->map(function ($item) use ($getFileUrl) {
        return [
            'title' => $item->title()->value(),
            'description' => $item->description()->value(),
            'src' => $getFileUrl($item->image()),
            'projectId' => $item->projectId()->value()
        ];
    })->values();
}

return [
    'header' => [
        'headline' => $page->intro_headline()->value(),
        'video' => $getFileUrl($page->header_video()),
    ],
    'intro' => [
        'text_1' => $page->intro_text_1()->value(),
        'text_2' => $page->intro_text_2()->value(),
    ],

    'aktuelles' => [
        'headline' => $page->aktuelles_headline()->value(),
        'items' => $newsItems,
    ],

    'aboutUs' => [
        'headline' => $page->team_header()->value(),
        'text' => $page->team_text()->value(),
        'image' => $getFileUrl($page->team_image()),
    ],

    'audition_banner' => [
        'text' => $page->audition_text()->value(),
        'link_text' => $page->audition_link_text()->value(),
    ],

    'footerCta' => [
        'show' => $page->show_footer_cta()->toBool(),
        'title' => $site->global_cta_title()->value(),
        'text' => $site->global_cta_text()->value()
    ]
];