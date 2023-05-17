<template>
    <edit-render :path_param="['queuing', 'ticket']" :model="model">
        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.number" label="Number" id="number" type="text" validation="required" />
            </div>
            <div class="col-md-6">
                <FormKit label="Attendant" button_label="Select Attendant" id="attendant_id" type="recordselect"
                    comp_url="queuing/admin/attendant/list.vue" :setting="setting.attendant_id" v-model="model.attendant_id"
                    validation="required" />
            </div>
        </div>


    </edit-render>
</template>

<script>
export default {
    data() {
        return {
            id: null,
            setting: {
                attendant_id: {
                    path_param: ["queuing", "attendant"],
                    fields: ['name', 'slug'],
                    template: '[name] - [slug]',
                },
            },
            model: {
                id: "",
                number: "",
                attendant_id: "",
            },

        };
    }
};
</script>
