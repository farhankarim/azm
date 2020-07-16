<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'doctor' => [
        'title' => 'Doctors',

        'actions' => [
            'index' => 'Doctors',
            'create' => 'New Doctor',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'nurse' => [
        'title' => 'Nurses',

        'actions' => [
            'index' => 'Nurses',
            'create' => 'New Nurse',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            
        ],
    ],

    'teacher' => [
        'title' => 'Teachers',

        'actions' => [
            'index' => 'Teachers',
            'create' => 'New Teacher',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'dob' => 'Dob',
            'enabled' => 'Enabled',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];