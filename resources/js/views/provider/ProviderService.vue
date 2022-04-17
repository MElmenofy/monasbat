<template>
  <div>
    <breadcrumb-component :sectionName="'Service List'" :homeName="this.$route.meta.label"  />
    <section class="our-service our-service-lists mar-top mar-bot editors service-card-box"  data-iq-gsap="onStart" data-iq-position-y="70" data-iq-rotate="0" data-iq-trigger="scroll" data-iq-ease="power.out" data-iq-opacity="0">
      <div class="container">
        <service-list :providerid="$route.params.provider_id" />
      </div>
    </section>
  </div>
</template>
<script>
export default {
  name: "providerService"
};
</script>