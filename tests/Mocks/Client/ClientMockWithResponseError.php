<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests\Mocks\Client;

use IdapGroup\ViberSdk\Interfaces\ClientInterface;

class ClientMockWithResponseError implements ClientInterface
{
    public const RESPONSE = ['error' => ['message' => 'Error message']];

    /**
     * @inheritDoc
     */
    public function request(string $method, string $url, array $params): array
    {
        return self::RESPONSE;
    }
}