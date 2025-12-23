<?php

namespace Wolf\Profile\Form;

use Wolf\Forms\Form\AbstractForm;

class SignupForm extends AbstractForm
{
    public function getForm()
    {
        $state = $this->getState();
        $values = $state->getValues();
        $first_name = isset($values['first_name']) ? esc_attr($values['first_name']) : '';
        $last_name = isset($values['last_name']) ? esc_attr($values['last_name']) : '';
        $email = isset($values['email']) ? esc_attr($values['email']) : '';
        $username = isset($values['username']) ? esc_attr($values['username']) : '';
        $password = isset($values['password']) ? esc_attr($values['password']) : '';


        if (is_user_logged_in()) {
            return '<p>You are already logged in.</p>';
        }

        if ($state->isSubmitted() && !$state->hasErrors()) {
            return '<p>Registration successful. You can now <a href="' . esc_url(wp_login_url()) . '">log in</a>.</p>';
        }

        return '<form method="post" class="form">
        <input type="hidden" name="wolf_forms_form_id" value="wolf-profile.form.signup"> 
            <div class="form-group">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="' . $first_name . '" required>    
                ' . ($state->hasError('first_name') ? '<div class="error-message">' . $state->getError('first_name') . '</div>' : '') . '
            </div>
            <div class="form-group">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="' . $last_name . '" required>    
                ' . ($state->hasError('last_name') ? '<div class="error-message">' . $state->getError('last_name') . '</div>' : '') . '
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="' . $email . '" required>
                ' . ($state->hasError('email') ? '<div class="error-message">' . $state->getError('email') . '</div>' : '') . '
            </div>
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="' . $username . '" required>
                ' . ($state->hasError('username') ? '<div class="error-message">' . $state->getError('username') . '</div>' : '') . '
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" value="' . $password . '" required>
                ' . ($state->hasError('password') ? '<div class="error-message">' . $state->getError('password') . '</div>' : '') . '
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>';
    }

    public function validateForm()
    {
        $state = $this->getState();
        $values = $state->getValues();

        if (empty($values['first_name'])) {
            $state->setError('first_name', 'First name is required.');
        }

        if (empty($values['last_name'])) {
            $state->setError('last_name', 'Last name is required.');
        }

        if (empty($values['email'])) {
            $state->setError('email', 'Email is required.');
        } elseif (!is_email($values['email'])) {
            $state->setError('email', 'Invalid email format.');
        } elseif (email_exists($values['email'])) {
            $state->setError('email', 'Email is already registered.');
        }

        if (empty($values['username'])) {
            $state->setError('username', 'Username is required.');
        } elseif (username_exists($values['username'])) {
            $state->setError('username', 'Username is already taken.');
        }

        if (empty($values['password'])) {
            $state->setError('password', 'Password is required.');
        } elseif (strlen($values['password']) < 6) {
            $state->setError('password', 'Password must be at least 6 characters long.');
        }
    }

    public function submitForm()
    {
        $state = $this->getState();
        $values = $state->getValues();
        $user_id = wp_create_user($values['username'], $values['password'], $values['email']);

        if (is_wp_error($user_id)) {
            return false;
        }

        wp_update_user([
            'ID' => $user_id,
            'first_name' => sanitize_text_field($values['first_name']),
            'last_name' => sanitize_text_field($values['last_name']),
        ]);


        $redirect_url = isset($_GET['redirect_to']) ? esc_url_raw($_GET['redirect_to']) : home_url();
        wp_safe_redirect($redirect_url);
        exit;
    }
}
