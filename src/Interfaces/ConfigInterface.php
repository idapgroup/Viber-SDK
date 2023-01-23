<?php

namespace IdapGroup\ViberSdk\Interfaces;

/**
 * Interface ConfigInterface
 *
 * @package IdapGroup\ViberSdk\Interfaces
 */
interface ConfigInterface
{
    public function setMessageId($messageId);

    public function setExtraId($extraId);

    /**
     * @return string
     */
    public function getMessageId();

    /**
     * @return string
     */
    public function getExtraId();

    /**
     * @return string
     */
    public function getBaseUrl();

    /**
     * @return string
     */
    public function getFullDrByMessageIdUrl();

    /**
     * @return string
     */
    public function getFullDrByExtraIdUrl();

    /**
     * @return string
     */
    public function getShortDrByMessageIdUrl();

    /**
     * @return string
     */
    public function getShortDrByExtraIdUrl();
}