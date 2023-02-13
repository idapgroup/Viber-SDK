<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests\Mocks\Client;

use IdapGroup\ViberSdk\Exceptions\ResponseException;
use IdapGroup\ViberSdk\Interfaces\ClientInterface;

class ClientMockWithNoResponseReturnedException implements ClientInterface
{

    /**
     * @inheritDoc
     */
    public function request(string $method, string $url, array $params): array
    {
        throw new ResponseException('No response returned');
    }
}