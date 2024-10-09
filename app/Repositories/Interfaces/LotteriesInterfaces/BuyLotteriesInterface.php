<?php

namespace App\Repositories\Interfaces\LotteriesInterfaces;

interface BuyLotteriesInterface
{
    /**
     * get all packages
     * @param string $id
     * @return object $response
     */
    public function show(string $id): array;

    /**
     * update buying packages
     * @param string $id
     * @param array $request
     * @return object $response
     */
    public function update(string $id, array $request): object;
}
