<?php

/*
  @name Fleexed
  @author gavrochelegnou <gavrochelegnou@trashmail.net>
  @licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
  @version 1.0.0
  @description Repositionne les menus en position fixed
 */

function fleexed_plugin_addFeedData($event) {
    echo '<span class="fleexed_feed" data-feed="'.$event->getFeed().'"></span>';
}

Plugin::AddCss('/css/fleexed.css');
Plugin::AddJs('/js/fleexed.js');

Plugin::AddHook('event_post_top_options','fleexed_plugin_addFeedData');