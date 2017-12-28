<?php

use Facebook\Facebook;

$fb = new \Facebook\Facebook([

    'app_id'        => '1782052178495689',
    'app_secret'    => '44ebff15be92eda57114778627d7cf66',
    'default_graph_version' => 'v2.10',

]);

$helper = $fb->getRedirectLoginHelper();