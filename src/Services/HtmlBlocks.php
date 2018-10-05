<?php

namespace Oxygencms\Blocks\Services;

use Oxygencms\Blocks\Models\Block;
use Illuminate\Support\Facades\Cache;

class HtmlBlocks
{
    /**
     * @var array $keys
     */
    protected static $keys = [];

    /**
     * Set the cache tags for a HtmlBlock only in one place.
     *
     * @var string $tags
     */
    public static $tags = 'blocks';

    /**
     * Called when the @block blade directive is called.
     *
     * @param string $block_name
     *
     * @return bool
     */
    public static function setUp(string $block_name): bool
    {
        $key = "models.block.$block_name";

        array_push(static::$keys, $key);

        ob_start();

        // in local env always parse the content between the @block & @endblock directives.
        if (app()->environment() === 'local') {
            return false;
        }

        return (boolean) Cache::tags(static::$tags)->has($key);
    }

    /**
     * Called when the @endblock blade directive is called.
     *
     * @return string
     */
    public static function tearDown(): string
    {
        $key = array_pop(static::$keys);

        $html = trim(ob_get_clean());

        // If the block is cached return it. Otherwise get it from the DB or create it. Then cache it.
        $block = Cache::tags(static::$tags)->rememberForever($key, function () use ($key, $html) {

            $block = [
                'name' => str_replace('models.block.', '', $key),
                'body' => [],
            ];

            // set the block body to the html
            foreach (array_keys(config('oxygen.locales')) as $locale) {
                $block['body'][$locale] = $html;
            }

            return Block::firstOrCreate(['name' => $block['name']], $block);
        });

        if (app()->environment() === 'local' && md5($html) != md5($block->body)) {
            $block = $block->fresh();
            $block->update(['body' => $html]);
        }

        return $block->body;
    }
}