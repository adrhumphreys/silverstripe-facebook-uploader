<template>
    <div id="facebook-uploader">
        <button id="show-modal" v-if="!showModal" @click="showModal = true" type="button">Upload from Facebook</button>
        <FacebookModal v-if="showModal" @close="showModal = false" @selectPhoto="selectPhoto"/>
        <div class="facebook-image-selected" v-if="photoURL">
            <p>Image selected:</p>
            <img v-bind:src="photoURL">
        </div>
        <input type="hidden" v-bind:name="name" v-bind:value="photoURL">
    </div>
</template>

<script>
  import FacebookModal from './components/FacebookModal.vue'

  export default {
    props: ['name'],
    data: function () {
      return {
        showModal: false,
        photoURL: null
      }
    },
    components: {
      FacebookModal
    },
    methods: {
      selectPhoto(url) {
        this.photoURL = url;
        this.showModal = false;
      }
    }
  }
</script>
