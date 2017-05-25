<?php

namespace AppBundle\Image;

/**
 * This class contains methods for compressing images
 * using the ImageMagick library.
 */
class ImagickCompressor implements ImageCompressorInterface
{
  /**
   * {@inheritDoc}
   */
  public function compress($src, $dest)
  {
    $image = new \Imagick($src);
    $image->setImageCompressionQuality(75);
    $image->stripImage();
    $image->writeImage($dest);

    return $dest;
  }
}
