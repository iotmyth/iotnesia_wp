<?php
/**
 * Vikinger GamiPress POINT functions
 * 
 * @since 1.0.0
 */

/**
 * Get point types
 * 
 * @return array
 */
function vikinger_gamipress_get_point_types() {
  $gm_point_types = gamipress_get_points_types();
  $point_types = [];

  foreach ($gm_point_types as $key => $value) {
    $point_types[$key] = [
      'id'            => $value['ID'],
      'singular_name' => $value['singular_name'],
      'plural_name'   => $value['plural_name'],
      'slug'          => $key,
      'image_url'     => vikinger_post_get_image($value['ID'])
    ];
  }

  // order point types by id ASC
  uasort($point_types, function ($a, $b) {
    if ($a['id'] < $b['id']) {
      return -1;
    }

    if ($a['id'] > $b['id']) {
      return 1;
    }

    return 0;
  });

  return $point_types;
}

/**
 * Get user point data
 * 
 * @param int $user_id    ID of the user to get point data from
 * @return array
 */
function vikinger_gamipress_get_user_points($user_id) {
  $user_points = [];

  $point_types = vikinger_gamipress_get_point_types();

  foreach ($point_types as $key => $value) {
    $points = gamipress_get_user_points($user_id, $key);

    $user_points[$key] = array_merge($value, ['points' => $points]);
  }

  return $user_points;
}

/**
 * Get logged user point data
 * 
 * @return array|boolean
 */
function vikinger_gamipress_get_logged_user_points() {
  $user_id = false;

  if (is_user_logged_in()) {
    $user_id = get_current_user_id();
  }

  if ($user_id) {
    return vikinger_gamipress_get_user_points($user_id);
  }

  return false;
}

/**
 * Get point awards for all point types, or false if there aren't any
 * 
 * @return array
 */
function vikinger_gamipress_get_point_type_awards() {
  $point_types = vikinger_gamipress_get_point_types();

  $point_type_awards = [];

  foreach ($point_types as $key => $point_type) {
    $gp_point_type_awards = gamipress_get_points_type_points_awards($key);

    if (!$gp_point_type_awards) {
      continue;
    }

    $point_type_awards[$key] = [];

    if ($gp_point_type_awards) {
      foreach ($gp_point_type_awards as $gp_point_type_award) {
        $limit = gamipress_get_post_meta($gp_point_type_award->ID, '_gamipress_limit');
        $limit_type = gamipress_get_post_meta($gp_point_type_award->ID, '_gamipress_limit_type');

        $limit_text = $limit . ' ' . $limit_type;

        if ($limit_type === 'unlimited') {
          $limit_text = ucfirst($limit_type);
        }

        $point_type_awards[$key][] = [
          'id'          => $gp_point_type_award->ID,
          'description' => $gp_point_type_award->post_title,
          'limit_type'  => $limit_type,
          'limit'       => $limit,
          'limit_text'  => $limit_text,
          'point_type'  => $point_type,
          'points'      => absint(gamipress_get_post_meta($gp_point_type_award->ID, '_gamipress_points'))
        ];
      }
    }
  }

  if (count($point_type_awards) === 0) {
    return false;
  }

  return $point_type_awards;
}

/**
 * Get point deducts for all point types, or false if there aren't any
 * 
 * @return array
 */
function vikinger_gamipress_get_point_type_deducts() {
  $point_types = vikinger_gamipress_get_point_types();

  $point_type_deducts = [];

  foreach ($point_types as $key => $point_type) {
    $gp_point_type_deducts = gamipress_get_points_type_points_deducts($key);

    if (!$gp_point_type_deducts) {
      continue;
    }

    $point_type_deducts[$key] = [];

    if ($gp_point_type_deducts) {
      foreach ($gp_point_type_deducts as $gp_point_type_award) {
        $limit = gamipress_get_post_meta($gp_point_type_award->ID, '_gamipress_limit');
        $limit_type = gamipress_get_post_meta($gp_point_type_award->ID, '_gamipress_limit_type');

        $limit_text = $limit . ' ' . $limit_type;

        if ($limit_type === 'unlimited') {
          $limit_text = ucfirst($limit_type);
        }

        $point_type_deducts[$key][] = [
          'id'          => $gp_point_type_award->ID,
          'description' => $gp_point_type_award->post_title,
          'limit_type'  => $limit_type,
          'limit'       => $limit,
          'limit_text'  => $limit_text,
          'point_type'  => $point_type,
          'points'      => absint(gamipress_get_post_meta($gp_point_type_award->ID, '_gamipress_points'))
        ];
      }
    }
  }

  if (count($point_type_deducts) === 0) {
    return false;
  }

  return $point_type_deducts;
}

?>