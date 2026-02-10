<?php

/*************************************************
## Register Menu
*************************************************/
/**
* Extended Walker class for use with the  Bootstrap toolkit Dropdown menus in Wordpress.
* Edited to support n-levels submenu and Title and Description text.
* @author @jaycbrf4 https://github.com/jaycbrf4/wp-bootstrap-navwalker
*  Original work by johnmegahan https://gist.github.com/1597994, Emanuele 'Tex' Tessore https://gist.github.com/3765640
* @license CC BY 4.0 https://creativecommons.org/licenses/by/4.0/
*/
if ( ! class_exists( 'Agrikon_Wp_Bootstrap_Navwalker' ) ) {
    class Agrikon_Wp_Bootstrap_Navwalker extends Walker_Nav_Menu
    {
        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $submenu = ($depth > 0) ? '' : '';
            $output	.= "\n$indent<ul class=\"sub_menu depth_$depth\">\n";
        }
        public function end_lvl(&$output, $depth = 0, $args = array())
        {
            $output	.= "</ul>";
        }

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $li_attributes = '';
            $class_names = $value = '';

            $classes = empty($item->classes) ? array() : (array) $item->classes;

            // managing divider: add divider class to an element to get a divider before it.
            $divider_class_position = array_search('divider', $classes);

            if ($divider_class_position !== false) {
                $output .= "<li class=\"divider\"></li>\n";
                unset($classes[$divider_class_position]);
            }

            $classes[] = ($args->has_children) ? 'dropdown' : '';
            $classes[] = ($item->current || $item->current_item_ancestor) ? 'is-active current' : '';
            $classes[] = 'menu-item-' . $item->ID;

            if ($depth && $args->has_children) {
                $classes[] = 'has-submenu menu-item--has-child';
            }

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = ' class="' . esc_attr($class_names) . '"';

            $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
            $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

            $attributes  = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) .'"' : '';
            $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
            $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
            $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';


            $item_output  = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

            $item_output .= '</a>';
            $item_output .= $args->after;


            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        } // start_el

        public function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output)
        {
            if (!$element) {
                return;
            }

            $id_field = $this->db_fields['id'];

            //display this element
            if (is_array($args[0])) {
                $args[0]['has_children'] = ! empty($children_elements[$element->$id_field]);
            } elseif (is_object($args[0])) {
                $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
            }
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'start_el'), $cb_args);

            $id = $element->$id_field;

            // descend only when the depth is right and there are childrens for this element
            if (($max_depth == 0 || $max_depth > $depth+1) && isset($children_elements[$id])) {
                foreach ($children_elements[ $id ] as $child) {
                    if (!isset($newlevel)) {
                        $newlevel = true;

                        // start the child delimiter
                        $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                    }

                    $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                }

                unset($children_elements[ $id ]);
            }

            if (isset($newlevel) && $newlevel) {

            // end the child delimiter
                $cb_args = array_merge(array(&$output, $depth), $args);
                call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
            }

            // end this element
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'end_el'), $cb_args);
        }

        /**
         * Menu Fallback
         *
         * @since 1.0.0
         *
         * @param array $args passed from the wp_nav_menu function.
         */
        public static function fallback($args)
        {
            if (current_user_can('edit_theme_options')) {
                echo '<li><a href="' . admin_url('nav-menus.php') . '">' . esc_html__('Add a menu', 'agrikon') . '</a></li>';
            }
        }
    }
}

if ( ! class_exists( 'Agrikon_Menu_Navwalker' ) ) {
    class Agrikon_Menu_Navwalker extends Walker_Nav_Menu
    {
        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $submenu = ($depth > 0) ? '' : '';
            $close = esc_html__('Close','agrikon');
            $output	.= "\n$indent<ul class=\"sub-menu depth_$depth\"><li class=\"menu-item goback\"><div class=\"hidden-item\"><a href=\"#0\"><i class=\"fas fa-times\"></i> $close</a></span></div>\n";
        }
        public function end_lvl(&$output, $depth = 0, $args = array())
        {
            $output	.= "</li></ul>";
        }
        private $increment = 1;
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $class_names = $value = $li_attributes = '';

            $desc   = ! empty( $item->description ) ? '<em>'.$item->description.'</em>' : '';
            $title  = apply_filters('the_title', $item->title, $item->ID);
            $sub    = $depth && $args->has_children ? 'sub-link' : 'link';

            $attributes  = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) .'"' : '';
            $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
            $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

            // Get the nav menu based on the requested menu.
            $number = 'default' == agrikon_settings( 'header_template', 'default' ) ? '<span class="nm"></span>' : '';
            if ( $depth < 2 && $args->has_children ) {
                $linkitem ='<div class="hidden-item"><a '. $attributes .' class="link">'.$number.$title.' <i class="fas fa-angle-down"></i></a></div>';
            } else {
                $linkitem  = '<div class="hidden-item"><a '. $attributes .' class="link">'.$number.$title.' '.$desc.'</a></div>';
            }

            $classes = empty($item->classes) ? array() : (array) $item->classes;

            $classes[] = ($args->has_children) ? 'menu-item--has-child' : '';
            $classes[] = ($item->current || $item->current_item_ancestor) ? 'is--active' : '';
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = ' class="' . esc_attr($class_names) . '"';

            $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
            $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

            $item_output = $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
            $item_output .= $linkitem;
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

        } // start_el

        public function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
        {
            if ( !$element ) {
                return;
            }

            $id_field = $this->db_fields['id'];

            //display this element
            if (is_array($args[0])) {
                $args[0]['has_children'] = ! empty($children_elements[$element->$id_field]);
            } elseif (is_object($args[0])) {
                $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
            }
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'start_el'), $cb_args);

            $id = $element->$id_field;

            // descend only when the depth is right and there are childrens for this element
            if (($max_depth == 0 || $max_depth > $depth+1) && isset($children_elements[$id])) {
                foreach ($children_elements[ $id ] as $child) {
                    if (!isset($newlevel)) {
                        $newlevel = true;

                        // start the child delimiter
                        $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                    }

                    $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                }

                unset($children_elements[ $id ]);
            }

            if (isset($newlevel) && $newlevel) {

            // end the child delimiter
                $cb_args = array_merge(array(&$output, $depth), $args);
                call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
            }

            // end this element
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'end_el'), $cb_args);
        }

        /**
         * Menu Fallback
         *
         * @since 1.0.0
         *
         * @param array $args passed from the wp_nav_menu function.
         */
        public static function fallback($args)
        {
            if (current_user_can('edit_theme_options')) {
                echo '<li><a href="' . admin_url('nav-menus.php') . '">' . esc_html__('Add a menu', 'agrikon') . '</a></li>';
            }
        }
    }
}
