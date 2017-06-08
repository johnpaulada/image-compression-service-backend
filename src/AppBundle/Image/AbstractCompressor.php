<?php

namespace AppBundle\Image;

abstract class AbstractCompressor
{
  /**
   * Starts image compression command process.
   *
   * @param string $src path of image to be compressed
   * @param string $dest path of compressed image
   */
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

  /**
   * Retrieve and execute compression command
   * depending on the image type.
   *
   * @param string $src path of image to be compressed
   * @param string $dest path of compressed image
   * @param string $type MIME type of image
   */
  private function compressImage($src, $dest, $type)
  {
    $types = [
      'image/jpeg' => $this->getJpegCommand($src, $dest),
      'image/png'  => $this->getPngCommand($src, $dest)
    ];
    $success = $this->isSuccess($this->executeCommand($types[$type]));

    return $success;
  }

  /**
   * Execute command on the shell.
   *
   * @param string $command the command to be executed
   * @return string
   */
  private function executeCommand($command)
  {
    $escaped = escapeshellcmd($command);
    $output = "";
    $code = -1;
    exec($escaped, $output, $code);

    return $code;
  }

  /**
   * Get image MIME type.
   *
   * @param string $src the image location
   * @return string
   */
  private function getMimeType($src)
  {
    return getimagesize($src)['mime'];
  }

  /**
   * Check if code is a success code.
   *
   * @param int $code a command return code
   * @return boolean
   */
  private function isSuccess($code) {
    return $code === 0;
  }

  /**
   * Generate a JPEG compression command.
   *
   * @param string $src path of JPEG image to be compressed
   * @param string $dest path of compressed JPEG image
   * @return string
   */
  abstract protected function getJpegCommand($src, $dest);

  /**
   * Generate a PNG compression command.
   *
   * @param string $src path of PNG image to be compressed
   * @param string $dest path of compressed PNG image
   * @return string
   */
  abstract protected function getPngCommand($src, $dest);
}
