(() => {
    'use strict';

    const storageKey = 'mod_agegate_choice';
    const millisecondsPerDay = 24 * 60 * 60 * 1000;

    function readChoice() {
        let value;

        try {
            value = window.localStorage.getItem(storageKey);
        } catch {
            return null;
        }

        if (!value) {
            return null;
        }

        let choice;

        try {
            choice = JSON.parse(value);
        } catch {
            try {
                window.localStorage.removeItem(storageKey);
            } catch {
                // Storage may be unavailable in the current browser context.
            }

            return null;
        }

        if (
            choice
            && (choice.value === 'yes' || choice.value === 'no')
            && Number.isFinite(choice.expiresAt)
            && choice.expiresAt > Date.now()
        ) {
            return choice.value;
        }

        try {
            window.localStorage.removeItem(storageKey);
        } catch {
            // Storage may be unavailable in the current browser context.
        }

        return null;
    }

    function saveChoice(value, choiceDuration) {
        try {
            window.localStorage.setItem(storageKey, JSON.stringify({
                value,
                expiresAt: Date.now() + choiceDuration,
            }));
        } catch {
            // The age gate remains usable when browser storage is disabled.
        }
    }

    function initializeAgeGate() {
        const gate = document.querySelector('[data-agegate]');

        if (!gate) {
            return;
        }

        const dialog = gate.querySelector('.mod-agegate__dialog');
        const actions = gate.querySelector('[data-agegate-actions]');
        const yesButton = gate.querySelector('[data-agegate-yes]');
        const noButton = gate.querySelector('[data-agegate-no]');
        const message = gate.querySelector('[data-agegate-message]');
        const redirectUrl = gate.dataset.redirectUrl;
        const choiceDays = Number.parseInt(gate.dataset.choiceDays, 10);
        const choiceDuration = choiceDays * millisecondsPerDay;
        const savedChoice = readChoice();

        if (savedChoice === 'yes') {
            return;
        }

        if (savedChoice === 'no' && redirectUrl) {
            window.location.assign(redirectUrl);
            return;
        }

        gate.hidden = false;
        document.documentElement.classList.add('mod-agegate-open');

        gate.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                event.preventDefault();
                return;
            }

            if (event.key !== 'Tab') {
                return;
            }

            event.preventDefault();

            if (actions.hidden) {
                dialog.focus();
                return;
            }

            (document.activeElement === yesButton ? noButton : yesButton).focus();
        });

        if (savedChoice === 'no') {
            actions.hidden = true;
            message.hidden = false;
            dialog.focus();
            return;
        }

        yesButton.focus();

        yesButton.addEventListener('click', () => {
            saveChoice('yes', choiceDuration);
            gate.hidden = true;
            document.documentElement.classList.remove('mod-agegate-open');
        });

        noButton.addEventListener('click', () => {
            saveChoice('no', choiceDuration);

            if (redirectUrl) {
                window.location.assign(redirectUrl);
                return;
            }

            message.hidden = false;
            actions.hidden = true;
            dialog.focus();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeAgeGate, { once: true });
    } else {
        initializeAgeGate();
    }
})();
