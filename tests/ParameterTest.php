<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use IdapGroup\ViberSdk\Parameter;
use IdapGroup\ViberSdk\Tests\Fixtures\Sms\SmsFixture;
use IdapGroup\ViberSdk\Tests\Fixtures\Viber\ViberFixture;
use IdapGroup\ViberSdk\Tests\Mocks\Sms\SmsMock;
use IdapGroup\ViberSdk\Tests\Mocks\Viber\ViberMock;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    public function testSetInvalidExtraId()
    {
        $parameter = new Parameter();
        $extraId = str_repeat('a', Parameter::EXTRA_ID_MAX_LENGTH + 1);

        $this->expectException(InvalidConfigException::class);

        $parameter->setExtraId($extraId);
    }

    public function testSetInvalidTag()
    {
        $parameter = new Parameter();
        $tag = str_repeat('a', Parameter::TAG_MAX_LENGTH + 1);

        $this->expectException(InvalidConfigException::class);

        $parameter->setTag($tag);
    }

    public function testSetInvalidStartTime()
    {
        $parameter = new Parameter();

        $this->expectException(InvalidConfigException::class);

        $parameter->setStartTime('2022-11-22T18:12:22.000Z');
    }

    public function testSetEmptyChannels()
    {
        $parameter = new Parameter();

        $this->expectException(InvalidConfigException::class);

        $parameter->setChannels([]);
    }

    public function testSetInvalidChannels()
    {
        $parameter = new Parameter();

        $this->expectException(InvalidConfigException::class);

        $parameter->setChannels(['telegram']);
    }

    public function testSetInvalidChannelsOptions()
    {
        $parameter = new Parameter();

        $this->expectException(InvalidConfigException::class);

        $parameter->setChannelsOptions();
    }

    public function testGetModifyParametersWithAllParametersAreSet()
    {
        $expectedResult = [
            "phone_number"    => 1234567890,
            "is_promotional"  => true,
            "channels"        => ['viber', 'sms'],
            "channel_options" => [
                'sms'  => SmsFixture::PARAMETERS,
                'viber' => ViberFixture::ALL_PARAMETERS,
            ],
            "extra_id" => 'extra_id',
            "tag" => 'tag',
            "callback_url" => 'callback_url',
            "start_time" => '2022-12-12 10:10:10',
        ];
        $parameter = new Parameter();
        $parameter->setPhoneNumber($expectedResult['phone_number']);
        $parameter->setIsPromotional($expectedResult['is_promotional']);
        $parameter->setChannels($expectedResult['channels']);
        $parameter->setChannelsOptions(new SmsMock(), new ViberMock());
        $parameter->setExtraId($expectedResult['extra_id']);
        $parameter->setTag($expectedResult['tag']);
        $parameter->setCallbackUrl($expectedResult['callback_url']);
        $parameter->setStartTime($expectedResult['start_time']);


        $result = $parameter->getModifyParameters();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetModifyParametersWithRequiredParametersAreSet()
    {
        $parameter = new Parameter();
        $parameter->setPhoneNumber(1234567890);
        $parameter->setIsPromotional(true);
        $parameter->setChannels(['viber', 'sms']);
        $parameter->setChannelsOptions(new SmsMock(), new ViberMock());
        $expectedResult = [
            "phone_number"    => 1234567890,
            "is_promotional"  => true,
            "channels"        => ['viber', 'sms'],
            "channel_options" => [
                'sms'  => SmsFixture::PARAMETERS,
                'viber' => ViberFixture::ALL_PARAMETERS,
            ],
        ];


        $result = $parameter->getModifyParameters();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetModifyParametersWithPhoneNumberIsNotSet()
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Set all require parameters');

        $parameter = new Parameter();
        $parameter->setIsPromotional(true);
        $parameter->setChannels(['viber', 'sms']);
        $parameter->setChannelsOptions(new SmsMock(), new ViberMock());
        $parameter->getModifyParameters();
    }

    public function testGetModifyParametersWithIsPromotionalIsNotSet()
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Set all require parameters');

        $parameter = new Parameter();
        $parameter->setPhoneNumber(1234567890);
        $parameter->setChannels(['viber', 'sms']);
        $parameter->setChannelsOptions(new SmsMock(), new ViberMock());
        $parameter->getModifyParameters();
    }

    public function testGetModifyParametersWithChannelsAreNotSet()
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Set all require parameters');

        $parameter = new Parameter();
        $parameter->setPhoneNumber(1234567890);
        $parameter->setIsPromotional(true);
        $parameter->setChannelsOptions(new SmsMock(), new ViberMock());
        $parameter->getModifyParameters();
    }

    public function testGetModifyParametersWithChannelsOptionsAreNotSet()
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Set all require parameters');

        $parameter = new Parameter();
        $parameter->setPhoneNumber(1234567890);
        $parameter->setIsPromotional(true);
        $parameter->setChannels(['viber', 'sms']);
        $parameter->getModifyParameters();
    }
}
