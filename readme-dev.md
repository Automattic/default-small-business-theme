## Directory structure

- **build/** » The build files are placed here.
- **docs** » Documentation on how to use the build system.
- **stylesheets** » Contains all the Sass stylesheets.
- **tools** » Contains build system scripts.
- **excludes.rsync** » Files to exclude from build.
- **Gruntfile.js** » Grunt configuration.
- **Makefile** » Build makefile.
- **package-lock.json** » Node.js dependency lock file.
- **package.json** » Node.js dependencies.
- **readme.md** » The document you are currently reading.
- **readme.txt** » Readme for the theme.
- **rtl.scss** » RTL Stylesheet.
- **style.scss** » Theme Stylesheet. Main entry point for Sass styles.

## Usage & Installation

Install dependencies:

```$ make deps```

Build project:

```$ make build```

Watch files for changes:

```$ make dev```

Build CSS4 Variables:

```$ make css-vars```

> Have in mind that building the CSS4 vars is a build-only process. It does not work when watching files for changes.

Build release (final theme build):

```$ make theme```

The release files will be created inside the `build/` directory.
The ZIP file created will be the installable WordPress theme.

## Using the Manifest file

The **manifest.json** file contains the files that the build system will expect in your final theme's ZIP file. This is a good way to make sure the release is built **only** if it contains the files listed in the manifest.

If a file is missing from the build, but present in the manifest, an error will be raised when building the release.

If a file is pressent in the build, but not in the manifest, an error will be raised when building the release.
