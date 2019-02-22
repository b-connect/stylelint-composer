<?php

namespace Bconnect\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface, EventSubscriberInterface {

  protected static $STYLELINT_FILE = 'http://bconnect.b-connect.org/styleguide/.stylelintrc.yml';
  protected static $STYLELINT_IGNORE_FILE = 'http://bconnect.b-connect.org/styleguide/.stylelintignore';

  public function activate(Composer $composer, IOInterface $io) {}

  public static function getSubscribedEvents()
  {
      return array(
          'post-install-cmd' => 'handle',
          'post-update-cmd' => 'handle',
      );
  }

  public function handle($event)
  {
      $this->download($event->getComposer(), $event->getIO());
  }

  public function download(Composer $composer, IOInterface $io) {
    $rootDir = dirname($composer->getConfig()->get('vendor-dir'));
    $io->write("Download stylelint configs....", true, IOInterface::NORMAL);
    $error = false;
    if (!copy(static::$STYLELINT_FILE, $rootDir . "/" . basename(static::$STYLELINT_FILE))) {
      $io->writeError("Could not download stylelint config", true);
    }
    if (!copy(static::$STYLELINT_IGNORE_FILE, $rootDir . "/" . basename(static::$STYLELINT_IGNORE_FILE))) {
      $io->writeError("Could not download stylelint ignore config", true);
    }
  }

}
