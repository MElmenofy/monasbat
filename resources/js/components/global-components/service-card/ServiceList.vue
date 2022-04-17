<template>
<div class="row">
  <div class="col-lg-12">
    <div v-if="serviceList.length > 0" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 list-inline">
      <div class="col" v-for="(data, index) in serviceList" :key="index">
        <div class="card">
          <div class="iq-image position-relative">
            <router-link
              :to="{
                name: 'service-detail',
                params: { service_id: data.id },
              }"
            >
              <div class="img">
                <img v-if="data.attchment_extension"
                  :src="data.attchments[0] ? data.attchments[0] : baseUrl+'/images/default.png'"
                  alt="image"
                  class="img-fluid w-100  "
                />
                <img v-else
                  :src="baseUrl+'/images/file.png'"
                  alt="image"
                  class="img-fluid w-100  "
                />
              </div>
            </router-link>
          <Favorite :servicedata="data.id" :favorited="data.is_favourite" @service-list="getCategoryService"></Favorite>
            <span class="badge badge-2 bg-primary">{{ data.price_format }}</span>
            <span class="badge badge-1 rounded-pill bg-primary badge-category" data-bs-toggle="tooltip" data-bs-placement="top" :title="data.name"
              >{{ data.name }}
            </span>
          </div>
          <div class="card-body">
            <div class="content-title mb-3">
              <p class="para-ellipsis short-description mb-0 text-dark">
                {{ data.description }}
              </p>
            </div>
            <div
              class="d-flex justify-content-between align-items-center flex-wrap"
            >
              <div>
                <img
                  :src="data.provider_image"
                  alt="image"
                  class="img-fluid avatar avatar-40 avatar-rounded"
                />
                <span class="ms-1">{{ data.provider_name }}</span>
              </div>
              <div>
                <span class="badge-position">
                  <i class="fas fa-star text-primary"></i>
                  <span class="ms-1">{{ data.total_rating }}</span
                ></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="row">
        <img :src=" baseUrl +'/images/frontend/data_not_found.png'"  />
    </div>
  </div>
</div>
</template>
<script>
import Favorite from "../favorite/favorite.vue";
import {get} from '../../../request'
import { mapGetters } from "vuex";
export default {
  name: "ServiceList",
  props: {
    categoryid: { type: Number },
    providerid: { type: Number },
    is_featured:{ type: Boolean},
    is_all_service:{type: Boolean}
  },
  components: {
    Favorite,
  },
  computed: {
    ...mapGetters(['category','provider']),
  },
  data() {
    return {
      filterData: {},
      serviceList: [],
      favourite: [],
      baseUrl:window.baseUrl,
      checkedNames: [],
    };
  },
  mounted() {
    this.getCategoryService();
  },
  methods: {
    getCategoryService(filterData='') {
      var  params = {
        per_page: 8,
        customer_id: this.$store.state.user ? this.$store.state.user.id : 0
      }
      if(this.categoryid || this.providerid ){
        params = {
          category_id: this.categoryid,
          provider_id: this.providerid,
          customer_id: this.$store.state.user ? this.$store.state.user.id : 0,
          per_page: 'all'
        }
      }
      if(this.is_featured == true){
        params = {
          is_featured: 1,
          per_page: 4
        }
      }
      if(this.is_all_service == true){
         params = {
          per_page: 'all'
        }
      }
      if(filterData != '' ){
        var params ={
          category_id:filterData.category_id.id,
          provider_id:filterData.provider_id.id,
          search:filterData.keyword,
          is_rating:filterData.is_rating,
          per_page: 'all'
        }
      }
      get("service-list", {
        params: params
      })
      .then((response) => {
        this.serviceList = response.data.data;
      });
    }
  },
};
</script>
