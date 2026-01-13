<?php

return [
    'navigation_label' => 'Robots.txt',
    'title' => 'Robots.txt Editor',

    'sections' => [
        'editor' => 'Robots.txt File',
        'editor_description' => 'Configure rules for search bots. Changes are applied immediately.',
    ],

    'fields' => [
        'content' => 'Content',
        'content_helper' => 'Contents of robots.txt file. Be careful - incorrect configuration may affect your site indexing.',
    ],

    'actions' => [
        'save' => 'Save',
    ],

    'notifications' => [
        'saved_title' => 'Saved',
        'saved_body' => 'Robots.txt file updated successfully. Backup created.',
    ],
];
