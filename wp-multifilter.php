<?php
/**
 * WP MultiFilter
 * Description: Allows you to attach an anonymous function to multiple actions or filters (WordPress helper plugin)
 * Version: 2015.01.19
 * Author: khromov
 */

/**
 * Add multiple filters to a closure
 *
 * @param $tags
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 *
 * @return bool true
 */
function add_filters($tags, $function_to_add, $priority = 10, $accepted_args = 1)
{
  //If the filter names are not an array, create an array containing one item
  if(!is_array($tags))
    $tags = array($tags);

  //For each filter name
  foreach($tags as $index => $tag)
    add_filter($tag, $function_to_add, (int)(is_array($priority) ? $priority[$index] : $priority), (int)(is_array($accepted_args) ? $accepted_args[$index] : $accepted_args));

  return true;
}

/**
 * Add multiple actions to a closure
 *
 * @param $tags
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 *
 * @return bool true
 */
function add_actions($tags, $function_to_add, $priority = 10, $accepted_args = 1)
{
  //add_action() is just a wrapper around add_filter(), so we do the same
  return add_filters($tags, $function_to_add, $priority, $accepted_args);
}
