<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Interfaces;

/**
 * Interface ClientInterface
 *
 * @package IdapGroup\ViberSdk\Interfaces
 */
interface ClientInterface
{
    /**
     * @param string $method
     * @param string $url
     * @param array  $params
     *
     * @return array
     */
    public function request(string $method, string $url, array $params): array;
}