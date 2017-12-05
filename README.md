# Extender Module

[![Build Status](https://travis-ci.org/wpfulcrum/extender.svg?branch=develop)](https://travis-ci.org/wpfulcrum/extender) [![Latest Stable Version](https://poser.pugx.org/wpfulcrum/extender/v/stable)](https://packagist.org/packages/wpfulcrum/extender) [![License](https://poser.pugx.org/wpfulcrum/extender/license)](https://packagist.org/packages/wpfulcrum/extender)

The Fulcrum Extender module - extending the PHP functionality for arrays and strings.

1. Array Module - making it easier to work with PHP arrays, especially deeply nested array.  It includes "dot" notation.
2. String Module - providing the missing PHP string functionality
3. WP MOdule - providing some missing WordPress functionality

## Array Module

Working with arrays is tedious, especially deeply nested arrays.  This module provides a handful of useful functions including borrowing from Laravel's "dot" notation.

### "Dot" Notation

Dot notation is a clever mechanism to access deeply nested arrays using a string of the keys separated by dots.  

For example, let's say you have a deeply nested array like this one:

```
$user = array(
	'user_id'   => 504,
	'name'      => 'Bob Jones',
	'social'    => array(
		'twitter' => '@bobjones',
	),
	'languages' => array(
		'php'        => array(
			'procedural' => true,
			'oop'        => false,
		),
		'javascript' => true,
		'ruby'       => false,
	),
);
```

To drill down to Bob's twitter handle, you'd pass `'social.twitter'` and to get to whether he likes OOP or procedural, you'd pass `'languages.php.oop'` or `'languages.php.procedural'`.

Check the documentation for the available array functions including: `array_add`, `array_has`, `array_set`, `array_get`, and more.  

## String Module

We often need functionality to test if a string has, starts with, or ends with a character or substring.  This module includes functionality for checking, converting, and truncating strings.

## WordPress Module

Often times, we need extra functionality to make our jobs easier.  This module adds functionality such as `is_post_page()`, `is_root_web_page()`, `get_url_relative_to_home_url()`, and many more.  Check for the wiki.
