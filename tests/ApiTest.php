<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests;

use IdapGroup\ViberSdk\Api;
use IdapGroup\ViberSdk\Exceptions\ResponseException;
use IdapGroup\ViberSdk\Interfaces\ClientInterface;
use IdapGroup\ViberSdk\Interfaces\ConfigInterface;
use IdapGroup\ViberSdk\Interfaces\ParameterInterface;
use IdapGroup\ViberSdk\Tests\Mocks\Client\ClientMock;
use IdapGroup\ViberSdk\Tests\Mocks\Client\ClientMockWithNoResponseReturnedException;
use IdapGroup\ViberSdk\Tests\Mocks\Client\ClientMockWithResponseError;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testSendMessageSuccess()
    {
        $clientMock = new ClientMock();

        $configMock = $this->createMock(ConfigInterface::class);
        $configMock->method('getBaseUrl')
            ->willReturn('https://example.com');

        $parameterMock = $this->createMock(ParameterInterface::class);
        $parameterMock->method('getModifyParameters')
            ->willReturn(['foo' => 'bar']);

        $api = new Api($configMock, $clientMock);
        $result = $api->sendMessage($parameterMock);

        $this->assertIsArray($result);
        $this->assertEquals(ClientMock::RESPONSE, $result);
    }

    public function testSendMessageErrorResponse()
    {
        $clientMock = new ClientMockWithResponseError();

        $this->expectException(ResponseException::class);
        $this->expectExceptionMessage('Error message');

        $configMock = $this->createMock(ConfigInterface::class);
        $configMock->method('getBaseUrl')
            ->willReturn('http://example.com');

        $parameterMock = $this->createMock(ParameterInterface::class);
        $parameterMock->method('getModifyParameters')
            ->willReturn(['foo' => 'bar']);

        $api = new Api($configMock, $clientMock);
        $api->sendMessage($parameterMock);
    }

    public function testSendMessageNoResponse()
    {
        $clientMock = new ClientMockWithNoResponseReturnedException();

        $this->expectException(ResponseException::class);
        $this->expectExceptionMessage('No response returned');

        $configMock = $this->createMock(ConfigInterface::class);
        $configMock->method('getBaseUrl')
            ->willReturn('http://example.com');

        $parameterMock = $this->createMock(ParameterInterface::class);
        $parameterMock->method('getModifyParameters')
            ->willReturn(['foo' => 'bar']);

        $api = new Api($configMock, $clientMock);
        $api->sendMessage($parameterMock);
    }

    public function testGetShortDrByMessageId()
    {
        $messageId = '12345';
        $messageIdUrl = 'https://dr.hyber.im/api/dr/external/12345/simple';

        $configMock = $this->createMock(ConfigInterface::class);
        $configMock->expects($this->once())
            ->method('setMessageId')
            ->with($this->equalTo($messageId));
        $configMock->expects($this->once())
            ->method('getShortDrByMessageIdUrl')
            ->willReturn($messageIdUrl);

        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo('GET'), $messageIdUrl, $this->equalTo([]))
            ->willReturn(['response' => 'data']);

        $api = new Api($configMock, $clientMock);
        $api->getShortDrByMessageId($messageId);
    }

    public function testGetShortDrByExtraId()
    {
        $extraId = '12345';
        $extraIdUrl = 'https://dr.hyber.im/api/dr/external/12345/advanced';

        $configMock = $this->createMock(ConfigInterface::class);
        $configMock->expects($this->once())
            ->method('setExtraId')
            ->with($this->equalTo($extraId));
        $configMock->expects($this->once())
            ->method('getShortDrByExtraIdUrl')
            ->willReturn($extraIdUrl);

        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo('GET'), $extraIdUrl, $this->equalTo([]))
            ->willReturn(['response' => 'data']);

        $api = new Api($configMock, $clientMock);
        $api->getShortDrByExtraId($extraId);
    }

    public function testFullDrByMessageId()
    {
        $messageId = '12345';
        $messageIdUrl = 'https://dr.hyber.im/api/dr/12345/advanced';

        $configMock = $this->createMock(ConfigInterface::class);
        $configMock->expects($this->once())
            ->method('setMessageId')
            ->with($this->equalTo($messageId));
        $configMock->expects($this->once())
            ->method('getFullDrByMessageIdUrl')
            ->willReturn($messageIdUrl);

        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo('GET'), $messageIdUrl, $this->equalTo([]))
            ->willReturn(['response' => 'data']);

        $api = new Api($configMock, $clientMock);
        $api->getFullDrByMessageId($messageId);
    }

    public function testFullDrByExtraId()
    {
        $extraId = '12345';
        $extraIdUrl = 'https://dr.hyber.im/api/dr/external/12345/advanced';

        $configMock = $this->createMock(ConfigInterface::class);
        $configMock->expects($this->once())
            ->method('setExtraId')
            ->with($this->equalTo($extraId));
        $configMock->expects($this->once())
            ->method('getFullDrByExtraIdUrl')
            ->willReturn($extraIdUrl);

        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo('GET'), $extraIdUrl, $this->equalTo([]))
            ->willReturn(['response' => 'data']);

        $api = new Api($configMock, $clientMock);
        $api->getFullDrByExtraId($extraId);
    }
}
