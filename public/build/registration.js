(self["webpackChunkprojet_security_response"] = self["webpackChunkprojet_security_response"] || []).push([["registration"],{

/***/ "./assets/registration.js":
/*!********************************!*\
  !*** ./assets/registration.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");

__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");

__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");

var userMemberFormPart = document.getElementById('registration_form_userMember'); // const userMembershipTypeChoices = document.getElementById('registration_form_membershipType').querySelectorAll('input');

var userMembershipTypeChoices = document.getElementById('choice-register').querySelectorAll('div'); // TODO: Récupérer la div correspondant aux champs de l'entreprise 

var userEnterpriseFormPart = document.getElementById('registration_form_userEnterprise'); // console.log(userMembershipTypeChoices);
// userMembershipTypeChoices.forEach(function(item) {
//     item.addEventListener('click', function(e) {
//         if(e.currentTarget.value === 'enterprise') {
//             userMemberFormPart.style.display = 'none';
//             // TODO: Montrer les champs de l'entreprise
//             userEnterpriseFormPart.style.display = 'block';
//         }
//         if(e.currentTarget.value === 'member') {
//             userMemberFormPart.style.display = 'block';
//             // TODO: Cacher les champs de l'entreprise
//             userEnterpriseFormPart.style.display = 'none';
//         }
//     });
// })

userMembershipTypeChoices.forEach(function (item) {
  item.addEventListener('click', function (e) {
    if (e.currentTarget.id === 'register-enterprise') {
      userMemberFormPart.style.display = 'none'; // TODO: Montrer les champs de l'entreprise

      userEnterpriseFormPart.style.display = 'block';
    }

    if (e.currentTarget.id === 'register-member') {
      userMemberFormPart.style.display = 'block'; // TODO: Cacher les champs de l'entreprise

      userEnterpriseFormPart.style.display = 'none';
    }
  });
});

/***/ }),

/***/ "./node_modules/core-js/internals/array-for-each.js":
/*!**********************************************************!*\
  !*** ./node_modules/core-js/internals/array-for-each.js ***!
  \**********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";

var $forEach = (__webpack_require__(/*! ../internals/array-iteration */ "./node_modules/core-js/internals/array-iteration.js").forEach);
var arrayMethodIsStrict = __webpack_require__(/*! ../internals/array-method-is-strict */ "./node_modules/core-js/internals/array-method-is-strict.js");

var STRICT_METHOD = arrayMethodIsStrict('forEach');

// `Array.prototype.forEach` method implementation
// https://tc39.es/ecma262/#sec-array.prototype.foreach
module.exports = !STRICT_METHOD ? function forEach(callbackfn /* , thisArg */) {
  return $forEach(this, callbackfn, arguments.length > 1 ? arguments[1] : undefined);
// eslint-disable-next-line es/no-array-prototype-foreach -- safe
} : [].forEach;


/***/ }),

/***/ "./node_modules/core-js/internals/array-method-is-strict.js":
/*!******************************************************************!*\
  !*** ./node_modules/core-js/internals/array-method-is-strict.js ***!
  \******************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";

var fails = __webpack_require__(/*! ../internals/fails */ "./node_modules/core-js/internals/fails.js");

module.exports = function (METHOD_NAME, argument) {
  var method = [][METHOD_NAME];
  return !!method && fails(function () {
    // eslint-disable-next-line no-useless-call,no-throw-literal -- required for testing
    method.call(null, argument || function () { throw 1; }, 1);
  });
};


/***/ }),

/***/ "./node_modules/core-js/modules/es.array.for-each.js":
/*!***********************************************************!*\
  !*** ./node_modules/core-js/modules/es.array.for-each.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

"use strict";

var $ = __webpack_require__(/*! ../internals/export */ "./node_modules/core-js/internals/export.js");
var forEach = __webpack_require__(/*! ../internals/array-for-each */ "./node_modules/core-js/internals/array-for-each.js");

// `Array.prototype.forEach` method
// https://tc39.es/ecma262/#sec-array.prototype.foreach
// eslint-disable-next-line es/no-array-prototype-foreach -- safe
$({ target: 'Array', proto: true, forced: [].forEach != forEach }, {
  forEach: forEach
});


/***/ }),

