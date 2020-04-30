<template>
    <div class="row separator">
        <div class="col-md-4 col-xs-12 box center_box">
            <form :action="route" @submit="formSubmit" ref="form" method="post" >
                <div class="new_user_container">
                    <h2>Usuario</h2>
                    <div class="form__group flex flex-baseline" ref="emailEditable">
                        <input type="text" v-model="user.name" id="name" class="form__field" name="name" placeholder="Nombre"/>
                        <label class="form__label" for="name">Nombre</label>
                    </div>
                    <div class="form__group flex flex-baseline" ref="emailEditable">
                        <input type="email" v-model="user.email" id="email" class="form__field" name="email" placeholder="Email"/>
                        <label class="form__label" for="email">Email</label>
                    </div>
                    <div class="form__group flex flex-baseline" ref="emailEditable">
                        <input type="text" v-model="user.password" id="password" class="form__field" name="password" placeholder="Contraseña"/>
                        <label class="form__label" for="password">Contraseña</label>
                    </div>
                    <button type="submit" class="dark-white-btn-icon">
                        Crear <font-awesome-icon icon="plus-circle" />
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['route'],
        data: function() {
            return {
                user: [],
            }
        },
        methods: {

        }
    }
</script>
