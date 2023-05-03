<?php
if (!function_exists('modelCount')) {
    function modelCount($model)
    {
        $model = '\App\Models\\'.$model;
        $model = new $model;
        return $model::count();
    }
}
if (!function_exists('modelCountEl')) {
    function modelCountEl($model, $name, $id)
    {
        $model = '\App\Models\\'.$model;
        $model = new $model;
        return $model::where([$name.'_id' => $id])->count();
    }
}

