import {defineStore} from "pinia";

export const useStateStore = defineStore('state', {
    state: () => ({
        isLoading: false,
        showError: false,
        messages: {},
        activeModalId: null,
        isEditing: false,
        isCreating: false,
    }),

    actions: {
        startLoading() {
            this.isLoading = true
        },

        endLoading() {
            this.isLoading = false
        },

        showErrorModal(messages) {
            this.showError = true
            this.messages = messages
        },

        closeErrorModal() {
            this.showError = false
            this.messages = {}
        },

        setActiveModalId(id) {
            this.activeModalId = id
        },

        closeActiveModal() {
            this.activeModalId = null
            this.isEditing = false
        },

        startEditing() {
            this.isEditing = true
        },

        endEditing() {
            this.isEditing = false
        },

        startCreating() {
            this.isCreating = true
        },

        endCreating() {
            this.isCreating = false
        }
    }
})
