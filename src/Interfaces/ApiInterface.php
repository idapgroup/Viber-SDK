<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Interfaces;

/**
 * Interface ApiInterface
 *
 * @package IdapGroup\ViberSdk\Interfaces
 */
interface ApiInterface
{
    /**
     * @param $parameter ParameterInterface
     *
     * @return array
     */
    public function sendMessage(ParameterInterface $parameter): array;

    /**
     * @param string $messageId
     *
     * @return array
     */
    public function getShortDrByMessageId(string $messageId): array;

    /**
     * @param string $extraId
     *
     * @return array
     */
    public function getShortDrByExtraId(string $extraId): array;

    /**
     * @param string $messageId
     *
     * @return array
     */
    public function getFullDrByMessageId(string $messageId): array;

    /**
     * @param string $extraId
     *
     * @return array
     */
    public function getFullDrByExtraId(string $extraId): array;
}