/***/ "./node_modules/core-js/modules/web.dom-collections.for-each.js":
/*!**********************************************************************!*\
  !*** ./node_modules/core-js/modules/web.dom-collections.for-each.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

var global = __webpack_require__(/*! ../internals/global */ "./node_modules/core-js/internals/global.js");
var DOMIterables = __webpack_require__(/*! ../internals/dom-iterables */ "./node_modules/core-js/internals/dom-iterables.js");
var DOMTokenListPrototype = __webpack_require__(/*! ../internals/dom-token-list-prototype */ "./node_modules/core-js/internals/dom-token-list-prototype.js");
var forEach = __webpack_require__(/*! ../internals/array-for-each */ "./node_modules/core-js/internals/array-for-each.js");
var createNonEnumerableProperty = __webpack_require__(/*! ../internals/create-non-enumerable-property */ "./node_modules/core-js/internals/create-non-enumerable-property.js");

var handlePrototype = function (CollectionPrototype) {
  // some Chrome versions have non-configurable methods on DOMTokenList
  if (CollectionPrototype && CollectionPrototype.forEach !== forEach) try {
    createNonEnumerableProperty(CollectionPrototype, 'forEach', forEach);
  } catch (error) {
    CollectionPrototype.forEach = forEach;
  }
};

for (var COLLECTION_NAME in DOMIterables) {
  if (DOMIterables[COLLECTION_NAME]) {
    handlePrototype(global[COLLECTION_NAME] && global[COLLECTION_NAME].prototype);
  }
}

