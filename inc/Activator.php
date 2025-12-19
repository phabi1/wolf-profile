<?php

namespace Wolf\Event;

class Activator
{
    private $pages = [];

    public function __construct()
    {
        $this->pages = [
            ['title' => 'User Profile', 'slug' => 'profile'],
            ['title' => 'Edit Profile', 'slug' => 'edit-profile'],
            ['title' => 'Signin', 'slug' => 'signin'],
            ['title' => 'Signup', 'slug' => 'signup'],
            ['title' => 'Signout', 'slug' => 'signout'],
            ['title' => 'Password Reset', 'slug' => 'password-reset'],
        ];
    }

    public function activate()
    {
        $this->createPages();
    }

    public function deactivate()
    {
        $this->removePages();
    }

    protected function createPages()
    {
        foreach ($this->pages as $page) {
            $page = wp_insert_post([
                'post_title'   => $page['title'],
                'post_name'    => $page['slug'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '<!-- wp:wolf/profile-' . str_replace('-', '', $page['slug']) . ' /-->',
            ]);
        }
    }

    protected function removePages()
    {
        foreach ($this->pages as $page) {
            $existing_page = get_page_by_path($page['slug']);
            if ($existing_page) {
                wp_delete_post($existing_page->ID, true);
            }
        }
    }
}
