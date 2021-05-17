import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
import DatetimePicker from 'vuetify-datetime-picker'
// (Optional) import 'vuetify-datetime-picker/src/stylus/main.styl'


import colors from 'vuetify/lib/util/colors'
Vue.use(Vuetify);
Vue.use(DatetimePicker)

export default new Vuetify({
    icons: {
        iconfont: 'md' || 'fa'
    },
    theme: {
        dark: true
    },
});
