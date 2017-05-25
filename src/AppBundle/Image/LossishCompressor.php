<?php

namespace AppBundle\Image;

/**
 * This class contains methods for compressing images
 * using the lossless compression libraries.
 */
class LossishCompressor extends AbstractCompressor implements ImageCompressorInterface
{
  protected function getJpegCommand($src, $dest)
  {
    return "jpeg-recompress --strip --method smallfry $src $dest";
  }

  protected function getPngCommand($src, $dest)
  {
    return "pngquant --strip  --quality 75-80 --output $dest $src";
  }
}
