<?php
/** Build the theme's single public stylesheet from repository-only CSS sources. */
$root = dirname( __DIR__ );

function bl_css_matching_brace( $css, $open ) {
    $depth = 1; $quote = ''; $comment = false; $length = strlen( $css );
    for ( $i = $open + 1; $i < $length; $i++ ) {
        $char = $css[$i]; $next = $i + 1 < $length ? $css[$i + 1] : '';
        if ( $comment ) { if ( '*' === $char && '/' === $next ) { $comment = false; $i++; } continue; }
        if ( $quote ) { if ( '\\' === $char ) { $i++; continue; } if ( $char === $quote ) $quote = ''; continue; }
        if ( '/' === $char && '*' === $next ) { $comment = true; $i++; continue; }
        if ( '"' === $char || "'" === $char ) { $quote = $char; continue; }
        if ( '{' === $char ) $depth++;
        elseif ( '}' === $char && 0 === --$depth ) return $i;
    }
    throw new RuntimeException( 'Unbalanced CSS braces.' );
}

function bl_css_scope_selector( $selector, $scope ) {
    $selector = trim( $selector );
    if ( '' === $selector ) return '';
    if ( 0 === strpos( $selector, ':root' ) ) return preg_replace( '/^:root/', $scope, $selector );
    if ( preg_match( '/^body(?=\b|[.#:\[])/', $selector ) ) return preg_replace( '/^body/', $scope, $selector );
    if ( preg_match( '/^html\s+body(?=\b|[.#:\[])/', $selector ) ) return preg_replace( '/^html\s+body/', $scope, $selector );
    if ( 'html' === $selector ) return $scope;
    return $scope . ' ' . $selector;
}

function bl_css_scope( $css, $scope ) {
    $output = ''; $offset = 0; $length = strlen( $css );
    while ( $offset < $length ) {
        $open = strpos( $css, '{', $offset );
        if ( false === $open ) { $output .= substr( $css, $offset ); break; }
        $prelude = substr( $css, $offset, $open - $offset );
        $close = bl_css_matching_brace( $css, $open );
        $body = substr( $css, $open + 1, $close - $open - 1 );
        $trimmed = trim( preg_replace( '~/\*.*?\*/~s', '', $prelude ) );
        if ( preg_match( '/^@(media|supports|container|layer|document)\b/i', $trimmed ) ) {
            $output .= $prelude . '{' . bl_css_scope( $body, $scope ) . '}';
        } elseif ( preg_match( '/^@/i', $trimmed ) ) {
            $output .= $prelude . '{' . $body . '}';
        } else {
            $selectors = array_map( function ( $selector ) use ( $scope ) { return bl_css_scope_selector( $selector, $scope ); }, explode( ',', $prelude ) );
            $output .= "\n" . implode( ',', array_filter( $selectors ) ) . '{' . $body . '}';
        }
        $offset = $close + 1;
    }
    return $output;
}

$header = "/*\nTheme Name: BottomLine Communication\nTheme URI: https://github.com/pmunankarmi/bottomline-communication\nAuthor: BottomLine Communication\nDescription: Faithful classic WordPress conversion of the supplied BottomLine HTML. Native content types, classic templates and ACF Pro fields.\nVersion: 2.2.0\nUpdate URI: https://github.com/pmunankarmi/bottomline-communication\nRequires at least: 6.4\nRequires PHP: 7.4\nText Domain: bottomline\n*/\n";
$output = $header . "@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');\n";
$output .= file_get_contents( $root . '/css-source/bootstrap.min.css' ) . "\n";
foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $kind ) {
    $output .= "\n/* " . ucfirst( $kind ) . " */\n" . bl_css_scope( file_get_contents( $root . '/css-source/' . $kind . '.css' ), 'body.bl-page-' . $kind );
}
$output .= "\n/* Classic/ACF editor */\n" . bl_css_scope( file_get_contents( $root . '/css-source/editor.css' ), '.mce-content-body' );
$output .= "\n/* Shared theme overrides */\n" . file_get_contents( $root . '/css-source/common.css' );
file_put_contents( $root . '/bottomline-communication/style.css', $output );
