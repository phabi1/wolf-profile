<?php

namespace Wolf\Profile\Form;

use Wolf\Forms\Form\AbstractForm;

class PasswordResetForm extends AbstractForm
{
    public function getForm()
    {
        return '
        <form method="post">
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>';
    }
}
