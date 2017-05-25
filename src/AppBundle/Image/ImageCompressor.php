<?php

namespace AppBundle\Image;

class ImageCompressor
{
  /**
   * @var ImageCompressorInterface
   */
  private $compressor;

  /**
   * Initialize Image Compressor.
   *
   * @param ImageCompressorInterface compressor
   */
  public function __construct(ImageCompressorInterface $compressor)
  {
    $this->compressor = $compressor;
  }

  /**
   * Compresses an image and returns path to compressed image.
   *
   * @param string $src Path of image to be compressed.
   * @param string $dest Path of the compressed image.
   *
   * @return string Returns the path of the compressed image.
   */
  public function compress(string $src, string $dest)
  {
    // Download src image
    if (copy($src, $dest)) {

      // Compress image in place
      return $this->compressor->compress($dest, $dest);
    }
    else {
      throw new \Exception("Unable to download image from $dest. Please check your permissions and shit.", 1);
    }
  }
}
