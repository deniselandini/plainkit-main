<?php

$searchId = get('id');
$projects = $page->projects_list()->toStructure();

if ($searchId) {
    $project = $projects->findBy('project_id', $searchId);

    if (!$project) {
        return ['error' => 'Project not found'];
    }

    $headerImg = $project->header_image()->toFile();

    $photos = $project->project_photo_impressions()->toFiles()->map(fn($f) => [
        'src' => $f->url(),
        'alt' => $f->alt()->value(),
        'type' => 'image'
    ])->values();

    $videos = $project->project_video_impressions()->toFiles()->map(fn($v) => [
        'src' => $v->url(),
        'mime' => $v->mime(),
        'type' => 'video'
    ])->values();




    return [
        'id' => $project->project_id()->value(),
        'name' => $project->project_name()->value(),
        'title' => $project->project_title()->value(),
        'imageSrc' => $headerImg ? $headerImg->url() : null,
        'categories' => $project->project_categories()->split(','),
        'subjects' => $project->project_subjects()->split(','),
        'descriptionLeft' => $project->project_description_left()->value(),
        'descriptionRight' => $project->project_description_right()->value(),
        'titleImpressions' => $project->project_impressions_header()->value(),
        /* 'videos' => $videos,
        'photos' => $photos, */
        'impressions' => array_merge($videos, $photos)
    ];
}

$allProjects = [];
foreach ($projects as $p) {
    $img = $p->header_image()->toFile();
    $allProjects[] = [
        'id' => $p->project_id()->value(),
        'name' => $p->project_name()->value(),
        'title' => $p->project_title()->value(),
        'src' => $img ? $img->url() : null,
        // Add other fiels hier (see if it is necessary)
    ];


}

return $allProjects;