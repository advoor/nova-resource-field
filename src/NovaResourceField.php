<?php

namespace Advoor\NovaResourceField;

use Laravel\Nova\Fields\Select;

class NovaResourceField extends Select
{
    private $formatLabel;
    private $defaultOption;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-resource-field';

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->formatLabel = config('nova-resource-field.formatLabel', false);
        $this->defaultOption = config('nova-resource-field.default', [
            'value' => '',
            'label' => 'Choose one'
        ]);

        $options = $this->getOptions();

        $this->withMeta([
            'default' => $this->defaultOption,
            'options' => collect($options ?? [])->map(function ($label, $value) {
                return is_array($label) ? $label + ['value' => $value] : ['label' => $label, 'value' => $value];
            })->values()->all(),
        ]);
    }

    /**
     * @var string|null
     * 
     * @return mixed
     */
    protected function getOptions($directory = null)
    {
        if (empty($directory)) {
            $directory = config('nova-resource-field.directory');
        }
        
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
        if ($this->formatLabel === false) {
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

    /**
     * Format labels
     */
    public function formatLabels($format) {
        $this->formatLabel = (bool)$format;

        return $this;
    }

    /**
     * Set default option
     */
    public function default($defaultOption)
    {
        $this->defaultOption = $defaultOption;

        return $this->withMeta([
            'default' => $this->defaultOption
        ]);
    }

    /**
     * Use directory
     */
    public function directory(string $directory)
    {
        $options = $this->getOptions($directory);

        return $this->withMeta([
            'options' => collect($options ?? [])->map(function ($label, $value) {
                return is_array($label) ? $label + ['value' => $value] : ['label' => $label, 'value' => $value];
            })->values()->all(),
        ]);
    }
}
