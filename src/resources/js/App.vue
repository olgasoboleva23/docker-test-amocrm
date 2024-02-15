<template>
  <div class="d-flex justify-center py-3">
      <v-sheet class="pa-6 pt-0" min-width="350px">
          <h1 class="text-deep-purple-lighten-3 py-2">amoCRM</h1>
          <v-form @submit.prevent="submitHandler">
            <v-text-field
                variant="outlined"
                placeholder="Имя"
                rounded="xl"
                v-model="username"></v-text-field>

            <v-text-field
                variant="outlined"
                :rules="rulesEmail"
                placeholder="Email"
                rounded="xl"
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
                rounded="xl"
                :rules="rulesPrice"
                v-model="price"></v-text-field>

            <v-row justify=center no-gutters>
                <v-btn
                    variant="tonal"
                    @click="btnClickHandler"
                    type="submit"
                    block
                    rounded="xl"
                    class="font-weight-black text-overline"
                    color="deep-purple-lighten-3">Отправить</v-btn>
            </v-row>
          </v-form>
      </v-sheet>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
        username: '',
        email: '',
        phone: '',
        price: null,
        flag: false,
        rulesEmail: [
            (value) => {
                if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) return true
                return 'Email должен быть корректным.'
            },
        ],
        rulesPrice: [
            (value) => {
                if (!String(value).includes('.')) return true
                return 'Должно быть целым.'
            },
        ],
        csrf_token: window.token
    }
  },
  computed: {
    formDisabled() {
      return !this.username || !this.phone || !this.price || !this.email;
    }
  },
  mounted() {
    setTimeout(() => this.flag = true, 30000);
  },
  methods: {
    btnClickHandler(e) {
      if (this.formDisabled) {
        e.preventDefault();
        alert('Заполните все поля!');
      }
    },
    submitHandler() {
      let data = {
                  _token: window.token,
                  username: this.username,
                  email: this.email,
                  phone: this.phone,
                  price: this.price,
                  longer_than_30_sec: this.flag
                 };
      axios.post('/send_api_request', data)
      .then(function (response) {
        alert('Заявка сохранена!');
      })
      .catch(function (error) {
        alert('Ошибка при сохранении.');
      });
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
input {
    padding: 0 20px !important;
}
.vue-tel-input {
    margin-bottom: 22px;
    box-shadow: none!important;
    border-color: rgb(118, 118, 118) !important;
    border-radius: 24px!important;
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
    border-radius: 24px!important;
}
</style>
