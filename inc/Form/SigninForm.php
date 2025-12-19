<?php

namespace Wolf\Profile\Form;

use Wolf\Forms\Form\AbstractForm;
use Wolf\Forms\Form\FormResult;

class SigninForm extends AbstractForm
{
    public function getForm()
    {
        return '<form method="post">
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>';
    }

    public function validateForm($data)
    {
        $errors = [];

        if (empty($data['username'])) {
            $errors['username'] = 'Username or Email is required.';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Password is required.';
        }

        $result = new FormResult(empty($errors), $errors);
        return $result;
    }

    public function submitForm($data)
    {
        try {
            wp_signon([
                'user_login'    => $data['username'],
                'user_password' => $data['password'],
                'remember'      => true,
            ], false);
        } catch (\Exception $e) {
            return false;
        }

        $redirect_url = isset($_GET['redirect_to']) ? esc_url_raw($_GET['redirect_to']) : home_url();
        wp_safe_redirect($redirect_url);
        exit;
    }
}
