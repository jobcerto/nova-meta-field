<?php

namespace Jobcerto\Meta;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Meta extends Field
{
    public $showOnIndex = false;
    public $showOnDetail = false;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'meta';

    public function config($arguments)
    {
        return $this->withMeta(['config' => $arguments]);
    }

    public function fields($fields)
    {
        return $this->withMeta(['fields' => $fields]);
    }

    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        $metas = $request[$requestAttribute];

        $class = get_class($model);

        $class::saved(function ($model) use ($metas, $attribute) {
            if ($model->hasMeta($attribute)) {
                $model->updateMeta($attribute, $metas);
            } else {
                $model->setMeta($attribute, $metas);
            }
        });

        return;
    }

    public function resolveAttribute($resource, $attribute = null)
    {
        return $resource->getMeta($attribute);
    }
}
