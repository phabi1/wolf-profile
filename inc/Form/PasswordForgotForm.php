<?php

namespace Wolf\Profile\Form;

use Wolf\Forms\Form\AbstractForm;
use Wolf\Forms\Form\FormState;

class PasswordForgotForm extends AbstractForm
{
    public function getForm(FormState $state)
    {
        return '<form method="post">
        <input type="hidden" name="wolf_forms_form_id" value="wolf-profile.form.password_forgot">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </div>
        </form>';
    }

    public function validateForm(FormState $state)
    {
        $values = $state->getValues();

        if (empty($values['email'])) {
            $state->setError('email', 'Email is required.');
        } elseif (!is_email($values['email'])) {
            $state->setError('email', 'Invalid email format.');
        } elseif (!email_exists($values['email'])) {
            $state->setError('email', 'No user found with this email.');
        }
    }

    public function submitForm(FormState $state)
    {
        $values = $state->getValues();
        $user = get_user_by('email', $values['email']);
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
