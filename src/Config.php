<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk;

use IdapGroup\ViberSdk\Interfaces\ConfigInterface;

class Config implements ConfigInterface
{
    const    BASE_URL                   = 'https://api-v2.hyber.im/790';
    const    FULL_DR_BY_MESSAGE_ID_URL  = 'https://dr.hyber.im/api/dr/{message_id}/advanced';
    const    FULL_DR_BY_EXTRA_ID_URL    = 'https://dr.hyber.im/api/dr/external/{extra_id}/advanced';
    const    SHORT_DR_BY_MESSAGE_ID_URL = 'https://dr.hyber.im/api/dr/{message_id}/simple';
    const    SHORT_DR_BY_EXTRA_ID_URL   = 'https://dr.hyber.im/api/dr/external/{extra_id}/simple';

    private string $messageId;
    private string $extraId;

    public function setMessageId(string $messageId): void
    {
        $this->messageId = $messageId;
    }

    public function setExtraId(string $extraId): void
    {
        $this->extraId = $extraId;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function getExtraId(): string
    {
        return $this->extraId;
    }

    public function getBaseUrl(): string
    {
        return self::BASE_URL;
    }

    public function getFullDrByMessageIdUrl(): string
    {
        return strtr(self::FULL_DR_BY_MESSAGE_ID_URL, [
            '{message_id}' => $this->messageId,
        ]);
    }

    public function getFullDrByExtraIdUrl(): string
    {
        return strtr(self::FULL_DR_BY_EXTRA_ID_URL, [
            '{extra_id}' => $this->extraId,
        ]);
    }

    public function getShortDrByMessageIdUrl(): string
    {
        return strtr(self::SHORT_DR_BY_MESSAGE_ID_URL, [
            '{message_id}' => $this->messageId,
        ]);
    }

    public function getShortDrByExtraIdUrl(): string
    {
        return strtr(self::SHORT_DR_BY_EXTRA_ID_URL, [
            '{extra_id}' => $this->extraId,
        ]);
    }
}