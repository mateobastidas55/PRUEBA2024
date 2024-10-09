<?php

namespace App\Repositories\Interfaces\LotteriesInterfaces;

interface BuyLotteriesInterface
{

    /**
     * get all winners
     * @return object $response
     */
    public function index(): array;

    /**
     * get all packages
     * @param string $id
     * @return object $response
     */
    public function show(int $id): array;

    /**
     * update buying packages
     * @param string $id
     * @param array $request
     * @return object $response
     */
    public function update(int $id, array $request): array;
}
