<template>
  <h1 class="text-deep-purple-lighten-3">amoCRM test</h1>
  <div class="d-flex justify-center py-3">
      <v-sheet min-width="300px" class="bg-transparent">
          <v-form method="post" action="/send_api_request">
            <v-text-field
                variant="outlined"
                placeholder="Имя"
                v-model="name"></v-text-field>

            <v-text-field
                variant="outlined"
                :rules="rulesEmail"
                placeholder="Email"
                v-model="email"></v-text-field>

            <vue-tel-input
                v-model="phone"
                defaultCountry="ru"
                invalidMsg="Неверный номер телефона."
                :inputOptions="{placeholder: 'Телефон'}"
                :dropdownOptions="{disabled: true}"
                mode="national"></vue-tel-input>

            <v-text-field
                variant="outlined"
                type="number"
                placeholder="Цена"
                v-model="price"></v-text-field>

            <v-row justify=center no-gutters>
                <v-btn
                    variant="outlined"
                    @click="btnClickHandler"
                    type="submit"
                    block
                    rounded="xl"
                    color="deep-purple-lighten-3">Отправить</v-btn>
            </v-row>
          </v-form>
      </v-sheet>
  </div>
</template>
<script>
//import axios from 'axios';

export default {
  data() {
    return {
        name: '',
        email: '',
        phone: '',
        price: null,
        rulesEmail: [
            (value) => {
                if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) return true
                return 'Email должен быть корректным.'
            },
        ],
    }
  },
  computed: {
    formDisabled() {
      return !this.name || !this.phone || !this.price || !this.email;
    }
  },
  methods: {
    btnClickHandler(e) {
      if (this.formDisabled) {
        e.preventDefault();
        alert('Заполните все поля!');
      }
    }
  }
}
</script>
<style>
h1 {
    text-align: center;
}
.vue-tel-input .vti__dropdown {
    display: none;
}
.vue-tel-input .vti__input {
    height: 56px;
}
.vue-tel-input {
    margin-bottom: 22px;
    box-shadow: none!important;
    border-color: rgb(118, 118, 118) !important;
}
.vue-tel-input:focus-within {
    border-width: 2px!important;
    border-color: black !important;
}
input::placeholder {
  color: grey !important;
  opacity: 0.7 !important;
}
html {
    background: #DCEDC8;
}
input {
    background: #EDE7F6 !important;
    border-radius: 2px!important;
}
</style>
