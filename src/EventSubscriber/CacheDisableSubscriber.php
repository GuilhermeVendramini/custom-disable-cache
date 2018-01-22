<?php

namespace Drupal\custom_disable_cache\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class CacheDisableSubscriber.
 */
class CacheDisableSubscriber implements EventSubscriberInterface {
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['disableCacheForPageLocked'];
    return $events;
  }

  /**
   * Subscriber Callback for the event.
   */
  public function disableCacheForPageLocked() {
    $node = \Drupal::routeMatch()->getParameter('node');

    //Faça a sua regra aqui
    if (!empty($node) && $node->id() == '3') {
      \Drupal::service('page_cache_kill_switch')->trigger();
    }
  }
}