<?php
$site = site();

return [
  'active' => $site->global_audition_banner_active()->toBool(),
  'title' => $site->global_audition_banner_title()->value(),
  'link' => $site->global_audition_banner_link()->value()
];


