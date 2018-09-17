<?php

namespace App\Services\InputTransform;

use App\Helpers\Hash\HashServiceInterface;

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
    public function transform(array $data): array
    {
        return is_null($data['password']) ? $this->removePasswordData($data) : $this->preparePasswordData($data);
    }

    /**
     * @param array $data
     * @return array
     */
    private function preparePasswordData(array $data): array
    {
        $data['password'] = $this->hashPassword($data['password']);

        return $data;
    }

    /**
     * Remove password from array of parameters
     *
     * @param array $params
     * @return array
     */
    private function removePasswordData(array $params): array
    {
        unset($params['password']);

        return $params;
    }

    /**
     * Make hash of password string
     *
     * @param string $password
     * @return string
     */
    private function hashPassword(string $password): string
    {
        return $this->hashService->make($password);
    }

}