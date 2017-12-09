# Extender Module

[![Build Status](https://travis-ci.org/wpfulcrum/extender.svg?branch=develop)](https://travis-ci.org/wpfulcrum/extender) 
[![Latest Stable Version](https://poser.pugx.org/wpfulcrum/extender/v/stable)](https://packagist.org/packages/wpfulcrum/extender) 
[![License](https://poser.pugx.org/wpfulcrum/extender/license)](https://packagist.org/packages/wpfulcrum/extender)

The Fulcrum Extender module - extending the PHP array, PHP strings, and WordPress functionality.

1. Array Module - making it easier to work with PHP arrays, especially deeply nested array.  It includes "dot" notation.
2. String Module - providing the missing PHP string functionality
3. WP Module - providing some missing WordPress functionality

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

>Credit: Taylor Otwell brought us "dot" notation in the [Laravel framework](https://laravel.com/).  Using his concept, Fulcrum adapts it to fit WordPress running on PHP 5.6 and up.

### Array Extender Functions

Each of these functions is documented in the [Wiki](https://github.com/wpfulcrum/extender/wiki/Array-API-Functionality).

<sup>*</sup> indicates this function works with "dot notation".

| - | - | - |
|---|---|---| 
| [`array_add`](https://github.com/wpfulcrum/extender/wiki/array_add)<sup>*</sup> | [`array_esc_attr`](https://github.com/wpfulcrum/extender/wiki/array_esc_attr) | [`array_exists`](https://github.com/wpfulcrum/extender/wiki/array_exists) | 
| [`array_flatten`](https://github.com/wpfulcrum/extender/wiki/array_flatten) | [`array_flatten_into_dots`](https://github.com/wpfulcrum/extender/wiki/array_flatten_into_dots)<sup>*</sup> | [`array_flatten_into_delimited_list`](https://github.com/wpfulcrum/extender/wiki/array_flatten_into_delimited_list) | 
| [`array_filter_with_keys`](https://github.com/wpfulcrum/extender/wiki/array_filter_with_keys) | [`array_get`](https://github.com/wpfulcrum/extender/wiki/array_get)<sup>*</sup> | [`array_get_except`](https://github.com/wpfulcrum/extender/wiki/array_get_except)<sup>*</sup> |
| [`array_get_first_element`](https://github.com/wpfulcrum/extender/wiki/array_get_first_element) | [`array_get_first_match`](https://github.com/wpfulcrum/extender/wiki/array_get_first_match) | [`array_get_last_match`](https://github.com/wpfulcrum/extender/wiki/array_get_last_match) |
| [`array_get_only`](https://github.com/wpfulcrum/extender/wiki/array_get_only)<sup>*</sup> | [`array_has`](https://github.com/wpfulcrum/extender/wiki/array_has)<sup>*</sup> | [`array_pluck`](https://github.com/wpfulcrum/extender/wiki/array_pluck)<sup>*</sup> |
| [`array_prepend`](https://github.com/wpfulcrum/extender/wiki/array_prepend) | [`array_pull`](https://github.com/wpfulcrum/extender/wiki/array_pull)<sup>*</sup> | [`array_remove`](https://github.com/wpfulcrum/extender/wiki/array_remove)<sup>*</sup> | 
| [`array_set`](https://github.com/wpfulcrum/extender/wiki/array_set)<sup>*</sup> | [`array_strip_tags`](https://github.com/wpfulcrum/extender/wiki/array_strip_tags) | [`array_trim`](https://github.com/wpfulcrum/extender/wiki/array_trim) |

## String Module

We often need functionality to test if a string has, starts with, or ends with a character or substring.  This module includes functionality for checking, converting, and truncating strings.

Each of these functions is documented in the [Wiki](https://github.com/wpfulcrum/extender/wiki/String-API-Functionality).

| - | - | - |
|---|---|---| 
| [`convert_to_ascii`](https://github.com/wpfulcrum/extender/wiki/convert_to_ascii) | [`convert_to_camel_case`](https://github.com/wpfulcrum/extender/wiki/convert_to_camel_case) | [`convert_to_lower_case`](https://github.com/wpfulcrum/extender/wiki/convert_to_lower_case) | 
| [`convert_to_snake_case`](https://github.com/wpfulcrum/extender/wiki/convert_to_snake_case) | [`convert_to_studly_case`](https://github.com/wpfulcrum/extender/wiki/convert_to_studly_case) | [`convert_to_underscore`](https://github.com/wpfulcrum/extender/wiki/convert_to_underscore) | 
| [`convert_to_upper_case`](https://github.com/wpfulcrum/extender/wiki/convert_to_upper_case) |  [`get_substr`](https://github.com/wpfulcrum/extender/wiki/get_substr) | [`str_ends_with`](https://github.com/wpfulcrum/extender/wiki/str_ends_with) | 
| [`str_matches_pattern`](https://github.com/wpfulcrum/extender/wiki/str_matches_pattern) |[`str_starts_with`](https://github.com/wpfulcrum/extender/wiki/str_starts_with) |  [`truncate_by_characters`](https://github.com/wpfulcrum/extender/wiki/truncate_by_characters) | 
| [`truncate_by_words`](https://github.com/wpfulcrum/extender/wiki/truncate_by_words) |


## WordPress Module

We often need extra functionality to make our jobs easier when working with WordPress.  This module adds functionality for checking, getting, and preparing.

Each of these functions is documented in the [Wiki](https://github.com/wpfulcrum/extender/wiki/WP-Functionality).

| - | - | - |
|---|---|---| 
| [`do_harder_rewrite_rules_flush`](https://github.com/wpfulcrum/extender/wiki/do_harder_rewrite_rules_flush) | [`do_hard_get_option`](https://github.com/wpfulcrum/extender/wiki/do_hard_get_option) | [`extract_post_id`](https://github.com/wpfulcrum/extender/wiki/extract_post_id) | 
| [`fulcrum_declare_plugin_constants`](https://github.com/wpfulcrum/extender/wiki/fulcrum_declare_plugin_constants) | [`fulcrum_get_plugin_url`](https://github.com/wpfulcrum/extender/wiki/fulcrum_get_plugin_url) | [`get_all_custom_post_types`](https://github.com/wpfulcrum/extender/wiki/get_all_custom_post_types) | 
| [`get_all_supports_for_post_type`](https://github.com/wpfulcrum/extender/wiki/get_all_supports_for_post_type) | [`get_current_web_page_id`](https://github.com/wpfulcrum/extender/wiki/get_current_web_page_id) | [`get_joined_list_of_terms`](https://github.com/wpfulcrum/extender/wiki/get_joined_list_of_terms) | 
| [`get_number_of_children_for_post`](https://github.com/wpfulcrum/extender/wiki/get_number_of_children_for_post) | [`get_next_parent_post`](https://github.com/wpfulcrum/extender/wiki/get_next_parent_post) | [`get_previous_parent_post`](https://github.com/wpfulcrum/extender/wiki/get_previous_parent_post) | 
| [`get_post_id`](https://github.com/wpfulcrum/extender/wiki/get_post_id) | [`get_post_id_when_in_backend`](https://github.com/wpfulcrum/extender/wiki/get_post_id_when_in_backend) | [`get_terms_by_post_type`](https://github.com/wpfulcrum/extender/wiki/get_terms_by_post_type) |
| [`get_url_relative_to_home_url`](https://github.com/wpfulcrum/extender/wiki/get_url_relative_to_home_url) |  [`prepare_array_for_sql_where_in`](https://github.com/wpfulcrum/extender/wiki/prepare_array_for_sql_where_in) | [`post_has_children`](https://github.com/wpfulcrum/extender/wiki/post_has_children) | 
| [`is_child_post`](https://github.com/wpfulcrum/extender/wiki/is_child_post) | [`is_parent_post`](https://github.com/wpfulcrum/extender/wiki/is_parent_post) | [`is_posts_page`](https://github.com/wpfulcrum/extender/wiki/is_posts_page) | 
| [`is_root_web_page`](https://github.com/wpfulcrum/extender/wiki/is_root_web_page) | [`is_static_front_page`](https://github.com/wpfulcrum/extender/wiki/is_static_front_page) | 

## Contributing

All feedback, bug reports, and pull requests are welcome.
