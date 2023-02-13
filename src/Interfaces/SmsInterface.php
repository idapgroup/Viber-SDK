<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Interfaces;

/**
 * Interface SmsInterface
 *
 * @package IdapGroup\ViberSdk\Interfaces
 */
interface SmsInterface
{
    /**
     * @return array
     */
    public function getModifyParameters(): array;
}