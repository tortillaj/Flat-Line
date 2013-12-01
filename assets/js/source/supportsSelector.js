(function( global ) {

  var doc = global.document,
    hasQuerySelect = !!doc.querySelector;

  function supportsSelector( selector ) {

    var body = doc.body,
      ret, div, style;

    // If the browser has support, take the faster path
    if ( hasQuerySelect ) {

      try {
        // Invalid selectors will throw exceptions
        doc.querySelector( selector );
        ret = true;
      } catch( e ) {
        ret = false;
      }

      // Return early from fast path
      return ret;
    }

    // Back up plan for older browser that do not support qS
    body.appendChild(
      (
        ( div = document.createElement( "div" ) ),
          ( div.innerHTML = [ "&shy;<style>", selector, "{}</style>" ].join("") ),
          div
        )
    );

    style = div.children[ 0 ];

    // IE8 has an easy out, the rule list will be empty
    if ( style.styleSheet && !style.styleSheet.rules.length ) {
      ret = false;
    } else {
      // IE6,7 will create pseudo selectors named ":unknown"
      // Some cases will be uppercase, others will not
      // IE6,7,8 will all create correct rules for selectors deemed valid

      ret = !/unknown/.test( style.styleSheet.rules[0].selectorText.toLowerCase() );
    }

    body.removeChild( div );

    return ret;
  }

  global.supportsSelector = supportsSelector;

})( this );