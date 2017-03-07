# Extender Module

The Fulcrum Extender module - extending the PHP functionality for arrays and strings.

1. Array Module - making it easier to work with PHP arrays, especially deeply nested array.  It includes "dot" notation.
2. String Module - providing the missing PHP string functionality

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