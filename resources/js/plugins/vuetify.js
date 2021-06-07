import Vue from 'vue';
import Vuetify from 'vuetify';
// import 'vuetify/dist/vuetify.min.css'
import DatetimePicker from 'vuetify-datetime-picker'
import  colors  from 'vuetify/lib/util/colors';
// (Optional) import 'vuetify-datetime-picker/src/stylus/main.styl'


Vue.use(Vuetify)

Vue.use(DatetimePicker)
const vuetify =  new Vuetify({
    theme: {
        dark: true
    }
})

export default vuetify
