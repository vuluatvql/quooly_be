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
                class="h-adr"
              >
                <Field type="hidden" :value="csrfToken" name="_token" />
                <span class="p-country-name" style="display:none;">Japan</span>
                <CCardHeader>
                  <CFormLabel>ユーザー詳細_編集画面</CFormLabel>
                </CCardHeader>
                <CCardBody>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >姓名</CFormLabel
                    >
                    <div class="col-sm-3">
                      <Field
                        name="first_name"
                        v-model="model.first_name"
                        rules="required|max:255"
                        class="form-control"

                      />
                      <ErrorMessage class="error" name="first_name" />
                    </div>
                    <div class="col-sm-3">
                      <Field
                        name="last_name"
                        v-model="model.last_name"
                        rules="required|max:255"
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
                        rules="required|is_furigana|max:255"
                        class="form-control"
                        placeholder="例）やまだ"

                      />
                      <ErrorMessage class="error" name="first_name_furigana" />
                    </div>
                    <div class="col-sm-3">
                      <Field
                        name="last_name_furigana"
                        v-model="model.last_name_furigana"
                        rules="required|is_furigana|max:255"
                        class="form-control"
                        placeholder="例）太郎"
                      />
                      <ErrorMessage class="error" name="last_name_furigana" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >ユーザーのメール</CFormLabel
                    >
                    <div class="col-sm-6">
                      <Field
                        name="email"
                        v-model="model.email"
                        rules="required|unique_custom|email|max:255"
                        class="form-control"
                      />
                      <ErrorMessage class="error" name="email" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >パスワード</CFormLabel
                    >
                    <div class="col-sm-6">
                      <Field
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        v-model="model.password"
                        rules="required|max:15|min:8|password_rule"
                        class="form-control"
                        ref="password"
                      />
                      <ErrorMessage class="error" name="password" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >パスワード確認</CFormLabel
                    >
                    <div class="col-sm-6">
                      <Field
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
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
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >郵便番号（ハイフンなし）</CFormLabel
                    >
                    <div class="col-sm-3">
                      <Field
                        name="postcode"
                        v-model="model.postcode"
                        rules="required|max:10"
                        class="form-control p-postal-code"
                        placeholder="例）01234567"

                      />
                      <input type="hidden" name="pRegionId" class="p-region-id" ref="adr_preg">
                      <input type="hidden" name="pLocality" class="p-locality p-street-address" ref="adr_addr01">
                      <input type="hidden" name="pExtendedAddress" class="p-extended-address" ref="adr_addr02">
                      <ErrorMessage class="error" name="postcode" />
                    </div>
                    <div class="col-sm-3">
                      <CButton
                        class="c-button-orange-outline search-postcode-btn"
                        v-on:click="getPostCode"
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
                      <CFormSelect
                        name="prefecture_id"
                        v-model="model.prefecture_id"
                        rules="required|max:255"
                        class=""
                        :options="data.prefectures">
                      </CFormSelect>
                      <ErrorMessage class="error" name="prefecture_id" />
                    </div>
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >市区郡</CFormLabel
                      >
                      <Field
                        name="city"
                        v-model="model.city"
                        rules="required|max:255"
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
                        rules="required|max:255"
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
                        rules="required|telephone"
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
                        v-model="model.company_industry_type"
                        name="company_industry_type"
                        :options="data.industryTypes">
                      </CFormSelect>
                      <ErrorMessage class="error" name="company_industry_type" />
                    </div>
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >業種</CFormLabel
                      >
                      <CFormSelect
                        v-model="model.jobs_type"
                        name="jobs_type"
                        :options="data.jobTypes">
                      </CFormSelect>
                      <ErrorMessage class="error" name="jobs_type" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >生年月日</CFormLabel
                    >
                    <div class="col-sm-6">
                      <Datepicker 
                        v-model="model.birthday" 
                        name="birthday"
                        format="yyyy/MM/dd"
                        rules="required"
                        autoApply
                        :maxDate="new Date()"
                        placeholder="0000年/00月/00日"
                      >
                      </Datepicker>
                      <ErrorMessage class="error" name="birthday" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >家賃収入*1</CFormLabel
                      >
                      <div class="d-flex">
                        <CFormInput 
                          type="number"
                          name="rent_income"
                          v-model="model.rent_income"
                          min="0"
                          rules="required|number|min:0"
                          class="form-control w-75 mr-2"
                          placeholder=""
                        /> <span class="mt-2 pl-2">&nbsp;&nbsp;万円</span>
                      </div>
                      <ErrorMessage class="error" name="rent_income" />
                    </div>
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >世帯年収（家賃収入込み）*2</CFormLabel
                      >
                      <div class="d-flex">
                        <CFormInput 
                          type="number"
                          name="annual_income"
                          v-model="model.annual_income"
                          rules="required|number|min:0"
                          min="0"
                          class="form-control w-75 mr-2"
                          placeholder=""
                        /> <span class="mt-2 pl-2">&nbsp;&nbsp;万円</span>
                      </div>
                      <ErrorMessage class="error" name="annual_income" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <div class="col-sm-4">
                      <CFormLabel class="col-sm-12" require
                        >不動産購入のための自己資金</CFormLabel
                      >
                      <div class="d-flex">
                        <CFormInput 
                          type="number"
                          name="user_income"
                          v-model="model.user_income"
                          rules="required|number|min:0"
                          min="0"
                          class="form-control w-75 mr-2"
                          placeholder=""
                        /> <span class="mt-2 pl-2">&nbsp;&nbsp;万円</span>
                      </div>
                      <ErrorMessage class="error" name="user_income" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >保有物件（一棟）</CFormLabel
                      >
                      <CFormSelect
                        v-model="model.property_building"
                        name="property_building"
                        :options="data.propertyBuilding">
                      </CFormSelect>
                      <ErrorMessage class="error" name="property_building" />
                    </div>
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >保有物件（区分）</CFormLabel
                      >
                      <CFormSelect
                        v-model="model.property_division"
                        name="property_division"
                        :options="data.propertyDivision">
                      </CFormSelect>
                      <ErrorMessage class="error" name="property_division" />
                    </div>
                    <div class="col-sm-3">
                      <CFormLabel class="col-sm-12" require
                        >保有物件（戸建賃貸）</CFormLabel
                      >
                      <CFormSelect
                        v-model="model.property_kodate_chintai"
                        name="property_kodate_chintai"
                        :options="data.propertyKodateChintai">
                      </CFormSelect>
                      <ErrorMessage class="error" name="property_kodate_chintai" />
                    </div>
                  </CRow>
                  <CRow class="mb-4">
                    <hr style="width: 97%; margin: auto;">
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >お気に入り物件が値下げされたときのメール配信</CFormLabel
                    >
                    <div class="col-sm-3" v-for="(item, index) in data.mailNoti" :key="index">
                      <div class="d-flex mail-flg-box">
                        <input 
                          type="radio"
                          name="mail_magazine_flag"
                          :id="'mail_magazine_flag_'+item.id"
                          v-model="model.mail_magazine_flag"
                          class="mr-2 cformcheck-ip form-check-input"
                          :value="item.id"
                        /> <span class="mt-2 pl-2">&nbsp;&nbsp;<label :for="'mail_magazine_flag_'+item.id">{{ item.label }}</label></span>
                      </div>
                    </div>
                    <ErrorMessage class="error" name="mail_magazine_flag" />
                  </CRow>
                  <CRow class="mb-4">
                    <CFormLabel class="col-sm-12" require
                      >お住まいのエリアで開催されるセミナーのメール通知（週1回配信）</CFormLabel
                    >
                    <div class="col-sm-3" v-for="(item, index) in data.mailNoti" :key="index">
                      <div class="d-flex mail-flg-box">
                        <input 
                          type="radio"
                          name="request_noti_flag"
                          :id="'request_noti_flag_'+item.id"
                          v-model="model.request_noti_flag"
                          class="mr-2 cformcheck-ip form-check-input"
                          :value="item.id"
                        /> <span class="mt-2 pl-2">&nbsp;&nbsp;<label :for="'request_noti_flag_'+item.id">{{ item.label }}</label></span>
                      </div>
                    </div>
                    <ErrorMessage class="error" name="request_noti_flag" />
                  </CRow>
                  <CRow class="mb-2">
                    <hr style="width: 97%; margin: auto;">
                  </CRow>
                  <CRow class="mb-4 p-3">
                    <CButton
                        class="c-button-orange-outline search-postcode-btn m-auto pd-26"
                      >
                      登録情報は、問合せするまで不動産会社に開示されません。
                    </CButton>
                  </CRow>
                  <CRow>
                    <div class="col-md-12 btn-box">
                      <CButton type="submit" class="btn-primary btn-action btn-w-100 pt-1">
                        保存する
                      </CButton>
                      <a :href="data.urlBack" class="btn btn-secondary size-btn-cancel text-white btn-w-100">
                        ユーザー情報を削除(退会)
                      </a>
                    </div>
                  </CRow>
                </CCardBody>
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
import { ref } from 'vue';

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
      model: {
        mail_magazine_flag: 1,
        request_noti_flag: 1,
      },
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          first_name: {
            required: "ユーザー名を入力してください。",
            max: "255文字を超えて入力しないでください。"
          },
          last_name: {
            required: "ユーザー名を入力してください。",
            max: "255文字を超えて入力しないでください。"
          },
          first_name_furigana: {
            required: "ユーザー名を入力してください。",
            is_furigana: "フリガナは全角文字で入力してください",
            max: "255文字を超えて入力しないでください。"
          },
          last_name_furigana: {
            required: "ユーザー名を入力してください。",
            is_furigana: "フリガナは全角文字で入力してください",
            max: "255文字を超えて入力しないでください。"
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
            max: "255文字を超えて入力しないでください。"
          },
          company_industry_type: {
            required: "ユーザー名を入力してください。",
          },
          jobs_type: {
            required: "ユーザー名を入力してください。",
          },
          address: {
            required: "ユーザー名を入力してください。",
            max: "255文字を超えて入力しないでください。"
          },
          phone_number: {
            required: "ユーザー名を入力してください。",
            telephone: "ユーザー名を入力してください。",
            max: "255文字を超えて入力しないでください。"
          },
          birthday: {
            required: "ユーザー名を入力してください。",
          },
          rent_income: {
            required: "ユーザー名を入力してください。",
            number: "ユーザー名を入力してください。",
            min: '0未満は入力しないでください。'
          },
          annual_income: {
            required: "ユーザー名を入力してください。",
            number: "ユーザー名を入力してください。",
            min: '0未満は入力しないでください。'
          },
          user_income: {
            required: "ユーザー名を入力してください。",
            number: "ユーザー名を入力してください。",
            min: '0未満は入力しないでください。'
          },
          email: {
            required: "ユーザーのメールを入力してください。",
            unique_custom: "このメールアドレスは既に登録されています。",
            email: 'メールが無効になります。',
            max: "255文字を超えて入力しないでください。"
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
    getPostCode() {
      this.model.prefecture_id = this.$refs.adr_preg.value;
      this.model.city = this.$refs.adr_addr01.value;
      this.model.address = this.$refs.adr_addr02.value;
    }
  },
};
</script>
