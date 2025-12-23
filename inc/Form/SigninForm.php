<?php

namespace Wolf\Profile\Form;

use Wolf\Forms\Form\AbstractForm;

class SigninForm extends AbstractForm
{
    public function getForm()
    {
        $values = $this->getState()->getValues();
        $identity = isset($values['username']) ? esc_attr($values['username']) : '';
        $password = isset($values['password']) ? esc_attr($values['password']) : '';

        return '<form method="post" class="form">
        <input type="hidden" name="wolf_forms_form_id" value="wolf-profile.form.signin">
            <div class="form-group">
                <label for="username" class="form-label">Username or Email</label>
                <input type="text" id="username" name="username" class="form-control" value="' . $identity . '" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" value="' . $password . '" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>';
    }

    public function validateForm()
    {
        $state = $this->getState();
        $values = $state->getValues();

        if (empty($values['username'])) {
            $state->setError('username', 'Username or Email is required.');
        }

        if (empty($values['password'])) {
            $state->setError('password', 'Password is required.');
        }
    }

    public function submitForm()
    {
        $state = $this->getState();
        $values = $state->getValues();
        try {
            wp_signon([
                'user_login'    => $values['username'],
                'user_password' => $values['password'],
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
