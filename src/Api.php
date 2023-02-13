<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk;

use IdapGroup\ViberSdk\Exceptions\ResponseException;
use IdapGroup\ViberSdk\Interfaces\ApiInterface;
use IdapGroup\ViberSdk\Interfaces\ClientInterface;
use IdapGroup\ViberSdk\Interfaces\ConfigInterface;
use IdapGroup\ViberSdk\Interfaces\ParameterInterface;

/**
 * Class Api
 *
 * @package IdapGroup\ViberSdk
 */
class Api implements ApiInterface
{
    /**
     * @var ConfigInterface
     */
    protected ConfigInterface $config;

    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * Api constructor.
     *
     * @param ConfigInterface $config
     * @param ClientInterface $client
     */
    public function __construct(ConfigInterface $config, ClientInterface $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @throws ResponseException
     */
    public function sendMessage(ParameterInterface $parameter): array
    {
        return $this->call('POST', $this->config->getBaseUrl(), $parameter->getModifyParameters());
    }

    /**
     * @throws ResponseException
     */
    public function getShortDrByMessageId(string $messageId): array
    {
        $this->config->setMessageId($messageId);

        return $this->call('GET', $this->config->getShortDrByMessageIdUrl());
    }

    /**
     * @throws ResponseException
     */
    public function getShortDrByExtraId(string $extraId): array
    {
        $this->config->setExtraId($extraId);

        return $this->call('GET', $this->config->getShortDrByExtraIdUrl());
    }

    /**
     * @throws ResponseException
     */
    public function getFullDrByMessageId(string $messageId): array
    {
        $this->config->setMessageId($messageId);

        return $this->call('GET', $this->config->getFullDrByMessageIdUrl());
    }

    /**
     * @throws ResponseException
     */
    public function getFullDrByExtraId(string $extraId): array
    {
        $this->config->setExtraId($extraId);

        return $this->call('GET', $this->config->getFullDrByExtraIdUrl());
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $params
     *
     * @return mixed
     * @throws ResponseException
     */
    protected function call(string $method, string $url, array $params = []): array
    {
        $response = $this->client->request($method, $url, $params);

        if (isset($response['error'])) {
            throw new ResponseException($response['error']['message']);
        }

        return $response;
    }
}