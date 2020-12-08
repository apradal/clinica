<template>
    <div>
        <label for="christmass-switch">Modo Navidad</label>
        <input type="checkbox" id="christmass-switch" name="christmass-switch" v-model="checked" v-on:click="onoff"/>
    </div>
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
            checkCookie() {
                if (parseInt(this.getCookie('is_christmas')) === 1) {
                    return true;
                } else {
                    return false;
                }
            },
            onoff(event) {
                if (event.target.checked) {
                    if (!this.bodyElement.classList.contains('christmas')) {
                        this.bodyElement.classList.add("christmas");
                        this.setCookie('is_christmas', 1, 30)
                    }
                } else {
                    if (this.bodyElement.classList.contains('christmas')) {
                        this.bodyElement.classList.remove("christmas");
                        this.setCookie('is_christmas', 0, 30)
                    }
                }
            },
            getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            },
            setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
        },
        mounted() {
            this.checked = this.checkCookie();
        }
    }
</script>