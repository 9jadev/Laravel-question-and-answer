export default {
    data() {
        return {
            editing: false
        }
    },   
    methods: {
        edit () {
            this.setEditCache();
            this.editing = true;
        },
        cancel () {
            this.restoreFromCache();
            this.editing = false;
        },   
        setEditCache () {},
        restoreFromCache () {}
    }
 }    