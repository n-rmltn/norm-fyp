<?php

if (!function_exists('vite')) {
    function vite($path)
    {
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        return asset('build/' . $manifest[$path]['file']);
    }
}
