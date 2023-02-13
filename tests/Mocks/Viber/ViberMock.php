<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests\Mocks\Viber;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use IdapGroup\ViberSdk\Interfaces\ViberInterface;
use IdapGroup\ViberSdk\Tests\Fixtures\Viber\ViberFixture;

class ViberMock implements ViberInterface
{
    private string $text;

    private string $img;

    private int $ttl;

    private string $caption;

    private string $action;

    private string $ios_expirity_text;

    public function __construct()
    {
        $expectedResult = ViberFixture::ALL_PARAMETERS;

        $this->ios_expirity_text = $expectedResult['ios_expirity_text'];
        $this->ttl = $expectedResult['ttl'];
        $this->text = $expectedResult['text'];
        $this->img = $expectedResult['img'];
        $this->caption = $expectedResult['caption'];
        $this->action = $expectedResult['action'];
    }

    public function getModifyParameters(): array
    {
        $params = [
            "ios_expirity_text" => $this->ios_expirity_text,
            "ttl" => $this->ttl,
            "text" => $this->text,
        ];

        if (isset($this->img)) {
            $params['img'] = $this->img;
        }

        if (isset($this->caption)) {
            $params['caption'] = $this->caption;
        }

        if (isset($this->action)) {
            $params['action'] = $this->action;
        }

        return $params;
    }
}