<?php


function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}

function   responseJson($status, $msg, $data = null)
{
    $response = [
        'status' => $status,
        'msg' => $msg,
        'data' => $data
    ];
    return response()->json($response);
}
