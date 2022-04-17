<template>
<div>
<breadcrumb-component :homeName="'Category List'" :sectionName="this.$route.meta.label" />
 <section class="our-category our-category-lists" data-iq-gsap="onStart" data-iq-position-y="70" data-iq-rotate="0" data-iq-trigger="scroll" data-iq-ease="power.out" data-iq-opacity="0">
    <div class="container">
      <div v-if="category.length > 0" class="row">
        <div class="mar-top mar-bot category-box">
          <ul class="row row-cols-2 row-cols-lg-3 row-cols-xl-4 list-inline">
            <li class="col mb-4" v-for="(data, index) in category" :key="index">
              <router-link :to="{
                name: 'category-service',
                params: { category_id: data.id },
              }">
                <div class="card mb-0 bg-soft-primary circle-clip-effect bg-img undefined">
                    <div class="card-body service-card undefined">
                        <img :src="data.category_image" alt="image" class="img-fluid " :style="[data.category_extension === 'svg'? {'background-color':  data.  color} : '']"> 
                    </div>                                
                </div>
                </router-link>
                <div class="card-body category-content undefined text-center">
                    <h5 class="categories-name">
                        {{ data.name }}
                    </h5>
                     <p class="category-desc mb-0"> {{ data.description | desc_limit(70) }}</p>
                     <a href="#" @click="opendesc(data.description)" v-if="data.description?data.description.length>70:false">{{__('messages.load_more')}}</a>
                </div>
            </li>
            <b-modal ref="desc" title="Description">
              <p class="my-4">{{description}}</p>
            </b-modal>
          </ul>
        </div>
      </div>
        <div v-else class="row">
          <img :src="baseUrl+'/images/frontend/data_not_found.png'"  />
        </div>
    </div>
 </section>
</div>
</template>
<script>
import {get} from '../../request'
export default {
  name: "Categories",
  data() {
    return {
      category: [],
      baseUrl:window.baseUrl,
      description:''
    };
  },
  mounted() {
    this.getCategory();
  },
  filters: {
  desc_limit: function (value, size) {
    if (!value) return '';
  value = value.toString();

  if (value.length <= size) {
    return value;
  }
  return value.substr(0, size) + '...';
  }
}, 
  methods: {
    getCategory() {
      get("category-list", {
        params: {
          per_page: "all",
        },
      }).then((response) => {
        this.category = response.data.data;
      });
    },
    opendesc(desc) {
      this.show=true
      this.$refs.desc.show();
      this.description=desc
    },
  },
};
</script>