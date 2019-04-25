<p align="center">
    <a href="https://www.awes.io/?utm_source=github&utm_medium=demo" target="_blank" rel="noopener noreferrer">
        <img width="100" src="https://static.awes.io/promo/Logo_sign_color.svg" alt="Awes.io logo">
    </a>
</p>

<p align="center">
    <a href="https://www.awes.io/?utm_source=github&amp;utm_medium=shields">
        <img src="https://img.shields.io/github/license/awes-io/demo.svg" alt="License" />
    </a>
    <a href="https://www.awes.io/?utm_source=github&amp;utm_medium=shields">
        <img src="https://img.shields.io/github/last-commit/awes-io/demo.svg" alt="Last commit" />
    </a>
    <a href="https://www.pkgkit.com/?utm_source=github&amp;utm_medium=shields">
        <img src="https://www.pkgkit.com/badges/hosted.svg" alt="Hosted by Package Kit" />
    </a>
    <a href="https://github.com/awes-io/demo">
        <img src="https://ga-beacon.appspot.com/UA-134431636-1/awes-io/demo" alt="Analytics" />
    </a>
</p>

<h1 align="center">Awes.io Demo</h1>

<p align="center">This is a build with demo functionality for an overview of features. For convenience, we've deployed this demo to our server. Follow the link to check it: <a href="https://demo.awes.io/?utm_source=github&amp;utm_medium=demo_link">Live Demo</a></p>


<p align="center">
    <a href="https://www.patreon.com/awesdotio" target="_blank">
        <img src="https://c5.patreon.com/external/logo/become_a_patron_button.png" alt="Become a Patreon">
    </a>
</p>

## 

<p align="center">
    <img src="https://static.awes.io/promo/illustration_1440x1030.png" alt="Awes.io">
</p>

## Live version
Follow to the [Demo](https://demo.awes.io/?utm_source=github&amp;utm_medium=demo_link) link.

## Quick Start `Docker`
💡 We recommend using [Docker](https://www.docker.com/). Inside, we've collected everything you need to work with this demo on your local machine.

**Here is a short guide:**
1. Clone the repository: `git clone git@github.com:awes-io/demo.git`
2. Go to the dirrectory: `cd ./demo`
3. Please run: `sh ./install.sh` - the script will ask about `keys` from [Package Kit](https://www.pkgkit.com)
4. You are ready! 🍺🍺🍺 [http://localhost:5080](http://localhost:5080) 

## Alternate Quick Start `Installer`

[Awes.io](https://www.awes.io) utilizes [Composer](https://getcomposer.org/) to manage its dependencies. So, before using [Awes.io](https://www.awes.io), make sure you have Composer installed on your machine.

#### Step 1
First, download the [Awes.io](https://www.awes.io) installer using Composer:
```bash
composer global require awes-io/installer
```

Make sure to place composer's system-wide vendor bin directory in your `$PATH` so the awes-io executable can be located by your system. This directory exists in different locations based on your operating system; however, some common locations include:

- macOS: `$HOME/.composer/vendor/bin`, command: `export PATH=~/.composer/vendor/bin:$PATH`
- GNU / Linux Distributions: `$HOME/.config/composer/vendor/bin`
- Windows: `%USERPROFILE%\AppData\Roaming\Composer\vendor\bin`

#### Step 2
Once installed, the `awes-io demo` command will create a demo installation in the directory you specify. For instance, `awes-io demo crm` will create a directory named `crm` containing a last version of [Demo Awes.io](https://demo.awes.io) installation with all of Awes.io's dependencies already installed:

```bash
awes-io demo crm
```

#### We've finished! 👏
You can open your local URL and try the demo!


## Alternate Manual installation
For the fast start, we recommend using [Docker](#quick-start-via-docker).
If for some reason it's not an option, please follow the this guide:

1. Clone the repository: `git clone git@github.com:awes-io/demo.git`
2. Create a project by the link on Package Kit: [https://www.pkgkit.com/awes-io/create](https://www.pkgkit.com/awes-io/create)
3. Copy project's API keys and save it to your `composer.json` and `.env` file
4. `composer install`


## License
The Laravel framework and Awes.io are open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
