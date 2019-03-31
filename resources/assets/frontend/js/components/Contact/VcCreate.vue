<template>
  <div>
    <load-component v-if="loading.component"></load-component>
    <div class="container" v-show="!loading.component">
      <h2 class="page-header">{{ trans('strings.contact_us') }}</h2>
      <form id="contacts-create" ref="form" @submit.prevent="handleForm">
        <div class="row">
          <div class="col-lg-3 col-12 col-sm-6 col-md-3">
            <div class="form-group">
              <label for="contacts-name">{{ trans('strings.name') }}*</label>
              <input
                name="name"
                v-model="name"
                type="text"
                class="form-control"
                id="contacts-name"
                aria-describedby="name"
                :placeholder="trans('strings.name')"
              >
            </div>
          </div>
          <div class="col-lg-3 col-12 col-sm-6 col-md-3">
            <div class="form-group">
              <label for="contacts-email">{{ trans('strings.email') }}*</label>
              <input
                name="email"
                v-model="email"
                type="email"
                class="form-control"
                id="contacts-email"
                aria-describedby="email"
                :placeholder="trans('strings.email')"
              >
            </div>
          </div>
          <div class="col-lg-3 col-12 col-sm-6 col-md-3">
            <div class="form-group">
              <label for="contacts-category">{{ trans('strings.category') }}*</label>
              <select
                name="category"
                id="contacts-category"
                v-model="category"
                class="form-control"
                :placeholder="trans('strings.category')"
              >
                <option
                  :key="index"
                  :value="value.id"
                  v-for="(value, index) in categories"
                >{{ value.name }}</option>
              </select>
            </div>
          </div>
          <div class="col-lg-3 col-12 col-sm-6 col-md-3">
            <div class="form-group">
              <label for="contacts-subject">{{ trans('strings.subject') }}*</label>
              <input
                name="subject"
                v-model="subject"
                type="text"
                class="form-control"
                id="contacts-subject"
                aria-describedby="name"
                :placeholder="trans('strings.subject')"
              >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-12 col-sm-12 col-md-12">
            <label
              for="file"
            >{{ trans('strings.file') }} (jpg, png ou pdf). Tamanho de arquivo até 5mb*</label>
            <br>
            <span @click="openFiles" class="btn btn-primary btn-xs">
              <i class="glyphicon glyphicon-plus"></i>
              <span>{{ trans('strings.select_an_file') }}</span>
              <input class="file" @change="changeFile($event)" type="file" name="file" id="file">
            </span>
            <span class="file-name">{{ trans('strings.no_file_selected') }}</span>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12 col-12 col-sm-12 col-md-12">
            <div class="form-group">
              <label for="contacts-description">{{ trans('strings.description') }}*</label>
              <textarea
                name="description"
                v-model="description"
                class="form-control"
                id="contacts-description"
                rows="10"
              ></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-12 col-sm-12 col-md-12">
            <vc-recaptcha ref="recaptcha" :sitekey="sitekey" :callback="recaptchaCallback"></vc-recaptcha>
            <label
              v-if="token === '' && submited == true"
              style="font-size: 10px; color: red;"
            >{{ trans('strings.field_required') }}</label>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12 col-12 col-sm-12 col-md-12">
            <button
              type="submit"
              v-if="!loading.submit"
              class="btn btn-md btn-primary"
            >{{ trans('strings.save_button') }}</button>
            <button v-else @click.prevent type="submit" class="btn btn-md btn-primary">
              <i class="fa fa-refresh fa-spin"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { routes } from "../../api_routes";
