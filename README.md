# Joomla Age Gate Module

A Joomla site module for Joomla 5 and Joomla 6 that displays an age-verification popup. The popup asks visitors whether they are 18 or older and includes English and Greek translations.

## Installation

1. In Joomla administrator, go to **System → Install → Extensions**.
2. Upload `mod_agegate.zip`.
3. Go to **Content → Site Modules** (or **System → Manage → Modules**, depending on your administrator menu).
4. Create or edit the **Age Gate** module, publish it, and assign it to the pages where the age gate should appear.
5. Save the module.

### Module position

Select a position that exists in your active template and is rendered on every page where the age gate should appear. The popup is fixed over the full screen, so the position does not change where it appears; it only determines whether the module is rendered. A position that the template does not render will prevent the popup from loading.

## Configuration

The module has these settings:

- **Remember choice for (days)**: Set how long the visitor's choice is remembered (1–365 days; default: 10).
- **Under-18 redirect URL**: Enter an `http://` or `https://` destination to redirect visitors who select **No**. If the field is blank or the URL is invalid, the module displays an underage message instead.

The popup text follows the active Joomla site language. English (`en-GB`) and Greek (`el-GR`) translations are included.

## Visitor choice

The visitor's Yes or No choice is stored in that browser's local storage for the configured number of days. A Yes choice suppresses the popup for that period. A No choice redirects to the configured URL on later visits, or continues to show the underage message when no URL is configured.

The choice is stored per browser and website origin. Clearing browser data or using a browser that blocks local storage may prevent the choice from being retained.

## Important

This is a client-side age-verification prompt, not a secure access-control mechanism. Visitors can bypass client-side checks. Do not rely on this module alone where age restrictions require legally enforceable or server-side verification.