handlePrototype(DOMTokenListPrototype);


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_internals_array-iteration_js-node_modules_core-js_internals_dom--711a0d"], () => (__webpack_exec__("./assets/registration.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoicmVnaXN0cmF0aW9uLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7O0FBRUEsSUFBTUEsa0JBQWtCLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3Qiw4QkFBeEIsQ0FBM0IsRUFDQTs7QUFDQSxJQUFNQyx5QkFBeUIsR0FBR0YsUUFBUSxDQUFDQyxjQUFULENBQXdCLGlCQUF4QixFQUEyQ0UsZ0JBQTNDLENBQTRELEtBQTVELENBQWxDLEVBRUE7O0FBQ0EsSUFBTUMsc0JBQXNCLEdBQUdKLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixrQ0FBeEIsQ0FBL0IsRUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7O0FBR0FDLHlCQUF5QixDQUFDRyxPQUExQixDQUFrQyxVQUFTQyxJQUFULEVBQWU7QUFDN0NBLEVBQUFBLElBQUksQ0FBQ0MsZ0JBQUwsQ0FBc0IsT0FBdEIsRUFBK0IsVUFBU0MsQ0FBVCxFQUFZO0FBQ3ZDLFFBQUdBLENBQUMsQ0FBQ0MsYUFBRixDQUFnQkMsRUFBaEIsS0FBdUIscUJBQTFCLEVBQWlEO0FBQzdDWCxNQUFBQSxrQkFBa0IsQ0FBQ1ksS0FBbkIsQ0FBeUJDLE9BQXpCLEdBQW1DLE1BQW5DLENBRDZDLENBRTdDOztBQUNBUixNQUFBQSxzQkFBc0IsQ0FBQ08sS0FBdkIsQ0FBNkJDLE9BQTdCLEdBQXVDLE9BQXZDO0FBQ0g7O0FBRUQsUUFBR0osQ0FBQyxDQUFDQyxhQUFGLENBQWdCQyxFQUFoQixLQUF1QixpQkFBMUIsRUFBNkM7QUFFekNYLE1BQUFBLGtCQUFrQixDQUFDWSxLQUFuQixDQUF5QkMsT0FBekIsR0FBbUMsT0FBbkMsQ0FGeUMsQ0FHekM7O0FBQ0FSLE1BQUFBLHNCQUFzQixDQUFDTyxLQUF2QixDQUE2QkMsT0FBN0IsR0FBdUMsTUFBdkM7QUFDSDtBQUVKLEdBZEQ7QUFlSCxDQWhCRDs7Ozs7Ozs7Ozs7QUM1QmE7QUFDYixlQUFlLHdIQUErQztBQUM5RCwwQkFBMEIsbUJBQU8sQ0FBQyx1R0FBcUM7O0FBRXZFOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxFQUFFOzs7Ozs7Ozs7Ozs7QUNYVztBQUNiLFlBQVksbUJBQU8sQ0FBQyxxRUFBb0I7O0FBRXhDO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsZ0RBQWdELFVBQVU7QUFDMUQsR0FBRztBQUNIOzs7Ozs7Ozs7Ozs7QUNUYTtBQUNiLFFBQVEsbUJBQU8sQ0FBQyx1RUFBcUI7QUFDckMsY0FBYyxtQkFBTyxDQUFDLHVGQUE2Qjs7QUFFbkQ7QUFDQTtBQUNBO0FBQ0EsSUFBSSw2REFBNkQ7QUFDakU7QUFDQSxDQUFDOzs7Ozs7Ozs7OztBQ1RELGFBQWEsbUJBQU8sQ0FBQyx1RUFBcUI7QUFDMUMsbUJBQW1CLG1CQUFPLENBQUMscUZBQTRCO0FBQ3ZELDRCQUE0QixtQkFBTyxDQUFDLDJHQUF1QztBQUMzRSxjQUFjLG1CQUFPLENBQUMsdUZBQTZCO0FBQ25ELGtDQUFrQyxtQkFBTyxDQUFDLHVIQUE2Qzs7QUFFdkY7QUFDQTtBQUNBO0FBQ0E7QUFDQSxJQUFJO0FBQ0o7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9wcm9qZXQtc2VjdXJpdHktcmVzcG9uc2UvLi9hc3NldHMvcmVnaXN0cmF0aW9uLmpzIiwid2VicGFjazovL3Byb2pldC1zZWN1cml0eS1yZXNwb25zZS8uL25vZGVfbW9kdWxlcy9jb3JlLWpzL2ludGVybmFscy9hcnJheS1mb3ItZWFjaC5qcyIsIndlYnBhY2s6Ly9wcm9qZXQtc2VjdXJpdHktcmVzcG9uc2UvLi9ub2RlX21vZHVsZXMvY29yZS1qcy9pbnRlcm5hbHMvYXJyYXktbWV0aG9kLWlzLXN0cmljdC5qcyIsIndlYnBhY2s6Ly9wcm9qZXQtc2VjdXJpdHktcmVzcG9uc2UvLi9ub2RlX21vZHVsZXMvY29yZS1qcy9tb2R1bGVzL2VzLmFycmF5LmZvci1lYWNoLmpzIiwid2VicGFjazovL3Byb2pldC1zZWN1cml0eS1yZXNwb25zZS8uL25vZGVfbW9kdWxlcy9jb3JlLWpzL21vZHVsZXMvd2ViLmRvbS1jb2xsZWN0aW9ucy5mb3ItZWFjaC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJcblxuY29uc3QgdXNlck1lbWJlckZvcm1QYXJ0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3JlZ2lzdHJhdGlvbl9mb3JtX3VzZXJNZW1iZXInKTtcbi8vIGNvbnN0IHVzZXJNZW1iZXJzaGlwVHlwZUNob2ljZXMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncmVnaXN0cmF0aW9uX2Zvcm1fbWVtYmVyc2hpcFR5cGUnKS5xdWVyeVNlbGVjdG9yQWxsKCdpbnB1dCcpO1xuY29uc3QgdXNlck1lbWJlcnNoaXBUeXBlQ2hvaWNlcyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjaG9pY2UtcmVnaXN0ZXInKS5xdWVyeVNlbGVjdG9yQWxsKCdkaXYnKTtcblxuLy8gVE9ETzogUsOpY3Vww6lyZXIgbGEgZGl2IGNvcnJlc3BvbmRhbnQgYXV4IGNoYW1wcyBkZSBsJ2VudHJlcHJpc2UgXG5jb25zdCB1c2VyRW50ZXJwcmlzZUZvcm1QYXJ0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3JlZ2lzdHJhdGlvbl9mb3JtX3VzZXJFbnRlcnByaXNlJyk7XG5cbi8vIGNvbnNvbGUubG9nKHVzZXJNZW1iZXJzaGlwVHlwZUNob2ljZXMpO1xuLy8gdXNlck1lbWJlcnNoaXBUeXBlQ2hvaWNlcy5mb3JFYWNoKGZ1bmN0aW9uKGl0ZW0pIHtcbi8vICAgICBpdGVtLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuLy8gICAgICAgICBpZihlLmN1cnJlbnRUYXJnZXQudmFsdWUgPT09ICdlbnRlcnByaXNlJykge1xuLy8gICAgICAgICAgICAgdXNlck1lbWJlckZvcm1QYXJ0LnN0eWxlLmRpc3BsYXkgPSAnbm9uZSc7XG4vLyAgICAgICAgICAgICAvLyBUT0RPOiBNb250cmVyIGxlcyBjaGFtcHMgZGUgbCdlbnRyZXByaXNlXG4vLyAgICAgICAgICAgICB1c2VyRW50ZXJwcmlzZUZvcm1QYXJ0LnN0eWxlLmRpc3BsYXkgPSAnYmxvY2snO1xuLy8gICAgICAgICB9XG5cbi8vICAgICAgICAgaWYoZS5jdXJyZW50VGFyZ2V0LnZhbHVlID09PSAnbWVtYmVyJykge1xuLy8gICAgICAgICAgICAgdXNlck1lbWJlckZvcm1QYXJ0LnN0eWxlLmRpc3BsYXkgPSAnYmxvY2snO1xuLy8gICAgICAgICAgICAgLy8gVE9ETzogQ2FjaGVyIGxlcyBjaGFtcHMgZGUgbCdlbnRyZXByaXNlXG4vLyAgICAgICAgICAgICB1c2VyRW50ZXJwcmlzZUZvcm1QYXJ0LnN0eWxlLmRpc3BsYXkgPSAnbm9uZSc7XG4vLyAgICAgICAgIH1cblxuLy8gICAgIH0pO1xuLy8gfSlcblxuXG51c2VyTWVtYmVyc2hpcFR5cGVDaG9pY2VzLmZvckVhY2goZnVuY3Rpb24oaXRlbSkge1xuICAgIGl0ZW0uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbihlKSB7XG4gICAgICAgIGlmKGUuY3VycmVudFRhcmdldC5pZCA9PT0gJ3JlZ2lzdGVyLWVudGVycHJpc2UnKSB7XG4gICAgICAgICAgICB1c2VyTWVtYmVyRm9ybVBhcnQuc3R5bGUuZGlzcGxheSA9ICdub25lJztcbiAgICAgICAgICAgIC8vIFRPRE86IE1vbnRyZXIgbGVzIGNoYW1wcyBkZSBsJ2VudHJlcHJpc2VcbiAgICAgICAgICAgIHVzZXJFbnRlcnByaXNlRm9ybVBhcnQuc3R5bGUuZGlzcGxheSA9ICdibG9jayc7XG4gICAgICAgIH1cblxuICAgICAgICBpZihlLmN1cnJlbnRUYXJnZXQuaWQgPT09ICdyZWdpc3Rlci1tZW1iZXInKSB7XG5cbiAgICAgICAgICAgIHVzZXJNZW1iZXJGb3JtUGFydC5zdHlsZS5kaXNwbGF5ID0gJ2Jsb2NrJztcbiAgICAgICAgICAgIC8vIFRPRE86IENhY2hlciBsZXMgY2hhbXBzIGRlIGwnZW50cmVwcmlzZVxuICAgICAgICAgICAgdXNlckVudGVycHJpc2VGb3JtUGFydC5zdHlsZS5kaXNwbGF5ID0gJ25vbmUnO1xuICAgICAgICB9XG5cbiAgICB9KTtcbn0pIiwiJ3VzZSBzdHJpY3QnO1xudmFyICRmb3JFYWNoID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2FycmF5LWl0ZXJhdGlvbicpLmZvckVhY2g7XG52YXIgYXJyYXlNZXRob2RJc1N0cmljdCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9hcnJheS1tZXRob2QtaXMtc3RyaWN0Jyk7XG5cbnZhciBTVFJJQ1RfTUVUSE9EID0gYXJyYXlNZXRob2RJc1N0cmljdCgnZm9yRWFjaCcpO1xuXG4vLyBgQXJyYXkucHJvdG90eXBlLmZvckVhY2hgIG1ldGhvZCBpbXBsZW1lbnRhdGlvblxuLy8gaHR0cHM6Ly90YzM5LmVzL2VjbWEyNjIvI3NlYy1hcnJheS5wcm90b3R5cGUuZm9yZWFjaFxubW9kdWxlLmV4cG9ydHMgPSAhU1RSSUNUX01FVEhPRCA/IGZ1bmN0aW9uIGZvckVhY2goY2FsbGJhY2tmbiAvKiAsIHRoaXNBcmcgKi8pIHtcbiAgcmV0dXJuICRmb3JFYWNoKHRoaXMsIGNhbGxiYWNrZm4sIGFyZ3VtZW50cy5sZW5ndGggPiAxID8gYXJndW1lbnRzWzFdIDogdW5kZWZpbmVkKTtcbi8vIGVzbGludC1kaXNhYmxlLW5leHQtbGluZSBlcy9uby1hcnJheS1wcm90b3R5cGUtZm9yZWFjaCAtLSBzYWZlXG59IDogW10uZm9yRWFjaDtcbiIsIid1c2Ugc3RyaWN0JztcbnZhciBmYWlscyA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9mYWlscycpO1xuXG5tb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uIChNRVRIT0RfTkFNRSwgYXJndW1lbnQpIHtcbiAgdmFyIG1ldGhvZCA9IFtdW01FVEhPRF9OQU1FXTtcbiAgcmV0dXJuICEhbWV0aG9kICYmIGZhaWxzKGZ1bmN0aW9uICgpIHtcbiAgICAvLyBlc2xpbnQtZGlzYWJsZS1uZXh0LWxpbmUgbm8tdXNlbGVzcy1jYWxsLG5vLXRocm93LWxpdGVyYWwgLS0gcmVxdWlyZWQgZm9yIHRlc3RpbmdcbiAgICBtZXRob2QuY2FsbChudWxsLCBhcmd1bWVudCB8fCBmdW5jdGlvbiAoKSB7IHRocm93IDE7IH0sIDEpO1xuICB9KTtcbn07XG4iLCIndXNlIHN0cmljdCc7XG52YXIgJCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9leHBvcnQnKTtcbnZhciBmb3JFYWNoID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2FycmF5LWZvci1lYWNoJyk7XG5cbi8vIGBBcnJheS5wcm90b3R5cGUuZm9yRWFjaGAgbWV0aG9kXG4vLyBodHRwczovL3RjMzkuZXMvZWNtYTI2Mi8jc2VjLWFycmF5LnByb3RvdHlwZS5mb3JlYWNoXG4vLyBlc2xpbnQtZGlzYWJsZS1uZXh0LWxpbmUgZXMvbm8tYXJyYXktcHJvdG90eXBlLWZvcmVhY2ggLS0gc2FmZVxuJCh7IHRhcmdldDogJ0FycmF5JywgcHJvdG86IHRydWUsIGZvcmNlZDogW10uZm9yRWFjaCAhPSBmb3JFYWNoIH0sIHtcbiAgZm9yRWFjaDogZm9yRWFjaFxufSk7XG4iLCJ2YXIgZ2xvYmFsID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2dsb2JhbCcpO1xudmFyIERPTUl0ZXJhYmxlcyA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9kb20taXRlcmFibGVzJyk7XG52YXIgRE9NVG9rZW5MaXN0UHJvdG90eXBlID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2RvbS10b2tlbi1saXN0LXByb3RvdHlwZScpO1xudmFyIGZvckVhY2ggPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvYXJyYXktZm9yLWVhY2gnKTtcbnZhciBjcmVhdGVOb25FbnVtZXJhYmxlUHJvcGVydHkgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvY3JlYXRlLW5vbi1lbnVtZXJhYmxlLXByb3BlcnR5Jyk7XG5cbnZhciBoYW5kbGVQcm90b3R5cGUgPSBmdW5jdGlvbiAoQ29sbGVjdGlvblByb3RvdHlwZSkge1xuICAvLyBzb21lIENocm9tZSB2ZXJzaW9ucyBoYXZlIG5vbi1jb25maWd1cmFibGUgbWV0aG9kcyBvbiBET01Ub2tlbkxpc3RcbiAgaWYgKENvbGxlY3Rpb25Qcm90b3R5cGUgJiYgQ29sbGVjdGlvblByb3RvdHlwZS5mb3JFYWNoICE9PSBmb3JFYWNoKSB0cnkge1xuICAgIGNyZWF0ZU5vbkVudW1lcmFibGVQcm9wZXJ0eShDb2xsZWN0aW9uUHJvdG90eXBlLCAnZm9yRWFjaCcsIGZvckVhY2gpO1xuICB9IGNhdGNoIChlcnJvcikge1xuICAgIENvbGxlY3Rpb25Qcm90b3R5cGUuZm9yRWFjaCA9IGZvckVhY2g7XG4gIH1cbn07XG5cbmZvciAodmFyIENPTExFQ1RJT05fTkFNRSBpbiBET01JdGVyYWJsZXMpIHtcbiAgaWYgKERPTUl0ZXJhYmxlc1tDT0xMRUNUSU9OX05BTUVdKSB7XG4gICAgaGFuZGxlUHJvdG90eXBlKGdsb2JhbFtDT0xMRUNUSU9OX05BTUVdICYmIGdsb2JhbFtDT0xMRUNUSU9OX05BTUVdLnByb3RvdHlwZSk7XG4gIH1cbn1cblxuaGFuZGxlUHJvdG90eXBlKERPTVRva2VuTGlzdFByb3RvdHlwZSk7XG4iXSwibmFtZXMiOlsidXNlck1lbWJlckZvcm1QYXJ0IiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsInVzZXJNZW1iZXJzaGlwVHlwZUNob2ljZXMiLCJxdWVyeVNlbGVjdG9yQWxsIiwidXNlckVudGVycHJpc2VGb3JtUGFydCIsImZvckVhY2giLCJpdGVtIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJjdXJyZW50VGFyZ2V0IiwiaWQiLCJzdHlsZSIsImRpc3BsYXkiXSwic291cmNlUm9vdCI6IiJ9