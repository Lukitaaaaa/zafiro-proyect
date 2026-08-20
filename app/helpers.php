<?php

if (!function_exists('hashtagsToLinks')) {
    /**
     * Convert #hashtags in text to clickable links.
     *
     * @param string|null $text
     * @return string
     */
    function hashtagsToLinks(?string $text): string
    {
        if (empty($text)) {
            return '';
        }

        $escaped = e($text);

        return preg_replace_callback(
            '/(?<!&)#([\w]+)/u',
            function ($matches) {
                $tag = strtolower($matches[1]);
                $url = route('dashboard.explore.tag', $tag);
                return '<a href="' . $url . '" class="text-primary text-decoration-none fw-semibold">#' . e($matches[1]) . '</a>';
            },
            $escaped
        );
    }
}
