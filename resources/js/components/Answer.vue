<script>
    export default {
        props: ['answer'],
        
        data () {
            return {
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache: null
            }
        },
        methods: {
            edit(){
                this.beforeEditCache = this.body;
                this.editing = true;
            },      
            cancel(){
              this.body = this.beforeEditCache;
              this.editing = false;  
            },
             update(){
                 axios.patch(this.endpoint, {
                     body: this.body
                 }).then(res => {
                     //console.log(res);
                     this.editing = false;
                     this.bodyHtml = res.data.body_html;
                     alert(res.data.message);
                 }).catch(err => {
                     swal("Error", err.response.data.message, "error");
                     //console.log();
                 })
             },
             destroy(){
                 swal({
                        title: "Confirm ",
                        text: "are you sure?",
                        icon: "warning",
                        }).then(value => {
                             if (value == true) {
                               axios.delete(this.endpoint).then(
                                res => {
                                    $(this.$el).fadeOut(500, () => {
                                        swal (res.data.message);
                                    })
                                }) 
                            }
                        });
             }

        },
        computed: {
            isInValid () {
                return this.body.length < 10;
            },
            endpoint () {
                return `/questions/${this.questionId}/answers/${this.id}`;
            }
        }
    }  
</script>

