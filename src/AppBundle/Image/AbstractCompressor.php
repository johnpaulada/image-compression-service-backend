<?php

namespace AppBundle\Image;

abstract class AbstractCompressor
{
  public function compress($src, $dest)
  {
    $type = $this->getMimeType($src);
    $input = escapeshellarg($src);
    $output = escapeshellarg($dest);
    $success = $this->compressImage($input, $output, $type);

    if ($success) {
      return $dest;
    }
    else {
      throw new \Exception("Compression failed.");
    }
  }

  private function compressImage($src, $dest, $type)
  {
    // $jpegCommand = "jpeg-recompress --strip --method smallfry --max 75 $src $dest";
    // $jpegCommand = "jpeg-recompress --strip --method smallfry $src $dest";
    // $pngCommand = "pngquant --strip  --quality 75-80 --output $dest $src";
    $types = [
      'image/jpeg' => $this->getJpegCommand($src, $dest),
      'image/png'  => $this->getPngCommand($src, $dest)
    ];
    $success = $this->isSuccess($this->executeCommand($types[$type]));

    return $success;
  }

  private function executeCommand($command)
  {
    $escaped = escapeshellcmd($command);
    $output = "";
    $code = -1;
    exec($escaped, $output, $code);

    return $code;
  }

  private function getMimeType($src)
  {
    return getimagesize($src)['mime'];
  }

  private function isSuccess($code) {
    return $code === 0;
  }

  abstract protected function getJpegCommand($src, $dest);
  abstract protected function getPngCommand($src, $dest);
}
