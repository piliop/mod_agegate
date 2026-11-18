<?php

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('stylesheet', 'mod_agegate/agegate.css', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('script', 'mod_agegate/agegate.js', ['version' => 'auto', 'relative' => true]);

$redirectUrl = trim((string) $params->get('redirect_url', ''));
$validatedUrl = filter_var($redirectUrl, FILTER_VALIDATE_URL);
$scheme = $validatedUrl ? strtolower((string) parse_url($validatedUrl, PHP_URL_SCHEME)) : '';

if (!$validatedUrl || !in_array($scheme, ['http', 'https'], true)) {
    $redirectUrl = '';
}

$choiceDays = filter_var(
    $params->get('choice_days', 10),
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1, 'max_range' => 365]]
);

if ($choiceDays === false) {
    $choiceDays = 10;
}

require ModuleHelper::getLayoutPath('mod_agegate', $params->get('layout', 'default'));
