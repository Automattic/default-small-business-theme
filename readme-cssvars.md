# CSS Variables Framework – README

When using the `sass-variables` post-processing tool, it is good to have in mind the following DO's and DON'Ts:

- - -

**DO NOT** specify property values containing CSS4 variables in multiple lines:

```css
.box-shadow: 0 0 0 $x-box-shadow-color inset,
             0 0 10px $x-box-shadow-color inset;
```

**DO** specify property values in a single line:

```css
.box-shadow: 0 0 0 $x-box-shadow-color inset, 0 0 10px $x-box-shadow-color inset;
```

Having the property values in a single line, makes it easier for the variable replacements and the fallback generation. At this moment, the `sass-variables` parser only supports single line property values.

- - -

**DO NOT** add CSS variable overrides on blocks:

```css
body {
  --font-size-base: 45px;
}
```

**DO** add property overrides instead:

```css
body {
  font-size: 45px;
 }
```

If CSS variable overrides are added, it will not add a fallback and the results may vary from the development (`make dev` or `make`) versions and the final builds (`make theme` or `make css-vars`).
