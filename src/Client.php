<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use IdapGroup\ViberSdk\Exceptions\ResponseException;
use IdapGroup\ViberSdk\Interfaces\ClientInterface;

/**
 * Class Client
 *
 * @package IdapGroup\ViberSdk
 */
class Client implements ClientInterface
{
    private string $login;
    private string $password;

    /**
     * Client constructor
     *
     * @param array $params
     *
     * @throws InvalidConfigException
     */
    public function __construct(array $params)
    {
        if (!isset($params['login']) || !isset($params['password'])) {
            throw new InvalidConfigException('Login and password must be set');
        }

        $this->login    = $params['login'];
        $this->password = $params['password'];
    }

    /**
     * @throws ResponseException
     */
    public function request(string $method, string $url, array $params = []): array
    {
        $ch = curl_init();

        if ($method === "POST") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            ['Content-Type: application/json']
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt(
            $ch,
            CURLOPT_USERPWD,
            sprintf("%s:%s", $this->login, $this->password)
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $data = json_decode(curl_exec($ch), true);

        curl_close($ch);

        if (empty($data)){
            throw new ResponseException('No response returned');
        }

        return $data;
    }
}