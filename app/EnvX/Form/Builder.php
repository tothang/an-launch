<?php

namespace App\EnvX\Form;

use Carbon\Carbon;
use Collective\Html\FormBuilder as LaravelFormBuilder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\HtmlString;

class Builder extends LaravelFormBuilder
{
    protected $labelWidth;

    protected $inputWidth;

    protected $horizontal;

    protected $showValid;

    private $theme;

    public function model($model, array $options = [], array $styles = []): HtmlString
    {
        $this->model = $model;

        return $this->open($options, $styles);
    }

    public function open(array $options = [], array $styles = []): HtmlString
    {
        $this->labelWidth = $styles['labelWidth'] ?? config('envx.forms.labelWidth');
        $this->inputWidth = $styles['inputWidth'] ?? config('envx.forms.inputWidth');
        $this->horizontal = $styles['horizontal'] ?? config('envx.forms.horizontal');
        $this->showValid = isset($styles['showValid']) && empty(Request::old()) === false;

        if ($this->horizontal) {
            $options['class'] = isset($options['class']) ? $options['class'] . ' form-horizontal ' : 'form-horizontal';
        }

        if (isset($styles['theme'])) {
            $this->theme = $styles['theme'];
        }

        return parent::open($options);
    }

    public function attendingButtons(): string
    {
        return view($this->getView('attending-buttons'))->render();
    }

    public function buttonGroup(string $name, $value = null, array $values = [], array $options = []): string
    {
        if (in_array('ButtonGroup', $this->skipValueTypes, false) === false) {
            $value = $this->getValueAttribute($name, $value);
        }

        $data = $this->getInputData($name, $value, $options, $values);
        $data['values'] = $values;
        $data['type'] = 'button-group';
        $data['button_class'] = $options['button_class'] ?? null;
        $data['toggle'] = $options['toggle'] ?? $name;

        return view($this->getView('input-wrap'), $data)->render();
    }

    public function select(
        $name,
        $list = [],
        $selected = null,
        array $selectAttributes = [],
        array $optionsAttributes = [],
        array $optgroupsAttributes = []
    ): string {
        $options = $selectAttributes;

        $data = $this->getInputData($name, null, $options);
        $data['classes'] = $options['classes'] ?? null;
        $data['type'] = 'select';
        $data['values'] = $list;
        $data['value'] = $selected;
        $data['groupClasses'] = $options['groupClasses'] ?? null;
        $data['multiple'] = $options['multiple'] ?? false;
        $data['id'] = $options['id'] ?? null;

        return view($this->getView('input-wrap'), $data)->render();
    }

    public function submit($name = null, $value = null, $options = []): string
    {
        $data = $this->getInputData($name, $value, $options);

        $previousTab = $options['previousTab'] ?? false;
        $data['previousTab'] = $previousTab;

        return view($this->getView('submit'), $data)->render();
    }

    public function input($type, $name, $value = null, $options = []): string
    {
        if (in_array('input', $this->skipValueTypes, false) === false) {
            $value = $this->getValueAttribute($name, $value);
        }

        $data = $this->getInputData($name, $value, $options);

        $data['type'] = 'input';
        $data['inputType'] = $type;

        return (isset($data['noWrap']) && $data['noWrap'])
            ? view($this->getView('input-no-wrap'), $data)->render()
            : view($this->getView('input-wrap'), $data)->render();
    }

    public function dateTime($name, $value = null, $options = []): string
    {
        return view(
            $this->getView('datetime'),
            $this->getInputData($name, $value, $options)
        )->render();
    }

    public function textarea($name, $value = null, $options = []): string
    {
        if (!in_array('input', $this->skipValueTypes)) {
            $value = $this->getValueAttribute($name, $value);
        }

        $input = parent::textarea($name, $value, $options);
        $data = $this->getInputData($name, $value, $options);
        $data['input'] = $input;
        $data['type'] = 'textarea';

        return view($this->getView('input-wrap'), $data)->render();
    }

    public function spinner(string $name, $value = null, array $options = []): string
    {
        if (!in_array('spinner', $this->skipValueTypes)) {
            $value = $this->getValueAttribute($name, $value);
        }

        $input = parent::textarea($name, $value, $options);
        $data = $this->getInputData($name, $value, $options);
        $data['input'] = $input;
        $data['type'] = 'spinner';

        return view($this->getView('input-wrap'), $data)->render();
    }

    public function checkboxGroup(string $name, array $values = [], $value = null, array $options = []): string
    {
        if (!in_array('checkboxGroup', $this->skipValueTypes)) {
            $value = $this->getValueAttribute($name, $value);
        }

        $data = $this->getInputData($name, $value, $options);
        $data['inline'] = isset($options['inline']) ? $options['inline'] : false;
        $data['values'] = $values;
        $data['type'] = 'checkbox-group';

        return view($this->getView('input-wrap'), $data)->render();
    }

    public function radioGroup(string $name, array $values = [], $value = null, array $options = []): string
    {
        $data = $this->getInputData($name, $value, $options);
        $data['inline'] = isset($options['inline']) ? $options['inline'] : false;
        $data['values'] = $values;
        $data['type'] = 'radio-group';

        return view($this->getView('input-wrap'), $data)->render();
    }

    protected function getInputData(string $name, $value = null, array $options = []): array
    {
        $label = Arr::get($options, 'label', null);
        $placeholder = Arr::get($options, 'placeholder', null);
        $horizontal = Arr::get($options, 'horizontal', $this->horizontal);
        $labelWidth = Arr::get($options, 'labelWidth', $this->labelWidth);
        $inputWidth = Arr::get($options, 'inputWidth', $this->inputWidth);
        $groupClasses = Arr::get($options, 'groupClasses', null);
        $classes = Arr::get($options, 'classes', null);
        $helpBlock = Arr::get($options, 'helpBlock', null);
        $required = Arr::get($options, 'required', false);
        $noWrap = Arr::get($options, 'noWrap', false);
        $disabled = Arr::get($options, 'disabled', false);
        $maxLength = Arr::get($options, 'maxLength', null);
        $hasSuccess = $this->showValid;
        $readonly = Arr::get($options, 'readonly', null);
        $rows = Arr::get($options, 'rows', null);
        $time = Arr::get($options, 'time', null);
        $defaultDate = Arr::get($options, 'defaultDate', null);
        $minDate = Arr::get($options, 'minDate', null);
        $maxDate = Arr::get($options, 'maxDate', null);
        $searchable = Arr::get($options, 'searchable', false);
        $inline = Arr::get($options, 'inline', false);
        $center = Arr::get($options, 'center', false);

        $hasErrors = $this->checkErrors($name);

        $data = compact(
            'name',
            'value',
            'label',
            'placeholder',
            'horizontal',
            'labelWidth',
            'inputWidth',
            'helpBlock',
            'required',
            'groupClasses',
            'classes',
            'hasSuccess',
            'hasErrors',
            'maxLength',
            'disabled',
            'noWrap',
            'readonly',
            'rows',
            'time',
            'defaultDate',
            'minDate',
            'maxDate',
            'searchable',
            'inline',
            'center'
        );

        return $data;
    }

    protected function checkErrors(string $name): bool
    {
        $errorName = str_replace([']', '['], ['', '.'], $name);

        return session()->has('errors') && session('errors')->has($errorName);
    }

    private function getView(string $viewName): string
    {
        $theme = $this->theme ?? 'default';

        return 'form.' . $theme . '.' . $viewName;
    }
}
