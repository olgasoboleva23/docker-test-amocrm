import './bootstrap';

import {createApp} from 'vue'
import App from './App.vue'

import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/vue-tel-input.css';

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'

const vuetify = createVuetify()

createApp(App).use(vuetify).use(VueTelInput).mount('#app')
