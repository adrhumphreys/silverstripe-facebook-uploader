import Vue from 'vue'
import FacebookUploader from './FacebookUploader'

let name = document.getElementById('facebook-uploader').getAttribute('name');

new Vue({
    el: '#facebook-uploader',
    template: '<FacebookUploader v-bind:name="name"/>',
    components: { FacebookUploader },
    data() {
        return {name: name}
    }
})
