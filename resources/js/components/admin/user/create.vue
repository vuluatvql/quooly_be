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
                :action="data.urlStore"
                ref="formData"
              >
                <Field type="hidden" :value="csrfToken" name="_token" />
                <CCardBody>
                  <CRow class="mb-4">
                    <h3>ユーザー詳細_編集画面</h3>
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >姓名</CFormLabel
                    >
                    <div class="col-sm-3">
                      <Field
                        name="first_name"
                        v-model="model.first_name"
                        rules="required"
                        class="form-control"

                      />
                      <ErrorMessage class="error" name="first_name" />
                    </div>
                    <div class="col-sm-3">
                      <Field
                        name="last_name"
                        v-model="model.last_name"
                        rules="required"
                        class="form-control"
                        placeholder="例）太郎"
                      />
                      <ErrorMessage class="error" name="last_name" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >せいめい</CFormLabel
                    >
                    <div class="col-sm-3">
                      <Field
                        name="first_name_furigana"
                        v-model="model.first_name_furigana"
                        rules="required|is_furigana"
                        class="form-control"
                        placeholder="例）やまだ"

                      />
                      <ErrorMessage class="error" name="first_name_furigana" />
                    </div>
                    <div class="col-sm-3">
                      <Field
                        name="last_name_furigana"
                        v-model="model.last_name_furigana"
                        rules="required|is_furigana"
                        class="form-control"
                        placeholder="例）太郎"
                      />
                      <ErrorMessage class="error" name="last_name_furigana" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >郵便番号（ハイフンなし）</CFormLabel
                    >
                    <div class="col-sm-3">
                      <Field
                        name="postcode"
                        v-model="model.postcode"
                        rules="required|max:10"
                        class="form-control"
                        placeholder="例）01234567"

                      />
                      <ErrorMessage class="error" name="postcode" />
                    </div>
                    <div class="col-sm-3">
                      <CButton
                        class="c-button-orange-outline search-postcode-btn"
                      >
                        住所を検索
                      </CButton>
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >都道府県</CFormLabel
                      >
                      <Field
                        name="prefecture_id"
                        v-model="model.prefecture_id"
                        rules="required"
                        class="form-control"
                        placeholder="例）東京都"

                      />
                      <ErrorMessage class="error" name="prefecture_id" />
                    </div>
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >市区郡</CFormLabel
                      >
                      <Field
                        name="city"
                        v-model="model.city"
                        rules="required"
                        class="form-control"
                        placeholder="例）渋谷区"

                      />
                      <ErrorMessage class="error" name="city" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <div class="col-sm-10">
                      <CFormLabel class="col-sm-12" require
                        >番地・建物名・部屋番号まで入力ください</CFormLabel
                      >
                      <Field
                        name="address"
                        v-model="model.address"
                        rules="required"
                        class="form-control"
                        placeholder="例）渋谷町1丁目2-3 渋谷マンション205号室"

                      />
                      <ErrorMessage class="error" name="address" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >電話番号（ハイフンなし）</CFormLabel
                      >
                      <Field
                        name="phone_number"
                        v-model="model.phone_number"
                        rules="required"
                        class="form-control"
                        placeholder="例）08012345678"

                      />
                      <ErrorMessage class="error" name="phone_number" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >職業</CFormLabel
                      >
                      <CFormSelect
                        v-model="model.job"
                        name="job"
                        :options="[
                          '例）会社員',
                          { label: 'One', value: '1' },
                          { label: 'Two', value: '2' },
                          { label: 'Three', value: '3'}
                        ]">
                      </CFormSelect>
                      <ErrorMessage class="error" name="job" />
                    </div>
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >市区郡</CFormLabel
                      >
                      <Field
                        name="city"
                        v-model="model.city"
                        rules="required"
                        class="form-control"
                        placeholder="例）渋谷区"

                      />
                      <ErrorMessage class="error" name="city" />
                    </div>
                  </CRow>







                  <CRow class="mb-2">
                    <CFormLabel class="col-sm-12" require
                      >ユーザー名</CFormLabel
                    >
                    <div class="col-sm-12">
                      <Field
                        name="name"
                        v-model="model.name"
                        rules="required"
                        class="form-control"
                      />
                      <ErrorMessage class="error" name="name" />
                    </div>
                  </CRow>
                  <CRow class="mb-2">
                    <CFormLabel class="col-sm-3 lbl-input" require
                      >ユーザーのメール</CFormLabel
                    >
                    <div class="col-sm-6">
                      <Field
                        name="email"
                        v-model="model.email"
                        rules="required|unique_custom"
                        class="form-control"
                      />
                      <ErrorMessage class="error" name="email" />
                    </div>
                  </CRow>
                  <CRow class="mb-2">
                    <CFormLabel class="col-sm-3 lbl-input" require
                      >パスワード</CFormLabel
                    >
                    <div class="col-sm-6">
                      <Field
                        name="password"
                        type="password"
                        autocomplete="off"
                        v-model="model.password"
                        rules="required|max:15|min:8|password_rule"
                        class="form-control"
                        ref="password"
                      />
                      <ErrorMessage class="error" name="password" />
                    </div>
                  </CRow>
                  <CRow class="mb-2">
                    <CFormLabel class="col-sm-3 lbl-input" require
                      >パスワード確認</CFormLabel
                    >
                    <div class="col-sm-6">
                      <Field
                        name="password_confirmation"
                        type="password"
                        autocomplete="off"
                        v-model="model.password_confirmation"
                        rules="required|confirmed:@password"
                        class="form-control"
                      />
                      <ErrorMessage
                        class="error"
                        name="password_confirmation"
                      />
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
import axios from "axios";

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
  },
  props: ["data"],
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,
      flagShowLoader: false,
      model: {},
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          first_name: {
            required: "ユーザー名を入力してください。",
          },
          last_name: {
            required: "ユーザー名を入力してください。",
          },
          first_name_furigana: {
            required: "ユーザー名を入力してください。",
            is_furigana: "フリガナは全角文字で入力してください",
          },
          last_name_furigana: {
            required: "ユーザー名を入力してください。",
            is_furigana: "フリガナは全角文字で入力してください",
          },
          postcode: {
            required: "ユーザー名を入力してください。",
            max: "最大10文字",
          },
          prefecture_id: {
            required: "ユーザー名を入力してください。",
          },
          city: {
            required: "ユーザー名を入力してください。",
          },
          address: {
            required: "ユーザー名を入力してください。",
          },
          phone_number: {
            required: "ユーザー名を入力してください。",
          },


          email: {
            required: "ユーザーのメールを入力してください。",
            unique_custom: "このメールアドレスは既に登録されています。",
          },
          password: {
            password_rule:
              "パスワードは半角英数字で、大文字、小文字、数字で入力してください",
            required: "パスワードを入力してください。",
            max: "パスワードは15文字以内で入力してください。",
            min: "パスワードは8文字以上で入力してください。",
          },
          password_confirmation: {
            required: "パスワード確認 を入力してください。",
            confirmed: "パスワード確認が入力されたものと異なります。",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });

    let that = this;
    defineRule("unique_custom", (value) => {
      return axios
        .post(that.data.urlCheckEmail, {
          _token: Laravel.csrfToken,
          value: value,
        })
        .then(function (response) {
          return response.data.valid;
        })
        .catch((error) => {});
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
