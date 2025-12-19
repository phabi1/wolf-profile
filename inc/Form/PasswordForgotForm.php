<?php

namespace Wolf\Profile\Form;

use Wolf\Forms\Form\AbstractForm;
use Wolf\Forms\Form\FormResult;

class PasswordForgotForm extends AbstractForm
{
    public function getForm()
    {
        return '<form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </div>
        </form>';
    }

    public function validateForm($data) {
        $errors = [];

        if (empty($data['email'])) {
            $errors['email'] = 'Email is required.';
        } elseif (!is_email($data['email'])) {
            $errors['email'] = 'Invalid email format.';
        } elseif (!email_exists($data['email'])) {
            $errors['email'] = 'No user found with this email.';
        }

        return new FormResult(empty($errors), $errors);
    }

    public function submitForm($data)
    {
        $user = get_user_by('email', $data['email']);
        if ($user) {
            $reset_key = get_password_reset_key($user);
            $reset_link = add_query_arg([
                'key' => $reset_key,
                'login' => rawurlencode($user->user_login)
            ], wp_lostpassword_url());

            wp_mail(
                $user->user_email,
                'Password Reset Request',
                'Click the following link to reset your password: ' . $reset_link
            );
        }

        return true;
    }
}
