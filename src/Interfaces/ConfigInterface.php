<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Interfaces;

/**
 * Interface ConfigInterface
 *
 * @package IdapGroup\ViberSdk\Interfaces
 */
interface ConfigInterface
{
    /**
     * @param string $messageId
     *
     * @return void
     */
    public function setMessageId(string $messageId): void;

    /**
     * @param string $extraId
     */
    public function setExtraId(string $extraId): void;

    /**
     * @return string
     */
    public function getMessageId(): string;

    /**
     * @return string
     */
    public function getExtraId(): string;

    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /**
     * @return string
     */
    public function getFullDrByMessageIdUrl(): string;

    /**
     * @return string
     */
    public function getFullDrByExtraIdUrl(): string;

    /**
     * @return string
     */
    public function getShortDrByMessageIdUrl(): string;

    /**
     * @return string
     */
    public function getShortDrByExtraIdUrl(): string;
}