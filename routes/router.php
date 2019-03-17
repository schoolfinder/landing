<?php

    $app->group('', function() {
        $this->get('/', 'WebController:home')->setName('home');
        $this->get('/features', 'WebController:features')->setName('features');
        $this->get('/contact-us', 'WebController:contact_us')->setName('contact-us');
        $this->get('/for-schools', 'WebController:for_schools')->setName('for-schools');
        $this->get('/search', 'WebController:search')->setName('search');
    });