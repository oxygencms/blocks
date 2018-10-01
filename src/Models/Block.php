<?php

namespace Oxygencms\Blocks\Models;

use App\Traits\HasUploads;
use Oxygencms\Core\Models\Model;
use Spatie\Translatable\HasTranslations;

class Block extends Model
{
    use HasUploads, HasTranslations;

    /**
     * @var array $fillable
     */
    protected $fillable = ['name', 'body'];

    /**
     * @var array $translatable
     */
    protected $translatable = ['body'];
}
