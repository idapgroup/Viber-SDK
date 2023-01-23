<?php

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
    protected $config;

    /**
     * @var ClientInterface
     */
    protected $client;

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

    public function sendMessage(ParameterInterface $parameter)
    {
        return $this->call('POST', $this->config->getBaseUrl(), $parameter->getModifyParameters());
    }

    public function getShortDrByMessageId($messageId)
    {
        $this->config->setMessageId($messageId);

        return $this->call('GET', $this->config->getShortDrByMessageIdUrl());
    }

    public function getShortDrByExtraId($extraId)
    {
        $this->config->setExtraId($extraId);

        return $this->call('GET', $this->config->getShortDrByExtraIdUrl());
    }

    public function getFullDrByMessageId($messageId)
    {
        $this->config->setMessageId($messageId);

        return $this->call('GET', $this->config->getFullDrByMessageIdUrl());
    }

    public function getFullDrByExtraId($extraId)
    {
        $this->config->setExtraId($extraId);

        return $this->call('GET', $this->config->getFullDrByExtraIdUrl());
    }

    /**
     * Send request.
     *
     * @param $method
     * @param $url
     * @param $params
     *
     * @return mixed
     */
    protected function call($method, $url, $params = [])
    {
        $response = $this->client->request($method, $url, $params);

        if (isset($response['error'])) {
            throw new ResponseException($response['error']['message']);
        }

        return $response;
    }
}