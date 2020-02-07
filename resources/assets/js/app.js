
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('forecast-table', require('./components/ForecastTable.vue'));
Vue.component('dots-loader', require('./components/DotsLoader.vue'));

const app = new Vue({
    el: '#app',
    data: {
        isLoadingData: false,
        isFormVisible: true,
        numberOfStudy: '',
        growthPerMonth: '',
        numberOfMonths: '',
        forecast: [],
    },
    mounted() {
        console.log('App ready.')
    },
    methods: {
        handleSubmit() {
            const params = new URLSearchParams();
            params.append('numberOfStudies', this.numberOfStudy);
            params.append('monthlyGrowth', this.growthPerMonth);
            params.append('monthsHorizon', this.numberOfMonths);

            this.isLoadingData = true;

            fetch(`/stats?${params.toString()}`, {
                method: 'GET',
                headers: {},
            })
            .then(res => res.json())
            .then(forecast => {
                this.forecast = forecast;
                this.isFormVisible = false;
                this.isLoadingData = false;
            }).catch(() => {
                this.isLoadingData = false;
            });

            console.log('Form submit.')
        }
    }
});
