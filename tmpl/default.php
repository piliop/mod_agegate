<?php

defined('_JEXEC') or die;

$moduleId = (int) $module->id;
$headingId = 'mod-agegate-heading-' . $moduleId;
?>
<div
    class="mod-agegate"
    data-agegate
    data-redirect-url="<?php echo htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8'); ?>"
    data-choice-days="<?php echo (int) $choiceDays; ?>"
    data-heading-id="<?php echo htmlspecialchars($headingId, ENT_QUOTES, 'UTF-8'); ?>"
    hidden
>
    <div class="mod-agegate__backdrop"></div>
    <section
        class="mod-agegate__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="<?php echo htmlspecialchars($headingId, ENT_QUOTES, 'UTF-8'); ?>"
        tabindex="-1"
    >
        <h2 id="<?php echo htmlspecialchars($headingId, ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars(\Joomla\CMS\Language\Text::_('MOD_AGEGATE_HEADING'), ENT_QUOTES, 'UTF-8'); ?>
        </h2>
        <p><?php echo htmlspecialchars(\Joomla\CMS\Language\Text::_('MOD_AGEGATE_QUESTION'), ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="mod-agegate__actions" data-agegate-actions>
            <button type="button" class="mod-agegate__button mod-agegate__button--yes" data-agegate-yes>
                <?php echo htmlspecialchars(\Joomla\CMS\Language\Text::_('MOD_AGEGATE_YES'), ENT_QUOTES, 'UTF-8'); ?>
            </button>
            <button type="button" class="mod-agegate__button mod-agegate__button--no" data-agegate-no>
                <?php echo htmlspecialchars(\Joomla\CMS\Language\Text::_('MOD_AGEGATE_NO'), ENT_QUOTES, 'UTF-8'); ?>
            </button>
        </div>
        <p class="mod-agegate__message" data-agegate-message role="status" hidden>
            <?php echo htmlspecialchars(\Joomla\CMS\Language\Text::_('MOD_AGEGATE_UNDERAGE'), ENT_QUOTES, 'UTF-8'); ?>
        </p>
    </section>
</div>
