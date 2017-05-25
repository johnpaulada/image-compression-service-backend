<?php

namespace AppBundle\Image;

/**
 * This class contains methods for compressing images
 * using the gd library.
 */
class GDCompressor implements ImageCompressorInterface
{
  /**
   * {@inheritDoc}
   */
  public function compress($src, $dest)
  {
    return $this->compressImage($src, $dest, $this->getMimeType($src));
  }

  private function compressImage($src, $dest, $type)
  {
    $image = $this->createImage($src, $type);
    $this->writeImage($image, $dest, $type);

    return $dest;
  }

  private function writeImage($image, $dest, $type)
  {
    $writers = [
      'image/jpeg' => imagejpeg,
      'image/png'  => imagepng
    ];

    $success = $writers[$type]($image, $dest);

    if ($success) {
      return true;
    }
    else {
      throw new \Exception("Could not write image of type $type to $dest.");
    }
  }

  private function createImage($src, $type) {
    $creators = [
      'image/jpeg' => imagecreatefromjpeg,
      'image/png'  => imagecreatefrompng
    ];

    $image = $creators[$type]($src);

    if ($image) {
      return $image;
    }
    else {
      throw new \Exception("Could not create image of type $type from $src.");
    }
  }

  private function getMimeType($src)
  {
    return getimagesize($src)['mime'];
  }
}
