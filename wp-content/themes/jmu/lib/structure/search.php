<?php

remove_filter('get_search_form', 'genesis_search_form');
add_filter( 'get_search_form', 'jmu_search_form' );
/**
 * Replace the default search form with a Genesis-specific form.
 *
 * The exact output depends on whether the child theme supports HTML5 or not.
 *
 * Applies the `genesis_search_text`, `genesis_search_button_text`, `genesis_search_form_label` and
 * `genesis_search_form` filters.
 *
 * @since 0.2.0
 *
 * @uses genesis_html5() Check for HTML5 support.
 *
 * @return string HTML markup.
 */
function jmu_search_form() {
	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) . '&#x02026;' );

	$button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );

	$onfocus = "if ('" . esc_js( $search_text ) . "' === this.value) {this.value = '';}";
	$onblur  = "if ('' === this.value) {this.value = '" . esc_js( $search_text ) . "';}";

	//* Empty label, by default. Filterable.
	$label = apply_filters( 'genesis_search_form_label', '' );

	$value_or_placeholder = ( get_search_query() == '' ) ? 'placeholder' : 'value';

    $form = sprintf('<form action="//www.google.com/cse" class="search-form" role="search" >%s<input type="search" name="q" %s="%s"> <input name="cx" type="hidden" value="016476667732860519677:h7le3e3by1g"> <input name="ie" type="hidden" value="UTF-8"> <input title="search" type="submit" class="searchsubmit search-submit" value="%s"></form>', esc_html( $label ), $value_or_placeholder, esc_attr( $search_text ), esc_attr( $button_text ) );
    
	return apply_filters( 'jmu_search_form', $form, $search_text, $button_text, $label );

}