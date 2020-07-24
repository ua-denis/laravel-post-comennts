import Vue from 'vue';
import Vuex from 'vuex';
import Axios from "axios";

Vue.use(Vuex);

export  default  new Vuex.Store({
    state: {
        comments: [],
        dialog: false,
        dialogTitle: '',
        dialogBtnTxt: '',
        dialogInputCommentId: '',
        dialogInputParentId: '',
        dialogCommentEdit: false
    },
    getters:{
        getComments(state){
            return state.comments;
        },
        getDialogModal(state){
            return state.dialog;
        },
        getDialogTitle(state){
            return state.dialogTitle;
        },
        getDialogBtnTxt(state){
            return state.dialogBtnTxt;
        },
        getDialogInputCommentId(state){
            return state.dialogInputCommentId;
        },
        getDialogInputParentId(state){
            return state.dialogInputParentId;
        },
        getDialogCommentEdit(state){
            return state.dialogCommentEdit;
        }
    },
    mutations:{
        setDialogModal(state, opened){
            state.dialog = opened;
        },
        setDialogBtnTxt(state, text){
            state.dialogBtnTxt = text;
        },
        setDialogTitle(state, title){
            state.dialogTitle = title;
        },
        setDialogInputCommentId(state, id){
            state.dialogInputCommentId = id;
        },
        setDialogInputParentId(state, id){
            state.dialogInputParentId = id;
        },
        setDialogCommentEdit(state, edit){
            state.dialogCommentEdit = edit;
        },
        setAllComments(state, comments){
            state.comments = comments;
        },
        pushComment(state, comment){
            state.comments.push(comment);
        },
        updateComment(state, comment){
            let update_el_index = state.comments.map(function(e) { return e.id; }).indexOf(comment.id);

            state.comments.splice(update_el_index, 1, comment);
        },
    },
    actions:{
        getCommentsFromApi: function({commit}, {param, callback_func}) {
            Axios(param)
                .then(function(comments){
                    commit(callback_func, comments.data.data);
                    return comments.data.data;
                });
        }
    },
});
