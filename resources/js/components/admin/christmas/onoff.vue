<template>
    <input type="checkbox" id="christmass-switch" name="christmass-switch" v-model="checked" v-on:click="onoff"/>
</template>
<script>
    export default {
        data: function() {
            return {
                checked: null,
                bodyElement: document.querySelector("body")
            }
        },
        methods: {
            checkStorage() {
                return !!localStorage.getItem("christmas");
            },
            onoff(event) {
                if (event.target.checked) {
                    if (!this.bodyElement.classList.contains('christmas')) {
                        this.bodyElement.classList.add("christmas");
                        this.controlStorageChristmas();
                    }
                } else {
                    if (this.bodyElement.classList.contains('christmas')) {
                        this.bodyElement.classList.remove("christmas");
                        this.controlStorageChristmas();
                    }
                }
            },
            controlStorageChristmas() {
                if (this.bodyElement.classList.contains('christmas')) {
                    localStorage.setItem("christmas", true);
                } else {
                    localStorage.removeItem("christmas");
                }
            }
        },
        mounted() {
            this.checked = this.checkStorage();
        }
    }
</script>