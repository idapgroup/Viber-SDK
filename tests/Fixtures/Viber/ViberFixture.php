<?php

declare(strict_types=1);

namespace IdapGroup\ViberSdk\Tests\Fixtures\Viber;

class ViberFixture
{
    const ALL_PARAMETERS = [
        'ios_expirity_text' => 'Test ios_expirity_text',
        'ttl' => 100,
        'text' => 'Test Text',
        'img' => 'Test Img Url',
        'caption' => 'Test Caption',
        'action' => 'Test Action',
    ];

    const REQUIRED_PARAMETERS = [
        'ios_expirity_text' => 'Test ios_expirity_text',
        'ttl' => 100,
        'text' => 'Test Text',
    ];
}