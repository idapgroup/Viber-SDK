<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests\Mocks\Sms;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use IdapGroup\ViberSdk\Interfaces\SmsInterface;
use IdapGroup\ViberSdk\Tests\Fixtures\Sms\SmsFixture;

class SmsMock implements SmsInterface
{
    private string $text;
    private string $alpha_name;
    private int $ttl;

    public function __construct()
    {
        $expectedParameters = SmsFixture::PARAMETERS;
        $this->text = $expectedParameters['text'];
        $this->alpha_name = $expectedParameters['alpha_name'];
        $this->ttl = $expectedParameters['ttl'];
    }

    public function getModifyParameters(): array
    {
        return [
            "text"       => $this->text,
            "alpha_name" => $this->alpha_name,
            "ttl"        => $this->ttl,
        ];
    }
}