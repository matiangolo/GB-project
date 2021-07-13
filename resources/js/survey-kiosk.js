window.Vue = require('vue').default;
window.axios = require('axios').default;

Vue.mixin(require('./helpers'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Register new component within main file
Vue.component('photo-booth', require('./components/PhotoBooth.vue').default);
Vue.component('reward-form', require('./components/RewardForm.vue').default);
Vue.component('feedback-form', require('./components/FeedBackForm.vue').default);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('animation-test', require('./components/AnimationExample.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        showLeftForm: false,
        showRightForm: false,
        timer: null,
        config: {
            delay: (1000 * 5),
        },
        answer: null,
        questionError: false,
    },
    computed: {
        showExitButton(){
            // if(this.questionError === false && (this.showLeftForm === true || this.showRightForm === true)) {
            //     return true;
            // } else {
            //     return false;
            // }
            //Shorthand
            return this.questionError === false && (this.showLeftForm || this.showRightForm);
        }
    },
    methods: {
        photoBoothItemClicked(answer) {
            //--||
            this.showLeftForm = true;
            if (this.timer == null) this.timer = setTimeout(this.hideForms, this.config.delay);
            this.answer = answer;


        },
        formSubmitted(data) {
            let clientClientAnswer = {
                "answer": this.answer,
                "email": data.email,
                "address": data.address,
                "street": data.street,
                "houseNr": data.houseNr,
                "postCode": data.postCode
            }
            // //--||Returns/register the answer to the database
            axios.post('/api/survey-questions/question-of-the-day/1', {answer: clientClientAnswer})
                .then(response => {
                    console.log(response)
                })
                .catch(err => console.error(err));
        },
        qrCodeButtonClicked() {
            //--||
            this.showRightForm = true;
            if (this.timer == null) this.timer = setTimeout(this.hideForms, this.config.delay);
        },
        resetTimer() {
            //--||
            clearTimeout(this.timer);
            this.timer = setTimeout(this.hideForms, this.config.delay);
        },
        hideForms() {
            //--||
            clearTimeout(this.timer);
            this.timer = null;
            this.showRightForm = false;
            this.showLeftForm = false;
        },
    }
});

//Global code comes here !!!!!
// Example code:
console.log("Survey kiosk javascript loaded");

