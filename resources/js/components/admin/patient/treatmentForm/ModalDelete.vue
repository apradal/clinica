<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container" :style=this.css>
                    <slot name="close"/>
                    <div class="modal-body flex flex-column">
                        <slot name="body"/>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['styles'],
        data: function() {
            return {
                css: ''
            }
        },
        methods: {
            prepareStyles() {
                //foreach Json
                Object.entries(this.styles).forEach(([key, value]) => {
                    this.css += key + ':' + value + ';';
                });
            }
        },
        mounted() {
            if (this.styles !== undefined) this.prepareStyles();
        }
    }
</script>