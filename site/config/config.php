<?php
use Kirby\Http\Response;

$allowed_origins = [
    'http://localhost:3000',
    'http://localhost:3001',
    'https://www.new.cdsh.de',
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
            [
                'pattern' => 'form/audition',
                'method' => 'POST|OPTIONS',
                'action' => function () {

                    header('Access-Control-Allow-Origin: http://localhost:3000');
                    header('Access-Control-Allow-Methods: POST, OPTIONS');
                    header('Access-Control-Allow-Headers: Content-Type, Authorization');

                    if (kirby()->request()->method() === 'OPTIONS') {
                        return response::json([], 200);
                    }

                    $request = kirby()->request();
                    $data = $request->data();
                    $files = $request->files();
                    $getArray = function ($key) use ($data) {
                        if (isset($data[$key])) {
                            return is_array($data[$key])
                                ? $data[$key]
                                : array_filter(array_map('trim', explode(',', $data[$key])));
                        }

                        if (isset($data[$key . '[]'])) {
                            return is_array($data[$key . '[]'])
                                ? $data[$key . '[]']
                                : [$data[$key . '[]']];
                        }

                        return [];
                    };
                    $getBool = function ($key) use ($data) {
                        if (!isset($data[$key]))
                            return false;
                        return filter_var($data[$key], FILTER_VALIDATE_BOOLEAN);
                    };

                    $normalized = [
                        'vorname' => $data['vorname'] ?? '',
                        'nachname' => $data['nachname'] ?? '',
                        'geburtsdatum' => $data['geburtsdatum'] ?? '',
                        'email' => $data['email'] ?? '',
                        'telefon' => $data['telefon'] ?? '',
                        'strasse' => $data['strasse'] ?? '',
                        'hausnummer' => $data['hausnummer'] ?? '',
                        'plz' => $data['plz'] ?? '',
                        'ort' => $data['ort'] ?? '',
                        'muttersprache' => $data['muttersprache'] ?? '',
                        'audition_selection' => $getArray('audition_selection'),
                        'erf_mog_list' => $getArray('erf_mog_list'),
                        'zusatzliche_fahigkeiten' => $data['zusatzliche_fahigkeiten'] ?? '',
                        'accept_data_verbindliche_anmeldung' => $getBool('accept_data_verbindliche_anmeldung'),
                        'accept_data_datenschutz' => $getBool('accept_data_datenschutz'),
                    ];

                    $required = [
                        'vorname',
                        'nachname',
                        'geburtsdatum',
                        'email'
                    ];

                    foreach ($required as $field) {
                        if (empty($normalized[$field])) {
                            return response::json(['error' => "Missing field: $field"], 400);
                        }
                    }

                    if (!$normalized['accept_data_verbindliche_anmeldung'] || !$normalized['accept_data_datenschutz']) {
                        return response::json(['error' => 'You must accept required terms'], 400);
                    }

                    $picture = $files->get('picture');

                    if (!$picture) {
                        return response::json(['error' => 'Picture profile required'], 400);
                    }

                    try {
                        kirby()->email([
                            'to' => 'auditions@cdsh.de', // Email of who is receiving the audition
                            'from' => 'no-reply@cdsh.de',   // username SMTP
                            'replyTo' => $normalized['email'],
                            'subject' => 'New Audition: ' . $normalized['vorname'] . ' ' . $normalized['nachname'],
                            'template' => 'audition',
                            'data' => [
                                'vorname' => $normalized['vorname'],
                                'nachname' => $normalized['nachname'],
                                'email' => $normalized['email'],
                                'geburtsdatum' => $normalized['geburtsdatum'],
                                'telefon' => $normalized['telefon'] ?: 'N/A',
                                'address' => trim($normalized['strasse'] . ' ' . $normalized['hausnummer']),
                                'stadt' => trim($normalized['plz'] . ' ' . $normalized['ort']),
                                'sprache' => $normalized['muttersprache'],
                                'audition_selection' => $normalized['audition_selection'] ?? [],
                                'erf_mog_list' => $normalized['erf_mog_list'] ?? [],
                                'zusatzliche_fahigkeiten' => $normalized['zusatzliche_fahigkeiten'] ?? '',
                            ],
                            'attachments' => [
                                $picture['tmp_name'] // attachments
                            ]
                        ]);

                        return response::json([
                            'status' => 'success',
                            'message' => 'Candidacy sent succesfully'
                        ]);

                    } catch (Exception $e) {
                        return response::json([
                            'status' => 'error',
                            'message' => 'Error: ' . $e->getMessage()
                        ], 500);
                    }
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

    'email' => [
        'transport' => [
            'type' => 'smtp',
            'host' => $_ENV['SMTP_HOST'] ?? null,
            'port' => 587,
            'security' => 'tls',
            'auth' => true,
            'username' => $_ENV['SMTP_USER'] ?? null,
            'password' => $_ENV['SMTP_PASS'] ?? null,
        ]
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
            'pattern' => 'form/audition',
            'method' => 'POST|OPTIONS',
            'action' => function () {

                header('Access-Control-Allow-Origin: http://localhost:3000');
                header('Access-Control-Allow-Methods: POST, OPTIONS');
                header('Access-Control-Allow-Headers: Content-Type, Authorization');
                header('Access-Control-Allow-Credentials: true');

                if (kirby()->request()->method() === 'OPTIONS') {
                    return response::json([], 200);
                }

                $request = kirby()->request();
                $data = $request->data();
                $files = $request->files();

                // Required fields (mirror your Yup rules)
                $required = [
                    'vorname',
                    'nachname',
                    'geburtsdatum',
                    'email',
                    'accept_data_verbindliche_anmeldung',
                    'accept_data_datenschutz'
                ];

                foreach ($required as $field) {
                    if (empty($data[$field])) {
                        return response::json([
                            'error' => "Missing field: $field"
                        ], 400);
                    }
                }

                // File validation
                $picture = $files->get('durchsuchen');

                if (empty($picture)) {
                        return response::json(['error' => 'Portrait photo required'], 400);
                }
                if ($picture['error'] !== UPLOAD_ERR_OK) {
                    return response::json(['error' => 'Upload failed'], 400);
                }

                if ($picture['size'] > 3 * 1024 * 1024) {
                    return response::json(['error' => 'File too large'], 400);
                    return response::json(['error' => 'File too large'], 400);
                }

                $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp'];
                if (!in_array($picture['type'], $allowed)) {
                    return response::json(['error' => 'Invalid file type'], 400);
                    return response::json(['error' => 'Invalid file type'], 400);
                }

                // Send email
                kirby()->email([
                'to'      => 'auditions@cdsh.de',
                'from'    => 'no-reply@cdsh.de',
                'replyTo' => $data['email'],
                'subject' => 'Neue Audition-Anmeldung',
                'body' => "Neue Audition-Anmeldung von {$data['vorname']} {$data['nachname']}",
                'html'    => tpl::load(kirby()->root('templates') . '/emails/audition.php', [
                    'data' => $data
                ]),
                'attachments' => [
                    $picture['tmp_name']
                ]
                ]);

                return response::json([
                    'status' => 'ok',
                    'message' => 'POST route reached'
                ]);

                return response::json(['success' => true]);
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