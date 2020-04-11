<template>
    <form :action="this.route" @submit="formSubmit" method="post">
        <div class="alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
        <div class="alert alert-danger" ref="alertError" v-show="alertError"></div>
        <div class="tr" ref="treatmentEditable">
            <input type="date" v-model="treatment.date" class="td form-control" name="date" :readonly="!this.new" />
            <textarea v-model="treatment.description" class="td form-control" name="description" :readonly="!this.new"></textarea>
            <input v-model="treatment.id" type="hidden" name="id" />
            <input v-model="treatment.patient_id" type="hidden" name="patient_id" />
            <span class="edit-icon" data-target="treatmentEditable" v-on:click="edit">edit</span>
            <span class="delete-icon" v-on:click="openModal">delete</span>
            <button type="submit" v-show="showBtn">Guardar</button>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['routes', 'treatmentData', 'index'],
        data: function() {
            return {
                new: this.treatmentData.new,
                showBtn: false,
                alertSuccess: false,
                alertError: false,
                route: this.treatmentData.new ? this.routes.add : this.routes.edit,
                treatment: {
                    id: this.treatmentData.id,
                    date: this.treatmentData.date,
                    description: this.treatmentData.description,
                    patient_id: this.treatmentData.patient_id
                }
            }
        },
        methods: {
            edit(event) {
                let target = event.target.getAttribute('data-target');
                let wrapper = this.$refs[target];

                if (wrapper !== undefined) {
                    for (let i = 0; i < wrapper.children.length; i++) {
                        let elmt = wrapper.children[i];

                        if (elmt.hasAttribute('readonly')) elmt.removeAttribute('readonly');
                        if (elmt.hasAttribute('disabled')) elmt.removeAttribute('disabled');
                        elmt.focus();
                    }
                }
                this.showBtn = true;
            },
            remove() {
                axios
                    .post(this.routes.delete, this.treatment)
                    .then(function (response) {})
            },
            openModal() {
                this.$emit('openModal', this)
            },
            formSubmit(event) {
                event.preventDefault();
                let self = this;

                axios.post(event.target.getAttribute('action'), this.treatment)
                    .then(function (response) {
                        self.new = false;
                        self.route = self.routes.edit;
                        self.showBtn = false;

                        //if new form has been saved and page haven't been reloaded, it needs id for edit.
                        if (self.treatment.id === null || self.treatment.id === undefined && response.success === true)
                            self.treatment.id = response.data.id;

                        let inputs = event.target.querySelectorAll('input, textarea');
                        for (let i = 0; i < inputs.length; i++) inputs[i].setAttribute('readonly', true);

                        self.$refs.alertSuccess.innerText = response.data.message;
                        self.alertSuccess = true;
                        setTimeout(() => self.alertSuccess = false, 3000);
                    })
                    .catch(function (error) {
                        let data = error.response.data;
                        if (data.error) {
                            self.$refs.alertError.innerText = data.message;
                            self.alertError = true;
                            setTimeout(() => self.alertError = false, 5000);
                        }
                    });
            }
        },
        created() {
            this.showBtn = this.new
        }
    }
</script>