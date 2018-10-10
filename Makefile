
CSS_VAR_PREFIX="x"

PKG="default-small-business-theme"

default: build

check-for-grunt:
	@if [ ! -f /usr/local/bin/grunt ]; then echo -e "\nGrunt CLI is not installed. Install it with sudo npm install -g grunt\n"; exit 1; fi

deps: check-for-grunt
	@npm install

clean:
	@rm -Rf build vars-build.*
	@rm -f style.css editor.css rtl.css css/blocks.css
	
clean-vars:
	@rm -f *-vars.scss *-vars.css css/*-vars.scss css/*-vars.css

build: clean check-for-grunt
	@grunt build
	
dev: clean check-for-grunt
	@grunt build && grunt watch
	
css-vars: clean-vars
	@node tools/sass-variables.js --prefix=${CSS_VAR_PREFIX} style.scss --output style-css-vars.scss
	@node tools/sass-variables.js --prefix=${CSS_VAR_PREFIX} --root-selector=".edit-post-visual-editor" editor.scss --output editor-css-vars.scss
	@node tools/sass-variables.js --prefix=${CSS_VAR_PREFIX} --skip-root css/blocks.scss --output css/blocks-css-vars.scss
	@grunt build > /dev/null
	@make clean-vars

theme: clean
	@echo "* Initializing build"; mkdir -p build
	@echo "* Building assets"; make css-vars
	@echo "* Copying assets"; rsync -a . build/ --exclude-from=excludes.rsync
	@echo "* Integrity check"; node tools/buildtool.js --check --path build/
	@echo "* Zipping"; mv build ${PKG}; mkdir build; zip -mqr build/${PKG}.zip ${PKG}; cd build/; unzip -qq ${PKG}.zip

.PHONY: build
