<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public function createDummyImageWithTextSizeAndPosition(
        int $width,
        int $height,
        string $x,
        string $y,
        string $text,
        string $size
    ) {
        $image = imagecreatetruecolor($width, $height);
        $bg = imagecolorallocate($image, 238, 238, 238);
        imagefilledrectangle($image, 0, 0, $width, $height, $bg);

        $border = imagecolorallocate($image, 200, 200, 200);
        imagerectangle($image, 0, 0, $width - 1, $height - 1, $border);

        return $image;
    }

    public function storeAndResizeImage($image, string $folder, int $width, int $height): string
    {
        $filename = "placeholder-{$width}x{$height}.png";
        $path = "$folder/$filename";

        ob_start();
        imagepng($image);
        $data = ob_get_clean();
        imagedestroy($image);

        Storage::disk('public')->put($path, $data);

        return "storage/$path";
    }
}
