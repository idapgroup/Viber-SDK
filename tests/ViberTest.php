<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use IdapGroup\ViberSdk\Tests\Fixtures\Viber\ViberFixture;
use IdapGroup\ViberSdk\Viber;
use PHPUnit\Framework\TestCase;

class ViberTest extends TestCase
{
    public function testSetTtlWithValidTtlValue()
    {
        $viber = new Viber();
        $ttl = 200;
        $viber->setIosExpirityText('Test ios_expirity_text');
        $viber->setTtl($ttl);
        $viber->setText('Test Text');

        $this->assertEquals($ttl, $viber->getModifyParameters()['ttl']);
    }

    public function testSetTtlWithInvalidTtlValueTooLow()
    {
        $viber = new Viber();
        $ttl = Viber::TTL_MIN_VALUE - 1;

        $this->expectException(InvalidConfigException::class);
        $viber->setTtl($ttl);
    }

    public function testSetTtlWithInvalidTtlValueTooHigh()
    {
        $viber = new Viber();
        $ttl = Viber::TTL_MAX_VALUE + 1;

        $this->expectException(InvalidConfigException::class);
        $viber->setTtl($ttl);
    }

    public function testGetModifyParametersWithIosExpirityTextIsNotSet(): void
    {
        $viber = new Viber();
        $viber->setTtl(100);
        $viber->setText('Test Text');

        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Set all require parameters');

        $viber->getModifyParameters();
    }

    public function testGetModifyParametersWithTtlIsNotSet(): void
    {
        $viber = new Viber();
        $viber->setIosExpirityText('Test ios_expirity_text');
        $viber->setText('Test Text');

        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Set all require parameters');

        $viber->getModifyParameters();
    }

    public function testGetModifyParametersWithTextIsNotSet(): void
    {
        $viber = new Viber();
        $viber->setIosExpirityText('Test ios_expirity_text');
        $viber->setTtl(100);

        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Set all require parameters');

        $viber->getModifyParameters();
    }

    public function testGetModifyParametersWithAllRequiredParametersAreSet(): void
    {
        $expectedResult = ViberFixture::REQUIRED_PARAMETERS;
        $viber = new Viber();
        $viber->setIosExpirityText('Test ios_expirity_text');
        $viber->setTtl(100);
        $viber->setText('Test Text');

        $this->assertEquals($expectedResult, $viber->getModifyParameters());
    }

    public function testGetModifyParametersWithAllParametersAreSet(): void
    {
        $expectedResult = ViberFixture::ALL_PARAMETERS;

        $viber = new Viber();
        $viber->setIosExpirityText($expectedResult['ios_expirity_text']);
        $viber->setTtl($expectedResult['ttl']);
        $viber->setText($expectedResult['text']);
        $viber->setImgUrl($expectedResult['img']);
        $viber->setCaption($expectedResult['caption']);
        $viber->setAction($expectedResult['action']);

        $this->assertEquals($expectedResult, $viber->getModifyParameters());
    }
}
