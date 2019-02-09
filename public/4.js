webpackJsonp([4],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Classic/VcClassic.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__api_routes_js__ = __webpack_require__("./resources/assets/frontend/js/api_routes.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__VcPodium__ = __webpack_require__("./resources/assets/frontend/js/components/League/Classic/VcPodium.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__VcPodium___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__VcPodium__);
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
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
    methods: {
        getTeams: function getTeams() {
            var _this = this;

            var req = axios.create();
            var url = __WEBPACK_IMPORTED_MODULE_0__api_routes_js__["c" /* host */] + '/leagues/' + this.slug + '/classic/teams';
            this.loading.teams = true;
            req.get(url).then(function (response) {
                _this.loading.teams = false;
                _this.teams = response.data;
            }).catch(function (error) {
                _this.loading.teams = false;
            });
        }
    },
    name: 'VcClassic',
    created: function created() {
        this.getTeams();
    },
    mounted: function mounted() {},
    data: function data() {
        return {
            rankingOrder: 'p_c',
            teams: [],
            loading: {
                component: false,
                teams: false
            }
        };
    },

    watch: {
        rankingOrder: function rankingOrder(newValue, oldValue) {
            var len = this.teams.length;
            var aux = null;
            for (var i = 0; i < len; i++) {
                for (var j = i + 1; j < len; j++) {
                    if (this.teams[i][newValue] < this.teams[j][newValue]) {
                        aux = this.teams[i];
                        this.teams[i] = this.teams[j];
                        this.teams[j] = aux;
                    }
                }
            }
        }
    },
    props: ['league', 'slug'],
    components: {
        VcPodium: __WEBPACK_IMPORTED_MODULE_1__VcPodium___default.a
    }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Classic/VcPodium.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    props: ['league']
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Cup/VcCup.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__api_routes_js__ = __webpack_require__("./resources/assets/frontend/js/api_routes.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__VcInProgress__ = __webpack_require__("./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__VcInProgress___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__VcInProgress__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__VcOnVerification__ = __webpack_require__("./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__VcOnVerification___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__VcOnVerification__);
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
    methods: {},
    name: 'VcCup',
    props: ['league'],
    mounted: function mounted() {},
    data: function data() {
        return {
            steps: [],
            teams: [],
            loading: {
                component: false,
                teams: false
            }
        };
    },

    components: {
        VcInProgress: __WEBPACK_IMPORTED_MODULE_1__VcInProgress___default.a,
        VcOnVerification: __WEBPACK_IMPORTED_MODULE_2__VcOnVerification___default.a
    }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__api_routes_js__ = __webpack_require__("./resources/assets/frontend/js/api_routes.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__VcStepKey__ = __webpack_require__("./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__VcStepKey___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__VcStepKey__);
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
        getStepName: function getStepName(typeStep) {
            var types = {
                F: 'Final',
                S: 'Semifinal',
                Q: 'Quartas de Final',
                O: 'Oitavas de Final',
                I: 'Fase Inicial',
                T: '3º Lugar'
            };
            return types[typeStep];
        },
        getSteps: function getSteps() {
            var _this = this;

            var req = axios.create();
            var url = __WEBPACK_IMPORTED_MODULE_0__api_routes_js__["c" /* host */] + '/leagues/' + this.league.slug + '/cup/steps';
            this.loading.steps = true;
            req.get(url).then(function (response) {
                _this.steps = response.data;
                _this.loading.steps = false;
            }).catch(function (error) {
                _this.loading.steps = false;
            });
        }
    },
    props: ['league'],
    mounted: function mounted() {
        this.getSteps();
    },
    data: function data() {
        return {
            steps: [],
            loading: {
                steps: true
            }
        };
    },

    components: {
        VcStepKey: __WEBPACK_IMPORTED_MODULE_1__VcStepKey___default.a
    }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__api_routes_js__ = __webpack_require__("./resources/assets/frontend/js/api_routes.js");
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
        getTeams: function getTeams() {
            var _this = this;

            var req = axios.create();
            var url = __WEBPACK_IMPORTED_MODULE_0__api_routes_js__["c" /* host */] + '/leagues/' + this.league.slug + '/cup/teams';
            this.loading.teams = true;
            req.get(url).then(function (response) {
                _this.loading.teams = false;
                _this.teams = response.data;
            }).catch(function (error) {
                _this.loading.teams = false;
            });
        }
    },
    created: function created() {
        this.getTeams();
    },
    mounted: function mounted() {},

    props: ['league'],
    data: function data() {
        return {
            teams: [],
            loading: {
                teams: true
            }
        };
    }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
        getStepName: function getStepName(typeStep) {
            var types = {
                F: 'Final',
                S: 'Semi',
                Q: 'Quartas',
                O: 'Oitavas',
                I: 'Fase Inicial',
                T: '3º Lugar'
            };
            return types[typeStep];
        }
    },
    props: ['step', 'stepKey', 'index'],
    data: function data() {
        return {};
    },
    mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/VcShow.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__api_routes__ = __webpack_require__("./resources/assets/frontend/js/api_routes.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vuex__ = __webpack_require__("./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Cup_VcCup__ = __webpack_require__("./resources/assets/frontend/js/components/League/Cup/VcCup.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Cup_VcCup___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__Cup_VcCup__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__Classic_VcClassic__ = __webpack_require__("./resources/assets/frontend/js/components/League/Classic/VcClassic.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__Classic_VcClassic___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__Classic_VcClassic__);
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
        getStyleImage: function getStyleImage() {
            var background = 'background-image: url(' + this.league.bg_image_domain + '/' + this.league.bg_image + ')';
            return 'width: 270px; height: 270px; ' + 'background-repeat: no-repeat; background-position: center; ' + 'background-size: cover; ' + background;
        },
        leagueRequest: function leagueRequest(slug) {
            return new Promise(function (resolve, reject) {
                var request = axios.create();
                var url = __WEBPACK_IMPORTED_MODULE_0__api_routes__["d" /* routes */].leagues.show.replace('{slug}', slug);
                request.get(url).then(function (response) {
                    resolve(response);
                }).catch(function (error) {
                    reject(error);
                });
            });
        },
        init: function init() {
            var _this = this;

            if (this.$route.params.slug != undefined) {
                //Setando novas configurações para o modal de login
                this.$store.dispatch('setLoginOptions', {
                    redirectToHome: false,
                    redirectToHomeOnLogout: false
                });
                var slug = this.$route.params.slug;
                this.loading.component = true;
                this.leagueRequest(slug).then(function (response) {
                    _this.loading.component = false;
                    _this.league = response.data;
                }).catch(function (error) {
                    _this.loading.component = false;
                });
            }
        }
    },
    metaInfo: function metaInfo() {
        return {
            title: this.trans('strings.lottoyou'),
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
            league: {},
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
    components: {
        VcCup: __WEBPACK_IMPORTED_MODULE_2__Cup_VcCup___default.a,
        VcClassic: __WEBPACK_IMPORTED_MODULE_3__Classic_VcClassic___default.a
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0a603051\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.identificator[data-v-0a603051] {\n    position: absolute; \n    top: 0; \n    left: 50%; \n    -webkit-transform: translate(-50%, -50%); \n            transform: translate(-50%, -50%);\n    padding: 8px 30px;\n    font-size: 14px;\n    border-radius: 25px;\n    text-transform: uppercase;\n    background-color: #fff;\n    border: 1px solid #e1e1de;\n}\n.row[data-v-0a603051] {\n    position: relative;\n}\n.key[data-v-0a603051] {\n    margin-top: 30px;\n    margin-bottom: 15px;\n    padding-bottom: 20px;\n    padding-top: 20px;\n    border-radius: 4px;\n    background-color: #ececec;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3c660c1c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcCup.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.help-image[data-v-3c660c1c] {\n    height: 167px;\n    overflow: hidden;\n    border-top-left-radius: 5px;\n    border-top-right-radius: 5px;\n    background-repeat: no-repeat;\n    background-position: center;\n    background-size: cover;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4554defe\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/VcShow.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.col-trophy[data-v-4554defe] {\n        -webkit-box-pack: end;\n            -ms-flex-pack: end;\n                justify-content: flex-end;\n}\n.league.quantity-teams[data-v-4554defe] {\n        margin: 0; \n        text-align: center;\n        line-height: 1;\n}\n.league.modality[data-v-4554defe] {\n        text-transform: uppercase;\n}\n.league.participants[data-v-4554defe] {\n        margin: 0; \n        text-align: center;\n        line-height: 1;\n}\n.league.name[data-v-4554defe] {\n        margin: 0; \n        text-transform: uppercase;\n}\n.league.small-description[data-v-4554defe] {\n        margin: 60px 0;\n}\n.card .help-image[data-v-4554defe] {\n        height: 167px;\n        overflow: hidden;\n        border-top-left-radius: 5px;\n        border-top-right-radius: 5px;\n        background-repeat: no-repeat;\n        background-position: center;\n        background-size: cover;\n        background-image: url(https://cartolafc.globo.com/dist/3.18.11/img/tempo.svg)\n}\n.card .card-header[data-v-4554defe] {\n        padding: 0;\n}\n@media (max-width: 992px) {\n}\n@media (max-width: 767px) {\n}\n@media (min-width: 576px) and (max-width: 768px) {\n}\n@media (max-width: 576px) {\n.col-trophy[data-v-4554defe] {\n            -webkit-box-pack: center;\n                -ms-flex-pack: center;\n                    justify-content: center;\n}\n.league.quantity-teams[data-v-4554defe] {\n            text-align: left;\n}\n.league.participants[data-v-4554defe] {\n            text-align: left;\n}\n.league.small-description[data-v-4554defe] {\n            margin: 10px 0;\n}\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4ccb092c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.row-team[data-v-4ccb092c] {       \n        padding: 18px 30px;\n        background-color: #ececec;\n        margin-top: 6px;\n        border-radius: 4px;\n}\n.row-team[data-v-4ccb092c]:last { \n        margin-top: 0;\n}\n.cartola-shield[data-v-4ccb092c] {\n        display: inline-block;\n        width: 5.2rem;\n        position: relative;\n}\n.cartola-shield .shield[data-v-4ccb092c] {\n        width: 100%;\n}\n.cartola-shield .photo[data-v-4ccb092c] {\n        right: -20%;\n        bottom: 0;\n        width: 60%;\n        height: auto;\n        position: absolute;\n        border: 2px solid #fff;\n        border-radius: 50%;\n}\n.cartola-cartoleiro[data-v-4ccb092c] {\n        margin-left: 27px;\n}\n.cartola-cartoleiro h4[data-v-4ccb092c] {\n        margin: 0;\n        line-height: 1;\n}\n.help-image[data-v-4ccb092c] {\n        height: 167px;\n        overflow: hidden;\n        border-top-left-radius: 5px;\n        border-top-right-radius: 5px;\n        background-repeat: no-repeat;\n        background-position: center;\n        background-size: cover;\n}\n@media (max-width: 992px) {\n}\n@media (max-width: 767px) {\n}\n@media (min-width: 576px) and (max-width: 768px) {\n}\n@media (max-width: 576px) {\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5e5b4dcc\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Classic/VcPodium.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.team-shield.winner[data-v-5e5b4dcc] {\n    width: 130px;\n    height: 147px;\n}\n.team-shield.loser[data-v-5e5b4dcc] {\n    height: 70px;\n    width: 70px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dafb278\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Classic/VcClassic.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.row-team[data-v-7dafb278] {       \n    padding: 18px 30px;\n    background-color: #ececec;\n    margin-top: 6px;\n    border-radius: 4px;\n}\n.row-team[data-v-7dafb278]:last { \n    margin-top: 0;\n}\n.cartola-shield[data-v-7dafb278] {\n    display: inline-block;\n    height: 54px;\n    width: 64px;\n    position: relative;\n}\n.cartola-shield .shield[data-v-7dafb278] {\n    width: 45px;\n    height: 50px;\n}\n.cartola-shield .photo[data-v-7dafb278] {\n    right: 0;\n    bottom: 6%;\n    width: 32px;\n    height: 32px;\n    position: absolute;\n    border: 2px solid #fff;\n    border-radius: 50%;\n}\n.cartola-cartoleiro[data-v-7dafb278] {\n    margin-left: 27px;\n}\n.cartola-cartoleiro h4[data-v-7dafb278] {\n    margin: 0;\n    line-height: 1;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-dc2a71f8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n#prev-slide-content[data-v-dc2a71f8] {\n    left: 0; \n    -webkit-box-align: start; \n        -ms-flex-align: start; \n            align-items: flex-start;\n    font-size: 50px;\n    top: 70px;\n    right: auto;\n    width: 30px !important;\n}\n#next-slide-content[data-v-dc2a71f8] {\n    left: auto; \n    -webkit-box-align: start; \n        -ms-flex-align: start; \n            align-items: flex-start;\n    font-size: 50px;\n    top: 70px;\n    right: 0;\n    width: 30px !important;\n}\n.slide[data-v-dc2a71f8]{\n    width: 97%;\n    margin: 0 auto;\n}\n.team-shield.winner[data-v-dc2a71f8] {\n    width: 130px;\n    height: 147px;\n}\n.team-shield.loser[data-v-dc2a71f8] {\n    height: 70px;\n    width: 70px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-0a603051\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "row key",
      style: _vm.index == 0 ? "margin-top: 10px;" : ""
    },
    [
      _c("div", { staticClass: "identificator" }, [
        _c("strong", [
          _vm._v(
            "\n            " +
              _vm._s(_vm.getStepName(_vm.stepKey.type_step)) +
              " " +
              _vm._s(_vm.index + 1) +
              "\n        "
          )
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-xs-12 col-sm-4 col-md-4 col-lg-5" }, [
        _c("div", { staticClass: "row no-margin" }, [
          _c(
            "div",
            {
              staticClass: "col-lg-7 vcenter-end",
              staticStyle: {
                "flex-direction": "column",
                "align-items": "flex-end"
              }
            },
            [
              _vm.stepKey.homeTeam
                ? _c("h5", { staticStyle: { "line-height": "1" } }, [
                    _c("strong", [
                      _vm._v(
                        "\n                        " +
                          _vm._s(_vm.stepKey.homeTeam.time.nome) +
                          "\n                    "
                      )
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.stepKey.homeTeam
                ? _c("h6", { staticStyle: { "line-height": "1" } }, [
                    _vm._v(
                      "\n                    " +
                        _vm._s(_vm.stepKey.homeTeam.time.nome_cartola) +
                        "\n                "
                    )
                  ])
                : _vm._e()
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3 vcenter-end" }, [
            _vm.stepKey.homeTeam
              ? _c("div", [
                  _c("img", {
                    staticClass: "img-fluid",
                    staticStyle: { "max-width": "62px" },
                    attrs: { src: _vm.stepKey.homeTeam.time.url_escudo_svg }
                  })
                ])
              : _vm._e()
          ]),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "col-lg-2 vcenter-end",
              staticStyle: { "align-items": "center" }
            },
            [
              _vm.stepKey.homeTeam
                ? _c("h3", [
                    _vm._v(
                      "\n                    " +
                        _vm._s(
                          _vm.stepKey.home_team_score == null
                            ? "-"
                            : _vm.stepKey.home_team_score
                        ) +
                        "\n                "
                    )
                  ])
                : _vm._e()
            ]
          )
        ])
      ]),
      _vm._v(" "),
      _vm._m(0),
      _vm._v(" "),
      _c("div", { staticClass: "col-xs-12 col-sm-4 col-md-4 col-lg-5" }, [
        _c("div", { staticClass: "row no-margin" }, [
          _c(
            "div",
            {
              staticClass: "col-lg-2 vcenter-end",
              staticStyle: { "align-items": "center" }
            },
            [
              _vm.stepKey.outTeam
                ? _c("h3", [
                    _vm._v(
                      "\n                    " +
                        _vm._s(
                          _vm.stepKey.out_team_score == null
                            ? "-"
                            : _vm.stepKey.out_team_score
                        ) +
                        "\n                "
                    )
                  ])
                : _vm._e()
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3 vcenter-end" }, [
            _c("div", [
              _vm.stepKey.outTeam
                ? _c("img", {
                    staticClass: "img-fluid",
                    staticStyle: { "max-width": "62px" },
                    attrs: { src: _vm.stepKey.outTeam.time.url_escudo_svg }
                  })
                : _vm._e()
            ])
          ]),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "col-lg-7 vcenter-end",
              staticStyle: {
                "flex-direction": "column",
                "align-items": "flex-start"
              }
            },
            [
              _vm.stepKey.outTeam
                ? _c("h5", { staticStyle: { "line-height": "1" } }, [
                    _c("strong", [
                      _vm._v(
                        "\n                        " +
                          _vm._s(_vm.stepKey.outTeam.time.nome) +
                          "\n                    "
                      )
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.stepKey.outTeam
                ? _c("h6", { staticStyle: { "line-height": "1" } }, [
                    _vm._v(
                      "\n                    " +
                        _vm._s(_vm.stepKey.outTeam.time.nome_cartola) +
                        "\n                "
                    )
                  ])
                : _vm._e()
            ]
          )
        ])
      ])
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "col-xs-12 col-sm-4 col-md-4 col-lg-2 vcenter",
        staticStyle: { "justify-content": "center" }
      },
      [_c("h3", [_vm._v("X")])]
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0a603051", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-3c660c1c\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Cup/VcCup.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.league.cup.in_progress === 0
        ? _c("vc-on-verification", {
            attrs: { league: _vm.league, teams: _vm.teams }
          })
        : _vm._e(),
      _vm._v(" "),
      _vm.league.cup.in_progress === 1
        ? _c("vc-in-progress", { attrs: { league: _vm.league } })
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3c660c1c", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-4554defe\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/VcShow.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.loading.component
    ? _c("load")
    : !_vm.loading.component && _vm.league.name
      ? _c(
          "div",
          { staticClass: "container" },
          [
            _c("br"),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c(
                "div",
                { staticClass: "col-lg-5 col-12 col-sm-6 vcenter col-trophy" },
                [
                  _c("div", {
                    staticClass: "img-fluid",
                    style: _vm.getStyleImage()
                  })
                ]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-5 col-12 col-sm-6" }, [
                _c("div", { staticClass: "row" }, [
                  _c(
                    "div",
                    { staticClass: "col-lg-12 col-12 col-md-12 col-sm-12" },
                    [
                      _c("small", { staticClass: "league modality" }, [
                        _c("strong", [_vm._v(_vm._s(_vm.league.modality))])
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "col-lg-12 col-12 col-md-12 col-sm-12" },
                    [
                      _c("h1", { staticClass: "league name" }, [
                        _vm._v(
                          "\n                        " +
                            _vm._s(_vm.league.name) +
                            "\n                    "
                        )
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "col-lg-12 col-12 col-md-12 col-sm-12" },
                    [
                      _c("h4", { staticClass: "league small-description" }, [
                        _vm._v(
                          "\n                        " +
                            _vm._s(_vm.league.small_description) +
                            "\n                    "
                        )
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "col-lg-3 col-12 col-md-12 col-sm-12" },
                    [
                      _c("div", [
                        _c("p", { staticClass: "league quantity-teams" }, [
                          _c("strong", [
                            _vm._v(_vm._s(_vm.league.quantity_teams))
                          ])
                        ]),
                        _vm._v(" "),
                        _c("h5", { staticClass: "league participants" }, [
                          _vm._v(
                            "\n                            " +
                              _vm._s(_vm.trans("strings.participants")) +
                              "\n                        "
                          )
                        ])
                      ])
                    ]
                  )
                ])
              ])
            ]),
            _vm._v(" "),
            _c("br"),
            _vm._v(" "),
            _vm.league.context === "cup"
              ? _c("vc-cup", { attrs: { league: _vm.league } })
              : _vm.league.context === "classic"
                ? _c("vc-classic", {
                    attrs: { league: _vm.league, slug: _vm.league.slug }
                  })
                : _vm._e()
          ],
          1
        )
      : _c("div", { staticClass: "container" }, [
          _c("br"),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("h1", [
              _c("a", { attrs: { href: _vm.$route.fullPath } }, [
                _vm._v("Erro ao carregar a liga, tente novamente")
              ])
            ])
          ])
        ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4554defe", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-4ccb092c\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.loading.teams
    ? _c("load")
    : _c("div", [
        _c("br"),
        _vm._v(" "),
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-12" }, [
            _c("h1", [_vm._v("Como funciona")])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-lg-4 col-md-4 col-sm-12 col-12" }, [
            _c("div", { staticClass: "card" }, [
              _c(
                "div",
                { staticClass: "card-header", staticStyle: { padding: "0" } },
                [
                  _c("div", {
                    staticClass: "help-image",
                    staticStyle: {
                      "background-image":
                        "url(https://cartolafc.globo.com/dist/3.18.14/img/tempo.svg)"
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "card-body" }, [
                _c("h4", [_c("strong", [_vm._v("Duração")])]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(
                    "\n                        O mata-mata é uma liga rápida que pode durar de 2 a 5 rodadas. Todo mundo pode participar, mas só quem é Cartoleiro PRO pode criá-lo!\n                    "
                  )
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-4 col-md-4 col-sm-12 col-12" }, [
            _c("div", { staticClass: "card" }, [
              _c(
                "div",
                { staticClass: "card-header", staticStyle: { padding: "0" } },
                [
                  _c("div", {
                    staticClass: "help-image",
                    staticStyle: {
                      "background-image":
                        "url(https://cartolafc.globo.com/dist/3.18.14/img/disputa.svg)"
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "card-body" }, [
                _c("h4", [_c("strong", [_vm._v("Disputa")])]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(
                    "\n                        A cada rodada os times disputam dois a dois para ver qual faz mais pontos - quem perde sai, quem ganha garante seu lugar nas disputas da rodada seguinte.\n                    "
                  )
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-4 col-md-4 col-sm-12 col-12" }, [
            _c(
              "div",
              { staticClass: "card", staticStyle: { "min-height": "350px" } },
              [
                _c(
                  "div",
                  { staticClass: "card-header", staticStyle: { padding: "0" } },
                  [
                    _c("div", {
                      staticClass: "help-image",
                      staticStyle: {
                        "background-image":
                          "url(https://cartolafc.globo.com/dist/3.18.14/img/trofeu.svg)"
                      }
                    })
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "card-body" }, [
                  _c("h4", [_c("strong", [_vm._v("Vencedor")])]),
                  _vm._v(" "),
                  _c("p", [
                    _vm._v(
                      "\n                        Ao final, dois times disputam a Taça do Campeão! O terceiro lugar é disputado entre os dois times que perderam na semifinal.\n                    "
                    )
                  ])
                ])
              ]
            )
          ])
        ]),
        _vm._v(" "),
        _c("br"),
        _vm._v(" "),
        _vm.teams.length > 0
          ? _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-12" }, [
                _c("h1", { staticStyle: { display: "inline-block" } }, [
                  _vm._v(
                    "\n                " +
                      _vm._s(_vm.trans("strings.participants")) +
                      "\n            "
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.teams.length > 0
          ? _c(
              "div",
              { staticClass: "row" },
              _vm._l(_vm.teams, function(team, index) {
                return _c(
                  "div",
                  {
                    key: index,
                    staticClass: "col-12 col-lg-6 col-sm-6 col-md-6"
                  },
                  [
                    _c("div", { staticClass: "row no-margin row-team" }, [
                      _c("div", { staticClass: "col-lg-1" }, [
                        _c("img", {
                          attrs: {
                            alt: "confirmado na liga",
                            title: "confirmado na liga",
                            src:
                              "https://cartolafc.globo.com/dist/3.18.13/img/icone_aprovado.svg"
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-lg-3" }, [
                        _c("div", { staticClass: "cartola-shield" }, [
                          _c("img", {
                            staticClass: "shield",
                            attrs: {
                              src: team.team.time.url_escudo_svg,
                              alt: team.team.time.nome
                            }
                          }),
                          _vm._v(" "),
                          _c("img", {
                            staticClass: "photo",
                            attrs: {
                              src: team.team.time.foto_perfil,
                              alt: team.team.time.nome
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-lg-8" }, [
                        _c("div", { staticClass: "cartola-cartoleiro" }, [
                          _c("h4", [
                            _c("strong", [_vm._v(_vm._s(team.team.time.nome))])
                          ]),
                          _vm._v(" "),
                          _c("h4", [
                            _vm._v(_vm._s(team.team.time.nome_cartola))
                          ])
                        ])
                      ])
                    ])
                  ]
                )
              })
            )
          : _vm._e(),
        _vm._v(" "),
        _vm.teams.length == 0
          ? _c("div", { staticClass: "row vcenter" }, [
              _c("div", { staticClass: "col-12" }, [
                _c("h1", [
                  _vm._v("Ainda não há nenhum time cadastrado nesta liga")
                ])
              ])
            ])
          : _vm._e()
      ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4ccb092c", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-5e5b4dcc\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Classic/VcPodium.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.league.classic.winner_id
      ? _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-12 col-lg-6" }, [
            _c("div", { staticClass: "row no-margin" }, [
              _c("div", { staticClass: "col-lg-3" }, [
                _c("div", [
                  _c("img", {
                    staticClass: "img-fluid team-shield winner",
                    attrs: {
                      src: _vm.league.classic.winnerTeam.time.url_escudo_svg
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass: "col-lg-9 vcenter",
                  staticStyle: {
                    "flex-direction": "column",
                    "justify-content": "center",
                    "align-items": "flex-start"
                  }
                },
                [
                  _c("h4", {}, [_vm._v("CAMPEÃO")]),
                  _vm._v(" "),
                  _c("p", { staticClass: "no-margin" }, [
                    _vm._v(
                      "\n                        Parabéns " +
                        _vm._s(
                          _vm.league.classic.winnerTeam.time.nome_cartola
                        ) +
                        "!"
                    ),
                    _c("br"),
                    _vm._v(
                      "\n                        Você ganhou a taça, foi o mito da liga e pode tirar onda com a galera. Prepare seu time para novas conquistas.\n                    "
                    )
                  ])
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3" }, [
            _c("div", { staticClass: "row no-margin" }, [
              _vm._m(0),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-12 vcenter-end" }, [
                _c("div", [
                  _c("img", {
                    staticClass: "img-fluid team-shield loser",
                    attrs: {
                      src: _vm.league.classic.loserTeam.time.url_escudo_svg
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-12" }, [
                _c(
                  "h4",
                  {
                    staticClass: "text-center",
                    staticStyle: { margin: "10px 0 0 0" }
                  },
                  [_vm._v(_vm._s(_vm.league.classic.loserTeam.time.nome))]
                ),
                _vm._v(" "),
                _c("p", { staticClass: "text-center no-margin" }, [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.league.classic.loserTeam.time.nome_cartola) +
                      "                            \n                    "
                  )
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3" }, [
            _c("div", { staticClass: "row no-margin" }, [
              _vm._m(1),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-12 vcenter-end" }, [
                _c("div", [
                  _c("img", {
                    staticClass: "img-fluid team-shield loser",
                    attrs: {
                      src: _vm.league.classic.thirdTeam.time.url_escudo_svg
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-12" }, [
                _c(
                  "h4",
                  {
                    staticClass: "text-center",
                    staticStyle: { margin: "10px 0 0 0" }
                  },
                  [_vm._v(_vm._s(_vm.league.classic.thirdTeam.time.nome))]
                ),
                _vm._v(" "),
                _c("p", { staticClass: "text-center no-margin" }, [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.league.classic.thirdTeam.time.nome_cartola) +
                      "                            \n                    "
                  )
                ])
              ])
            ])
          ])
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-lg-12" }, [
      _c("h6", { staticClass: "text-center" }, [
        _c("strong", [
          _vm._v(
            "\n                            2º Lugar\n                        "
          )
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-lg-12" }, [
      _c("h6", { staticClass: "text-center" }, [
        _c("strong", [
          _vm._v(
            "\n                            3º Lugar\n                        "
          )
        ])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-5e5b4dcc", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-7dafb278\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Classic/VcClassic.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.loading.teams
    ? _c("load")
    : _c(
        "div",
        [
          _c("br"),
          _vm._v(" "),
          _vm.league.classic.show_podium
            ? _c("vc-podium", { attrs: { league: _vm.league } })
            : _vm._e(),
          _vm._v(" "),
          _vm.teams.length > 0
            ? _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-12" }, [
                  _c("h1", { staticStyle: { display: "inline-block" } }, [
                    _vm._v("Ranking")
                  ]),
                  _vm._v(" "),
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.rankingOrder,
                          expression: "rankingOrder"
                        }
                      ],
                      staticClass: "form-control",
                      staticStyle: {
                        display: "inline-block",
                        width: "initial"
                      },
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.rankingOrder = $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        }
                      }
                    },
                    [
                      _c("option", { domProps: { value: "p_c" } }, [
                        _vm._v("do campeonato")
                      ]),
                      _vm._v(" "),
                      _c("option", { domProps: { value: "p_t" } }, [
                        _vm._v("do turno")
                      ]),
                      _vm._v(" "),
                      _c("option", { domProps: { value: "p_m" } }, [
                        _vm._v("do mês")
                      ]),
                      _vm._v(" "),
                      _c("option", { domProps: { value: "p_r" } }, [
                        _vm._v("da última rodada")
                      ]),
                      _vm._v(" "),
                      _c("option", { domProps: { value: "p_p" } }, [
                        _vm._v("por patrimônio")
                      ])
                    ]
                  )
                ])
              ])
            : _vm._e(),
          _vm._v(" "),
          _c("br"),
          _vm._v(" "),
          _vm.teams.length > 0
            ? _c(
                "div",
                {
                  staticClass: "row row-team no-margin",
                  staticStyle: {
                    "padding-left": "30px",
                    "padding-right": "30px"
                  }
                },
                [
                  _c(
                    "div",
                    { staticClass: "col-4 col-sm-4 col-md-4 col-lg-8 col-4" },
                    [_c("strong", [_vm._v(_vm._s(_vm.trans("strings.team")))])]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass:
                        "col-lg-2 col-4 col-sm-4 col-md-4 vcenter-end"
                    },
                    [
                      _c("strong", [
                        _vm._v(_vm._s(_vm.trans("strings.punctuation")))
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass:
                        "col-lg-2 col-4 col-sm-4 col-md-4 vcenter-end"
                    },
                    [
                      _c("strong", [
                        _vm._v(_vm._s(_vm.trans("strings.position")))
                      ])
                    ]
                  )
                ]
              )
            : _vm._e(),
          _vm._v(" "),
          _vm._l(_vm.teams, function(team, index) {
            return _vm.teams.length > 0
              ? _c(
                  "div",
                  { key: index, staticClass: "row vcenter row-team no-margin" },
                  [
                    _c(
                      "div",
                      {
                        staticClass: "col-4 col-sm-4 col-md-4 col-lg-8 vcenter"
                      },
                      [
                        _c("div", { staticClass: "cartola-shield" }, [
                          _c("img", {
                            staticClass: "shield",
                            attrs: {
                              src: team.team.time.url_escudo_svg,
                              alt: team.team.time.nome
                            }
                          }),
                          _vm._v(" "),
                          _c("img", {
                            staticClass: "photo",
                            attrs: {
                              src: team.team.time.foto_perfil,
                              alt: team.team.time.nome
                            }
                          })
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "cartola-cartoleiro" }, [
                          _c("h4", [
                            _c("strong", [_vm._v(_vm._s(team.team.time.nome))])
                          ]),
                          _vm._v(" "),
                          _c("h4", [
                            _vm._v(_vm._s(team.team.time.nome_cartola))
                          ])
                        ])
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass:
                          "col-4 col-sm-4 col-md-4 col-lg-2 vcenter-end"
                      },
                      [
                        _vm._v(
                          "\n            " +
                            _vm._s(
                              team[_vm.rankingOrder] == null
                                ? "-"
                                : team[_vm.rankingOrder]
                            ) +
                            "\n        "
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass:
                          "col-4 col-sm-4 col-md-4 col-lg-2 vcenter-end"
                      },
                      [
                        _vm._v(
                          "\n            " +
                            _vm._s(
                              team.position == null ? "-" : team.position
                            ) +
                            "\n        "
                        )
                      ]
                    )
                  ]
                )
              : _vm._e()
          }),
          _vm._v(" "),
          _vm.teams.length == 0
            ? _c("div", { staticClass: "row vcenter" }, [
                _c("div", { staticClass: "col-12" }, [
                  _c("h1", [
                    _vm._v("Ainda não há nenhum time cadastrado nesta liga")
                  ])
                ])
              ])
            : _vm._e()
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
    require("vue-hot-reload-api")      .rerender("data-v-7dafb278", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-dc2a71f8\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.loading.steps
    ? _c("load")
    : _c("div", [
        _c("br"),
        _vm._v(" "),
        _vm.league.cup.winner_id
          ? _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-12 col-lg-6" }, [
                _c("div", { staticClass: "row no-margin" }, [
                  _c("div", { staticClass: "col-lg-3" }, [
                    _c("div", [
                      _c("img", {
                        staticClass: "img-fluid team-shield winner",
                        attrs: {
                          src: _vm.league.cup.winnerTeam.time.url_escudo_svg
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "col-lg-9 vcenter",
                      staticStyle: {
                        "flex-direction": "column",
                        "justify-content": "center",
                        "align-items": "flex-start"
                      }
                    },
                    [
                      _c("h4", {}, [_vm._v("CAMPEÃO")]),
                      _vm._v(" "),
                      _c("p", { staticClass: "no-margin" }, [
                        _vm._v(
                          "\n                        Parabéns " +
                            _vm._s(
                              _vm.league.cup.winnerTeam.time.nome_cartola
                            ) +
                            "!"
                        ),
                        _c("br"),
                        _vm._v(
                          "\n                        Você ganhou a taça, foi o mito da liga e pode tirar onda com a galera. Prepare seu time para novas conquistas.\n                    "
                        )
                      ])
                    ]
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-3" }, [
                _c("div", { staticClass: "row no-margin" }, [
                  _c("div", { staticClass: "col-lg-12" }, [
                    _c("h6", { staticClass: "text-center" }, [
                      _c("strong", [
                        _vm._v(
                          "\n                            2º Lugar\n                        "
                        )
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-lg-12 vcenter-end" }, [
                    _c("div", [
                      _c("img", {
                        staticClass: "img-fluid team-shield loser",
                        attrs: {
                          src: _vm.league.cup.loserTeam.time.url_escudo_svg
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-lg-12" }, [
                    _c(
                      "h4",
                      {
                        staticClass: "text-center",
                        staticStyle: { margin: "10px 0 0 0" }
                      },
                      [_vm._v(_vm._s(_vm.league.cup.loserTeam.time.nome))]
                    ),
                    _vm._v(" "),
                    _c("p", { staticClass: "text-center no-margin" }, [
                      _vm._v(
                        "\n                        " +
                          _vm._s(_vm.league.cup.loserTeam.time.nome_cartola) +
                          "                            \n                    "
                      )
                    ])
                  ])
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-lg-3" }, [
                _c("div", { staticClass: "row no-margin" }, [
                  _c("div", { staticClass: "col-lg-12" }, [
                    _c("h6", { staticClass: "text-center" }, [
                      _c("strong", [
                        _vm._v(
                          "\n                            3º Lugar\n                        "
                        )
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-lg-12 vcenter-end" }, [
                    _c("div", [
                      _c("img", {
                        staticClass: "img-fluid team-shield loser",
                        attrs: {
                          src: _vm.league.cup.thirdTeam.time.url_escudo_svg
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-lg-12" }, [
                    _c(
                      "h4",
                      {
                        staticClass: "text-center",
                        staticStyle: { margin: "10px 0 0 0" }
                      },
                      [_vm._v(_vm._s(_vm.league.cup.thirdTeam.time.nome))]
                    ),
                    _vm._v(" "),
                    _c("p", { staticClass: "text-center no-margin" }, [
                      _vm._v(
                        "\n                        " +
                          _vm._s(_vm.league.cup.thirdTeam.time.nome_cartola) +
                          "                            \n                    "
                      )
                    ])
                  ])
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _c("br"),
        _vm._v(" "),
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-lg-12" }, [
            _c(
              "div",
              {
                staticClass: "carousel slide",
                attrs: {
                  id: "carouselExampleIndicators",
                  "data-ride": "carousel",
                  "data-interval": "false"
                }
              },
              [
                _c(
                  "ol",
                  {
                    staticClass: "carousel-indicators",
                    staticStyle: { bottom: "-46px" }
                  },
                  _vm._l(_vm.steps, function(step, index) {
                    return _c("li", {
                      key: index,
                      class: step.current_step == 1 ? "active" : "",
                      attrs: {
                        "data-target": "#carouselExampleIndicators",
                        "data-slide-to": index
                      }
                    })
                  })
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "carousel-inner", attrs: { role: "listbox" } },
                  _vm._l(_vm.steps, function(step, index) {
                    return _c(
                      "div",
                      {
                        key: index,
                        class:
                          step.current_step == 1
                            ? "carousel-item active"
                            : "carousel-item"
                      },
                      [
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "col-12" }, [
                            _c("h1", { staticClass: "text-center" }, [
                              _vm._v(_vm._s(_vm.getStepName(step.type_step)))
                            ]),
                            _vm._v(" "),
                            _c("h4", { staticClass: "text-center" }, [
                              _vm._v(
                                _vm._s(step.round) + "ª RODADA DO BRASILEIRÃO"
                              )
                            ])
                          ])
                        ]),
                        _vm._v(" "),
                        _c("br"),
                        _vm._v(" "),
                        _vm._l(step.keys, function(stepKey, indexKey) {
                          return _c("vc-step-key", {
                            key: indexKey,
                            attrs: {
                              step: step,
                              stepKey: stepKey,
                              index: indexKey
                            }
                          })
                        })
                      ],
                      2
                    )
                  })
                )
              ]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass: "carousel-control-prev",
                attrs: {
                  id: "prev-slide-content",
                  href: "#carouselExampleIndicators",
                  role: "button",
                  "data-slide": "prev"
                }
              },
              [
                _c("span", {
                  staticClass: "fa fa-angle-left",
                  staticStyle: { color: "black" }
                }),
                _vm._v(" "),
                _c("span", { staticClass: "sr-only" }, [_vm._v("Previous")])
              ]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass: "carousel-control-next",
                attrs: {
                  id: "next-slide-content",
                  href: "#carouselExampleIndicators",
                  role: "button",
                  "data-slide": "next"
                }
              },
              [
                _c("span", {
                  staticClass: "fa fa-angle-right",
                  staticStyle: { color: "black" }
                }),
                _vm._v(" "),
                _c("span", { staticClass: "sr-only" }, [_vm._v("Next")])
              ]
            )
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "row", attrs: { id: "conteudo" } }, [
          _c("div", {
            staticClass: "col-lg-12",
            staticStyle: { "min-height": "50px", "background-color": "#fff" }
          })
        ])
      ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-dc2a71f8", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0a603051\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0a603051\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("4ef56487", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0a603051\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcStepKey.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0a603051\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcStepKey.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3c660c1c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcCup.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3c660c1c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcCup.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("4360e7d8", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3c660c1c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcCup.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3c660c1c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcCup.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4554defe\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/VcShow.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4554defe\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/VcShow.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("c51c14c6", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4554defe\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcShow.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4554defe\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcShow.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4ccb092c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4ccb092c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("0344364b", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4ccb092c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcOnVerification.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4ccb092c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcOnVerification.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5e5b4dcc\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Classic/VcPodium.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5e5b4dcc\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Classic/VcPodium.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("02590be0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5e5b4dcc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcPodium.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5e5b4dcc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcPodium.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dafb278\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Classic/VcClassic.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dafb278\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Classic/VcClassic.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("7bfded7a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dafb278\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcClassic.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dafb278\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcClassic.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-dc2a71f8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-dc2a71f8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("643c330d", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-dc2a71f8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcInProgress.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-dc2a71f8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./VcInProgress.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/frontend/js/components/League/Classic/VcClassic.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7dafb278\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Classic/VcClassic.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Classic/VcClassic.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-7dafb278\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Classic/VcClassic.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7dafb278"
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
Component.options.__file = "resources/assets/frontend/js/components/League/Classic/VcClassic.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7dafb278", Component.options)
  } else {
    hotAPI.reload("data-v-7dafb278", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/frontend/js/components/League/Classic/VcPodium.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5e5b4dcc\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Classic/VcPodium.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Classic/VcPodium.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-5e5b4dcc\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Classic/VcPodium.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-5e5b4dcc"
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
Component.options.__file = "resources/assets/frontend/js/components/League/Classic/VcPodium.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5e5b4dcc", Component.options)
  } else {
    hotAPI.reload("data-v-5e5b4dcc", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/frontend/js/components/League/Cup/VcCup.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3c660c1c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcCup.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Cup/VcCup.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-3c660c1c\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Cup/VcCup.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3c660c1c"
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
Component.options.__file = "resources/assets/frontend/js/components/League/Cup/VcCup.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3c660c1c", Component.options)
  } else {
    hotAPI.reload("data-v-3c660c1c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-dc2a71f8\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-dc2a71f8\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Cup/VcInProgress.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-dc2a71f8"
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
Component.options.__file = "resources/assets/frontend/js/components/League/Cup/VcInProgress.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-dc2a71f8", Component.options)
  } else {
    hotAPI.reload("data-v-dc2a71f8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4ccb092c\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-4ccb092c\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-4ccb092c"
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
Component.options.__file = "resources/assets/frontend/js/components/League/Cup/VcOnVerification.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4ccb092c", Component.options)
  } else {
    hotAPI.reload("data-v-4ccb092c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0a603051\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-0a603051\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/Cup/VcStepKey.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-0a603051"
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
Component.options.__file = "resources/assets/frontend/js/components/League/Cup/VcStepKey.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0a603051", Component.options)
  } else {
    hotAPI.reload("data-v-0a603051", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/assets/frontend/js/components/League/VcShow.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4554defe\",\"scoped\":true,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/frontend/js/components/League/VcShow.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}],[\"env\",{\"modules\":false}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}],\"babel-plugin-syntax-dynamic-import\",\"transform-object-rest-spread\"]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/frontend/js/components/League/VcShow.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-4554defe\",\"hasScoped\":true,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/frontend/js/components/League/VcShow.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-4554defe"
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
Component.options.__file = "resources/assets/frontend/js/components/League/VcShow.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4554defe", Component.options)
  } else {
    hotAPI.reload("data-v-4554defe", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});