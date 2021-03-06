<?php
/**
 * FlameCore Essentials
 * Copyright (C) 2015 IceFlame.net
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 *
 * @package  FlameCore\Essentials
 * @version  0.1
 * @link     http://www.flamecore.org
 * @license  http://opensource.org/licenses/ISC ISC License
 */

namespace FlameCore\Essentials;

/**
 * Class Slugifier
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
class Slugifier
{
    /**
     * Generates a slug for the given string.
     *
     * @param string $string The string to slugify
     * @param string $separator The words separator
     * @param bool $normalize Normalize non-latin characters
     * @return string Returns the slug.
     */
    public function slugify($string, $separator = '-', $normalize = true)
    {
        if ($normalize) {
            $string = $this->normalize($string);
        }

        $chars = " _-$separator";
        $charsx = preg_quote($chars);

        $string = preg_replace("/[^a-zA-Z0-9$charsx]/", '', $string);
        $string = str_replace([' ', '_', '-'], $separator, strtolower($string));
        $string = trim($string, $chars);

        return $string;
    }

    /**
     * Normalizes the given string.
     *
     * @param $string The string to normalize
     * @return string
     */
    protected function normalize($string)
    {
        if (function_exists('iconv')) {
            return @iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        }

        return $string;
    }
}
