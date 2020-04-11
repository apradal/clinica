<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-body">
                        <slot name="body">
                            <p>¿Estás seguro de eliminar este tratamiento?</p>
                            <button class="modal-default-button" @click="$emit('closeModal', true)">Si</button>
                            <button class="modal-default-button" @click="$emit('closeModal', false)">No</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
    }
</script>