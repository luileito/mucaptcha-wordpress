=== Plugin Name ===
Contributors: luileito
Tags: mucaptcha, antispam, captcha, math, handwriting, comments, login, registration
Requires at least: 3.3
Tested up to: 4.4
Stable tag: 1.0

Integrates μcaptcha with WordPress, including comment and login/registration forms.

== Description ==

μcaptcha is a math handwriting captcha scheme for touch-capable devices. Instead of entering text with a keyboard, you just retype a mathematical expression shown on a web canvas. μcaptcha belongs to the set of protocols called HIPs (Human Interactive Proofs), which allow a person to authenticate as belonging to a select group; e.g., human as opposed to machine, adult as opposed to a child, etc.

μcaptcha allows you protect your online forms from illegitimate access or abuse. Furthermore, as a byproduct of solving μcaptchas, a valuable labeled dataset of online handwritten math expressions is collected. μcaptcha is thus channeling the users' effort into creating valuable resources for machine learning. [Learn how μcaptcha works](https://mucaptcha.com/faq.html)

== Installation ==

1. Upload the `wp-mucaptcha` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu.
3. Get the μcaptcha keys [here](https://api.mucaptcha.com) and set them in the plugin configuration page.

== Requirements ==

1. You need the μcaptcha API keys. [Get them here](https://api.mucaptcha.com).
2. Your server must have [the cURL library](http://php.net/manual/book.curl.php) installed. Most servers do.

== Screenshots ==

1. A μcaptcha example (screenshots/example.png)
2. μcaptcha plugin settings (screenshots/options.png)
3. μcaptcha in the comment form (screenshots/comments.png)
4. μcaptcha in the login form (screenshots/login.png)
