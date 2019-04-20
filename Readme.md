# Laravel Nova View Field

Created by [@advoor](https://github.com/advoor). 
Based on the default [select field](https://nova.laravel.com/docs/2.0/resources/fields.html#select-field), to
allow an easy way to select templates located in a specific directory.

## Installation

Install via composer:

```
composer require advoor/nova-view-field
```

Publish the config file
```
php artisan vendor:publish --provider="Advoor\NovaViewField\FieldServiceProvider"
```

You can now configure which directory which should be used in `nova-view-field.php`.

## Usage:

Add this `use` statement to the top of the your nova resource file:

```
use Advoor\NovaViewField\NovaViewField;
```

Use the field as below:

```
NovaViewField::make('FieldName')
```

Similar to the Select field, the values can overwritten if required:

```
NovaViewField::make('Template')->options(
    [
        'value' => 'Label'
    ]
)
```
