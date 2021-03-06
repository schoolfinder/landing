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
                'title' => 'Features',
                'uri' => 'features'
            ]);
        }

        public function contact_us($request, $response)
        {
            return $this->view->render($response, 'views/landing/contact-us.html', [
                'title' => 'Contact Us',
                'uri' => 'contact-us'
            ]);
        }

        public function for_schools($request, $response)
        {
            return $this->view->render($response, 'views/landing/for-schools.html', [
                'title' => 'For Schools',
                'uri' => 'for-schools'
            ]);
        }

        public function pricing($request, $response)
        {
            return $this->view->render($response, 'views/landing/pricing.html', [
                'title' => 'Pricing',
                'uri' => 'pricing'
            ]);
        }

        public function search($request, $response)
        {
            $results = 0;
            $text = ($results != 1) ? 'results' : 'result';

            return $this->view->render($response, 'views/landing/search.html', [
                'title' => 'Search',
                'uri' => 'search',
                'found' => '<strong>'.$results.'</strong> '.$text.' found'
            ]);
        }

        public function schools($request, $response)
        {
            $results = 0;
            $text = ($results != 1) ? 'results' : 'result';
            
            return $this->view->render($response, 'views/landing/schools.html', [
                'title' => 'Schools',
                'uri' => 'schools',
                'type' => $request->getParam('type'),
                'found' => '<strong>'.$results.'</strong> '.$text.' found'
            ]);
        }

        public function view_school($request, $response, $args)
        {
            return $this->view->render($response, 'views/landing/view-school.html', [
                'title' => 'School Name',
                'uri' => 'view-school'
            ]);
        }
    }
    