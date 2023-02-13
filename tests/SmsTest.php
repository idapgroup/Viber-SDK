<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use IdapGroup\ViberSdk\Sms;
use IdapGroup\ViberSdk\Tests\Fixtures\Sms\SmsFixture;
use PHPUnit\Framework\TestCase;

class SmsTest extends TestCase
{
    public function testGetModifyParametersWithAllParamsSet()
    {
        $expectedParameters = SmsFixture::PARAMETERS;

        $sms = new Sms();
        $sms->setText($expectedParameters['text']);
        $sms->setAlphaName($expectedParameters['alpha_name']);
        $sms->setTtl($expectedParameters['ttl']);
        $this->assertEquals($expectedParameters, $sms->getModifyParameters());
    }

    public function testGetModifyParametersWithParametersNotSet()
    {
        $sms = new Sms();
        $this->expectException(InvalidConfigException::class);
        $sms->getModifyParameters();
    }

    public function testGetModifyParametersWithTextNotSet()
    {
        $sms = new Sms();
        $sms->setAlphaName("Test alpha name");
        $sms->setTtl(30);
        $this->expectException(InvalidConfigException::class);
        $sms->getModifyParameters();
    }

    public function testGetModifyParametersWithAlphaNameNotSet()
    {
        $sms = new Sms();
        $sms->setText("Test text");
        $sms->setTtl(30);
        $this->expectException(InvalidConfigException::class);
        $sms->getModifyParameters();
    }

    public function testGetModifyParametersWithTtlNotSet()
    {
        $sms = new Sms();
        $sms->setText("Test text");
        $sms->setAlphaName("Test alpha name");
        $this->expectException(InvalidConfigException::class);
        $sms->getModifyParameters();
    }

    public function testSetTtlWithTtlLessThanMinimum()
    {
        $sms = new Sms();
        $this->expectException(InvalidConfigException::class);
        $sms->setTtl(10);
    }

    public function testSetTtlWithTtlGreaterThanMaximum()
    {
        $sms = new Sms();
        $this->expectException(InvalidConfigException::class);
        $sms->setTtl(86401);
    }
}