<?php

return [
    'wolf-profile.form.password_forgot' => [
        'class' => \Wolf\Profile\Form\PasswordForgotForm::class,
        'tags' => [
            ['name' => 'wolf-forms.form', 'key' => 'wolf-profile.form.password_forgot']
        ],
    ],
    'wolf-profile.form.password_reset' => [
        'class' => \Wolf\Profile\Form\PasswordResetForm::class,
        'tags' => [
            ['name' => 'wolf-forms.form', 'key' => 'wolf-profile.form.password_reset']
        ],
    ],
    'wolf-profile.form.signin' => [
        'class' => \Wolf\Profile\Form\SigninForm::class,
        'tags' => [
            ['name' => 'wolf-forms.form', 'key' => 'wolf-profile.form.signin']
        ],
    ],
    'wolf-profile.form.signup' => [
        'class' => \Wolf\Profile\Form\SignupForm::class,
        'tags' => [
            ['name' => 'wolf-forms.form', 'key' => 'wolf-profile.form.signup']
        ],
    ],
];