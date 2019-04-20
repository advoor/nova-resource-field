<?php

namespace Advoor\NovaResourceField;

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
            $label = $this->formatLabel($file);

            return [
                'label' => $label,
                'value' => $file
            ];
        })->filter()->toArray();

        return $options;
    }

    /**
     * @param $label
     * @return mixed|string
     */
    private function formatLabel($label)
    {
        if (config('nova-resource-field.formatLabel') === false) {
            return $label;
        }

        $label = pathinfo($label, PATHINFO_FILENAME);
        $label = str_replace([
            '.blade.php',
            '.',
            '-',
            '_'
        ], ' ', $label);
        $label = ucfirst(trim($label));

        return $label;
    }
}
