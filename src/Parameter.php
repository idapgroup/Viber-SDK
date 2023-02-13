<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use DateTime;
use IdapGroup\ViberSdk\Interfaces\ParameterInterface;
use IdapGroup\ViberSdk\Interfaces\SmsInterface;
use IdapGroup\ViberSdk\Interfaces\ViberInterface;

/**
 * Class Parameter
 *
 * @package IdapGroup\ViberSdk
 */
class Parameter implements ParameterInterface
{
    const   VALID_CHANNELS = [
        'viber',
        'sms',
    ];

    const   EXTRA_ID_MAX_LENGTH = 64;
    const   TAG_MAX_LENGTH      = 63;
    const   VALID_DATE_FORMAT   = 'Y-m-d H:i:s';

    private int $phone_number;
    private string $extra_id;
    private string $tag;
    private string $callback_url;
    private string $start_time;
    private bool $is_promotional;
    private array $channels;
    private array $channel_options;

    /**
     * @param int $phoneNumber
     *
     * @return void
     */
    public function setPhoneNumber(int $phoneNumber): void
    {
        $this->phone_number = $phoneNumber;
    }

    /**
     * @param string $extraId
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function setExtraId(string $extraId): void
    {
        if (strlen($extraId) > self::EXTRA_ID_MAX_LENGTH) {
            throw new InvalidConfigException('Set valid extra id');
        }

        $this->extra_id = $extraId;
    }

    /**
     * @param string $tag
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function setTag(string $tag): void
    {
        if (strlen($tag) > self::TAG_MAX_LENGTH) {
            throw new InvalidConfigException('Set valid tag');
        }

        $this->tag = $tag;
    }

    /**
     * @param string $callbackUrl
     *
     * @return void
     */
    public function setCallbackUrl(string $callbackUrl): void
    {
        $this->callback_url = $callbackUrl;
    }

    /**
     * @param string $startTime
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function setStartTime(string $startTime): void
    {
        if (!$this->validateDate($startTime)) {
            throw new InvalidConfigException('Set valid start time');
        }

        $this->start_time = $startTime;
    }

    /**
     * @param bool $isPromotional
     *
     * @return void
     */
    public function setIsPromotional(bool $isPromotional): void
    {
        $this->is_promotional = $isPromotional;
    }

    /**
     * @param array $channels
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function setChannels(array $channels): void
    {
        if (empty($channels) || !empty(array_diff($channels, self::VALID_CHANNELS))) {
            throw new InvalidConfigException('Set valid channels');
        }

        $this->channels = $channels;
    }

    /**
     * @param SmsInterface|null   $sms
     * @param ViberInterface|null $viber
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function setChannelsOptions(SmsInterface $sms = null, ViberInterface $viber = null): void
    {
        $channelsOptions = [];

        if (!isset($sms) && !isset($viber)) {
            throw new InvalidConfigException('Set valid channels options');
        }

        if (isset($sms)) {
            $channelsOptions['sms'] = $sms->getModifyParameters();
        }

        if (isset($viber)) {
            $channelsOptions['viber'] = $viber->getModifyParameters();
        }

        $this->channel_options = $channelsOptions;
    }

    /**
     * @throws InvalidConfigException
     */
    public function getModifyParameters(): array
    {
        if (!isset($this->phone_number) || !isset($this->is_promotional)
            || !isset($this->channels)
            || !isset($this->channel_options)
        ) {
            throw new InvalidConfigException('Set all require parameters');
        }

        $params = [
            "phone_number"    => $this->phone_number,
            "is_promotional"  => $this->is_promotional,
            "channels"        => $this->channels,
            "channel_options" => $this->channel_options,
        ];

        if (isset($this->extra_id)) {
            $params['extra_id'] = $this->extra_id;
        }

        if (isset($this->tag)) {
            $params['tag'] = $this->tag;
        }

        if (isset($this->callback_url)) {
            $params['callback_url'] = $this->callback_url;
        }

        if (isset($this->start_time)) {
            $params['start_time'] = $this->start_time;
        }

        return $params;
    }

    /**
     * @param string $date
     * @param string $format
     *
     * @return bool
     */
    private function validateDate(string $date, string $format = self::VALID_DATE_FORMAT): bool
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) == $date;
    }
}