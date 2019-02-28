<?php

namespace Oxygencms\Blocks\Models;

use Oxygencms\Core\Models\MediaModel;
use Spatie\Translatable\HasTranslations;

class Block extends MediaModel
{
    use HasTranslations;

    /**
     * @var array $fillable
     */
    protected $fillable = ['name', 'body'];

    /**
     * @var array $translatable
     */
    protected $translatable = ['body'];
}
