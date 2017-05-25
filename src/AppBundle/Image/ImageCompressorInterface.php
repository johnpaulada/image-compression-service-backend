<?php

namespace AppBundle\Image;

interface ImageCompressorInterface
{
  /**
   * Compress source image to destination.
   *
   * @param string $src The path of the source image.
   * @param string $dest The path of the compressed image.
   *
   * @return string Returns path of the compressed image.
   */
  public function compress($src, $dest);
}
