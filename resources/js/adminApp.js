// require('./bootstrap');
import { createApp } from "vue";
import CoreuiVue from "@coreui/vue";
import { configure, defineRule } from "vee-validate";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
configure({
    validateOnBlur: false,
    validateOnChange: false,
    validateOnInput: true,
    validateOnModelUpdate: false,
});
const app = createApp({});
app.use(CoreuiVue);
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
app.use(VueSweetalert2);

defineRule('password_rule', value => {
    return /^[A-Za-z0-9]*$/i.test(value);
});

defineRule('is_furigana', value => {
    return /^[ぁ-ん]+$/i.test(value);
});
defineRule('telephone', value => {
    return /^0(\d-\d{4}-\d{4})+$/i.test(value.trim()) ||
      /^0(\d{3}-\d{2}-\d{4})+$/i.test(value.trim()) ||
      /^(070|080|090|050)(-\d{4}-\d{4})+$/i.test(value.trim()) ||
      /^0(\d{2}-\d{3}-\d{4})+$/i.test(value.trim())
});

import BtnDeleteConfirm from "./components/common/btnDeleteConfirm.vue";
import DataEmpty from "./components/common/dataEmpty.vue";
import PopupAlert from "./components/common/popupAlert.vue";
import LimitPageOption from "./components/common/limitPageOption.vue";
import UserCreate from "./components/admin/user/create.vue";
import UserEdit from "./components/admin/user/edit.vue";
import ContactEdit from "./components/admin/contact/edit.vue";

app.component("btn-delete-confirm", BtnDeleteConfirm);
app.component("data-empty", DataEmpty);
app.component("popup-alert", PopupAlert);
app.component("limit-page-option", LimitPageOption);
app.component("user-create", UserCreate);
app.component("user-edit", UserEdit);
app.component("contact-edit", ContactEdit);
app.component('Datepicker', Datepicker);

app.mount("#app");
