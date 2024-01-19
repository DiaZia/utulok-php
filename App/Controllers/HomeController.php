<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Adoption;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
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
     * About us page.
     * @return \App\Core\Responses\ViewResponse
     */
    public function aboutUs(): Response
    {
        return $this->html();
    }

    /**
     * Support us page.
     * @return \App\Core\Responses\ViewResponse
     */
    public function support(): Response
    {
        return $this->html();
    }

    /**
     * My adoption page.
     * @return \App\Core\Responses\ViewResponse
     */
    public function adoption(): Response
    {
        return $this->html();
    }

    /**
     * E-shop page.
     * @return \App\Core\Responses\ViewResponse
     */
    public function eshop(): Response
    {
        return $this->html();
    }

    /**
     * Kosik page.
     * @return \App\Core\Responses\ViewResponse
     */
    public function cart(): Response
    {
        return $this->html();
    }

    /**
     * Product page.
     * @return \App\Core\Responses\ViewResponse
     */
    public function product(): Response
    {
        return $this->html();
    }

}
