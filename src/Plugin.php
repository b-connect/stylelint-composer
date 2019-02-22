<?php

namespace Bconnect\Composer;

use Composer\Script\Event;
use Composer\Plugin\CommandEvent;
use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginEvents;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;

class Plugin implements PluginInterface, EventSubscriberInterface {
  /**
   * @var \Bconnect\Composer\Handler
   */
  protected $handler;

  public static function getSubscribedEvents()
  {
      return array(
          'post-install-cmd' => 'installOrUpdate',
          'post-update-cmd' => 'installOrUpdate',
      );
  }

}
