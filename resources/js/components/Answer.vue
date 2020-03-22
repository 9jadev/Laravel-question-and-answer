<template>
    <div class="media post">
        <vote :model="answer" name="answer"></vote>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea class="form-control" v-model="body" rows="10" required></textarea>
                </div>

                <button class="btn btn-outline-secondary" :disabled="isInValid"> Update </button>
                <button class="btn btn-outline-secondary" @click="cancel" type="button" Cancel> Cancel </button>
            </form>
           <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                            <a v-if="authorize('modify', answer)" @click.prevent="edit" class="btn btn-sm btn-outline-info"> Edit</a>                  
                            <button v-if="authorize('modify', answer)" @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                        
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <user-info :model="answer" label="Answered"></user-info>
                    </div>
                </div>
           </div>  
        </div>
    </div>
</template>
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

