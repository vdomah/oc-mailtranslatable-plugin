<?php return [
    'plugin' => [
        'name' => 'Mail Translatable',
        'description' => 'Multilingual mail templates stored in database',
    ],
    'fields' => [
        'mail_template' => 'Mail Template',
        'subject' => 'Subject',
        'description' => 'Description',
        'html' => 'Html',
        'plain' => 'Plain',
    ],
    'menu' => [
        'templates_label' => 'Mail Templates Translations',
        'templates_description' => 'Translate mail templates to any active language',
    ],
    'permissions' => [
        'access_settings' => 'Access settings',
    ],
];