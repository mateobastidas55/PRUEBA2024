<?php

namespace App\Repositories\Interfaces\UserInterfaces;

interface UserInterface
{
    /**
     * get all users
     * @return array $response
     */
    public function index(): array;


    /**
     * store user 
     * @param array $request
     * @return array $response
     */
    public function store(array $request): array;


    /**
     * get one user
     * @param int $id
     * @param array $request
     * @return array $response
     */
    public function show(int $id, array $request): array;


    /**
     * update one user
     * @param array $request
     * @return array $response
     */
    public function update(array $request): array;


    /**
     * delete one user
     * @param int $id
     * @return array $response
     */
    public function destroy(int $id): array;
}
