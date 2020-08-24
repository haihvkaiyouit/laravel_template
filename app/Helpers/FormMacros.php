<?php

namespace App\Helpers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class FormMacros extends FormBuilder
{
    public function requestMessage()
    {
        $result = '';
        $errors = Session::get('errors', new MessageBag);

        if ($errors->has('message') || $errors->count() > 0) {
            $result .= '<div class="alert alert-danger time-out-message"><span>';
            if ($errors->has('message')) {
                $result .= $errors->first('message');
            } else {
                if ($errors->has('error') && !$errors->first('error') == false) {
                    $result .= 'Đã có lỗi xảy ra, vui lòng kiểm tra lại!';
                } else {
                    $result .= $errors->first();
                }
            }
            $result .= '</span></div>';
        }

        if (session()->has('message')) {
            $result .= '<div class="alert alert-danger time-out-message">';
            $result .= '<span>' . session()->get('message') . '</span>';
            $result .= '</div>';
        }
        if (session()->has('alert') || session()->has('success') || session()->has('status')) {
            $result .= '<div class="alert alert-success time-out-message">';
            $result .= '<strong>' . session()->get('alert', session()->get('success', session()->get('status'))) . '</strong>';
            $result .= '</div>';
        }

        return $this->toHtmlString($result);
    }

    public function groupText($label, $inputName, $inputValue = null, $isRequired = false, $options = [])
    {
        if (!isset($options['maxlength']) | empty($options['maxlength'])) {
            $options['maxlength'] = 200;
        }

        return $this->groupControl($label, $inputName, $inputValue, 'text', $isRequired, $options);
    }

    public function groupNumber($label, $inputName, $inputValue = null, $isRequired = false, $options = [])
    {
        if (!isset($options['maxlength']) | empty($options['maxlength'])) {
            $options['maxlength'] = 50;
        }

        $options['data-mask-number'] = true;

        return $this->groupControl($label, $inputName, $inputValue, '', $isRequired, $options);
    }

    public function groupEmail($label, $inputName, $inputValue = null, $isRequired = false, $options = [])
    {
        return $this->groupControl($label, $inputName, $inputValue, 'email', $isRequired, $options);
    }

    public function groupColor($label, $inputName, $inputValue = null, $isRequired = false, $options = [])
    {
        $required     = ($isRequired == true) ? ' required' : '';
        $inputOptions = array_merge(['class' => 'form-control' . $required, 'data-toggle' => 'color-picker', 'maxlength' => '50'], $options);
        $input        = $this->input('text', $inputName, $inputValue, $inputOptions);

        $html = '<div class="form-group' . $required .'"><label>' . $label . '</label>
                    <div class="input-group" title="Using input value">
                        ' . $input . '
                    </div>
                </div>';

        return $this->toHtmlString($html);
    }

    public function groupPassword($label, $inputName, $isRequired = false, $options = [])
    {
        return $this->groupControl($label, $inputName, '', 'password', $isRequired, $options);
    }

    public function groupRadio($label, $inputName, array $inputData, $checkedValue = null, $isRequired = false, $options = [])
    {
        $html = '';
        $html .= '<div class="radio radio-primary mb-1">';
        foreach ($inputData as $value => $name) {
            $idElement = 'radio_'.$inputName.'_'.$value;
            $isChecked = ($checkedValue !== null && $checkedValue == $value)?true:false;

            $html .= $this->radio($inputName, $value, $isChecked, ['id' => $idElement]);
            $html .= '<label for="'.$idElement.'" class="d-inline-block w-auto">'.$name.'</label>';
        }
        $html .= '</div>'; //end of list radio
        return $this->baseHtmlFomGroup($label, $html, $isRequired);
    }

    public function groupCheckbox($label, $name, $list = [], $checked = null, $isRequired = false, $options = [])
    {
        $html = '<div class="list-checkbox-inline d-inline-block">';
        $totalLoop = count($list);
        foreach ($list as $value => $display) {
            $html .= '<div class="checkbox check-primary d-inline-block mr-2 mb-0">';
            $html .= $this->checkboxCustom($display, $name, $value, $checked, $options, $totalLoop);
            $html .='</div>';
        }
        $html .='</div>';
        return $this->baseHtmlFomGroup($label, $html, $isRequired);
    }

    private function checkboxCustom($label, $name, $value = 1, $checked = null, $options = [], $totalLoop = 1)
    {
        if ($checked === null) {
            $checked = in_array($value, request($name, []));
        }
        $options['id'] = $name.'_'.$value;
        $inputName = ($totalLoop > 1 ) ? $name.'[]' : $name;
        $html = $this->checkable('checkbox', $inputName, $value, $checked, $options);
        $html .= '<label for="'.$options['id'].'">'.$label.'</label>';

        return $this->toHtmlString($html);
    }

