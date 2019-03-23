<?php
    namespace SchoolFinder\Controllers;

    class WebController extends Controller
    {
        public function home($request, $response)
        {
            return $this->view->render($response, 'views/landing/home.html', [
                'title' => 'Home',
                'uri' => 'home'
            ]);
        }

        public function features($request, $response)
        {
            return $this->view->render($response, 'views/landing/features.html', [
                'title' => 'Home',
                'uri' => 'home'
            ]);
        }

        public function contact_us($request, $response)
        {
            return $this->view->render($response, 'views/landing/contact-us.html', [
                'title' => 'Home',
                'uri' => 'home'
            ]);
        }

        public function for_schools($request, $response)
        {
            return $this->view->render($response, 'views/landing/for-schools.html', [
                'title' => 'Home',
                'uri' => 'home'
            ]);
        }

        public function search($request, $response)
        {
            $results = 0;
            $text = ($results != 1) ? 'results' : 'result';

            return $this->view->render($response, 'views/landing/search.html', [
                'title' => 'Home',
                'uri' => 'search',
                'found' => '<strong>'.$results.'</strong> '.$text.' found'
            ]);
        }
    }
    