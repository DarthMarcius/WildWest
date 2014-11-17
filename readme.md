#Project Install guide
##Install nodejs
Here is a [link](http://nodejs.org/download/) to download page.
*Try to use `npm` command from cmd if it fails try to manualy create "npm" folder in your User\AppData\Roaming it should help.*
##install Bower globally 
Here is a [link](http://bower.io/#install-bower) to install guide and docs basicaly just do
`npm install -g bower` 
in cmd.
##install gulp globally 
Here is a [link](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md) to install guide and docs just as in above step just do
`npm install --global gulp`

##install sass
Here is a [link](http://sass-lang.com/install) to install guide and docs, dont forget to install ruby before installing sass and mind that Windows 7 ruby installer can fail to add gem to System Path if it occurs please add it yourself
##Install the project
1. Install git you can download it from [here](http://git-scm.com/downloads)
2. Use git clone to copy our project top your PC if you did not use git before look [here](http://git-scm.com/downloads) for an example
3. Go to project public/js folder in cmd using `cd` command
4. Type `npm install` in cmd, **It will install gulp build system and all dependencies for it**
5. Type `bower install` in cmd, **it will install jquery, underscore, backbone and twitter bootstrap**

##Install dev tools 
1. Install [Chrome Canary](https://www.google.com/intl/en/chrome/browser/canary.html) (it will work correct with sass sourcemaps we have)
2. In Chrome install [LiveReload](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei?hl=en) plugin
3. Also you may want to install [cacheKiller](https://chrome.google.com/webstore/detail/cache-killer/jpfbieopdmepaolggioebjmedmclkbap?hl=en) plugin to use in combitation with Live reload

##Launch the working environment
1. In cmd go with `cd` to public/js and type `gulp` command
2. Open Chrome Canary and click Live reload plugin icon, white dot in the center of icon should get black
