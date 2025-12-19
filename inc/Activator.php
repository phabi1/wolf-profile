<?php

namespace Wolf\Profile;

class Activator
{
    private $pages = [];

    public function __construct()
    {
        $this->pages = [
            ['title' => 'User Profile', 'slug' => 'profile', 'content' => '<-- wolf-profile:user-profile /-->'],
            ['title' => 'Edit Profile', 'slug' => 'edit-profile', 'content' => '<-- wolf-profile:edit-profile /-->'],
            ['title' => 'Signin', 'slug' => 'signin', 'content' => '<-- wolf-profile:auth-signin /-->'],
            ['title' => 'Signup', 'slug' => 'signup', 'content' => '<-- wolf-profile:auth-signup /-->'],
            ['title' => 'Signout', 'slug' => 'signout', 'content' => '<-- wolf-profile:auth-signout /-->'],
            ['title' => 'Password Reset', 'slug' => 'password-reset', 'content' => '<-- wolf-profile:auth-password-reset /-->'],
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
            wp_insert_post([
                'post_title'   => $page['title'],
                'post_name'    => $page['slug'],
                'post_content' => $page['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',

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
