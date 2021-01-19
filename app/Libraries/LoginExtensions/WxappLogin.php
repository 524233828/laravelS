<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-05-04
 * Time: 10:05
 */

namespace App\Libraries\LoginExtensions;


use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;
use JoseChan\UserLogin\Handler\LoginAbstract;

class WxappLogin extends LoginAbstract
{

    public function login(array $form): Model
    {
        // TODO: Implement login() method.
    }

    public function register(array $form): Model
    {
        // TODO: Implement register() method.
    }

    public function userInfo(): Model
    {
        // TODO: Implement userInfo() method.
    }

    public function failsRegisterHandler(): Response
    {
        // TODO: Implement failsRegisterHandler() method.
    }

    public function failsLoginHandler(): Response
    {
        // TODO: Implement failsLoginHandler() method.
    }

    public function successRegisterHandler(Model $user): Response
    {
        // TODO: Implement successRegisterHandler() method.
    }

    public function successLoginHandler(Model $user): Response
    {
        // TODO: Implement successLoginHandler() method.
    }

    public function loginValidate(): array
    {
        // TODO: Implement loginValidate() method.
    }

    public function registerValidate(): array
    {
        // TODO: Implement registerValidate() method.
    }

    public function getLoginData(array $form): array
    {
        // TODO: Implement getLoginData() method.
    }

    public function getRegisterData(array $form): array
    {
        // TODO: Implement getRegisterData() method.
    }
}
