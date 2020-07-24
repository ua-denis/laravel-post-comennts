<template>
    <div class="comment-wrap ml-3 my-3">
        <div class="comment">
            <div class="comment-head">
                <span class="name font-weight-bold">{{this.comment.name}}</span>
                <span class="date">{{dateFormat(this.comment.created_at)}}</span>
            </div>
            <div class="comment-body">{{this.comment.comment}}</div>
            <v-btn
                color="success"
                class="mr-4"
                small
                @click="modale(true, comment.id, comment.parent_id, false)"
                @click="dialogBtnTxt('create comment')"
                @click="dialogTitle('create comment')"
            >
                Reply
            </v-btn>

            <v-btn
                color="success"
                class="mx-2"
                fab
                x-small
                outlined
                @click="modale(true, comment.id, comment.parent_id, true)"
                @click="dialogBtnTxt('edit comment')"
                @click="dialogTitle('Edit comment')"
            >
                <v-icon>mdi-pencil</v-icon>
            </v-btn>

            <v-btn
                color="success"
                class="mx-2"
                fab
                x-small
                outlined
                @click="deleteComment(comment.id)"
            >
                <v-icon>mdi-delete</v-icon>
            </v-btn>
        </div>
        <comments
            v-for="replies in this.get_comments( this.comment.id )"
            :key="replies.id"
            :comment="replies"
            :post-id="replies.post_id"
        />
    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from "vuex";

    export default {
        name: 'comments',
        props: [
            'postId',
            'comment'
        ],
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
            get_comments(){
                return (id) => {
                    return this.getComments.filter(function (item) {
                        return item.parent_id === id;
                    });
                };
            },
        },
        methods: {
            ...mapActions([
                'getCommentsFromApi'
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
            modale(show, commentId, parentId, edit){
                this.$store.commit('setDialogModal', show);
                this.$store.commit('setDialogInputCommentId', commentId);
                this.$store.commit('setDialogInputParentId', parentId);
                this.$store.commit('setDialogCommentEdit', edit);
            },
            dialogBtnTxt(btnTxt){
                this.$store.commit('setDialogBtnTxt', btnTxt);
            },
            dialogTitle(title){
                this.$store.commit('setDialogTitle', title);
            },
            dateFormat(date) {
                if (date){
                    let date_format = new Date(date);
                    let year = date_format.getFullYear();
                    let month = (1 + date_format.getMonth()).toString().padStart(2, '0');
                    let day = date_format.getDate().toString().padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }
                return;
            },
            deleteComment(commentId){
                let param = {
                    method: 'DELETE',
                    url: '/api/post/comment/delete',
                    data: {
                        post_id: this.postId,
                        id: commentId,
                    }
                };
                let callback_func = 'setAllComments';
                this.$store.dispatch('getCommentsFromApi', {param: param, callback_func: callback_func});
            },
        },
        mounted() {

        },
    }
</script>

<style scoped>

</style>
