<template>
    <v-app>
        <div class="w-100">
            <v-form
                ref="formMain"
                id="mainForm"
                v-model="valid"
                lazy-validation
                @submit.prevent="commentCreate"
            >
                <v-text-field
                    v-model="name"
                    :rules="nameRules"
                    label="Name"
                    name="name"
                    outlined
                    required
                ></v-text-field>
                <v-textarea
                    v-model="comment"
                    :rules="commentRules"
                    outlined
                    name="comment"
                    label="Comment"
                    required
                ></v-textarea>
                <input type="hidden" name="commentId" :value=getDialogInputCommentId >
                <input type="hidden" name="parentId" value >
                <v-btn
                    color="success"
                    class="mr-4"
                    type="submit"
                >
                    Create Comment
                </v-btn>
            </v-form>
            <div class="comments-bl mt-5">
                <comments
                    :comment="comment"
                    :post-id="comment.post_id"
                    v-for="comment in this.get_comments(null)"
                    :key="comment.id"
                />
            </div>
            <v-row justify="center comment-form-modal">
                <v-dialog v-model="DialogModal" scrollable max-width="600px" width="90%" min-width="300px">
                    <v-card>
                        <v-card-title>{{getDialogTitle}}</v-card-title>
                        <v-btn icon @click="modale(false)">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-divider></v-divider>
                        <v-card-text style="height: 300px;">
                            <v-form
                                ref="formDialog"
                                v-model="modalFormValid"
                                class="mt-3"
                                id="dialogForm"
                                lazy-validation
                                @submit.prevent="commentModalEvent"
                            >
                                <v-text-field
                                    v-model="modalName"
                                    :rules="nameModalRules"
                                    label="Name"
                                    name="name"
                                    outlined
                                    required
                                ></v-text-field>
                                <v-textarea
                                    v-model="modalComment"
                                    :rules="commentModalRules"
                                    outlined
                                    name="comment"
                                    label="Comment"
                                    required
                                ></v-textarea>
                                <input type="hidden" name="commentId" :value=getDialogInputCommentId >
                                <input type="hidden" name="parentId" :value=getDialogInputParentId >
                            </v-form>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn
                                color="success"
                                class="mr-4"
                                type="submit"
                                form="dialogForm"
                            >
                                {{getDialogBtnTxt}}
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        </div>
    </v-app>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from "vuex";
    import comments from './Comments'

    export default {
        data(){
            return{
                valid: true,
                modalFormValid: true,
                name: '',
                modalName: '',
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length >= 2) || 'Name must be more than 2 characters',
                ],
                nameModalRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length >= 2) || 'Name must be more than 2 characters',
                ],
                comment: '',
                modalComment: '',
                commentRules: [
                    v => !!v || 'Comment is required',
                    v => (v && v.length >= 1) || 'Comment must be more than 1 characters',
                ],
                commentModalRules: [
                    v => !!v || 'Comment is required',
                    v => (v && v.length >= 1) || 'Comment must be more than 1 characters',
                ],
            }
        },
        props: [
            'postId'
        ],
        components: {
            comments,
        },
        computed:{
            ...mapGetters([
                'getComments',
                'getDialogModal',
                'getDialogTitle',
                'getDialogBtnTxt',
                'getDialogInputCommentId',
                'getDialogInputParentId',
                'getDialogCommentEdit'
            ]),
            DialogModal:{
                get(){
                    if (this.getDialogModal && this.getDialogCommentEdit){
                        this.modalName = this.comments_by_id(this.getDialogInputCommentId)['name'];
                        this.modalComment = this.comments_by_id(this.getDialogInputCommentId)['comment'];
                    }
                    return this.getDialogModal;
                },
                set(input){
                    if (!input){
                        this.modalName = '';
                        this.modalComment = '';
                        this.$store.commit('setDialogInputCommentId', '');
                        this.$store.commit('setDialogInputParentId', '');
                        this.$store.commit('setDialogCommentEdit', false);
                    }
                    this.$store.commit('setDialogModal', input);
                }
            },
            get_comments(){
                return (id) => {
                    return this.getComments.filter(function (item) {
                        return item.parent_id === id;
                    });
                };
            },
        },
        mounted() {
            let param = {
                method: 'POST',
                url: '/api/post/comments',
                data: {
                    post_id: this.postId
                }
            };
            let callback_func = 'setAllComments';
            this.$store.dispatch('getCommentsFromApi', {param: param, callback_func: callback_func});

            /*axios(param)
                .then((comments) => {
                    this.$store.commit(callback_func, comments.data.data);

                    return comments.data.data;
                });*/
        },
        methods: {
            ...mapActions([
                'getCommentsFromApi'
            ]),
            ...mapGetters([
                'getComments',
                'getDialogModal',
                'getDialogTitle',
                'getDialogBtnTxt',
                'getDialogInputCommentId',
                'getDialogInputParentId',
                'getDialogCommentEdit'
            ]),
            ...mapMutations([
                'setAllComments',
                'setDialogModal',
                'pushComment',
                'updateComment',
                'setDialogBtnTxt',
                'setDialogTitle',
                'setDialogInputCommentId',
                'setDialogInputParentId',
                'setDialogCommentEdit'
            ]),
            modale(show){
                if (!show){
                    this.modalName = '';
                    this.modalComment = '';
                    this.$store.commit('setDialogInputCommentId', '');
                    this.$store.commit('setDialogInputParentId', '');
                    this.$store.commit('setDialogCommentEdit', false);
                }
                this.$store.commit('setDialogModal', show);
            },
            comments_by_id(id){
                return this.getComments.filter(function (item) {
                    return item.id === id;
                })[0];

            },
            commentCreate (event) {
                event.preventDefault();
                if (event.target.getAttribute('id') == 'mainForm' && this.$refs.formMain.validate()){
                    let data = new FormData(event.target);
                    let param = {
                        method: 'POST',
                        url: '/api/post/comment/create',
                        data: {
                            post_id: this.postId,
                            name: data.get('name'),
                            comment: data.get('comment'),
                            parent_id: this.getDialogInputCommentId ? this.getDialogInputCommentId : null
                        }
                    };
                    let callback_func = 'pushComment';
                    this.$store.dispatch('getCommentsFromApi', {param: param, callback_func: callback_func});
                    this.$store.commit('setDialogInputCommentId', '');
                    this.$store.commit('setDialogInputParentId', '');
                    this.name = '';
                    this.comment = '';
                    /*this.name = '';
                    this.comment = '';*/
                }
            },
            commentModalEvent (event) {
                event.preventDefault();

                if (event.target.getAttribute('id') == 'dialogForm' && this.$refs.formDialog.validate()){
                    let data = new FormData(event.target);

                    let param = {
                        method: 'POST',
                        url: '/api/post/comment/create',
                        data: {
                            post_id: this.postId,
                            name: data.get('name'),
                            comment: data.get('comment'),
                            parent_id: this.getDialogInputCommentId ? this.getDialogInputCommentId : null,
                        }
                    };
                    let callback_func = 'pushComment';

                    if (this.getDialogCommentEdit){
                        param = {
                            method: 'PUT',
                            url: '/api/post/comment/update',
                            data: {
                                id: this.getDialogInputCommentId,
                                post_id: this.postId,
                                name: data.get('name'),
                                comment: data.get('comment'),
                                parent_id: this.getDialogInputParentId
                            }
                        };
                        callback_func = 'updateComment';
                    }

                    this.$store.dispatch('getCommentsFromApi', {param: param, callback_func: callback_func});

                    this.$store.commit('setDialogInputCommentId', '');
                    this.$store.commit('setDialogInputParentId', '');
                    this.modale(false);
                    /*this.modalName = '';
                    this.modalComment = '';*/
                }
            }
        },
    }
</script>
<style>
    body{
        background-color: #ffffff;
    }
    .v-text-field--outlined .primary--text{
        color: #1867c0 !important;
        caret-color: #1867c0 !important;
    }
    .error--text {
        color: #ff5252 !important;
        caret-color: #ff5252 !important;
    }
    .v-text-field--outlined.v-input--is-focused fieldset{
        border-color: #1867c0;
    }
    .v-textarea.v-text-field--enclosed .v-text-field__slot {
        margin-right: -12px;
    }
    .v-text-field--outlined fieldset {
        padding-left: 8px;
    }
    .v-text-field .v-label {
        transform-origin: top left;
    }
    .success {
        background-color: #4caf50 !important;
        border-color: #4caf50 !important;
    }
    .comments-bl > .comment-wrap{
        margin-left: 0 !important;
    }
</style>
