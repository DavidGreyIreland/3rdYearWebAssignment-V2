<?php

namespace Itb\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Itb\Model\User;

class LoginController
{
    // action for route:    /login
    public function loginAction(Request $request, Application $app)
    {
        /*
        $app['session']->set('user', ['username' => 'matt']);
        $user = $app['session']->get('user');
        var_dump($user);
        die();
*/
        // logout any existing user
        $app['session']->set('user', []);

        // build args array
        // ------------
        $argsArray = [];


        // render (draw) template
        // ------------
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    // action for POST route:    /processLogin
    public function processLoginAction(Request $request, Application $app)
    {
        //var_dump("asdf");
        //die();
        // default is bad login
        $isLoggedIn = false;

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // search for user with username in repository
        $isLoggedIn = User::canFindMatchingUsernameAndPassword($username, $password);
        $isRole = User::canFindMatchingUsernameAndRole($username);
        // action depending on login success
        if ($isLoggedIn) {
            if ($isRole) {
                // store username in 'user' in 'session'
                $app['session']->set('user', array('username' => $username));
                // success - redirect to the secure admin home page
                return $app->redirect('/admin');
            } else {
                // store username in 'user' in 'session'
                $app['session']->set('user', array('username' => $username));
                // success - redirect to the secure admin home page
                return $app->redirect('/student');
            }
        }

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter'
        );

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    // action for route:    /logout
    public function logoutAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null);

        // redirect to home page
//        return $app->redirect('/');

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', []);
    }

    //--------- helper functions -------
    public function isLoggedInFromSession()
    {
        $isLoggedIn = false;

        // user is logged in if there is a 'user' entry in the SESSION superglobal
        if (isset($_SESSION['user'])) {
            $isLoggedIn = true;
        }

        return $isLoggedIn;
    }

    public function usernameFromSession()
    {
        $username = '';

        // extract username from SESSION superglobal
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user'];
        }

        return $username;
    }
}
