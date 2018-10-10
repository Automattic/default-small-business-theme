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

