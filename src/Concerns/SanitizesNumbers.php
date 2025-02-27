<?php

declare(strict_types=1);

namespace MichaelRubel\ValueObjects\Concerns;

trait SanitizesNumbers
{
    /**
     * @param  int|string|null  $number
     *
     * @return string
     */
    public function sanitize(int|string|null $number): string
    {
        return str($number)
            ->replace([',', ' '], ['.', ''])
            ->value();
    }
}
