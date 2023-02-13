<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests;

use IdapGroup\ViberSdk\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testBaseUrl()
    {
        $config = new Config();
        $this->assertEquals(Config::BASE_URL, $config->getBaseUrl());
    }

    public function testGetMessageIdAndExtraId(): void
    {
        $messageId = 'test_message_id';
        $extraId = 'test_extra_id';

        $config = new Config();
        $config->setMessageId($messageId);
        $config->setExtraId($extraId);

        $this->assertEquals($messageId, $config->getMessageId());
        $this->assertEquals($extraId, $config->getExtraId());
    }

    public function testFullDrByMessageIdUrl()
    {
        $config = new Config();
        $messageId = '12345';
        $config->setMessageId($messageId);
        $expected = 'https://dr.hyber.im/api/dr/12345/advanced';
        $this->assertEquals($expected, $config->getFullDrByMessageIdUrl());
    }

    public function testFullDrByExtraIdUrl()
    {
        $config = new Config();
        $extraId = '12345';
        $config->setExtraId($extraId);
        $expected = 'https://dr.hyber.im/api/dr/external/12345/advanced';
        $this->assertEquals($expected, $config->getFullDrByExtraIdUrl());
    }

    public function testShortDrByMessageIdUrl()
    {
        $config = new Config();
        $messageId = '12345';
        $config->setMessageId($messageId);
        $expected = 'https://dr.hyber.im/api/dr/12345/simple';
        $this->assertEquals($expected, $config->getShortDrByMessageIdUrl());
    }

    public function testShortDrByExtraIdUrl()
    {
        $config = new Config();
        $extraId = '12345';
        $config->setExtraId($extraId);
        $expected = 'https://dr.hyber.im/api/dr/external/12345/simple';
        $this->assertEquals($expected, $config->getShortDrByExtraIdUrl());
    }
}
