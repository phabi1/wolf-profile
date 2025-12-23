<?php

namespace Wolf\Profile\Form;

use Wolf\Forms\Form\AbstractForm;

class PasswordResetForm extends AbstractForm
{
    public function getForm()
    {
        return '
        <form method="post" class="form">
        <input type="hidden" name="wolf_forms_form_id" value="wolf-profile.form.password_reset">
            <div class="form-group">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div>
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>';
    }

    public function validateForm()
    {
        $state = $this->getState();
        $values = $state->getValues();

        if (empty($values['new_password'])) {
            $state->setError('new_password', 'New password is required.');
        } elseif (strlen($values['new_password']) < 6) {
            $state->setError('new_password', 'Password must be at least 6 characters long.');
        }

        if (empty($values['confirm_password'])) {
            $state->setError('confirm_password', 'Please confirm your password.');
        } elseif ($values['new_password'] !== $values['confirm_password']) {
            $state->setError('confirm_password', 'Passwords do not match.');
        }
    }

    public function submitForm()
    {
        $state = $this->getState();
        $values = $state->getValues();
        $user_login = isset($_GET['login']) ? rawurldecode($_GET['login']) : '';
        $reset_key = isset($_GET['key']) ? $_GET['key'] : '';

        $user = get_user_by('login', $user_login);
        if ($user) {
            $result = reset_password($user, $values['new_password'], $reset_key);
            if (is_wp_error($result)) {
                return false;
            }
            return true;
        }

        return false;
    }
}
