(self["webpackChunkprojet_security_response"] = self["webpackChunkprojet_security_response"] || []).push([["password_visibility"],{

/***/ "./assets/password_visibility.js":
/*!***************************************!*\
  !*** ./assets/password_visibility.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.is-array.js */ "./node_modules/core-js/modules/es.array.is-array.js");

__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");

__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");

__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");

__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");

__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");

__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");

__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");

__webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");

__webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");

__webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");

__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

document.addEventListener('DOMContentLoaded', function () {
  var eyes = document.querySelectorAll(".fa-eye-slash");

  var _loop = function _loop(index) {
    var element = _toConsumableArray(eyes)[index];

    element.addEventListener('click', function () {
      changeEye(element);
    });
  };

  for (var index = 0; index < eyes.length; index++) {
    _loop(index);
  }

  var changeEye = function changeEye(element) {
    var password = element.previousElementSibling.children[1];

    if (element.classList.contains("fa-eye-slash")) {
      element.classList.remove('fa-eye-slash');
      element.classList.add('fa-eye');
      password.type = 'text';
    } else {
      element.classList.add('fa-eye-slash');
      element.classList.remove('fa-eye');
      password.type = "password";
    }
  };
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_internals_array-iteration_js-node_modules_core-js_internals_dom--711a0d","vendors-node_modules_core-js_modules_es_string_iterator_js-node_modules_core-js_modules_es_sy-0eab75","vendors-node_modules_core-js_modules_es_array_from_js-node_modules_core-js_modules_es_array_i-d9d6de"], () => (__webpack_exec__("./assets/password_visibility.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoicGFzc3dvcmRfdmlzaWJpbGl0eS5qcyIsIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUFBQSxRQUFRLENBQUNDLGdCQUFULENBQTBCLGtCQUExQixFQUE4QyxZQUFNO0FBQ2xELE1BQU1DLElBQUksR0FBR0YsUUFBUSxDQUFDRyxnQkFBVCxDQUEwQixlQUExQixDQUFiOztBQURrRCw2QkFHekNDLEtBSHlDO0FBSWhELFFBQU1DLE9BQU8sR0FBRyxtQkFBSUgsSUFBSixFQUFVRSxLQUFWLENBQWhCOztBQUNBQyxJQUFBQSxPQUFPLENBQUNKLGdCQUFSLENBQXlCLE9BQXpCLEVBQWtDLFlBQU07QUFDdENLLE1BQUFBLFNBQVMsQ0FBQ0QsT0FBRCxDQUFUO0FBQ0QsS0FGRDtBQUxnRDs7QUFHbEQsT0FBSyxJQUFJRCxLQUFLLEdBQUcsQ0FBakIsRUFBb0JBLEtBQUssR0FBR0YsSUFBSSxDQUFDSyxNQUFqQyxFQUF5Q0gsS0FBSyxFQUE5QyxFQUFrRDtBQUFBLFVBQXpDQSxLQUF5QztBQUtqRDs7QUFFRCxNQUFNRSxTQUFTLEdBQUcsU0FBWkEsU0FBWSxDQUFDRCxPQUFELEVBQWE7QUFDN0IsUUFBSUcsUUFBUSxHQUFHSCxPQUFPLENBQUNJLHNCQUFSLENBQStCQyxRQUEvQixDQUF3QyxDQUF4QyxDQUFmOztBQUVBLFFBQUlMLE9BQU8sQ0FBQ00sU0FBUixDQUFrQkMsUUFBbEIsQ0FBMkIsY0FBM0IsQ0FBSixFQUFnRDtBQUM5Q1AsTUFBQUEsT0FBTyxDQUFDTSxTQUFSLENBQWtCRSxNQUFsQixDQUF5QixjQUF6QjtBQUNBUixNQUFBQSxPQUFPLENBQUNNLFNBQVIsQ0FBa0JHLEdBQWxCLENBQXNCLFFBQXRCO0FBQ0FOLE1BQUFBLFFBQVEsQ0FBQ08sSUFBVCxHQUFnQixNQUFoQjtBQUVELEtBTEQsTUFLTztBQUNMVixNQUFBQSxPQUFPLENBQUNNLFNBQVIsQ0FBa0JHLEdBQWxCLENBQXNCLGNBQXRCO0FBQ0FULE1BQUFBLE9BQU8sQ0FBQ00sU0FBUixDQUFrQkUsTUFBbEIsQ0FBeUIsUUFBekI7QUFDQUwsTUFBQUEsUUFBUSxDQUFDTyxJQUFULEdBQWdCLFVBQWhCO0FBQ0Q7QUFDRixHQWJEO0FBY0QsQ0F4QkQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9wcm9qZXQtc2VjdXJpdHktcmVzcG9uc2UvLi9hc3NldHMvcGFzc3dvcmRfdmlzaWJpbGl0eS5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgKCkgPT4ge1xuICBjb25zdCBleWVzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcIi5mYS1leWUtc2xhc2hcIik7XG5cbiAgZm9yIChsZXQgaW5kZXggPSAwOyBpbmRleCA8IGV5ZXMubGVuZ3RoOyBpbmRleCsrKSB7XG4gICAgY29uc3QgZWxlbWVudCA9IFsuLi5leWVzXVtpbmRleF07XG4gICAgZWxlbWVudC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcbiAgICAgIGNoYW5nZUV5ZShlbGVtZW50KVxuICAgIH0pO1xuICB9XG5cbiAgY29uc3QgY2hhbmdlRXllID0gKGVsZW1lbnQpID0+IHsgICAgXG4gICAgbGV0IHBhc3N3b3JkID0gZWxlbWVudC5wcmV2aW91c0VsZW1lbnRTaWJsaW5nLmNoaWxkcmVuWzFdO1xuXG4gICAgaWYgKGVsZW1lbnQuY2xhc3NMaXN0LmNvbnRhaW5zKFwiZmEtZXllLXNsYXNoXCIpKSB7XG4gICAgICBlbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoJ2ZhLWV5ZS1zbGFzaCcpXG4gICAgICBlbGVtZW50LmNsYXNzTGlzdC5hZGQoJ2ZhLWV5ZScpXG4gICAgICBwYXNzd29yZC50eXBlID0gJ3RleHQnO1xuICAgICAgXG4gICAgfSBlbHNlIHtcbiAgICAgIGVsZW1lbnQuY2xhc3NMaXN0LmFkZCgnZmEtZXllLXNsYXNoJylcbiAgICAgIGVsZW1lbnQuY2xhc3NMaXN0LnJlbW92ZSgnZmEtZXllJylcbiAgICAgIHBhc3N3b3JkLnR5cGUgPSBcInBhc3N3b3JkXCI7XG4gICAgfVxuICB9XG59KTsiXSwibmFtZXMiOlsiZG9jdW1lbnQiLCJhZGRFdmVudExpc3RlbmVyIiwiZXllcyIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJpbmRleCIsImVsZW1lbnQiLCJjaGFuZ2VFeWUiLCJsZW5ndGgiLCJwYXNzd29yZCIsInByZXZpb3VzRWxlbWVudFNpYmxpbmciLCJjaGlsZHJlbiIsImNsYXNzTGlzdCIsImNvbnRhaW5zIiwicmVtb3ZlIiwiYWRkIiwidHlwZSJdLCJzb3VyY2VSb290IjoiIn0=