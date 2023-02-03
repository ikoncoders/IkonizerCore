<?php
declare(strict_types=1);

namespace IkonizerCore\FormBuilder;

use IkonizerCore\FormBuilder\Type\TextType;
use IkonizerCore\FormBuilder\Type\EmailType;
use IkonizerCore\FormBuilder\Type\RadioType;
use IkonizerCore\FormBuilder\Type\ButtonType;
use IkonizerCore\FormBuilder\Type\EditorType;
use IkonizerCore\FormBuilder\Type\HiddenType;
use IkonizerCore\FormBuilder\Type\NumberType;
use IkonizerCore\FormBuilder\Type\SelectType;
use IkonizerCore\FormBuilder\Type\SubmitType;
use IkonizerCore\FormBuilder\Type\UploadType;
use IkonizerCore\FormBuilder\Type\CheckboxType;
use IkonizerCore\FormBuilder\Type\PasswordType;
use IkonizerCore\FormBuilder\Type\TextareaType;
use IkonizerCore\FormBuilder\Type\DateType;
use IkonizerCore\FormBuilder\Type\MultipleCheckboxType;
use IkonizerCore\FormBuilder\FormBuilderBlueprintInterface;

class FormBuilderBlueprint implements FormBuilderBlueprintInterface
{

    private function args(
        string $name,
        array $class = [],
        mixed $value = null,
        string|null $placeholder = null
    ): array {
        return [
            'name' => $name,
            'class' => array_merge(['uk-input'], $class),
            'placeholder' => ($placeholder !== null) ? $placeholder : '',
            'value' => ($value !== null) ? $value : ''

        ];
    }

    private function arg(
        string $name,
        array $class = [],
        mixed $value = null
    ): array {
        return [
            'name' => $name,
            'class' => $class,
            'value' => ($value !== null) ? $value : ''

        ];
    }

    private function subArg(
        string $name,
        array $class = [],
        mixed $value = null,
        string $onclick = null
    ): array {
        return [
            'name' => $name,
            'class' => $class,
            'value' => ($value !== null) ? $value : '',
            'onclick' => $onclick

        ];
    }

    /**
     * Editor which returns an empty div tag with the id and class properties
     *
     * @param string $id
     * @param array $class
     * @return array
     */
    public function editor(string $id, array $class = []): array
    {
        return [
            EditorType::class => ['id' => $id, 'class' => $class]
        ];
    }


    public function text(
        string $name,
        array $class = [],
        mixed $value = null,
        bool $disabled = false,
        string|null $placeholder = null
    ): array {
        return [
            TextType::class => [
                array_merge(
                    $this->args($name, $class, $value, $placeholder),
                    ['disabled' => $disabled]
                )
            ]
        ];

    }

    public function number(
        string $name,
        array $class = [],
        mixed $value = null,
        bool $disabled = false,
        string|null $placeholder = null
    ): array {
        return [
            NumberType::class => [
                array_merge(
                    $this->args($name, $class, $value, $placeholder),
                    ['disabled' => $disabled]
                )
            ]
        ];

    }

    public function hidden(
        string $name,
        mixed $value = null,
        array $class = []
    ): array {
        return [
            HiddenType::class => [
                array_merge(
                    $this->arg($name, $class, $value),
                    []
                )

            ]
        ];

    }

    public function textarea(
        string $name,
        array $class = [],
        mixed $id = null,
        string|null $placeholder = null,
        int $rows = 5,
        int $cols = 33,
    ): array {
        return [
            TextareaType::class => [
                'name' => $name,
                'class' => $class,
                'id' => $id,
                'placeholder' => $placeholder,
                'rows' => $rows,
                'cols' => $cols
            ]
        ];

    }


    public function email(
        string $name,
        array $class = [],
        mixed $value = null,
        bool $required = true,
        bool $pattern = false,
        string|null $placeholder = null
    ): array {
        return [
            EmailType::class => [
                array_merge(
                    $this->args($name, $class, $value, $placeholder),
                    ['required' => $required, 'pattern' => $pattern]
                )
            ]
        ];
    }

    public function datePicker(
        string $name,
        array $class = [],
        mixed $value = null,
        bool $required = true,
    ): array {
        return [
            DateType::class => [
                array_merge(
                    $this->arg($name, $class, $value),
                    ['required' => $required,]
                )
            ]
        ];
    }


    public function password(
        string $name,
        array $class = [],
        mixed $value = null,
        string|null $autocomplete = null,
        bool $required = false,
        bool $pattern = false,
        bool $disabled = false,
        string|null $placeholder = null
    ): array {
        return [
            PasswordType::class => [
                array_merge(
                    $this->args($name, $class, $value, $placeholder),
                    ['autocomplete' => $autocomplete, 'required' => $required, 'pattern' => $pattern, 'disabled' => $disabled]
                )
            ]
        ];
    }
    
    public function radio(string $name, array $class = [], mixed $value = null): array
    {
        return [
            RadioType::class => [
                array_merge(
                    $this->arg($name, array_merge(['uk-radio'], $class), $value),
                    []
                )
            ]
        ];
    }

    public function checkbox(
        string $name,
        array $class = [],
        mixed $value = null
    ): array {
        return [
            CheckboxType::class => [
                $this->arg($name, array_merge(['uk-checkbox'], $class), $value)
            ]
        ];
    }

    public function select(
        string $name,
        array $class = [],
        string $id = null,
        mixed $size = null,
        bool $multiple = false,
    ): array
    {

        return [
            SelectType::class => [
                'name' => $name,
                'class' => $class,
                'id' => $id,
                'size' => $size,
                'multiple' => $multiple
            ]
        ];
    }


    public function multipleCheckbox(
        string $name,
        array $class = [],
        mixed $value = null
    ): array {
        return [
            MultipleCheckboxType::class => [
                $this->arg($name, array_merge(['uk-checkbox'], $class), $value)
            ]
        ];
    }

    public function upload(string $name, array $class = [], ?string $value = null, bool $multiple = true)
    {
        return [
            UploadType::class => [
                ['name' => $name, 'class' => $class, 'value' => $value, 'multiple' => $multiple]
            ]
        ];
    }

    public function submit(
        string $name,
        array $class = [],
        mixed $value = null,
        ?string $onclick = null
    ): array {
        return [
            SubmitType::class => [
                $this->subArg($name, $class, $value, $onclick)
            ]
        ];
    }

    public function dropdownSubmit(
        string $name,
        array $class = [],
        mixed $value = null,
        ?string $onclick = null
    ): array {
        return [
            ButtonType::class => [
                $this->subArg($name, $class, $value, $onclick)
            ]
        ];
    }


    public function choices(array $choices, string|int|array $default = null, object $form = null): array
    {
        return [
            'choices' => $choices,
            'default' => ($default !==null) ? $default : 'pending',
            'object' => $form
        ];
    }

    public function settings(
        bool $inlineFlipIcon = false,
        ?string $inlineIcon = null,
        bool $showLabel = true,
        ?string $newLabel = null,
        bool $wrapper = false,
        ?string $checkboxLabel = null,
        ?string $description = null): array
    {
        return [
            'inline_flip_icon' => $inlineFlipIcon,
            'inline_icon' => $inlineIcon,
            'show_label' => $showLabel,
            'new_label' => $newLabel,
            'before_after_wrapper' => $wrapper,
            'checkbox_label' => $checkboxLabel,
            'description' => $description
        ];
    }
}