    public function groupUploadFile($label, $inputName, $inputValue = '', $isRequired = false, $preview = false, $id = 'imageInputFile', $options = [])
    {
        $imagePath = asset('/upload/' . $inputValue);
        $required = ($isRequired == true) ? ' required' : '';
        $inputLabel = ($inputValue) ? $inputValue : $label;
        $showPreview = (!$inputValue) ? 'hide' : '';
        $inputOptions = array_merge(['class' => 'form-control' . $required], ['id' => $id, 'src' => $imagePath], $options);
        $html = '<label>'. $label .'</label>';
        $html .= '<div class="custom-file mb-3">';
        $html .= $this->input('file', $inputName, $inputValue, $inputOptions);
        $html .= '<label class="custom-file-label" for="'. $id .'">'. $inputLabel .'</label>';
        $html .= '</div>';
        if ($preview) {
            $html .= '<img id="preview" class="' . $showPreview .'" height="200" width="250" src="'. $imagePath .'" alt=""/>';
        }
        return $this->toHtmlString($html);
    }

    public function groupUploadFile2($label, $inputName, $inputValue = '', $isRequired = false, $options = [], $id = 'imageInputFile')
    {
        $required = ($isRequired == true) ? ' required' : '';
        $backgroundImage = ($inputValue) ? 'style="background-image: url('. $inputValue .')"' : '';
        $inputOptions = array_merge(['class' => 'form-control'], ['id' => $id, 'style' => 'display:none;', 'accept' => 'image/*'], $options);
        $html = '<div class="form-group' . $required . '">';
        $html .= '<label class="' . $required . '">' . $label . '</label>';
        $html .= '<div class="image-previews">';
        $html .= '<div class="img-clone"><div class="img-previews__item" '. $backgroundImage .'>';
        if (empty($options['notDelete']) || !empty($options['notDelete']) && !$options['notDelete']) {
            $html .= ($inputValue) ? '<div class="btn btn-sm btn-danger btn-remove-img _rm_btn" id="'.$id.'_rm"><i class="fa fa-trash"></i></div>' : '';
        }
        $html .= '<div class="file-add">';
        $html .= '<label id="'. $id .'_label"><i class="fa fa-plus-square-o"></i> ' . trans('common.image_upload');
        $html .= $this->input('file', $inputName, $inputValue, $inputOptions);
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="file-preview">';
        $html .= $this->input('hidden', $inputName.'_preview', $inputValue, ['data-toggle' => 'preview']);
        $html .= '</div>';
        $html .= '</div></div></div></div>';
        return $this->toHtmlString($html);
    }

    public function groupSelect($label, $name, $data, $selected = null, $isRequired = false, $options = [])
    {
        $required = ($isRequired == true) ? ' required' : '';
        $inputOptions = array_merge(['class' => 'form-control' . $required], ['data-toggle' => 'select2'], $options);
        $html = $this->select($name, $data, $selected, $inputOptions);

        return $this->baseHtmlFomGroup($label, $html, $isRequired);
    }

    public function groupTextarea($label, $inputName, $inputValue = null, $isRequired = false, $options = [])
    {
        if (!isset($options['maxlength']) | empty($options['maxlength'])) {
            $options['maxlength'] = 1000;
        }

        return $this->groupControl($label, $inputName, $inputValue, 'textarea', $isRequired, $options);
    }

    /**
     * Make html box input for form
     *
     * @param        $label
     * @param        $inputName
     * @param        $inputValue
     * @param string $inputType
     * @param bool   $isRequired
     * @param array  $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function groupControl($label, $inputName, $inputValue, $inputType = 'text', $isRequired = false, $options = [])
    {
        $required = ($isRequired == true) ? ' required' : '';
        $append = false;
        if (isset($options['append'])) {
            $append = $options['append'];
            unset($options['append']);
        }

        $html = '';
        $inputOptions = array_merge(['class' => 'form-control handle-half-size-kata' . $required], $options);
        $inputOptionsPassword = array_merge(['class' => 'form-control' . $required], $options);
        if ($inputType === 'textarea') {
            $html .= $this->textarea($inputName, $inputValue, $inputOptions);
        } elseif ($inputType == 'password') {
            $html .= $this->password($inputName, $inputOptionsPassword);
        } else {
            $html .= $this->input($inputType, $inputName, $inputValue, $inputOptions);
        }

        return $this->baseHtmlFomGroup($label, $html, $isRequired, $append);
    }

    private function baseHtmlFomGroup($label, $htmlContent, $isRequired = false, $isGroup = false)
    {
        $required = ($isRequired == true) ? ' required' : '';

        if ($isGroup !== false) {
            $textAppendGroup = $isGroup;
            $isGroup         = ' input-group';
        }
        $html = '<div class="form-group'.$required.$isGroup.'">';
        if ($isGroup !== false) {
            $html .= '<div class="form-input-group">';
        }
        $html .= '<label>'.$label.'</label>';
        $html .= $htmlContent;
        if ($isGroup !== false) {
            $html .= '</div>';
        }

        if ($isGroup !== false) {
            $html .= '<div class="input-group-append"><span class="input-group-text">'.$textAppendGroup.'</span> </div>';
        }

        $html .= '</div>';

        return $this->toHtmlString($html);
    }
}
