<?php

function getPath(Illuminate\Http\UploadedFile $file) {
    return $file->store('images');
}
