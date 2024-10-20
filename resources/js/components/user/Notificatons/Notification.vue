<template>
    <div class="notification">
        {{ message }}
    </div>
</template>


<script>
export default {
    name: "Notification",

    props: [
        'message'
    ]
}
</script>

<style scoped>
.notification {
    position: sticky;
    width: 250px;
    padding: 10px 15px;
    text-align: center;
    border: 3px solid #3c342e;
    border-radius: 20px;
    background-color: #6f6861;
    color: #fffdf5;
    animation: fadeIn .5s;
    box-shadow: 5px 5px 15px 0 rgba(0, 0, 0, 0.5);
}
</style>
