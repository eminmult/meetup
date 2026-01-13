<?php

return [
    'navigation_label' => 'Site Optimization',
    'title' => 'Site Optimization',

    'sections' => [
        'counts' => 'Items Count on Pages',
        'counts_description' => 'Configure the number of displayed items on different site pages',
    ],

    'fields' => [
        'home_posts_count' => 'Posts count on homepage',
        'search_posts_count' => 'Posts count on search page',
        'category_posts_count' => 'Posts count on category page',
        'tag_posts_count' => 'Posts count on tag page',
        'slider_posts_count' => 'Posts count in slider (main block)',
        'related_posts_count' => 'Related posts count',
        'trending_posts_count' => 'Trending posts count (TODAY\'S IMPORTANT)',
        'popular_posts_count' => 'Popular posts count (sidebar)',
        'popular_posts_days' => 'Days range for popular posts',
        'weather_city' => 'City for weather forecast',
    ],

    'actions' => [
        'save' => 'Save',
    ],

    'notifications' => [
        'saved_title' => 'Saved',
        'saved_body' => 'Optimization settings updated successfully.',
    ],
];
