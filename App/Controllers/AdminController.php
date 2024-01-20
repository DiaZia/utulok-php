<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;

/**
 * Class AdminController
 * Example class of a controller
 * @package App\Controllers
 */
class AdminController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        $isAdmin = $this->app->getAuth()->isAdmin();

        // Debugging
        error_log("Authorization Check for AdminController::$action: " . ($isAdmin ? 'Allowed' : 'Denied'));

        return $isAdmin;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        return $this->html();
    }

    /**
     * Edit page.
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function edit(): Response
    {
        return $this->html();
    }

    /**
     * New pet page.
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function newPet(): Response
    {
        return $this->html();
    }
}
