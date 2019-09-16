# Laravel Nova Resource Field

Created by [@advoor](https://github.com/advoor). 
Based on the default [select field](https://nova.laravel.com/docs/2.0/resources/fields.html#select-field), to
allow an easy way to select resources located in a specific directory.

## Installation

Install via composer:

```
composer require advoor/nova-resource-field
```

Publish the config file
```
php artisan vendor:publish --provider="Advoor\NovaResourceField\FieldServiceProvider"
```

You can now configure which directory which should be used in `nova-resource-field.php`.

## Usage:

Add this `use` statement to the top of the your nova resource file:

```
use Advoor\NovaResourceField\NovaResourceField;
```

Use the field as below:

```
NovaResourceField::make('FieldName')
```

Similar to the Select field, the values can overwritten if required:

```
NovaResourceField::make('Template')->options(
    [
        'value' => 'Label'
    ]
)
```

Using more then one field? You can customize each field with it's own settings:

```
NovaResourceField::make('Template')
    ->formatLabels(true)
    ->default([
        'value' => 'homepage',
        'label' => 'Homepage'
    ])
    ->directory(resource_path('views/pages'))
 ```          