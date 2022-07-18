<template>
  <div class="container">
    <div class="fade-in">
      <CRow>
        <CCol :sm="12">
          <CCard>
            <CCardHeader>
              <CFormLabel>詳細をリクエストする</CFormLabel>
            </CCardHeader>
            <!-- body -->
            <CCardBody>
              <CRow class="mb-2">
                <div class="col-sm-3" align="right">名前:</div>
                <div class="col-sm-6">
                  {{ model.name }}
                </div>
              </CRow>

              <CRow class="mb-2">
                <div class="col-sm-3" align="right">市区都:</div>
                <div class="col-sm-6">
                  {{ model.city }}
                </div>
              </CRow>

              <CRow class="mb-2">
                <div class="col-sm-3" align="right">物件価格下限:</div>
                <div class="col-sm-6">
                  {{ model.price_lower }}
                </div>
              </CRow>

              <CRow class="mb-2">
                <div class="col-sm-3" align="right">物件価格上限:</div>
                <div class="col-sm-6">
                  {{ model.price_upper }}
                </div>
              </CRow>

              <CRow class="mb-2">
                <div class="col-sm-3" align="right">利回り:</div>
                <div class="col-sm-6">
                  {{ model.revenue_yield }}
                </div>
              </CRow>

              <CRow class="mb-2">
                <div class="col-sm-3" align="right">築年数:</div>
                <div class="col-sm-6">
                  {{ model.construction_year }}
                </div>
              </CRow>

              <CRow class="mb-2">
                <div class="col-sm-3" align="right">駅徒歩:</div>
                <div class="col-sm-6">
                  {{ model.walkrange }}
                </div>
              </CRow>

              <CRow class="mb-2">
                <div class="col-sm-3" align="right">一言コメント:</div>
                <div class="col-sm-6">
                  {{ model.comment }}
                </div>
              </CRow>

              <CRow class="mb-2">
                <div class="col-sm-3" align="right">会員登録日:</div>
                <div class="col-sm-6">
                  {{ model.created_at }}
                </div>
              </CRow>
            </CCardBody>
            <!-- footer -->
            <CCardFooter>
              <div class="col-md-12 text-center btn-box">
                <a :href="data.urlEdit" class="btn btn-success btn-w-100">
                  キャンセル
                </a>
                <a :href="data.urlBack" class="btn btn-default btn-w-100">
                  キャンセル
                </a>
              </div>
            </CCardFooter>
          </CCard>
        </CCol>
      </CRow>
    </div>
    <loader :flag-show="flagShowLoader"></loader>
  </div>
</template>

<script>
import Loader from "../../common/loader";

export default {
  components: {
    Loader,
  },
  props: ["data"],
  data: function () {
    return {
      flagShowLoader: false,
      model: {
        name: this.data.request.name,
        city: this.data.request.city,
        price_lower: this.data.request.price_lower,
        price_upper: this.data.request.price_upper,
        revenue_yield: this.data.request.revenue_yield,
        construction_year: this.data.request.construction_year,
        walkrange: this.data.request.walkrange,
        comment: this.data.request.comment,
        created_at: this.data.request.created_at,
      },
    };
  },
};
</script>
