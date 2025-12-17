<?php
// site/templates/team.json.php
$site = site();
$searchId = get('id');

$membersStructure = $page->team_members()->toStructure();
$docentsStructure = $page->docents_members()->toStructure();

$roles_map = [];
$availableRoles = [];
foreach ($page->roles_manager()->toStructure() as $role) {
    $id = $role->role_id()->value();
    $name = $role->role_name()->value();
    $roles_map[$id] = $name;
    $availableRoles[] = [
        'id' => $id,
        'name' => $name
    ];
}
if ($searchId) {
    $member = $membersStructure->findBy('member_id', $searchId);
    $roleValues = $member->member_role()->split(',');
    $rolesArray = [];

    foreach ($roleValues as $roleValue) {
        $roleValue = trim($roleValue);
        $rolesArray[] = [
            'id' => $roleValue,
            'name' => $roles_map[$roleValue] ?? $roleValue
        ];
    }

    if ($member) {
        $imageFile = $member->member_image()->toFile();
        $roleId = $member->member_role()->value();
        return [
            'id' => $member->member_id()->value(),
            'name' => $member->member_name()->value(),
            'biographyLeft' => $member->member_biography_left()->value(),
            'biographyRight' => $member->member_biography_right()->value(),
            'roles' => $rolesArray,
            'subjects' => $member->member_subjects()->split(','),
            'src' => $imageFile ? $imageFile->url() : null,
        ];
    } else {
        return ['error' => 'Member not found'];
    }

} else {
    $teamArray = [];
    $docentsArray = [];

    $headerImg = $page->header_image()->toFile();
    $memoriamImg = $page->memoriam_image()->toFile();

    foreach ($membersStructure as $member) {
        $imageFile = $member->member_image()->toFile();
        $roleId = $member->member_role()->value();
        $teamArray[] = [
            'id' => $member->member_id()->value(),
            'name' => $member->member_name()->value(),
            'role' => $roles_map[$roleId] ?? $roleId,
            'subjects' => $member->member_subjects()->split(','),
            'src' => $imageFile ? $imageFile->url() : null,
        ];
    }

    foreach ($docentsStructure as $docent) {
        $imageFile = $docent->member_image()->toFile();
        $roleId = $docent->member_role()->value();
        $docentsArray[] = [
            'id' => $docent->member_id()->value(),
            'name' => $docent->member_name()->value(),
            'role' => $roles_map[$roleId] ?? $roleId,
            'subjects' => $docent->member_subjects()->split(','),
            'src' => $imageFile ? $imageFile->url() : null,
        ];
    }

    return [
        'intro' => [
            'headline' => $page->intro_headline()->value(),
            'text' => $page->intro_text()->value(),
            'image' => $headerImg ? $headerImg->url() : null
        ],
        'leadership' => [
            'headline' => $page->leadership_headline()->value(),
            'text' => $page->leadership_text()->value(),
        ],
        'teamMembers' => $teamArray,
        'docentsMembers' => $docentsArray,
        'memoriam' => [
            'headline' => $page->memoriam_headline()->value(),
            'text_left' => $page->memoriam_text_left()->value(),
            'text_right' => $page->memoriam_text_right()->value(),
            'image' => $memoriamImg ? $memoriamImg->url() : null
        ],
        'teachers' => [
            'headline' => $page->teachers_headline()->value(),
            'text' => $page->teachers_text()->value(),
        ],
        'footerCta' => [
            'show' => $page->show_footer_cta()->toBool(),
            'title' => $site->global_cta_title()->value(),
            'text' => $site->global_cta_text()->value()
        ]
    ];

}