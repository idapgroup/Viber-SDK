<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use IdapGroup\ViberSdk\Interfaces\SmsInterface;

/**
 * Class Sms
 *
 * @package IdapGroup\ViberSdk
 */
class Sms implements SmsInterface
{
    const   TTL_MIN_VALUE = 15;
    const   TTL_MAX_VALUE = 86400;

    private string $text;
    private string $alpha_name;
    private int $ttl;

    /**
     * @param string $text
     *
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @param string $alphaName
     *
     * @return void
     */
    public function setAlphaName(string $alphaName): void
    {
        $this->alpha_name = $alphaName;
    }

    /**
     * @param int $ttl
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function setTtl(int $ttl): void
    {
        if ($ttl < self::TTL_MIN_VALUE || $ttl > self::TTL_MAX_VALUE) {
            throw new InvalidConfigException('Set valid ttl value');
        }

        $this->ttl = $ttl;
    }

    /**
     * @throws InvalidConfigException
     */
    public function getModifyParameters(): array
    {
        if (!isset($this->text) || !isset($this->alpha_name) || !isset($this->ttl)) {
            throw new InvalidConfigException('Set all require parameters');
        }

        return [
            "text"       => $this->text,
            "alpha_name" => $this->alpha_name,
            "ttl"        => $this->ttl,
        ];
    }
}