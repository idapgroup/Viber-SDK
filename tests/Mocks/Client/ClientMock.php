<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests\Mocks\Client;

use IdapGroup\ViberSdk\Interfaces\ClientInterface;

class ClientMock implements ClientInterface
{
    public const RESPONSE = ['response' => 'OK'];

    /**
     * @inheritDoc
     */
    public function request(string $method, string $url, array $params): array
    {
        return self::RESPONSE;
    }
}