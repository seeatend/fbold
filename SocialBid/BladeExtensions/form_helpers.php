<?php

use Illuminate\Html\FormBuilder as Form;

Form::macro(
    "field",
    function ($options) {
        $markup = "";

        $type = "text";
        $errorsBag = \Session::get('errors', null);

        if (empty($options["name"])) {
            return;
        }

        $name = $options["name"];

        $label = "";

        if (!empty($options["type"])) {
            $type = $options["type"];
        }
        $select_options = [];

        if (isset($options['options'])) {
            $select_options = $options['options'];
        }
        $selected = null;
        if (!empty($options["selected"])) {
            $selected = \Input::old($name, $options['selected']);
        }

        if (!empty($options["label"])) {
            $label = $options["label"];
        }

        $value = \Input::old($name);
        if (isset($options["value"])) {
            $value = \Input::old($name, $options["value"]);
        }

        if (!empty($options["placeholder"])) {
            $placeholder = (isset($label) and
                $options['placeholder'] === true) ? $label :
                $options["placeholder"];
        }

        $container_class = "";

        if (!empty($options["container_class"])) {
            $container_class = " " . $options["container_class"];
        }

        $class = "";

        if (!empty($options["class"])) {
            $class = " " . $options["class"];
        }

        $parameters = [
            "class" => "form-control" . $class
        ];
        if (isset($placeholder)) {
            $parameters['placeholder'] = $placeholder;
        }

        $label_after = "";
        if (!empty($options['label_after'])) {
            $label_after = $options['label_after'];
        }

        if (!empty($options['params'])) {
            $tmp = explode(',', $options['params']);
            foreach ($tmp as $param) {
                $tmp2 = explode(':', $param);
                $parameters[$tmp2[0]] = $tmp2[1];
            }
        }

        $rules = array();
        if (!empty($options['rules'])) {
            $tmp = explode(',', $options['rules']);
            $parameters['data-bv-field'] = $options['name'];
            foreach ($tmp as $rule) {
                $tmp2 = explode(':', $rule, 2);
                $parameters['data-bv-' . $tmp2[0]] = $tmp2[1];
            }
        }

        $error = "";

        $icon = '';
        if ($errorsBag != null && $errorsBag->has($options['name'])) {
            $error = $errorsBag->first($options['name']);
        }

        if ($type !== "hidden") {
            $markup .= "<div class='form-group";
            $markup .= ($error ? " has-error" : "");
            $markup .= ' ' . $container_class;
            $markup .= "'>";
        }
        if (!empty($label) && $type !== 'checkbox') {
            $markup .= "<label for=\"{$name}\" class='control-label'>{$label}</label>";
            $markup .= $label_after;
        }
        switch ($type) {
            case "text": {
                $markup .= Form::text($name, $value, $parameters);
                break;
            }
            case "email": {
                $markup .= Form::email($name, $value, $parameters);
                break;
            }
            case "textarea": {
                $markup .= Form::textarea($name, $value, $parameters);
                break;
            }
            case "file": {
                $markup .= Form::file($name, $parameters);
                break;
            }
            case "password": {
                $markup .= Form::password($name, $parameters);

                break;
            }

            case "checkbox": {
                $markup .= "<div class='checkbox'>";
                $markup .= "<label>";
                $markup .= Form::checkbox($name, 1, !!$value);
                $markup .= " " . $label;
                $markup .= "</label>";
                $markup .= "</div>";

                break;
            }
            case "select": {
                $markup .= Form::select(
                    $name,
                    $select_options,
                    $selected,
                    $parameters
                );
                break;
            }
            case "hidden": {
                $markup .= Form::hidden($name, $value);
                break;
            }
        }
        if (!empty($options['icon'])) {
            $markup .= '<span class="' . $options['icon'] . '"></span>';
        }
        if ($error) {
            $markup .= "<span class='help-block has-error'>";
            $markup .= $error;
            $markup .= "</span>";
        }

        if ($type !== "hidden") {
            $markup .= "</div>";
        }

        return $markup;
    }
);

Form::macro(
    'error',
    function ($options) {
        $field = $options['name'];
        $markup = null;
        $error = null;
        $errorsBag = \Session::get('errors', null);

        if ($errorsBag != null && $errorsBag->has($options['name'])) {
            $error = $errorsBag->first($options['name']);
        }
        if ($error) {
            $markup .= "<span class='help-block has-error'>";
            $markup .= $error;
            $markup .= "</span>";
        }
        return $markup;
    }
);
