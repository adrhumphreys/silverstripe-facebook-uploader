<template>

    <div class="facebook-container">
        <div class="facebook-header">
            <h2>Facebook Photos</h2>
            <button class="facebook-close-button" type="button" @click="$emit('close')">
                Close
            </button>
        </div>

        <div class="facebook-modal-body">
            <div v-if="loading" class="facebook-loading">Loading...</div>

            <div v-else-if="photos" class="facebook-photos">
                <ul class="facebook-photo-list">
                    <li class="facebook-photo-list-item" v-for="photo in photos">
                        <button class="facebook-photo-button" type="button" v-on:click="selectPhoto(photo)">
                            <img v-bind:src="photo.picture">
                        </button>
                    </li>
                </ul>
            </div>

            <div v-else class="facebook-albums">
                <ul class="facebook-album-list">
                    <li v-for="album in albums">
                        <button class="facebook-album-button" type="button" v-on:click="loadAlbum(album.id)">
                            <div class="facebook-album-media">
                                <img v-bind:src="album.cover_photo.picture">
                            </div>
                            <div class="facebook-album-inner">
                                <div class="facebook-album-title">{{album.name}}</div>
                                <div class="facebook-album-subtitle">{{album.count}}</div>
                            </div>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'FacebookModal',
    data() {
      return {
        albums: null,
        loading: true,
        photos: null
      };
    },
    mounted() {
      FB.login((response) => {
        if (response.authResponse) {
          fetch('/facebook/login')
            .then(response => response.json())
            .then(json => this.albums = json.albums.data)
            .then(() => this.loading = false);
        } else {
          console.log('User cancelled login or did not fully authorize.');
        }
      }, { scope: 'user_photos' });
    },
    methods: {
      loadAlbum(id) {
        fetch('/facebook/album?album=' + id)
          .then(response => response.json())
          .then(json => this.photos = json.photos.data);
      },
      selectPhoto(photo) {
        let url = photo.images[0].source;
        this.$emit('selectPhoto', url);
      }
    }
  };
</script>
