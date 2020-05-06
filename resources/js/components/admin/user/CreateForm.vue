<template>
    <div class="row separator">
        <div class="col-md-4 col-xs-12 box center_box">
            <form :action="route" @submit="formSubmit" ref="form" method="post" >
                <div class="new_user_container">
                    <h2>Usuario</h2>
                    <div class="col-12 alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
                    <div class="col-12 alert alert-danger" ref="alertError" v-show="alertError"></div>
                    <div class="form__group flex flex-baseline">
                        <input type="text" v-model="user.name" id="name" class="form__field form-required" name="name" placeholder="Nombre"/>
                        <label class="form__label" for="name">Nombre</label>
                    </div>
                    <div class="form__group flex flex-baseline">
                        <input type="email" v-model="user.email" id="email" class="form__field form-required" name="email" placeholder="Email"/>
                        <label class="form__label" for="email">Email</label>
                    </div>
                    <div class="form__group flex flex-baseline flex-row">
                        <input type="password" v-model="user.password" ref="password" id="password" class="form__field form-required" name="password" placeholder="Contraseña"/>
                        <label class="form__label" for="password">Contraseña</label>
                        <button type="button" class="dark-white-btn-icon" v-on:mousedown="showPassword('password')" v-on:mouseup="hidePassword('password')">
                            <font-awesome-icon :icon="passwordIcon" v-on:mousedown="showPassword('password')" v-on:mouseup="hidePassword('password')" />
                        </button>
                    </div>
                    <div class="form__group flex flex-baseline">
                        <select v-model="user.role" class="form__field form-required" name="role" id="role">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <label class="form__label" for="role">Rol</label>
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
    import FormValidator from '../../generic/mixins/FormValidator';

    export default {
        props: ['route'],
        data: function() {
            return {
                alertSuccess: false,
                alertError: false,
                passwordIcon: 'eye',
                user: {
                    name: null,
                    email: null,
                    password: null,
                    role: 'general'
                },
                selectOptions: [
                    {text: 'General', value: 'general'},
                    {text: 'Administrador', value: 'administrator'},
                ],
            }
        },
        methods: {
            formSubmit(event) {
                event.preventDefault();
                let self = this;

                if (FormValidator.methods.validate(this.$refs.form)) {
                    axios.post(event.target.getAttribute('action'), this.user)
                        .then(function (response) {
                            console.log(response)
                            if (response.data.error) {
                                self.$refs.alertError.innerHTML = response.data.message;
                                self.alertError = true;
                                setTimeout(() => self.alertError = false, 3000);
                            } else {
                                self.$refs.alertSuccess.innerText = response.data.message;
                                self.alertSuccess = true;
                                setTimeout(() => self.alertSuccess = false, 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                }
            },
            showPassword(dataTarget) {
                let elmt = this.$refs[dataTarget];

                if (elmt !== undefined) {
                    elmt.setAttribute('type', 'text');
                    this.passwordIcon = 'eye-slash';
                }
            },
            hidePassword(dataTarget) {
                let elmt = this.$refs[dataTarget];

                if (elmt !== undefined) {
                    elmt.setAttribute('type', 'password')
                    this.passwordIcon = 'eye';
                }
            }
        }
    }
</script>
