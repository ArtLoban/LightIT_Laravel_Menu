<?php

namespace App\Services\InputTransform;


use App\Helpers\Hash\HashServiceInterface;

/**
 * Class UserUpdateDataTransform
 * @package App\Services\InputTransform
 */
class UserUpdateDataTransform implements TransformerInterface
{
    /**
     * @var HashServiceInterface
     */
    private $hashService;

    /**
     * UserUpdateDataTransform constructor.
     * @param HashServiceInterface $hashService
     */
    public function __construct(HashServiceInterface $hashService)
    {
        $this->hashService = $hashService;
    }

    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data)
    {
        return is_null($data['password']) ? $this->removePasswordData($data) : $this->preparePasswordData($data);
    }

    /**
     * @param array $data
     * @return array
     */
    private function preparePasswordData(array $data)
    {
        $data['password'] = $this->hashPassword($data['password']);

        return $data;
    }

    /**
     * @param array $params
     * @return array
     */
    private function removePasswordData(array $params)
    {
        unset($params['password']);

        return $params;
    }

    /**
     * @param string $password
     * @return string
     */
    private function hashPassword(string $password)
    {
        return $this->hashService->make($password);
    }

}