<?php
use Kirby\Http\Response;

$allowed_origins = [
    'http://localhost:3000',
    'http://localhost:3001'
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? null;
$is_origin_allowed = in_array($origin, $allowed_origins);

return [
    'debug' => true,
    'languages' => true,
    'thumbs' => [
            'driver' => 'gd'
        ],

    'api' => [
        'allowInsecure' => true,

        'routes' => [
            [
                'pattern' => 'reset-password/(:any)',
                'method' => 'GET',
                'action' => function ($email) {
                    try {
                        kirby()->auth()->createChallenge($email, false, 'password-reset');
                    } catch (\Exception $e) {
                        return new Response($e->getMessage(), 'text/plain', 400);
                    }

                    return Response::redirect('panel/login');
                }
            ],

            [
                'pattern' => '(:all)',
                'method' => 'OPTIONS',
                'action' => function () use ($origin, $is_origin_allowed) {
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    return new Response('', 'text/plain', 204);
                }
            ],

            //BANNER AUDITION
            [
                'pattern' => 'banner_audition',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', 'en');
                    kirby()->setCurrentLanguage($langCode);

                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type');
                    }

                    // Questo carica il file che hai creato nel punto 1
                    return require kirby()->root('snippets') . '/banner_audition.json.php';
                }
            ],

            // HOME
            [
                'pattern' => 'home',
                'method' => 'GET',
                'auth' => false,
                'action' => function () {
                    $langCode = get('lang', 'en');
                    kirby()->setCurrentLanguage($langCode);
                    header('Access-Control-Allow-Origin: http://localhost:3000');
                    $page = page('home');
                    if (!$page) {
                        return new Response('Home page not found', 'application/json', 404);
                    }
                    return require kirby()->root('templates') . '/home.json.php';
                }
            ],

            // ABOUT US
            [
                'pattern' => 'aboutUs',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', 'en');
                    kirby()->setCurrentLanguage($langCode);
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    $page = page('aboutUs');
                    if (!$page) {
                        return new Response('About page not found', 'application/json', 404);
                    }
                    return require kirby()->root('templates') . '/aboutUs.json.php';
                }
            ],

            // TEAM 
            [
                'pattern' => 'team',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', 'en');
                    kirby()->setCurrentLanguage($langCode);
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    header("Content-Type: application/json");
                    $page = page('team');
                    if (!$page) {
                        return new Response('Page not found', 'text/plain', 404);
                    }
                    $data = require kirby()->root('templates') . '/team.json.php';
                    return $data;
                }
            ],

            // STUDENTS (CLASSES)
            [
                'pattern' => 'students',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', 'en');
                    kirby()->setCurrentLanguage($langCode);
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    header("Content-Type: application/json");
                    $page = page('students');
                    if (!$page) {
                        return new Response('Classes page not found', 'text/plain', 404);
                    }
                    $data = require kirby()->root('templates') . '/students.json.php';
                    return $data;
                }
            ],

            // PROJECTS 
            [
                'pattern' => 'projects',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', 'en');
                    kirby()->setCurrentLanguage($langCode);
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    header("Content-Type: application/json");
                    $page = page('projects');
                    if (!$page) {
                        return new Response('Projects page not found', 'text/plain', 404);
                    }
                    $data = require kirby()->root('templates') . '/projects.json.php';
                    return $data;
                }
            ],

            // EDUCATION 
            [
                'pattern' => 'education',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', 'en');
                    kirby()->setCurrentLanguage($langCode);
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    header("Content-Type: application/json");
                    $page = page('education');
                    if (!$page) {
                        return new Response('Education page not found', 'text/plain', 404);
                    }
                    $data = require kirby()->root('templates') . '/education.json.php';
                    return $data;
                }
            ],

            // AUDITIONS
            [
                'pattern' => 'auditions',
                'method' => 'GET',
                'auth' => false,
                'action' => function () {
                    $langCode = get('lang', default: 'en');
                    kirby()->setCurrentLanguage($langCode);
                    header('Access-Control-Allow-Origin: http://localhost:3000');
                    $page = page('auditions');
                    if (!$page) {
                        return new Kirby\Http\Response('Auditions page not found', 'application/json', 404);
                    }
                    return require kirby()->root('templates') . '/auditions.json.php';
                }
            ],

            // NEWS
            [
                'pattern' => 'news',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', 'en');
                    kirby()->setCurrentLanguage($langCode);
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    $page = page('news');
                    if (!$page) {
                        return new Kirby\Http\Response('News page not found', 'application/json', 404);
                    }
                    return require kirby()->root('templates') . '/news.json.php';
                }
            ],

            // FAQ
            [
                'pattern' => 'faq',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', default: 'en');
                    kirby()->setCurrentLanguage($langCode);
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    $page = page('faq');
                    if (!$page) {
                        return new Kirby\Http\Response('Faq page not found', 'application/json', 404);
                    }
                    return require kirby()->root('templates') . '/faq.json.php';
                }
            ],

            // DATA PROTECTION
            [
                'pattern' => 'dataProtection',
                'method' => 'GET',
                'auth' => false,
                'action' => function () use ($origin, $is_origin_allowed) {
                    $langCode = get('lang', default: 'en');
                    kirby()->setCurrentLanguage($langCode);
                    if ($is_origin_allowed) {
                        header("Access-Control-Allow-Origin: $origin");
                        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
                        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
                        header('Access-Control-Max-Age: 86400');
                    }
                    $page = page('dataProtection');
                    if (!$page) {
                        return new Kirby\Http\Response('Data Protection page not found', 'application/json', 404);
                    }
                    return require kirby()->root('templates') . '/dataProtection.json.php';
                }
            ],

            // IMPRESSUM
            [
                'pattern' => 'impressum',
                'method' => 'GET',
                'auth' => false,
                'action' => function () {
                    $langCode = get('lang', default: 'en');
                    kirby()->setCurrentLanguage($langCode);
                    header('Access-Control-Allow-Origin: http://localhost:3000');
                    $page = page('impressum');
                    if (!$page) {
                        return new Kirby\Http\Response('Impressum page not found', 'application/json', 404);
                    }
                    return require kirby()->root('templates') . '/impressum.json.php';
                }
            ],

            // AGB
            [
                'pattern' => 'agb',
                'method' => 'GET',
                'auth' => false,
                'action' => function () {
                    $langCode = get('lang', default: 'en');
                    kirby()->setCurrentLanguage($langCode);
                    header('Access-Control-Allow-Origin: http://localhost:3000');
                    $page = page('agb');
                    if (!$page) {
                        return new Kirby\Http\Response('AGB page not found', 'application/json', 404);
                    }
                    return require kirby()->root('templates') . '/agb.json.php';
                }
            ],
        ],
    ],

    // ===================================
    // 2. ROTTE ESTERNE NON-API (Opzionale)
    // ===================================
    // 'routes' è per rotte che non usano il prefisso /api
    'routes' => [
        // Esempio: auth/ping non usa il prefisso API
        [
            'pattern' => 'auth/ping',
            'method' => 'GET',
            'action' => function () use ($origin, $is_origin_allowed) {
                return [
                    'status' => 'success',
                    'message' => 'API is alive and ready.',
                    'timestamp' => time()
                ];
            }
        ],
        [
            'pattern' => 'reset-password/(:any)',
            'method' => 'GET',
            'action' => function ($email) {
                try {
                    kirby()->auth()->createChallenge($email, false, 'password-reset');
                } catch (\Exception $e) {
                    return new Response($e->getMessage(), 'text/plain', 400);
                }

                return Response::redirect('plainkit-main/panel/login');
            }
        ],
    ]
];