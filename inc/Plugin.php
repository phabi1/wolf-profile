<?php
namespace Wolf\Profile;

class Plugin
{
    public function bootstrap()
    {
        \add_action('init', [new Blocks(), 'setup']);
    }
}
