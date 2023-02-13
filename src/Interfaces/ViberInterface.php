<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Interfaces;

/**
 * Interface ViberInterface
 *
 * @package IdapGroup\ViberSdk\Interfaces
 */
interface ViberInterface
{
    /**
     * @return array
     */
    public function getModifyParameters(): array;
}