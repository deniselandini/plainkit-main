<?php
// site/templates/education.json.php
$site = site();

$newsPage = page('news');
$newsItems = [];

if ($newsPage) {
    $newsItems = $newsPage->news_items()->toStructure()->map(function ($item) {
        $img = $item->image()->toFile();
        return [
            'title' => $item->title()->value(),
            'description' => $item->description()->value(),
            'src' => $img ? $img->url() : null,
            'projectId' => $item->projectId()->value()
        ];
    })->values();
}

$categories_map = [];
$availableCategories = [];
foreach ($page->categories_manager()->toStructure() as $cat) {
    $id = $cat->category_id()->value();
    $name = $cat->category_name()->value();
    $categories_map[$id] = $name;
    $availableCategories[] = [
        'id' => $id,
        'name' => $name
    ];
}

$subjectsArray = [];
foreach ($page->subjects_list()->toStructure() as $sub) {
    $img = $sub->image()->toFile();

    $subjectsArray[] = [
        'id' => $sub->id(),
        'name' => $sub->name()->value(),
        'description' => $sub->description()->value(),
        'teacher' => $sub->teacher()->value(),
        'tab' => $sub->categories()->split(','),
        'src' => $img ? $img->url() : null,
    ];
}

$ausbildungYears = [
    [
        'year' => 1,
        'headline' => $page->firstYear_headline()->value(),
        'level' => $page->firstYear_level()->value(),
        'description' => $page->firstYear_description()->value(),
    ],
    [
        'year' => 2,
        'headline' => $page->secondYear_headline()->value(),
        'level' => $page->secondYear_level()->value(),
        'description' => $page->secondYear_description()->value(),
    ],
    [
        'year' => 3,
        'headline' => $page->thirdYear_headline()->value(),
        'level' => $page->thirdYear_level()->value(),
        'description' => $page->thirdYear_description()->value(),
    ]
];


$fortImg = $page->fortbuildung_image()->toFile();
$fortbildung = [
    'headline' => $page->fortbuildung_headline()->value(),
    'overview' => $page->fortbuildung_overview()->value(),
    'schedule' => $page->fortbuildung_schedule()->value(),
    'requirement' => $page->fortbuildung_requirement()->value(),
    'image' => $fortImg ? $fortImg->url() : null,
];


return [
    'header' => [
        'headline' => $page->header_headline()->value(),
        'image' => $page->header_image()->toFile() ? $page->header_image()->toFile()->url() : null,
    ],
    'intro' => [
        'text_left' => $page->intro_text_left()->value(),
        'text_right' => $page->intro_text_right()->value(),
    ],

    'audition_banner' => [
        'text' => $page->audition_text()->value(),
        'link_text' => $page->audition_link_text()->value(),
    ],

    'filterCategories' => $availableCategories,
    'subjects' => $subjectsArray,

    'program_structure' => [
        'title' => $page->program_structure_title()->value(),
        'intro' => $page->program_structure_intro()->value(),
        'details' => $page->program_structure_details()->value(),
    ],

    'ausbildung_years' => $ausbildungYears,

    'costs' => [
        'headline' => $page->costs_headline()->value(),
        'text' => $page->costs_text()->value(),
    ],

    'fortbildung' => $fortbildung,

    'aktuelles' => [
        'headline' => $page->aktuelles_headline()->value(),
        'items' => $newsItems,
    ],

    'footerCta' => [
        'show' => $page->show_footer_cta()->toBool(),
        'title' => $site->global_cta_title()->value(),
        'text' => $site->global_cta_text()->value()
    ]
];
