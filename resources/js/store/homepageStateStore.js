import {defineStore} from "pinia";

export const useHomepageStateStore = defineStore('homepageState', {
    state: () => ({
        notifications: [],
    }),

    actions: {
        addNotification(message) {
            this.notifications.push(message)

            setTimeout(() => {
                this.notifications.shift()
            }, 2500)
        },
    }
})

