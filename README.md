
# Suomidigi Kehittäjäfoorumi

Suomidigi Kehittäjäfoorumi is live at [https://suomidigi.fi/kehittajafoorumi](https://suomidigi.fi/kehittajafoorumi)

## Requirements

* [Question2Answer version 1.7.4](http://question2answer.org)

## Notes

* KF Theme is built on top of SnowFlat theme base. The theme is styled only for the basic configuration used in [https://suomidigi.fi/kehittajafoorumi](https://suomidigi.fi/kehittajafoorumi). 
* KF Theme can be used as a stand-alone or within a Wordpress installation. If you want to use Q2A with a Wordpress installation, add `define('USE_QA_WITH_WORDPRESS',true);` to `qa-config.php`.
 
## Contents 

* Some external plugins
  * [Q2A Breadcrumbs v1.5.2](https://github.com/amiyasahu/q2a-breadcrumbs)

  * [Open Login v3.0.0](https://github.com/alixandru/q2a-open-login) that includes manually updated Hybrid-folder from [Hybridauth 2.8.2](https://github.com/hybridauth/hybridauth).

* Suomidigi plugin
* Finnish translations, based on [https://github.com/kyyberi/qa-fi-FI](https://github.com/kyyberi/qa-fi-FI)
* KF theme for Q2A

## Installation

1. Download Question2Answer from [question2answer.org](http://www.question2answer.org)
2. Install Q2A according to its instructions.
3. Clone this repo to the Q2A root folder.
4. If you want to use Open Login for external authentication, remove `qa-plugin/facebook-login` -folder and configure the Open Login plugin. 
5. Update some basic settings in Q2A Admin to use KF theme:

  * **General:**
  * Site language: Finnish-Suomi
  * Site theme: KF
  * Theme for mobiles: KF
  * **Users:**
  * Default avatar: upload a default avatar image
  * Avatar size on questions: 80 pixels
  * Avatar size on answers: 60 pixels
  * Avatar size on comments: 20 pixels
  * Avatar size on question lists: 80 pixels
  * Avatar size on message lists: 20 pixels
  * **Viewing:**
  * Show separate up and down votes: (X)

6. Create some categories in Q2A Admin.
7. Get reCAPTCHA API keys from [Google reCAPTCHA](https://www.google.com/recaptcha/) and add them to Q2A Admin->Plugins->reCAPTCHA->options.
8. More Q2A features can be enabled by uncommenting URL routes in `qa-plugin/q2a-suomidigi/suomidigi-url-override.php`.

