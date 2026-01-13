<?php

return [
    'title' => 'Users',
    'singular' => 'User',
    'plural' => 'Users',

    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_helper' => 'Leave empty to keep current password',
        'is_active' => 'Active',
        'is_active_helper' => 'Inactive users cannot log in to admin, but their posts remain on the site',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'actions' => [
        'create' => 'Create user',
        'edit' => 'Edit user',
        'delete' => 'Delete user',
    ],

    'notifications' => [
        'created' => 'User created successfully',
        'updated' => 'User updated successfully',
        'deleted' => 'User deleted successfully',
    ],
];
