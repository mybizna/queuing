<template>
    <edit-render :path_param="['queuing', 'ticket']" :model="model">
        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.number" label="Number" id="number" type="text" validation="required" />
            </div>
            <div class="col-md-6">
                <FormKit v-model="model.attendant_id" label="Attendant" id="attendant_id" type="text" validation="required" />
            </div>
        </div>


    </edit-render>
</template>

<script>
export default {
    data () {
        return {
            id: null,
            model: {
                id: "",
                number: "",
                attendant_id: "",
            },

        };
    }
};
</script>
