<?php

namespace AppBundle\Image;

/**
 * This class contains methods for compressing images
 * using the lossless compression libraries.
 */
class LosslessCompressor extends AbstractCompressor implements ImageCompressorInterface
{
  /**
   * {@inheritDoc}
   */
  protected function getJpegCommand($src, $dest)
  {
    return "jpegtran -copy none -optimize -progressive -trim -outfile $dest $src";
  }

  /**
   * {@inheritDoc}
   */
  protected function getPngCommand($src, $dest)
  {
    return "optipng -strip all -out $dest $src";
  }
}
