Nova.booting((Vue, router) => {
    Vue.component('index-meta', require('./components/IndexField'));
    Vue.component('detail-meta', require('./components/DetailField'));
    Vue.component('form-meta', require('./components/FormField'));
})
