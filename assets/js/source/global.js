var JC = JC || {};

// Load polyfills where needed
Modernizr.load([
  {
    test: Modernizr.mq('only all'),
    nope: 'assets/js/build/respond.min.js'
  },
  {
    test: supportsSelector(':before') && supportsSelector(':after') && supportsSelector(':nth-child(even)') && supportsSelector(':nth-child(odd)'),
    nope: 'assets/js/build/selectivizr-min.js'
  }
]);