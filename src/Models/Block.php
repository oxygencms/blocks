<?php

namespace Oxygencms\Blocks\Models;

use Oxygencms\Core\Models\MediaModel;
use Spatie\Translatable\HasTranslations;
use Oxygencms\Uploads\Traits\HasUploads;

class Block extends MediaModel
{
    use HasUploads, # added for backward compatibility
        HasTranslations;

    /**
     * @var array $fillable
     */
    protected $fillable = ['name', 'body'];

    /**
     * @var array $translatable
     */
    protected $translatable = ['body'];
}
