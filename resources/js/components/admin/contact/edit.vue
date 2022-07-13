<template>
  <div class="container">
    <div class="fade-in">
      <CRow>
        <CCol :sm="12">
          <CCard>
            <VeeForm
              as="div"
              v-slot="{ handleSubmit }"
              @invalid-submit="onInvalidSubmit"
            >
              <form
                method="POST"
                @submit="handleSubmit($event, onSubmit)"
                :action="data.urlUpdate"
                ref="formData"
              >
                <Field type="hidden" :value="csrfToken" name="_token" />
                <Field type="hidden" value="PUT" name="_method" />
                <CCardHeader>
                  <CFormLabel>問い合わせ編集</CFormLabel>
                </CCardHeader>
                <CCardBody>
                  <CRow class="mb-2">
                    <div class="col-sm-3" align="right"
                      >お名前 (姓):
                    </div>
                    <div class="col-sm-6">
                      {{model.first_name}}
                    </div>
                  </CRow>
                  <CRow class="mb-2">
                    <div class="col-sm-3" align="right"
                      >お名前 (名):
                    </div>
                    <div class="col-sm-6">
                      {{model.last_name}}
                    </div>
                  </CRow>
                  <CRow class="mb-2">
                    <div class="col-sm-3" align="right"
                      >ふりがな (姓):
                    </div>
                    <div class="col-sm-6">
                      {{model.first_name_furigana}}
                    </div>
                  </CRow>

                  <CRow class="mb-2">
                    <div class="col-sm-3" align="right"
                      >ふりがな (名):
                    </div>
                    <div class="col-sm-6">
                      {{model.last_name_furigana}}
                    </div>
                  </CRow>

                  <CRow class="mb-2">
                    <div class="col-sm-3" align="right"
                      >メールアドレス:
                    </div>
                    <div class="col-sm-6">
                      {{model.email}}
                    </div>
                  </CRow>
                  
                  <CRow class="mb-2">
                    <div class="col-sm-3" align="right"
                      >問い合わせ内容:
                    </div>
                    <nl2br :text="model.content" class="col-sm-6 content-break" style="margin-bottom: 0%;"/>
                    <!-- <div class="col-sm-6">
                      {{model.content}}
                    </div> -->
                  </CRow>

                  <CRow class="mb-2">
                    <div class="col-sm-3" align="right"
                      >連絡先タイプ:
                    </div>
                    <div class="col-sm-6">
                      {{model.contact_type}}
                    </div>
                  </CRow>

                  <CRow class="mb-2">
                    <CFormLabel class="col-sm-3 lbl-input" require
                      >状態:</CFormLabel
                    >
                    <div class="col-sm-6">
                      <select name="status" class="form-select" v-model="model.status">
                        <option v-for="status in model.status_list" :value="status.status">{{status.text}}</option>
                      </select>
                    </div>
                  </CRow>
                  
                </CCardBody>
                <CCardFooter>
                  <div class="col-md-12 text-center btn-box">
                    <CButton type="submit" class="btn-primary btn-w-100">
                      登録
                    </CButton>
                    <a :href="data.urlBack" class="btn btn-default btn-w-100">
                      キャンセル
                    </a>
                  </div>
                </CCardFooter>
              </form>
            </VeeForm>
          </CCard>
        </CCol>
      </CRow>
    </div>
    <loader :flag-show="flagShowLoader"></loader>
  </div>
</template>

<script>
import Loader from "../../common/loader";
import {
  Form as VeeForm,
  Field,
  ErrorMessage,
  defineRule,
  configure,
} from "vee-validate";
import { localize } from "@vee-validate/i18n";
import * as rules from "@vee-validate/rules";
import $ from "jquery";
import Nl2br from 'vue3-nl2br';

export default {
  setup() {
    Object.keys(rules).forEach((rule) => {
      if (rule != "default") {
        defineRule(rule, rules[rule]);
      }
    });
  },
  components: {
    Loader,
    VeeForm,
    Field,
    ErrorMessage,
    Nl2br
  },
  props: ["data"],
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,
      flagShowLoader: false,
      model: {
          first_name:this.data.contact.first_name,
          last_name:this.data.contact.last_name,
          first_name_furigana:this.data.contact.first_name_furigana,
          last_name_furigana:this.data.contact.last_name_furigana,
          email:this.data.contact.email,
          content:this.data.contact.content,
          contact_type:this.data.contact.contact_type,
          status:this.data.contact.status,
          status_text:this.data.contact.contact_status_text,
          status_list:this.data.contact_status_list
      },
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          status: {
            required: "問い合わせ名を入力してください。",
          }
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
  },
  methods: {
    onInvalidSubmit({ values, errors, results }) {
      let firstInputError = Object.entries(errors)[0][0];
      this.$el.querySelector("input[name=" + firstInputError + "]").focus();
      $("html, body").animate(
        {
          scrollTop:
            $("input[name=" + firstInputError + "]").offset().top - 150,
        },
        500
      );
    },
    onSubmit() {
      this.flagShowLoader = true;
      this.$refs.formData.submit();
    },
  },
};
</script>
