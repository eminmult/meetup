<?php

return [
    'navigation_label' => 'Main Info',
    'title' => 'Site Main Information',

    'sections' => [
        'main' => 'Main Information',
        'content_by_languages' => 'Content by languages',
        'contact' => 'Contact Information',
        'advertising' => 'Advertising Information',
        'seo' => 'SEO and Meta Information',
    ],

    'fields' => [
        'site_name' => 'Site Name',
        'site_url' => 'Site URL',
        'site_title' => 'Site Title',
        'site_description' => 'Site Description',
        'address' => 'Address',
        'emails' => 'Email Addresses',
        'phones' => 'Phones',
        'fax' => 'Fax',
        'location' => 'Location (Google Maps)',
        'location_placeholder' => 'https://maps.google.com/...',
        'reklam_emails' => 'Advertising Email',
        'reklam_phones' => 'Advertising Phones',
        'meta_title' => 'Meta Title',
        'meta_description' => 'Meta Description',
        'meta_keywords' => 'Meta Keywords',
        'meta_keywords_helper' => 'Keywords separated by commas',
    ],

    'actions' => [
        'save' => 'Save',
        'add_email' => 'Add email',
        'add_phone' => 'Add phone',
    ],

    'notifications' => [
        'saved_title' => 'Saved',
        'saved_body' => 'Main information updated successfully.',
    ],
];