import LoadComponent from "../Load";
import VcRecaptcha from "../VcRecaptcha";
export default {
  metaInfo() {
    return {
      title:
        this.trans("strings.contact_us") +
        " | " +
        this.trans("strings.lottoyou"),
      meta: [
        {
          name: "description",
          content: this.trans("strings.contact_us")
        }
      ]
    };
  },
  name: "VcCreate",
  data() {
    return {
      submited: false,
      name: "",
      description: "",
      email: "",
      categories: [],
      subject: "",
      category: 1,
      file: "",
      status_recaptcha: false,
      loading: {
        component: true,
        submit: false
      },
      sitekey: "6LeNc2EUAAAAABpFaOINnceFbni9gooWNYAMHkC6",
      token: ""
    };
  },
  methods: {
    handleForm() {
      this.submited = true;
      var isvalid = $(this.$refs.form).valid();
      if (isvalid) {
        this.store();
      }
    },
    changeFile(event) {
      var file = null;
      //var form = $('.user-edit');
      file = event.currentTarget.files[0];
      if (window.FileReader) {
        $(".file-name").text(file.name);
        var reader = new FileReader();
        reader.onprogress = function(evt) {};
        reader.onloadend = function(e) {
          //form.find('#user-edit-photo').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
      }
    },
    openFiles() {
      document.getElementById("file").click();
    },
    recaptchaCallback(token) {
      this.token = token;
    },
    recaptchaCheckRequest() {
      let recaptchaCheckRequest = axios.create();
      return recaptchaCheckRequest.post(routes.recaptcha.check, {
        token: this.token,
        sitekey: this.sitekey
      });
    },
    getCategories() {
      let categoriesRequest = axios.create();
      categoriesRequest
        .get(routes.contacts.categories)
        .then(response => {
          if (response.status === 200) {
            this.categories = response.data;
          }
        })
        .catch(response => {});
    },
    store() {
      //Verifico se o captcha está ok
      if (this.status_recaptcha) {
        var form = $(this.$el).find("form");
        var formData = new FormData(form[0]);
        let storeRequest = axios.create();
        storeRequest.interceptors.request.use(config => {
          this.loading.submit = true;
          return config;
        });
        storeRequest
          .post(routes.contacts.create, formData, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          })
          .then(response => {
            if (response.status === 200) {
              this.$refs.recaptcha.refresh();
              toastr.options.timeOut = 5000;
              toastr.options.newestOnTop = true;
              toastr.success(
                this.trans("alerts.contacts.create.success"),
                this.trans("strings.success")
              );
              this.submited = false;
              this.name = "";
              this.description = "";
              this.email = "";
              this.subject = "";
              this.category = 1;
              this.file = "";
              this.status_recaptcha = false;
              this.loading.submit = false;
              this.token = "";
            }
          })
          .catch(response => {
            toastr.options.timeOut = 5000;
            toastr.options.newestOnTop = true;
            toastr.error(
              this.trans("alerts.contacts.create.error"),
              this.trans("strings.error")
            );
          });
      } else {
        //Caso não esteja, faço validação e envio os dados do formulário
        this.recaptchaCheckRequest()
          .then(response => {
            if (response.status === 200 && response.data == true) {
              var form = $(this.$el).find("form");
              var formData = new FormData(form[0]);
              let storeRequest = axios.create();
              storeRequest.interceptors.request.use(config => {
                this.loading.submit = true;
                return config;
              });
              storeRequest
                .post(routes.contacts.create, formData, {
                  headers: {
                    "Content-Type": "multipart/form-data"
                  }
                })
                .then(response => {
                  if (response.status === 200) {
                    this.$refs.recaptcha.refresh();
                    toastr.options.timeOut = 5000;
                    toastr.options.newestOnTop = true;
                    toastr.success(
                      this.trans("alerts.contacts.create.success"),
                      this.trans("strings.success")
                    );

                    this.submited = false;
                    this.name = "";
                    this.description = "";
                    this.email = "";
                    this.subject = "";
                    this.category = 1;
                    this.file = "";
                    this.status_recaptcha = false;
                    this.loading.submit = false;
                    this.token = "";
                  }
                })
                .catch(response => {
                  toastr.options.timeOut = 3000;
                  toastr.options.newestOnTop = true;
                  toastr.error(
                    this.trans("alerts.contacts.create.error"),
                    this.trans("strings.error")
                  );
                });
            } else {
              toastr.error("Captcha inválido", this.trans("strings.error"));
            }
            this.status_recaptcha = response.data;
          })
          .catch(response => {
            toastr.error("Captcha inválido", this.trans("strings.error"));
          });
      }
    }
  },
  mounted() {
    this.getCategories();
    //window.document.title = this.trans('crud.contacts.create');
    this.loading.component = false;
    var vm = this;

    $(this.$refs.form).validate({
      rules: {
        email: {
          required: true,
          email: true
        },
        description: {
          required: true
        },
        name: {
          required: true
        },
        subject: {
          required: true
        },
        file: {
          required: true,
          extension: "jpg|jpeg|png|pdf",
          filesize: 5000000
        }
      },
      messages: {
        name: {
          required: vm.trans("strings.field_required")
        },
        description: {
          required: vm.trans("strings.field_required")
        },
        subject: {
          required: vm.trans("strings.field_required")
        },
        email: {
          required: vm.trans("strings.field_required"),
          email: vm.trans("validation.user.create.email.email")
        },
        file: {
          required: vm.trans("strings.field_required"),
          extension: "Arquivo inválido",
          filesize: "Arquivo muito grande"
        }
      },
      highlight: function(input) {
        $(input).addClass("error");
        $(input)
          .parents(".form-control")
          .addClass("error");

        // Se é do tipo file
        if ($(input).attr("type") == "file") {
          let file = $(input);
          if (file.parent().hasClass("btn")) {
            file.parent().addClass("border border-danger");
          }
        }
      },
      unhighlight: function(input) {
        $(input).removeClass("error");
        $(input)
          .parents(".form-control")
          .removeClass("error");

        // Se é do tipo file
        if ($(input).attr("type") == "file") {
          let file = $(input);
          if (file.parent().hasClass("btn")) {
            file.parent().removeClass("border border-danger");
          }
        }
      },
      errorPlacement: function(error, element) {
        $(element)
          .parents(".input-group")
          .append(error);
        $(element)
          .parents(".form-group")
          .append(error);

        if ($(element).attr("type") == "file") {
          let file = $(element);
          if (file.parent().hasClass("btn")) {
            error.addClass("d-block");
            file
              .parent()
              .parent()
              .append(error);
          }
        }
      }
    });

    setTimeout(() => {
      window.prerenderReady = true;
    }, 1000);
  },
  components: {
    LoadComponent,
    VcRecaptcha
  }
};
</script>

<style scoped>
.file {
  visibility: hidden;
  width: 10px;
}
</style>