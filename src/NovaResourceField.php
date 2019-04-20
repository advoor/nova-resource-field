<?php

namespace Advoor\NovaResourceField;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\Select;

class NovaResourceField extends Select
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-resource-field';

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $options = $this->getOptions();

        $this->withMeta([
            'default' => config('nova-resource-field.default', [
                'value' => '',
                'label' => 'Choose one'
            ]),
            'options' => collect($options ?? [])->map(function ($label, $value) {
                return is_array($label) ? $label + ['value' => $value] : ['label' => $label, 'value' => $value];
            })->values()->all(),
        ]);
    }

    /**
     * @return mixed
     */
    protected function getOptions()
    {
        $directory = config('nova-resource-field.directory');
        $files = array_diff(scandir($directory), array('.', '..'));

        $options = collect($files)->map(function ($file) {
            
            // Skip directories
            if (!Str::contains($file, '.php')) {
                return null;
            }

            $formattedName = str_replace('.blade.php', '', $file);
            $formattedName = str_replace('.', ' ', $formattedName);
            $formattedName = ucfirst($formattedName);

            return [
                'label' => $formattedName,
                'value' => $file
            ];
        })->filter()->toArray();

        return $options;
    }
}
