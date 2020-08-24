<?php

if (!function_exists('uuid')) {

    /**
     * @return string
     */
    function uuid()
    {
        return \Illuminate\Support\Str::uuid()->toString();
    }
}

if (!function_exists('image_demo')) {

    /**
     * @param int $width
     * @param int $height
     *
     * @return string
     */
    function image_demo($width = 45, $height = 45)
    {
        return '/maker-builder/no-image-view.png';
    }
}

if (!function_exists('fm_prop')) {

    /**
     * create Form Macro Property
     * @param int $width
     * @param int $height
     *
     * @return string
     */
    function fm_prop(array $property)
    {
        return new \App\Helpers\Components\FormMacroProperty($property);
    }
}
