<?php

namespace IdapGroup\ViberSdk\Interfaces;

/**
 * Interface ClientInterface
 *
 * @package IdapGroup\ViberSdk\Interfaces
 */
interface ClientInterface
{
    /**
     * @param $method
     * @param $url
     * @param $params
     *
     * @return mixed
     */
    public function request($method, $url, $params);
}