var JC = JC || {};

// Load polyfills where needed
Modernizr.load([
  {
    test: Modernizr.mq('only all'),
    nope: 'assets/js/build/respond.min.js'
  },
  {
    test: supportsSelector(':before') && supportsSelector(':nth-child(n + 1)') && supportsSelector(':last-of-type'),
    nope: 'assets/js/build/selectivizr.min.js'
  }
]);