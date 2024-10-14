<template>
    <div class="dialog-overlay">
        <div class="dialog">
            <h3>Ошибка!</h3>
            <ul v-for="message in messages">
                <li>{{ message[0] }}</li>
            </ul>
            <button @click="stateStore.closeErrorModal()">Закрыть</button>
        </div>
    </div>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";

export default {
    name: "ErrorModal",

    setup() {
        const stateStore = useStateStore()
        return {stateStore}
    },

    props: [
        'messages'
    ]
}
</script>

<style scoped>
.dialog-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Dim background */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999; /* Ensures it appears on top */
}

.dialog {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* Light shadow around the modal */
    z-index: 100000; /* Ensures it stays above the overlay */
    animation: fadeIn 0.3s ease-in-out; /* Smooth fade-in animation */
    display: flex;
    flex-direction: column;
    gap: 25px;
    font-size: 20px;
}

.dialog h3 {
    margin-top: 0;
    font-size: 1.5rem;
    text-align: center;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
