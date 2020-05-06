<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-body flex flex-column">
                        <slot name="body">
                            <div>
                                <p>¿Estás seguro de eliminar este tratamiento?</p>
                            </div>
                            <div class="flex btn-container">
                                <button class="dark-white-btn" @click="$emit('closeModal', true)">Si</button>
                                <button class="dark-white-btn" @click="$emit('closeModal', false)">No</button>
                            </div>
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