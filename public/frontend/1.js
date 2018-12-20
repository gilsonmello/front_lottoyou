webpackJsonp([1],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__api_routes__ = __webpack_require__("./resources/assets/frontend/js/api_routes.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vuex__ = __webpack_require__("./node_modules/vuex/dist/vuex.esm.js");
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
    methods: {
        init: function init() {
            var _this = this;

            if (this.$route.params.slug != undefined) {
                this.leaPackage.name = this.trans('strings.loading');
                var slug = this.$route.params.slug;
                this.getLeaguePackagesBySlug(slug).then(function (response) {
                    _this.leaPackage = response.data;
                    _this.meta.push({
                        name: 'description',
                        content: _this.leaPackage.name
                    });
                    _this.loading.component = false;
                }).catch(function (error) {
                    _this.loading.component = false;
                });

                /* this.loading.leagues = true;
                this.getLeaguesOfPackageBySlug(slug)
                    .then((response) => {
                        this.$set(this.leaPackage, 'leagues', response.data);
                        this.loading.leagues = false;
                    })
                    .catch((error) => {
                        this.loading.leagues = false;
                    }); */
            }
        }
    },
    metaInfo: function metaInfo() {
        return {
            title: this.leaPackage.name + ' | ' + this.trans('strings.lottoyou'),
            meta: this.meta
        };
    },
    data: function data() {
        return {
            form: null,
            loading: {
                component: true,
                paying: false,
                leagues: false,
                adding: false
            },
            leaPackage: {
                leagues: []
            },
            indexClicked: null,
            meta: [],
            awards: [],
            step: 0
        };
    },
    mounted: function mounted() {
        this.init();
    },
    beforeRouteUpdate: function beforeRouteUpdate(to, from, next) {
        next();
        this.init();
    },

    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_1_vuex__["mapGetters"])(['auth', 'purchase', 'loginOptions', 'getSystemCurrency'])),
    watch: {}
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00f00387\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.card[data-v-00f00387] {\n    margin-bottom: 10px;\n    cursor: pointer;\n}\n.card .card-header[data-v-00f00387] {\n    background-color: initial;\n}\n.card[data-v-00f00387]:last {\n    margin-bottom: 0;\n}\n.card[data-v-00f00387]:hover {\n    background-color: #f5f5f5;\n    -webkit-box-shadow: 0 2px 0 0 rgba(0,0,0,.4);\n            box-shadow: 0 2px 0 0 rgba(0,0,0,.4);\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-00f00387\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.loading.component == true
    ? _c("load")
    : _c(
        "div",
        { staticClass: "container" },
        [
          _c(
            "div",
            { staticClass: "sub-navigation" },
            [
              _c(
                "router-link",
                {
                  staticClass: "show",
                  attrs: {
                    to: {
                      name: "cartoleando.play",
                      params: { slug: _vm.leaPackage.slug }
                    }
                  }
                },
                [
                  _vm._v(
                    "\n                " +
                      _vm._s(_vm.trans("strings.play_on_the")) +
                      " " +
                      _vm._s(_vm.leaPackage.name) +
                      "\n            "
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "router-link",
                {
                  staticClass: "show active",
                  attrs: {
                    to: {
                      name: "cartoleando.leagues",
                      params: { slug: _vm.leaPackage.slug }
                    },
                    id: "result-component"
                  }
                },
                [
                  _vm._v(
                    "\n                " +
                      _vm._s(_vm.trans("strings.leagues")) +
                      " " +
                      _vm._s(_vm.leaPackage.name) +
                      "\n            "
                  )
                ]
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-lg-12 col-12 col-md-12 col-sm-12" }, [
              _c(
                "h1",
                {
                  staticClass: "page-header",
                  staticStyle: { border: "none", margin: "0" }
                },
                [
                  _vm._v(
                    "\n                    " +
                      _vm._s(_vm.trans("strings.leagues")) +
                      " " +
                      _vm._s(_vm.leaPackage.name) +
                      "\n                "
                  )
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _vm.loading.leagues
            ? _c("load")
            : _vm._l(_vm.leaPackage.leagues, function(league, index) {
                return _c(
                  "div",
                  {
                    key: index,
                    staticClass: "card",
                    on: {
                      click: function($event) {
                        _vm.$router.push({
                          name: "leagues.show",
                          params: { slug: league.slug }
                        })
                      }
                    }
                  },
                  [
                    _c("div", { staticClass: "card-header" }, [
                      _c("div", { staticClass: "row vcenter" }, [
                        _c(
                          "div",
                          { staticClass: "col-lg-2 col-4 col-sm-2 col-md-2" },
                          [
                            _c("img", {
                              staticClass: "img-fluid",
                              attrs: {
                                src:
                                  league.bg_image_domain +
                                  "/" +
                                  league.bg_image,
                                alt: league.name
                              }
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "col-lg-10 col-8 col-sm-10 col-md-10"
                          },
                          [
                            _c("h3", {}, [_vm._v(_vm._s(league.name))]),
                            _vm._v(" "),
                            _c("span", [
                              _vm._v(
                                "\n                            " +
                                  _vm._s(_vm.trans("strings.league")) +
                                  " " +
                                  _vm._s(league.modality) +
                                  " \n                        "
                              )
                            ]),
                            _vm._v(" "),
                            _c("br"),
                            _vm._v(" "),
                            _c("h5", [_vm._v(_vm._s(league.small_description))])
                          ]
                        )
                      ])
                    ])
                  ]
                )
              })
        ],
        2
      )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-00f00387", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00f00387\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00f00387\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("0f0041fc", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00f00387\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcLeague.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00f00387\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcLeague.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-00f00387\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-00f00387\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/Cartoleando/VcLeague.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-00f00387"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/frontend/js/components/Cartoleando/VcLeague.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-00f00387", Component.options)
  } else {
    hotAPI.reload("data-v-00f00387", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});