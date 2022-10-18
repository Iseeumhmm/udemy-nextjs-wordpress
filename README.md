# Boilerplate

This project uses the [WordPress Boilerplate](https://bitbucket.publishing.tools/projects/WP/repos/wp-bedrock-boilerplate/browse) which is built upon the [Bedrock Framework](https://roots.io/bedrock/). This allows us to use development tools like Composer to manage plugins, leverage Git to properly version control a WordPress website and throw in our own mix of automated processes for a better development experience.

## Table of Contents

<!-- Created with https://ecotrust-canada.github.io/markdown-toc/ -->

- [Requirements](#requirements)
  - [Software](#software)
  - [VS Code Extensions](#vs-code-extensions)
    - [Automatic installation](#automatic-installation)
    - [Manual installation](#manual-installation)
- [Getting Started](#getting-started)
  - [Creating the Environment](#creating-the-environment)
  - [Working with Hatchery](#working-with-hatchery)
    - [Start the Website](#start-the-website)
    - [Stop the Website](#stop-the-website)
    - [Use WP-CLI](#use-wp-cli)
    - [Import a new copy of the Production Database](#import-a-new-copy-of-the-production-database)
    - [Import newest assets from Production](#import-newest-assets-from-production)
- [Starting Development](#starting-development)
  - [Managing Dependencies](#managing-dependencies)
- [WordPress Plugins](#wordpress-plugins)
  - [Composer Vendors](#composer-vendors)
  - [Installing / Updating Plugins](#installing---updating-plugins)
  - [Creating Custom Plugins](#creating-custom-plugins)
  - [WordPress Plugins We Use](#wordpress-plugins-we-use)
    - [Advanced Custom Fields](#advanced-custom-fields)
    - [Gambling Ads](#gambling-ads)
    - [Query Monitor](#query-monitor)
- [Workflow Good Practices](#workflow-good-practices)
  - [Git](#git)
    - [Compiled Assets](#compiled-assets)
  - [Linting](#linting)
  - [Pre-commit Hooks](#pre-commit-hooks)
  - [SCSS](#scss)
    - [BEM Methodology](#bem-methodology)
  - [Javascript](#javascript)
  - [Timber/TWIG](#timber-twig)
  - [ACF Field Groups](#acf-field-groups)
  - [Creating Components](#creating-components)
  - [Creating Templates](#creating-templates)
  - [Creating Block](#creating-blocks)
  - [Geo Locations](#geo-locations)
  - [Enqueue Js/Css](#enqueue-js-css)
    - [Manifest File](#manifest-file)
    - [ResourcesManager](#resourcesmanager)
- [Maker Commands](#maker-commands)
  - [Make Block](#make-block)
  - [Make Component](#make-component)
  - [Make Template](#make-template)
  - [Make Single](#make-single)
  - [Make Twig Extension](#make-twig-extension)
  - [Make postType](#make-posttype)
- [Finishing Your Work](#finishing-your-work)
- [Hatchery and Boilerplate Folder Structure](#hatchery-and-boilerplate-folder-structure)
  - [Suggesting Updates to Resulta Plugins](#suggesting-updates-to-resulta-plugins)
- [Boilerplate Improvements](#boilerplate-improvements)
- [Further Reading](#further-reading)
  - [Confluence Documentation](#confluence-documentation)
  - [Hatchery Documentation](#hatchery-documentation)
  - [VsCode Documentation](#vscode-documentation)
  - [Official Documentation](#official-documentation)

## Requirements

Before editing this WordPress website your computer will require the following software installed.

### Software

- VS Code - [Install](https://code.visualstudio.com)
- Git [Install](https://git-scm.com/downloads)
- Hatchery - [Install](https://bitbucket.publishing.tools/projects/WTI/repos/hatchery/browse)
- AWS VPN Connected

### VS Code Extensions

#### Automatic installation

For the Extensions to be installed automatically, you must install VsCode's Command Cli [Adding Command Cli to VS Code](https://code.visualstudio.com/docs/setup/mac#_launching-from-the-command-line)

During the installation the necessary extensions will be installed automatically.

**Important**: If the extensions are already installed but deactivated then you have to activate them manually

#### Manual installation

[Adding extensions to VS Code](https://code.visualstudio.com/docs/editor/extension-marketplace) is super easy. Included is a search term to use because there are times where an extension may have a very similar name.

- [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint) (Search: dbaeumer.vscode-eslint)
- [Prettier](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint) (Search: esbenp.prettier-vscode)
- [stylelint](https://marketplace.visualstudio.com/items?itemName=stylelint.vscode-stylelint) (Search: stylelint.vscode-stylelint)
- [phpcs](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs) (Search: ikappas.phpcs)
- [markdownlint](https://marketplace.visualstudio.com/items?itemName=davidanson.vscode-markdownlint) (Search: davidanson.vscode-markdownlint)
- [Save and Run](https://marketplace.visualstudio.com/items?itemName=wk-j.save-and-run) (Search: wk-j.save-and-run)
- [Twig](https://marketplace.visualstudio.com/items?itemName=whatwedo.twig) (Search: whatwedo.twig)
- [XDebug](https://marketplace.visualstudio.com/items?itemName=xdebug.php-debug) (Search: xdebug.php-debug)
- [Remote Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) (Search: ms-vscode-remote.remote-containers)

_Tip: When opening the project a notification will appear at the bottom right of the screen. Pressing the "Install All" button will install and activate all the recommendations. Pressing the "Show Recommendations" will allow you to review the extensions before installing._

## Getting Started

To edit this WordPress website you'll need a local development environment setup. We'll use a system named _Hatchery_ to do this.

First lets learn some terms that will be commonly used throughout this readme:

- **Hatchery**: A local development environment that uses Docker that runs NGINX, PHP and MySQL containers.
- **Aquarium**: A system that will automatically launch the WordPress website, and build all assets.
- **Boilerplate**: A starter Wordpress theme using Node.js and Composer to facilitate development.

### Creating the Environment

Using _Hatchery 2_ we can get a development environment that matches production with just a single command.

1. Clone the site repo locally:
   `git clone ssh://git@bitbucket.publishing.tools:7999/wp/wp-bedrock-boilerplate.git boilerplate`
2. Inside the newly created directory, start the development environment:
   `hatchery build`
   - You will be prompted a name for the Wordpress theme.  
     If you skip this step you can always run `hatchery npm run setup-theme --themename=yourthemenamehere` later.

Once the setup is complete the local development URL and login details will be displayed in the terminal.

**Important**: Website development will be done inside the `data/site` directory. This is where you'll open VS Code and run all development Commands.

#### Use WP-CLI

[WP-CLI commands](https://developer.wordpress.org/cli/commands/) can be used here, just prepend `hatchery` to any `wp` command.

## Starting Development

At this point your local development server is running (Hatchery). We can start development by opening the `data/site` (our project root) directory in VS Code.

To begin development you'll run the following command:

```bash
hatchery npm run dev
```

This will run Webpack in watch mode. Any changes to SCSS, JS or Twig files will be built on the fly without running any additional commands. These files will be unminified to easily debug any potential problems.

You can also run `hatchery npm run build` which will compile and minify all files. This will be a closer match to the production environment.

Note: you can also run `hatchery build` which is a shorthand for `hatchery npm run build`.

**Tip:** VS Code has a built in Terminal where this command can be run, so you can watch the process as you develop. Go to _Terminal → New Terminal_.

### Managing Dependencies

If your latest pull updates the `composer.(json|lock)` (Composer) or `package.(json|lock)` (Node.js) files then you'll want to run the `hatchery build` command again.

```bash
hatchery build
```

This command will download and install the updated dependencies like **WordPress**, **WordPress Plugins**, and other development dependencies that have been updated.

**It's important that you're AWS VPN is connected while installing plugins.**

## WordPress Plugins

The WordPress Boilerplate has been setup to install WordPress Plugins using Composer. This means all plugins are managed using the command line. This is very beneficial because plugins will not be merged into the Git repository which is less likely to cause merge conflicts.

### Composer Vendors

Composer uses a vendor prefix to know where the plugin is stored. Resulta built plugins may use _chalk_ or _resulta_ as their vendor. WordPress plugins from the [WordPress Plugin Directory](https://wordpress.org/plugins/) will always use the vendor _wpackagist-plugin_.

### Installing / Updating Plugins

Installing or updating the version of a plugin can be done with the Composer require command at the root of this project:

```bash
hatchery composer require vendor/package:version
```

For example the [Akismet](https://en-ca.wordpress.org/plugins/akismet/) plugin can be installed with the command below:

```bash
hatchery composer require wpackagist-plugin/akismet:4.1.9
```

To update the plugin we can run the same command, with a change to the version number:

```bash
hatchery composer require wpackagist-plugin/akismet:4.1.10
```

This will update the `composer.json` and `composer.lock` files. These composer files will be pushed to the Git repository. By not storing plugin code inside the Git repository of the project there will be no opportunity for merge conflicts during plugin updates.

When installing or updating Resulta plugins explicit version numbers must be use. Example: `hatchery composer require resulta/resulta-schema:1.4.0`. Using adding publicly available plugins use the caret version range. Example: `hatchery composer require wpackagist-plugin/redirection:^4.8`

Read More: [Composer Best Practices](https://confluence.publishing.tools/display/WT/Composer+Best+Practices)

### Creating Custom Plugins

There could be times when you're asked to add the same functionality across multiple websites. Typically work like this could be a great candidate for a WordPress plugin. Get in touch with your team lead regarding this then follow the process of [adding a plugin to the private packagist for composer](https://confluence.publishing.tools/display/WT/Adding+a+Plugin+to+private+packagist+for+composer).

### WordPress Plugins We Use

Across all of our websites we commonly use these plugins.

- Advanced Custom Fields - [Documentation](https://www.advancedcustomfields.com/resources/)
- Yoast SEO - [Documentation](https://developer.yoast.com)
- Gambling Ads - [Documentation](https://bitbucket.publishing.tools/projects/CHCM/repos/gambling-ads/browse)
- Timber Library - [Documentation](https://github.com/timber/timber/)
- Resulta Schema - [Documentation](https://bitbucket.publishing.tools/projects/CHCM/repos/resulta-schema/browse)
- Image Compression - [Documentation](https://bitbucket.publishing.tools/projects/CHCM/repos/image-compression/browse)
- Query Monitor - [Documentation](https://en-ca.wordpress.org/plugins/query-monitor/)

#### Advanced Custom Fields

When an update is made to a ACF field group's json file, make sure that the "modified" property exists and the timestamp is larger than the current value. This will ensure the acf sync option for the ACF field group in `WP Dashboard → Custom Fields`.

[Read More](https://www.advancedcustomfields.com/resources/)

#### Gambling Ads

This plugin controls the CTA Table for our affiliates. Typically these tables will be found throughout the website displaying various providers like casinos.

[Read More](https://bitbucket.publishing.tools/projects/CHCM/repos/gambling-ads/browse)

#### Query Monitor

Query Monitor is the developer tools panel for WordPress. It enables debugging of database queries, PHP errors, hooks and actions, block editor blocks, enqueued scripts and stylesheets, HTTP API calls, and more.

When activated a new item will be added to the WordPress Admin Bar. When clicked a new modal will appear at the bottom of the screen where you can interact with Query Monitor.

[Read More](https://en-ca.wordpress.org/plugins/query-monitor/)

## Workflow Good Practices

### Git

This project is versioned using [BitBucket](https://bitbucket.publishing.tools), which is an Git server. Git is a powerful tool that allows many developers to work on a single project without fear of affecting others work.

Typically when starting work on a ticket you will want to run the `git pull` command at the root of the project. This will pull the latest work from the Git server, and any newly created branches. Then you will switch to a branch using `git checkout feature/your-branch` to start work.

Git is one piece of the puzzle of how the overall workflow for this project is managed. The latest details can be found here: [Working ticket on our Jira boards](https://confluence.publishing.tools/display/DEVDEPT/Working+on+tickets+on+our+Jira+boards).

#### Compiled Assets

Storing compile assets like CSS and JS inside a Git repository can be very problematic because of merge conflicts. This is why all assets stored inside the `public` directory are not moved into Git.

More information about this problem can be found here: [Why We Shouldn't Commit Our Compiled Assets to Git](https://confluence.publishing.tools/display/DEVDEPT/Why+We+Shouldn%27t+Commit+Our+Compiled+Assets+to+Git).

### Linting

When working on the website its expected that you will follow strict coding standards. This includes formatting. Code linting has been setup project wide. With the help of VS Code extensions we can ensure all developers who work on a project will maintain the same formatting throughout the projects life.

Using the VS Code extensions above will ensure that as you are developing suggestions and hints will be displayed on the screen. These suggestions will be shown as you type, or on save depending on the language.

### Pre-commit Hooks

To ensure all linting standards are being followed, before a commit is accepted it must pass formatting checks with a [pre-commit hook](https://www.atlassian.com/git/tutorials/git-hooks).

When you run the `git commit` command the following will be checked:

- PHP files using `phpcs`
- TWIG files using `twigcs`
- Javascript files using `eslint`
- SCSS files using `stylelint`

If any of these tasks fail, you will be given an opportunity to have the problems automatically fixed. If there are too many problems, it may fail and you'll need to fix them manually before the commit will be accepted.

When converting existing sites to use this boilerplate, we've sometimes seen a large number of stylesheet linting errors. If this is the case, try adding the line `"no-descending-specificity": null` in the `.stylelintrc` file's `"rules"` object, as this may resolve some errors.

### SCSS

This project closely follows the [Airbnb CSS / Scss Styleguide](https://github.com/airbnb/css). With the use of linting VS Code and Pre-commit hooks will automatically force the formatting or alert you of any problems.

The theme is broken out into Components, Templates and Utils (Global). When adding SCSS to the theme ensure you are adding to the correct place. For example, if the update is for the LatestNews component, then the SCSS will be added to the `Components/LatestNews/LatestNews.scss` file.

[Read More](https://confluence.publishing.tools/pages/viewpage.action?pageId=58803155)

#### BEM Methodology

All class names are to be formatted as BEM (Block-Element-Modifier). This is an effective and popular way of naming and thinking about HTML entities.

For example, the class name `photo__caption--large` indicates a code block named “photo” with a child element named “caption”, and a modifier of “large”. This naming makes the nature of the entity quite clear.

Complete documentation and more examples can be found here: [BEM Methodology Reference](https://confluence.publishing.tools/pages/viewpage.action?pageId=65145359)

### Creating Components

**You can generate a component easily with a command** : [Make Component](#make-component)

Components are small and reusable bits of code which can be used inside Templates or other Components. Splitting your code in components is a good way to reduce duplication, simplify the code and maintenance.

To create your own component simply create a new folder inside `themes/[themename]/Components` directory and add any of `.twig`/`.js`/`.scss`/`.json`/`.php`. There is no automation regarding these files except for ACF `.json` files, meaning unless you import them somewhere in the site they wont be used.

It is a convention to name these files the same as the folder, but you can divert from that if you need to have multiple files. For example if you need to have 2 Twig files you could create `Components/MegaTable/MegaTable.twig` and `Components/MegaTable/MegaTableVariant.twig`.

Note that the component's `.js` and `.scss` files are not being built as standalone files, you need to import them in a template or in another component that is being imported in a template in order to merge their code in.

#### Twig

Components usually are made of a [Twig macro](https://twig.symfony.com/doc/3.x/tags/macro.html). Macros are basically just like PHP functions, you declare it this way:

```twig
{% macro HelloComponent(props) %}
  <div class="hello">
    Hello {{ props.name }}
  </div>
{% endmacro %}
```

And then when you want to use it you just need to import it first:

```twig
{% from '@Components/HelloComponent/HelloComponent.twig' import HelloComponent %}
```

And then call it anywhere after:

```twig
{{
  HelloComponent({
    name: ''
  })
}}
```

Note: you can pass any number of parameter to your macros, it is only a convention for our components to have 1 parameter being an object, `props`, so it's very convenient to use because we can pass it any pair of key-values without changing the signature of the macro.

#### Javascript

Components usually are made of a class that is the default export of the file:

```javascript
class HelloComponent {
  constructor(element) {
    this.element = element;

    if (!this.element) {
      this.element = document.querySelector("hello");
    }

    if (!this.element) {
      return;
    }

    // Do stuff with this.element
    // ...
  }
}
export default HelloComponent;
```

And then when you want to use it you just need to import it first:

```javascript
import HelloComponent from "@Components/HelloComponent/HelloComponent";
```

And then call it anywhere after:

```javascript
new HelloComponent();
```

#### SCSS

Components usually are made with all variables at the top of the file and then all css is wrapped in the main class:

```scss
$hello-padding: 1rem;
$hello-color: $color-primary;

.hello {
  color: $hello-color;
  padding: $hello-padding;
}
```

Note how in this example we set the component's `$hello-color` variable with `$color-primary` which is a global variable in the project.

### Creating Templates

**You can generate a template easily with a command** : [Make Template](#make-template)

To create your own template simply create a new folder inside `themes/[themename]/Templates` directory and add any of `.twig`/`.js`/`.scss`/`.json`.

You'll also need to create the corresponding `.php` file at the root of the theme, as it is the convention with Wordpress. In this file you can do anything you want, and at the bottom of it you will need to call the Timber render function to render the right Twig file.

For example for the general page template, the php file is `themes/[themename]/page.php`, and all related files are in `themes/[themename]/Templates/Page`.

It is a convention to name these files the same as the folder. Naming is important here as there are automations in place which rely on naming.

When you run the build command, the `.js` and `.scss` files are being processed and built under `themes/[themename]/public`. Then when navigating on the site, `.js` and `.css` files corresponding to the displayed Twig template will be automatically enqueued. For this to work those files have to be named the same as the template.

For example: `themes/[themename]/Templates/Page/Page.scss` will be built to `themes/[themename]/public/css/page.css`. When navigating on a page that uses `page.php` file which renders `Page.twig`, then `page.css` and `page.js` will be automatically enqueued if they exist.

### Creating Blocks

**You can generate a block easily with a command** : [Make Block](#make-block)

Blocks are hybrids of Components and Templates. Like Components they are meant to be reusable, and unlike Components but like Templates their `.scss` and `.js` files are being built as standalone files under `themes/[themename]/public`.

This is useful especially for sections. Sections are added to pages dynamically, from the admin. So one page could use 1 type of section while another could use all types. Instead of merging all sections CSS and JS in the template, resulting in a giant template CSS and JS file with lots of code not necessarily used, the Blocks approach is to enqueue the sections CSS and JS only of the sections being displayed in the page.

For the auto enqueue to work the naming convention has to be followed, just like Templates.

### ACF

ACF group files can live in 4 different locations, `AcfFieldGroups/`, `Blocks/SomeBlock/`, `Components/SomeComponent/` and `Templates/SomeTemplate/`. Wether you place them all under `AcfFieldGroups/` or in the corresponding component/block/template will make no difference in their execution, it is only a matter of file organization.

The naming convention for ACF files is to have them starting with `group_` followed by the name of the component/block/template it applies to. For example: `Page/group_page.json`. ACF will only read files that start with `group_`

### Geo Locations

When a visitor visits the website a cookie of `geo_code` will be added to the browser. This cookie can be used to determine the location of the user.

### Enqueue Js/Css

#### Manifest File

This repository uses a manifest.json to add a hash to the name of the files built by webpack. so we can't use the file name to query the file because at each build the hash changes.

example of manifest file :

```json
{
  "ContentSection.css": "css/ContentSection.25b68c0e7568a9158046fcb4197269ea.css",
  "GamblingTableSection.css": "css/GamblingTableSection.cc8ae6ce1abb028ee25a048506f3d84e.css",
  "Archive.css": "css/Archive.d933d6626d83431f35b33a84069898a6.css",
  "Archive.js": "js/Archive.d933d6626d83431f35b33a84069898a6.js",
  "Author.css": "css/Author.c2823eb3cd3246417c2639b4e9ea017a.css",
  etc...
 }
```

#### ResourcesManager

This class allows to retrieve the manifest.json file and contains methode to return the relative url and the relative path to the right file.

example of use :

```php

<?php

namespace YOUR_NAMESPACE;

use YOUR_NAMESPACE\Utils\ResourcesManager;

// Get relative url and relative path
$cssFileUrl = ResourcesManager::getFileUrlByManifest("BoilerplateLayout.css");
$cssFilePath = ResourcesManager::getFilePathByManifest("BoilerplateLayout.css");

// enqueue style and script
wp_enqueue_style(
    "BoilerplateLayout-style",
    ResourcesManager::getFileUrlByManifest("BoilerplateLayout.css"),
    array(),
    filemtime(ResourcesManager::getFilePathByManifest("BoilerplateLayoutAMP.css")),
    'all'
);

wp_enqueue_script(
    "BoilerplateLayout-js",
    ResourcesManager::getFileUrlByManifest("BoilerplateLayout.js"),
    array(),
    filemtime(ResourcesManager::getFilePathByManifest("BoilerplateLayout.js")),
    true
);
```

## Maker Commands

Maker Commands is a set of commands that makes it easy to integrate new features using the wp-cli plugin that helps you, through a set of questions, to create the code base for you.

### Make Block

Allows you to create all the necessary files for a new block

```bash
hatchery wp make block
```

### Make Component

Allows you to create all the necessary files for a new component

```bash
hatchery wp make component
```

### Make Template

Create all the files needed for a new template

```bash
hatchery wp make template
```

### Make Single

Create all the necessary files for a new single

```bash
hatchery wp make single
```

### Make Twig Extension

Creates all the files needed for a new twig extension

```bash
hatchery wp make twig-extension
```

### Make PostType

Creates all the files needed for a new custom post type

```bash
hatchery wp make post-type
```

## Finishing Your Work

Once finished your ticket, you'll want to create a Pull Request so the work you've done can be eventually merged into the production website.

Before creating a PR (Pull Request) confirm your changes work across all browsers, doesn't introduce new errors and that all acceptance criteria is met. Please follow [Definition of Done](https://confluence.publishing.tools/display/DEVDEPT/Definition+of+Done) document as a good guideline.

Please follow the [WP Pull Request Standards](https://confluence.publishing.tools/display/DEVDEPT/Peer+Review+and+Pull+Request+Standards) when creating a PR.

## Boilerplate Folder Structure

Below is a list of files and directories that are included with the Boilerplate. These are the more common files, there are others which have been omitted which should not be updated or used.

```bash
├── composer.json                # → Manage versions of WordPress, plugins & dependencies
├── Dockerfile                   # → Instructions for Docker to use for setup
├── package.json                 # → Manage versions of development tools
├── /config                      # → WordPress configuration files
│   ├── application.php          # → Primary WP config file (wp-config.php equivalent)
│   └── /environments            # → Environment specific configs
│       ├── development.php      # → Development config (local development uses this config)
│       └── staging.php          # → Staging config
├── /vendor                      # → Composer packages (never edit)
└── /web                         # → Web root (document root on your webserver)
├── /app                     # → wp-content equivalent
│   ├── /mu-plugins          # → Must use plugins
│   ├── /plugins             # → Plugins
│   ├── /themes              # → Themes
│   │   ├── /Assets          # → Assets Files
│   │   │   ├── /Fonts       # → All fonts used for the site
│   │   │   ├── /Images      # → All Images static used for the site
│   │   │   ├── /Scss        # → Extras file scss
│   │   ├── /Blocks          # → Blocks are small parts HTML that can be used for form a template.
│   │   ├── /Components      # → Components are small parts HTML that can be used for form a template.
│   │   ├── /public          # → All public builder files by webpack
│   │   ├── /Skeletons       # → Folder containing all the Skeleton files needed for the make commands
│   │   ├── /Templates       # → Folder containing template and single without php files
│   │   ├── /Utils           # → Folder containing the classes useful for the operation of the site
│   │   ├── cta-table.php    # → File to use for the "GamblingAds" plugin shortcode
│   │   ├── style.css        # → Css file not used to add the theme to wordpress
│   └── /uploads             # → Uploads
├── wp-config.php            # → Required by WP (never edit)
├── index.php                # → WordPress view bootstrapper
└── /wp                      # → WordPress core (never edit)
```

### Suggesting Updates to Resulta Plugins

While working with a plugin you could find a problem or a requirement for some other feature. We've setup a whole process on how to Update Resulta built plugins, which can be found here: [WP Plugin (resulta-built) Update Process (DTI Board Process)](https://confluence.publishing.tools/pages/viewpage.action?pageId=50000833)

## Boilerplate Improvements

While creating/updating a site you may spot areas that can be improved in the boilerplate. Discuss with your team then create a ticket in the [DTI](https://jira.publishing.tools/projects/DTI/) board with all the details.

### Important

In order to commit modifications to this repo there are a few things to remember:

- The site needs to be running by running `hatchery build` or if site's already been built, `hatchery start`.
- The boilerplate uses placeholders like `NAMESPACE` and `THEME_NAME` that get replaced on setup
- The theme's folder is named `custom` but gets renamed on setup
- The boilerplate prevents commits that don't comply with all set rules

You might need to run the theme renaming setup in order to build assets.

Because of these features, if you try to setup the repo and choose a theme name other than `custom`, you will see 300+ changes due to the "moving" of all files and **you have to make sure you don't commit anything at this point**.

If you choose `custom` however the folder will actually be renamed `Custom` but git/mac seem to fail seeing this change and you will only see the placeholders replaced as changes. **You still have to make sure you don't commit those changes and keep the placeholders in the boilerplate**.

Then in this situation, after you stage your changes, when you will try to commit you will face a fail of the pre-commit script. What happens is that git provides all staged files paths to the script with `custom` instead of `Custom` (since there is no difference between the two according to it) and the script then fails to find the files because this one does see the difference between `custom` and `Custom`.  
In order to pass the pre-commit script you have to comment the `set -e` instruction found at the top of the script. This line makes sure the script stops if there is an error. The script is found in `data/site/.git/hooks`.

If you don't need to run the theme renaming setup things are straightforward.

## Further Reading

### Confluence Documentation

- [Bedrock Documentation](https://roots.io/docs/bedrock/master/composer/)
- [Bedrock Directory Structure](https://confluence.publishing.tools/pages/viewpage.action?pageId=43516838)
- [Git Standards](https://chris.beams.io/posts/git-commit/)
- [Atomic Commits](https://www.freshconsulting.com/atomic-commits/)

### Hatchery Documentation

- [Setting up an AQ site to work on locally aka Hatchery](https://confluence.publishing.tools/display/DEVDEPT/Bedrock+Boilerplate+Requirements#BedrockBoilerplateRequirements-Documentation)
- [Converting WP site to use Aquarium](https://confluence.publishing.tools/display/DDP/Converting+WP+site+to+use+Aquarium)

### VsCode Documentation

- [Command Line Interface (CLI)](https://code.visualstudio.com/docs/editor/command-line)
- [Extension Marketplace](https://code.visualstudio.com/docs/editor/extension-marketplace)

### Official Documentation

- [Timber for Wordpress](https://timber.github.io/docs/)
- [Twig](https://twig.symfony.com/doc/2.x/)
- [Bedrock](https://roots.io/docs/bedrock/master/composer/)
- [Webpack](https://webpack.js.org/concepts/)
- [Git](https://git-scm.com/docs)
- [npm](https://docs.npmjs.com/)
- [Composer](https://getcomposer.org/doc/)
