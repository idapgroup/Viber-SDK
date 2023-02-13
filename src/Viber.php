<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk;

use IdapGroup\ViberSdk\Exceptions\InvalidConfigException;
use IdapGroup\ViberSdk\Interfaces\ViberInterface;

/**
 * Class Viber
 *
 * @package IdapGroup\ViberSdk
 */
class Viber implements ViberInterface
{
    const   TTL_MIN_VALUE = 15;
    const   TTL_MAX_VALUE = 86400;

    private string $text;
    private string $img;
    private int $ttl;
    private string $caption;
    private string $action;
    private string $ios_expirity_text;

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
     * @param string $imgUrl
     *
     * @return void
     */
    public function setImgUrl(string $imgUrl): void
    {
        $this->img = $imgUrl;
    }

    /**
     * @param string $caption
     *
     * @return void
     */
    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    /**
     * @param string $action
     *
     * @return void
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @param string $ios_expirity_text
     *
     * @return void
     */
    public function setIosExpirityText(string $ios_expirity_text): void
    {
        $this->ios_expirity_text = $ios_expirity_text;
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
        if (!isset($this->ios_expirity_text) || !isset($this->ttl) || !isset($this->text)) {
            throw new InvalidConfigException('Set all require parameters');
        }

        $params = [
            "ios_expirity_text" => $this->ios_expirity_text,
            "ttl"               => $this->ttl,
            "text"              => $this->text,
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