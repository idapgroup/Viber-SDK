<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Interfaces;

/**
 * Interface ParameterInterface
 *
 * @package IdapGroup\ViberSdk\Interfaces
 */
interface ParameterInterface
{
    /**
     * @return array
     */
    public function getModifyParameters(): array;
}